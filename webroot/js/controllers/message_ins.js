App.controller('MessageInController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/message_ins/all").success(function(response) {
		
			$scope.inbox = response;
			
			console.log(response)
		});
	}
});2