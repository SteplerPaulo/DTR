App.controller('AssignRFIDController',function($scope,$rootScope,$http,$filter){
	
	//FORM MASTER RESET (This will be the one coppied when reset trigger)
	$scope.MASTER = {
		id: null,
		student_id: null,
		student_number: null,
		last_name: null,
		first_name: null,
		middle_name: null,
		student_mobile_no: null,
		guardian_mobile_no: null,
		section_id: null,
		gender: null,
		source_rfid: null,
		employee_id:null,
		employee_number:null,
		employee_mobile_no:null,
		emergency_contact_no:null,
		emergency_contact_person:null,
	};

	//FORM RESET
	$scope.reset = function(ReloadPage) {
		//TWO TYPE OF RESET 
			//1st reset type is, page is not reloading (this one use if the user use traditional filter input transaction);
			//2nd is, page is reloading (this one is use when the user use the other way: employee/student link assigning)
		if(ReloadPage == false){
			$scope.Field= angular.copy($scope.MASTER);
			$scope.StudentMode=true;
			$scope.EmployeeMode=false;
			$scope.DuplicatedRFID=false;
			$scope.HaveAnExistingRFID=false;
			$scope.No201=false;
			$scope.ReloadPage = false;
		}else{
			window.location.href = '/DTR/rfid_students/assign';
		}
    };
	
	//INITIALIZATION
	$scope.initializeController = function(){
		$scope.types = [{id:1,name:"Student"},{id:2,name:"Employee"}];
		$scope.typeSelected = $scope.types[0];
		$scope.type = $scope.types[0].id;
			
		$scope.reset(false);
		
		//2ND WAY OF ASSINGNING RFID (through student/employee assigning link)
		if(window.location.pathname.split('/')[4]){
			//INITIATE TYPE WHETHER STUDENT OR EMPLOYEE
			$scope.type = window.location.pathname.split('/')[4].split(':')[0];			
			$scope.typeSelected = ($scope.type == 1)?$scope.types[0]:$scope.types[1];
			$scope.changedType($scope.typeSelected);
			
			//TRIGGER DATA INSTALLATION EITHER STUDENT DATA OR EMPLOYEE DATA
			switch($scope.type){
				case 1: 
						$scope.Field.student_number = window.location.pathname.split('/')[4].split(':')[1];
						$scope.getStudDetails($scope.Field.student_number);
						break;
				case 2: 
						$scope.Field.employee_number = window.location.pathname.split('/')[4].split(':')[1];
						$scope.getEmpDetails($scope.Field.employee_number);
						break;
			}
			$scope.ReloadPage = true;
		}
	}
	
	//TYPE MODE EVENT HANDLER EITHER EMPLOYEE OR STUDENT ASSIGNING
	$scope.changedType = function(type){
		$scope.reset(false);
		if(type['name'] == 'Student'){
			$scope.type = type['id'];
			$scope.StudentMode = true;
			$scope.EmployeeMode = false;
		}else{
			$scope.type = type['id'];
			$scope.StudentMode = false;
			$scope.EmployeeMode = true;
		}
	}     

	//STUDENT NUMBER EVENT HANDLER
	$scope.getStudDetails = function(student_number){
		if(student_number){
			$scope.DuplicatedRFID=false;
			$http({ //CHECK STUDENT NUMBER IF ALREADY HAVE AN EXISTING DATA ON RFID TABLE
				method: 'POST',
				url: '/DTR/rfid_students/check_by_student_number',
				data: $.param({data:{'student_number':student_number}}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				// IF NO EXISTING RFID
				if(response.data == 'false'){ 
					$scope.HaveAnExistingRFID = false;
				
					$http({ //FINDING STUDENT NUMBER DATA
						method: 'POST',
						url: '/DTR/student201s/find_by_student_no',
						data: $.param({data:{'Student':{'student_number':student_number,}}}),
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).then(function(response) {
						var d = response.data;
						if(response.data != 'false'){//IF DATA IS AVAILABLE
							$scope.Field.id = '';
							$scope.Field.student_id = d.Student201.id;
							$scope.Field.last_name = d.Student201.last_name;
							$scope.Field.first_name = d.Student201.first_name;
							$scope.Field.middle_name = d.Student201.middle_name;
							$scope.Field.student_mobile_no = (d.Student201.mobile != null)?d.Student201.mobile.substring(3, 13):'';
							$scope.Field.guardian_mobile_no = (d.Student201.primary_mobile_no != null)?d.Student201.primary_mobile_no.substring(3, 13):'';
							$scope.Field.relationship = d.Student201.primary_relationship;
							$scope.Field.level_id = d.Student201.level_id;
							$scope.Field.section_id = d.Student201.section_code;
							$scope.Field.gender = d.Student201.gender;
						
							
						}else{			//IF NO DATA FOUND
							$scope.No201=true;
						}
					});
				//IF HAS AN EXISTING RFID	
				}else{ 		
					var d = response.data;
					$scope.Field.id = d.RfidStudent.id;
					$scope.Field.student_number = d.RfidStudent.student_number;
					$scope.Field.level_id = d.RfidStudent.level_id;
					$scope.Field.section_id = d.RfidStudent.section_id;
					$scope.Field.last_name = d.RfidStudent.last_name;
					$scope.Field.first_name = d.RfidStudent.first_name;
					$scope.Field.middle_name = d.RfidStudent.middle_name;
					$scope.Field.student_mobile_no = (d.RfidStudent.student_mobile_no != null)?d.RfidStudent.student_mobile_no.substring(3, 13):'';; 
					$scope.Field.guardian_mobile_no = (d.RfidStudent.guardian_mobile_no != null)?d.RfidStudent.guardian_mobile_no.substring(3, 13):''; 
					$scope.Field.relationship = d.RfidStudent.relationship;
					$scope.Field.source_rfid = d.RfidStudent.source_rfid;
					$scope.Field.gender = d.RfidStudent.gender;
					$scope.HaveAnExistingRFID = true;
				}
				
				console.log(d);
			});
			
		}
	}
	
	//EMPLOYEE NUMBER EVENT HANDLER
	$scope.getEmpDetails = function(employee_number){
		if(employee_number){
			$scope.DuplicatedRFID=false;
			$http({
				method: 'POST',
				url: '/DTR/rfid_students/check_by_employee_number',
				data: $.param({data:{'employee_number':employee_number}}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				if(response.data == 'false'){ 
					$http({
						method: 'POST',
						url: '/DTR/employees/find_by_employee_no',
						data: $.param({data:{'Employee':{'employee_no':employee_number}}}),
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).then(function(response) {
						var d = response.data;
						if(response.data != 'false'){
							$scope.Field.id = '';
							$scope.Field.employee_id = d.Employee.id;
							$scope.Field.last_name = d.Employee.last_name;
							$scope.Field.first_name = d.Employee.first_name;
							$scope.Field.middle_name = d.Employee.middle_name;
							$scope.Field.employee_mobile_no = d.Employee.mobile.substring(3, 13);
							$scope.Field.emergency_contact_no = d.Employee.emergency_contact_no.substring(3, 13);
							$scope.Field.emergency_contact_person = d.Employee.emergency_contact;
							console.log(d.Employee.mobile);
							console.log(d.Employee.mobile.substring(3, 13));
						}else{
							$scope.No201=true;
						}
					});
				}else{
					var d = response.data;
					$scope.Field.id = d.RfidStudent.id;
					$scope.Field.employee_number = d.RfidStudent.employee_number;
					$scope.Field.last_name = d.RfidStudent.last_name;
					$scope.Field.first_name = d.RfidStudent.first_name;
					$scope.Field.middle_name = d.RfidStudent.middle_name;
					$scope.Field.employee_mobile_no = d.RfidStudent.employee_mobile_no.substring(3, 13);
					$scope.Field.emergency_contact_no = d.RfidStudent.emergency_contact_no.substring(3, 13);
					$scope.Field.emergency_contact_person = d.RfidStudent.emergency_contact_person;
					$scope.Field.source_rfid = d.RfidStudent.source_rfid;
					$scope.HaveAnExistingRFID = true;
					console.log(d.Employee.mobile);
					console.log(d.Employee.mobile.substring(3, 13));
				}
			});
		}
	}
 
	//UPDATE EXISTING RFID DATA EVENT HANDLER
	$scope.update = function(){
		$scope.HaveAnExistingRFID=false;
	}	
	
	//AVOID RFID DUPLICATION
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