App.controller('AttendanceAdjustmentController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		
		//TRANSLATE DATA FROM MAIN PAGE
		$scope.fromDate = $('#AdjustmetTable caption h3').attr('fromdate');
		$scope.toDate = $('#AdjustmetTable caption h3').attr('todate');
		$scope.empno = $('#AdjustmetTable caption h3').attr('empno');
		$scope.empname =  $('#AdjustmetTable caption h3').text();
		$http.get('/DTR/attendances/data/'+$scope.fromDate+'/'+$scope.toDate+'/'+$scope.empno+'/'+$scope.empname).success(function(response) {
			$scope.data = response;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				$scope.editingData[$scope.data[i].attendances.id] = false;
			});
		});	
	}
	
	//MODIFY BUTTON EVENT HANDLER
	$scope.modify = function(data){		
		$scope.editingData[data.attendances.id] = true;
    };

	//SAVE BUTTON EVENT HANDLER
    $scope.update = function(data){
		$http({
			method: 'POST',
			url: '/DTR/attendances/update/'+$scope.fromDate+'/'+$scope.toDate,
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.data = response.data;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				 $scope.editingData[$scope.data[i].attendances.id] = false;
			});
		});
    };
});

//REFERNCE FOR UPDATING TABLE DATA
//http://plnkr.co/edit/Z0zNB1Dm04T4OnaouJYx?p=preview