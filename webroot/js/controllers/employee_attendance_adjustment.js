App.controller('AttendanceAdjustmentController',function($scope,$rootScope,$http,$uibModal, $log, $document){

	$rootScope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 15;
		
		//TRANSLATE DATA FROM MAIN PAGE
		$rootScope.fromDate = $('#AdjustmetTable caption h3').attr('fromdate');
		$rootScope.toDate = $('#AdjustmetTable caption h3').attr('todate');
		$rootScope.empno = $('#AdjustmetTable caption h3').attr('empno');
		$rootScope.empname =  $('#AdjustmetTable caption h3 #EmployeeName').text();
		$http.get('/DTR/attendances/data/'+$scope.fromDate+'/'+$scope.toDate+'/'+$scope.empno+'/'+$scope.empname).success(function(response) {
			$rootScope.data = response;
		});	
		
		$http.get('/DTR/attendances/remarks').success(function(response) {	
			$rootScope.remarks = response;
		});	
		
	}
	
	$rootScope.open = function (data,size, parentSelector) {
		var parentElem = parentSelector ? 
			angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
		var modalInstance = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'myModalContent.html',
			controller: 'ModalInstanceCtrl',
			controllerAs: '$ctrl',
			size: size,
			appendTo: parentElem,
			resolve: {
				EmployeeData: function () {
					return data;
				}
			}
		});

	};
	
	//DELETE BUTTON EVENT HANDLER
	$scope.Delete = function(data){		
		$http({
			method: 'POST',
			url: '/DTR/admin/attendances/delete/'+$scope.fromDate+'/'+$scope.toDate,
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$rootScope.initializeController();
			
		
		});
    };

	//POST BUTTON EVENT HANDLER
	$scope.Post = function(data){
		console.log(data);
		$http({
			method: 'POST',
			url: '/DTR/admin/attendances/posting/'+$scope.fromDate+'/'+$scope.toDate,
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.data = response.data;
			$scope.editingData = [];
			$.each($scope.data,function(i,o){
				 $scope.editingData[$scope.data[i].attendances.id] = false;
			});
		});
	}

});

App.directive('ngConfirmClick', [
	function(){
		return {
			link: function (scope, element, attr) {
				var msg = attr.ngConfirmClick || "Are you sure?";
				var clickAction = attr.confirmedClick;
				element.bind('click',function (event) {
					if ( window.confirm(msg) ) {
						scope.$eval(clickAction)
					}
				});
			}
		};
}]);

App.controller('ModalInstanceCtrl', function ($rootScope,$uibModalInstance, EmployeeData,$filter) {
	
	var $ctrl = this;
	$ctrl.active = false;
	$ctrl.o = EmployeeData;
	$ctrl.TimeInDate = new Date(EmployeeData.attendances.date +' '+EmployeeData.attendances.timein);
	$ctrl.TimeOutDate = new Date(EmployeeData.attendances.date +' '+EmployeeData.attendances.timeout);
	$ctrl.AttendanceId = EmployeeData.attendances.id;
	$ctrl.EmployeeNumber = EmployeeData.attendances.employee_number;
	$ctrl.SelectedRemark = EmployeeData.attendances.remarks;
	

	$ctrl.on = function() { 
		 $ctrl.active = true;
	}
	
	$ctrl.off = function() { 
		$ctrl.AttendanceForm.$valid = $ctrl.active = false;
	}
	
	
	$ctrl.save = function () {
		var data = {'attendances':{
						'id':$ctrl.AttendanceId,
						'employee_number':$ctrl.EmployeeNumber,
						'timein': $filter('date')($ctrl.TimeInDate, "HH:mm a"),
						'timeout':$filter('date')($ctrl.TimeOutDate, "HH:mm a"),
						'remarks':$ctrl.SelectedRemark,
				}};
		
		$.ajax({
			method: 'POST',
			url: '/DTR/admin/attendances/update/'+$rootScope.fromDate+'/'+$rootScope.toDate,
			dataType:'json',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$rootScope.initializeController();
			$uibModalInstance.close('');
		});
	};
	
	
	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

//DIALOG CONFIRMATION REFERENCE SITE
//http://plnkr.co/edit/YWr6o2?p=preview