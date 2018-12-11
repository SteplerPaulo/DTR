App.controller('SPSSMSSENDING',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.students = [];
		$scope.th =  true;
		$scope.list =  false;
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		//$scope.start_time = '06:45:00';
		$scope.filters = {'2':'Absent','3':'Late'};
		
		
		
		$http.get("/DTR/rfid_studattendances/sps_init_data").success(function(levels) {
			$scope.levels = levels;
		});
	}
	
	$scope.getData = function(level,date){
		//level = '7';
		//date = '2018-03-16';
		if(level && date){
			$http.get("/DTR/rfid_studattendances/sps_data/"+level+'/'+date).success(function(result) {
				if(result){
					$scope.students = result;
					$scope.updateRemarks();
				}	
			});
		}
	}
	
	$scope.updateRemarks = function(){
		console.log($scope.students);
		$.each($scope.students, function(i,o) {
			if(!o.RfidStudattendance.is_posted){
				//console.log(o.RfidStudattendance.is_posted);
				if(o.RfidStudattendance.time_in <= o.RfidStudattendance.start_time){
					$scope.students[i].RfidStudattendance.remarks='P';
					$scope.students[i].RfidStudattendance.remark_name='Present';
				}else if(o.RfidStudattendance.time_in > o.RfidStudattendance.start_time){
					$scope.students[i].RfidStudattendance.remarks='L';
					$scope.students[i].RfidStudattendance.remark_name='Late';
				}else{
					$scope.students[i].RfidStudattendance.remarks='A';
					$scope.students[i].RfidStudattendance.remark_name='Absent';
				}
			}
			
		});	
		
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
	
	//SEND BUTTON
	$scope.send = function () {
		var data = JSON.parse(angular.toJson($scope.students))
		console.log(data);
		//return;
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_studattendances/sps_sms_posting',
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
