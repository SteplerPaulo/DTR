App.controller('AssignRFIDController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;
		$scope.StudentMode = true;
		$scope.EmployeeMode = false;
		$scope.SavingStatus = false; 
		$scope.types = [{id:1,name:"Student"},{id:2,name:"Employee"}];
		$scope.typeSelected = $scope.types[0];
		
		$http.get("/DTR/school_years/active").success(function (response) {
			$scope.school_years = response;
			console.log($scope.school_years);
			$scope.sy = $scope.school_years[0];
		});
		
	}
	
	
	$scope.changedValue = function(type){
		if(type['name'] == 'Student'){
			$scope.StudentMode = true;
			$scope.EmployeeMode = false;
		}else{
			$scope.StudentMode = false;
			$scope.EmployeeMode = true;
		}
	}     

	
	
	$scope.save = function(){
		var data = {};
		data['RfidStudent'] = {};
		data['RfidStudent']['sy'] = $scope.sy.SchoolYear.id;
		data['RfidStudent']['type'] = $scope.typeSelected.id;
		data['RfidStudent']['last_name'] = $scope.last_name;
		data['RfidStudent']['first_name'] = $scope.first_name;
		data['RfidStudent']['middle_name'] = $scope.middle_name;
		data['RfidStudent']['employee_number'] = $scope.employee_number;
		data['RfidStudent']['student_number'] = $scope.student_number;
		data['RfidStudent']['student_mobile_no'] = $scope.student_mobile_no;
		data['RfidStudent']['guardian_mobile_no'] = $scope.guardian_mobile_no;
		data['RfidStudent']['relationship'] = $scope.relationship;
		data['RfidStudent']['source_rfid'] = $scope.source_rfid;
		data['RfidStudent']['section_id'] = $scope.section_id;
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_students/save',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			$scope.last_name = "";
			$scope.first_name = "";
			$scope.middle_name = "";
			$scope.employee_number = "";
			$scope.student_number = "";
			$scope.student_mobile_no = "";
			$scope.guardian_mobile_no = "";
			$scope.relationship = "";
			$scope.source_rfid = "";
			$scope.section_id = "";
			$scope.SavingStatus = true; 
		});
	}
	
	$scope.AssignNewRFID = function (){
		$scope.SavingStatus = false; 
	};
	
	$scope.CheckRFID = function(source_rfid){
		var data  = {};
			data['RfidStudent'] = {};
			data['RfidStudent']['source_rfid'] = source_rfid;
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_students/check_rfid',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			if(response.data != 'false'){
				$scope.DuplicatedRFID = true;
			}else{
				$scope.DuplicatedRFID = false;
			}
		});
	};
	
}).directive('myEnter', function () {
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