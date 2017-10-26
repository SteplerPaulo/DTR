App.controller('CalendarController',function($scope,$rootScope,$http,$filter){

	$scope.initializeController = function(){
		$scope.preventDoubleClick = false;
		
		
		$http.get("/DTR/school_calendars/index_init_data").success(function(o){
			$scope.school_years = o.school_years;
			//$scope.levels = o.levels;
			$scope.sy = $scope.school_years[0];
			
			$scope.changeSY();
		});
	}
	
	
	$scope.changeSY =  function(){
		
		$http.get("/DTR/school_calendars/sy_data").success(function(response){
			console.log(response);
			$scope.data = response;
		});
	}

});
