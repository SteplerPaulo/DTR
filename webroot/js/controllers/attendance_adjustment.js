App.controller('AttendanceAdjustmentController',function($scope,$rootScope,$http){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 5;
		
		var myDate = new Date();
		var year = myDate.getFullYear();
		var month = myDate.getMonth() + 1;
		if(month <= 9) month = '0'+month;
		
		$scope.date = year +'-'+ month;
		$scope.empno = $('#AdjustmetTable caption h3').attr('empno');
		$scope.empname =  $('#AdjustmetTable caption h3').text();

		$http.get('/DTR/attendances/data/'+$scope.empno+'/'+$scope.empname+'/'+$scope.date).success(function(response) {
			$scope.data = response;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				 $scope.editingData[$scope.data[i].attendances.id] = false;
			});

		});	
	}

	$scope.modify = function(data){		
		$scope.editingData[data.attendances.id] = true;
    };


    $scope.update = function(data){
		$http({
			method: 'POST',
			url: '/DTR/attendances/update/',
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