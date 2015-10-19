App.controller('ReportController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/employees").success(function(response) {
			$scope.data = response;
			console.log(response);
			
		});
	}
});