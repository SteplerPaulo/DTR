App.controller('AttendanceController',function($scope,$rootScope,$http,$timeout){
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
	
	
	//ON RFID ENTRY
	$scope.PostRFID = function(){

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
					$('#rfid').focus();
					if($scope.TYPE == 'OUT'){//CLASS MANIPULATION WHETHER ENTRY IS FOR IN OR OUT
						$scope.ICON = 'fa-sign-out'
						$scope.BADGE = 'label-warning'
						$scope.INFO = 'label-info'
					}else{
						$scope.ICON = 'fa-sign-in';
						$scope.BADGE = 'label-success'
						$scope.INFO = 'label-info'
					}
				});
			}else{
				$scope.RFID = '';
				$scope.empno = '';
				$scope.empname = 'DATA NOT FOUND. RETAP ID';
				$scope.History = [];
				$scope.ICON = '';
				$scope.BADGE = ''
				$scope.INFO = 'label-danger';
				
			}
        }, 500);	
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
