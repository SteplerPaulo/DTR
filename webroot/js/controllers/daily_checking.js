App.controller('DailyCheckingController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.th =  true;
		$scope.list =  false;
		$scope.filters = {'1':'Present','2':'Absent'};
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM-dd');
		
		$http.get("/DTR/rfid_studattendances/daily_checking_init_data").success(function(response) {
			$scope.sections = response;
		});
	}
	
	$scope.getData = function(section,date){
			
		$http.get("/DTR/rfid_studattendances/daily_checking_data/"+section+'/'+date).success(function(response) {
			$scope.students = response;
			console.log(response);
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
	
});