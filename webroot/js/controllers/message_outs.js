App.controller('MessageOutController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		
		$http.get("/DTR/message_outs/all").success(function(response) {
		
			$scope.outbox = response;
			
			console.log(response)
		});
	}
});2