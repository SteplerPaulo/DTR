App.controller('DataNotFoundReportController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 10;
		
		//GET ALL CATEGORIES
		$http.get("/DTR/attendances/checking").success(function(response) {
			$scope.data = response;
			console.log(response);
			
		});
	}
});