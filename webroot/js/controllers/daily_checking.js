App.controller('DailyCheckingController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.students = [];
		$scope.th =  true;
		$scope.list =  false;
		$scope.filters = {'1':'Present','2':'Absent','3':'Late'};
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.sendsms = true;
		
		$http.get("/DTR/rfid_studattendances/daily_checking_init_data").success(function(sections) {
			$scope.sections = sections;
		});
	}
	
	$scope.getData = function(section,date){
		//section = '15';
		//date = '2018-03-16';
		
		$http.get("/DTR/rfid_studattendances/daily_checking_data/"+section+'/'+date).success(function(result) {
			console.log(result);
			if(result){
				$scope.students = result;
				$http.get("/DTR/rfid_studattendances/get_section_sched/"+section).success(function(response) {
					console.log(response);
					if(response){
						$scope.start_time = response.Schedule.start_time;
						$scope.updateRemarks();
					}
				});
			}
			
		});
	}
	
	//UPDATE REMARK BASE ON TIME IN SCHEDULE
	$scope.updateRemarks = function(){
		$.each($scope.students, function(i,o) {
			if(!o.RfidStudattendance.is_posted){
				if(o.RfidStudattendance.time_in <= $scope.start_time){
					$scope.students[i].RfidStudattendance.remarks='P';
					$scope.students[i].RfidStudattendance.remark_name='Present';
				}else if(o.RfidStudattendance.time_in > $scope.start_time){
					$scope.students[i].RfidStudattendance.remarks='L';
					$scope.students[i].RfidStudattendance.remark_name='Late';
				}else{
					$scope.students[i].RfidStudattendance.remarks='A';
					$scope.students[i].RfidStudattendance.remark_name='Absent';
				}
			}
		});	
	}
	
	//LIST & GRID STYLE TOGGLE
	$scope.viewStyle = function(viewStyle){
		if(viewStyle == 'th'){
			$scope.th =  true;
			$scope.list =  false;
			return;
		}
		$scope.th =  false;
		$scope.list =  true;
	}
	
	//CHANGE STUDENT ATTENDANCE REMARK
	$scope.remark = function(i,rem,rem_name){
		$scope.students[i].RfidStudattendance.remarks = rem;
		$scope.students[i].RfidStudattendance.remark_name = rem_name;
		$scope.students[i].RfidStudattendance.status = 'Edited';
		console.log($scope.students[i]);
	}
	
	//POST BUTTON
	$scope.post = function () {
		var data = JSON.parse(angular.toJson($scope.students))
		
		//SAVE REMARKS
		$http({
			method: 'POST',
			url: '/DTR/rfid_studattendances/daily_checking_posting',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			if(response.data.status && !$scope.sendsms){
				$scope.initializeController();
			}
			alert(response.data.message);
		});
		
		//SEND SMS
		if($scope.sendsms){
			$http({
				method: 'POST',
				url: '/DTR/rfid_studattendances/send_sms',
				data: $.param({data:data}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				if(response.data.status){
					$scope.initializeController();
				}
				alert(response.data.message);
			});
		}			
				
				
	};

	
});