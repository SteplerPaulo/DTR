App.controller('AttendanceController',function($scope,$rootScope,$http){
	$scope.initializeController = function(){
		$http.get("/DTR/attendances/employees").success(function (data) {
			console.log(data);
			var employees = [];
			angular.forEach(data, function(o, i) {
				employees[o.RfidStudent.rfid] = {
					"empno":o.RfidStudent.employee_number,
					"empname":o.RfidStudent.full_name,
				}
			}, employees);
			$scope.Employees = employees;
		});
		
	}
	
	$scope.PostRFID = function(){
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
				
				//$scope.status = response.status;
				//$scope.data = response.data;
				$scope.History = response.data.data;
				console.log($scope.History );
				  
			});
			
		}else{
			$scope.empno = '';
			$scope.empname = '';
		}
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