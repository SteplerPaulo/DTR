App.controller('PrintSectionMonthlyReport',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.date = $filter("date")(Date.now(), 'yyyy-MM');
		$http.get("/DTR/rfid_studattendances/sections").success(function(sections) {
			$scope.sections = sections;
			console.log($scope.sections);
		});
	}
});