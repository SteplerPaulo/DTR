App.controller('SectionController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/sections/all").success(function(response) {
			$scope.sections = response;
			console.log(response);
		});
	}
});