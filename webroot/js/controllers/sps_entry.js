App.controller('DailyCheckingController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.remarks = {'1':'Present','2':'Absent','3':'Late'};
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		$scope.preventDoubleClick = false;
		
		
		$http.get("/DTR/rfid_studattendances/daily_checking_init_data").success(function(sections) {
			$scope.sections = sections;
		});
	}
	
	
	
	//SEND MESSAGE EVENT HANDLER
	$scope.save = function(){	
		$scope.preventDoubleClick = true;
		
		var data = {
			"RfidStudattendance":{
				"student_number":$scope.studno,
				"date":$scope.date,
				"remarks":$scope.remark,
				"reason":$scope.reason,
				"is_posted":true,
			}
			
		};
		
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_studattendances/sps_entry_saving',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			alert(response.data.message);
			window.location.href = "/DTR/rfid_studattendances/sps_entry";
		});
	
	};
	
});