App.controller('ContactListController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/contacts/all").success(function(response) {
		
			$scope.contacts = response;
			
			console.log(response)
		});
	}
});