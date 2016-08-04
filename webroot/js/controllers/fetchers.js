App.controller('FetchersController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/fetchers/all").success(function(response) {
		
			$scope.fetchers = response;
			console.log(response);
		});
	}
});