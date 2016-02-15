App.controller('StudentListController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/rfid_students/students").success(function(response) {
		
			$scope.students = response;
		});
	}
});