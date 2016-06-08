App.controller('Student201Controller',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/student201s/all").success(function(response) {
		
			$scope.students = response;
			console.log(response);
		});
	}
});