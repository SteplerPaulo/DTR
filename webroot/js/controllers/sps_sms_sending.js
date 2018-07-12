App.controller('SPSSMSSENDING',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.students = [];
		$scope.th =  true;
		$scope.list =  false;
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.start_time = '06:45:00';
		$scope.late = 'Late';
		$scope.absent = 'Absent';
		
		
		$http.get("/DTR/rfid_studattendances/sps_init_data").success(function(levels) {
			$scope.levels = levels;
		});
	}
	
	$scope.getData = function(level,date){
		//level = '7';
		date = '2018-03-16';
		
		$http.get("/DTR/rfid_studattendances/sps_data/"+level+'/'+date).success(function(result) {
			if(result){
				$scope.students = result;
				$scope.updateRemarks();
			}
					
		});
	}
	
	
	$scope.updateRemarks = function(){
		$.each($scope.students, function(i,o) {
			if(!o.RfidStudattendance.remarks){
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
		console.log($scope.students);
	}
	
	
	
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
		$scope.students[i].RfidStudattendance.status = 'Edited';
		console.log($scope.students[i]);
	}
	
	//POST BUTTON
	$scope.post = function () {
		var data = JSON.parse(angular.toJson($scope.students))
		//console.log(data);
		//return;
		
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_studattendances/daily_checking_posting',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			console.log(response);
			if(response.data.status){
				$scope.initializeController();
			}
			alert(response.data.message);
		});
		
		
	};

	
});