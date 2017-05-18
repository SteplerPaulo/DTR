App.controller('ResetRFIDController',function($scope,$rootScope,$http,$filter){

	//INITIALIZATION
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		
		$http.get("/DTR/rfid_students/reset_initial_data").success(function(response) {
			$scope.levels = response.levels;
			$scope.sections = response.sections;
			
			if($scope.level ==  undefined || $scope.level ==  'undefined'){
				$scope.level = '';
			}
			
			if($scope.section ==  undefined || $scope.section ==  'undefined'){
				$scope.section = '';
			}
		});
		
		$http.get("/DTR/rfid_students/reset_data").success(function(response) {
			$scope.data = response;
			//console.log(response);
		});
	}
	
	$scope.go = function(){
		console.log($scope.filteredData);
	

		$http({
			method: 'POST',
			url: '/DTR/rfid_students/reset_this',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data: $.param({data:$scope.filteredData})
		}).then(function(response){
			$scope.initializeController();
		});
		
	}
	


	

	
});