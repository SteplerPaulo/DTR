App.controller('SchedulesController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.pageSize = 10;
		
		$http.get("/DTR/schedules/init_data").success(function(response) {
			$scope.schedules = response;
		});
	}

});

