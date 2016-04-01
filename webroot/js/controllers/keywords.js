App.controller('KeywordListController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/keywords/all").success(function(response) {
		
			$scope.keywords = response;
			
			console.log(response)
		});
	}
});