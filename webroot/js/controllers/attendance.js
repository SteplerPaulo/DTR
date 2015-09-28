App.controller('AttendanceController',function($scope,$rootScope,$http,$timeout,focus){
	$scope.initializeController = function(focus){
		$scope.currentPage = 1;
		$scope.pageSize = 15;
		
		$http.get("/DTR/attendances/employees").success(function (data) {
			var employees = [];
			angular.forEach(data, function(o, i) {
				employees[o.RfidStudent.source_rfid] = {
					"empno":o.RfidStudent.employee_number,
					"empname":o.RfidStudent.full_name,
				}
				employees[o.RfidStudent.dec_rfid] = {
					"empno":o.RfidStudent.employee_number,
					"empname":o.RfidStudent.full_name,
				}
			}, employees);
			$scope.Employees = employees;
		});
		
	}
	
	focus('focusMe');
	var promise;
	
	//ON RFID ENTRY
	$scope.PostRFID = function(){
		$timeout.cancel(promise);
		$scope.isSaving = true;
		$timeout( function(){
			 $scope.isSaving = false;
			 if(typeof ($scope.Employees[$scope.RFID]) != 'undefined'){
				$scope.empno = $scope.Employees[$scope.RFID].empno;
				$scope.empname = $scope.Employees[$scope.RFID].empname;
				$http({
					method: 'POST',
					url: '/DTR/attendances/add',
					data: $.param({data:{'Attendance':{
									'employee_number':$scope.empno,
								}}}),
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function(response) {
					$scope.RFID = '';
					$scope.empno = '';
					$scope.History = response.data.data;
					$scope.TYPE = response.data.type;// IN OR OUT
					focus('focusMe');
					if($scope.TYPE == 'OUT'){//CLASS MANIPULATION WHETHER ENTRY IS FOR IN OR OUT
						$scope.ICON = 'fa-sign-out'
						$scope.BADGE = 'label-warning'
						$scope.INFO = 'label label-info'
					}else{
						$scope.ICON = 'fa-sign-in';
						$scope.BADGE = 'label-success'
						$scope.INFO = 'label label-info'
					}
				});
			}else{
				
				$scope.RFID = '';
				$scope.empno = '';
				$scope.empname = 'DATA NOT FOUND. RETAP ID';
				$scope.History = [];
				$scope.ICON = '';
				$scope.BADGE = ''
				$scope.INFO = 'label label-danger';
				focus('focusMe');
			}
        }, 500);	
		
		//CLEAR TABLE AFTER 60 Seconds
		promise = $timeout( function(){
			$scope.RFID = '';
			$scope.empno = '';
			$scope.empname = '';
			$scope.History = [];
			$scope.ICON = '';
			$scope.BADGE = ''
			$scope.INFO = '';
			focus('focusMe');
		}, 60000);
	}
});

App.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.myEnter);
                });
                event.preventDefault();
            }
        });
    };
});

App.directive('focusOn', function() {
   return function(scope, elem, attr) {
      scope.$on('focusOn', function(e, name) {
        if(name === attr.focusOn) {
          elem[0].focus();
        }
      });
   };
});

App.factory('focus', function ($rootScope, $timeout) {
  return function(name) {
    $timeout(function (){
      $rootScope.$broadcast('focusOn', name);
    });
  }
});