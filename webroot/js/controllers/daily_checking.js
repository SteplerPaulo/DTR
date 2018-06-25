App.controller('DailyCheckingController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.students = [];
		$scope.th =  true;
		$scope.list =  false;
		$scope.filters = {'1':'Present','2':'Late','3':'Absent'};
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		
		$http.get("/DTR/rfid_studattendances/daily_checking_init_data").success(function(response) {
			$scope.sections = response;
		});
	}
	
	$scope.getData = function(section,date){
		$scope.students = [];
		$http.get("/DTR/rfid_studattendances/daily_checking_data/"+section+'/'+date).success(function(response) {
			$scope.students = response;
			console.log(response);
			
		})
		$http.get("/DTR/rfid_studattendances/get_section_schedule/"+section).success(function(response) {
				$scope.start_time = response.Schedule.start_time;
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
	
	//CHANGE STUDENT ATTENDANCE REMARK
	$scope.remark = function(i,rem,rem_name){
		$scope.students[i].RfidStudattendance.remarks = rem;
		$scope.students[i].RfidStudattendance.remark_name = rem_name;
		console.log($scope.students[i]);
	}
	
	//POST BUTTON
	$scope.post = function () {
		$.ajax({
			url: '/DTR/rfid_studattendances/daily_checking_posting',
			dataType:'json',
			data:{'data':$scope.students},
			type:'post',
		}).done(function( response ) {
			if(response.status){
				$scope.initializeController();
			}
			alert(response.message);
		});
	};

	
});