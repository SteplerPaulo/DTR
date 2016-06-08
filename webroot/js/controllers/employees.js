App.controller('EmployeesController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/employees/all").success(function(response) {
		
			$scope.students = response;
			console.log(response);
		});
	}
});