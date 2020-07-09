App.controller('StudentListController',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = 7;

		$http.get("/DTR/rfid_students/sy").success(function(response) {
			$scope.sy = response;
		});
		
		$http.get("/DTR/rfid_students/sections").success(function(response) {
			$scope.sections = response;
		});
		
		$http.get("/DTR/rfid_students/stud_201").success(function(response) {
			$scope.students = response;
			console.log($scope.students);
		});
		
	}
	
	$scope.save = function (i) {
		var stud = $scope.students[i];
		
		console.log(stud);
		return;
	
		var registered = parseInt(stud.Student201.has_rfid);
		if(registered){
			var data = {
				'RfidStudent':{
					'id':stud.RfidStudent.id,
					'source_rfid':stud.RfidStudent.source_rfid
				},
				'Image':{
					'id':stud.Image.id,
					'source_rfid':stud.RfidStudent.source_rfid
				}
			}
		}else{
			var data = {
				'RfidStudent':{
					'source_rfid':stud.RfidStudent.source_rfid,
					'LRN':null,
					'sy':$scope.sy.SchoolYear.id,
					'type':'1',
					'student_number':stud.Student201.student_number,
					'last_name':stud.Student201.last_name,
					'first_name':stud.Student201.first_name,
					'middle_name':stud.Student201.middle_name,
					'student_mobile_no':stud.Student201.mobile,
					'guardian_name':stud.Student201.primary_name,
					'guardian_mobile_no':stud.Student201.primary_mobile_no,
					'guardian_address':stud.Student201.primary_address,
					'relationship':stud.Student201.primary_relationship,
					'level_id':stud.Student201.level_id,
					'section_id':stud.Student201.section_code,
					'gender':stud.Student201.gender
				},
				'Student201':{
					'id':stud.Student201.id,
					'has_rfid':1,
				},
				'Image':{
					'img_path':'PHOTO/'+stud.Student201.student_number+'.jpg',
					'source_rfid':stud.RfidStudent.source_rfid,
					'name':stud.Student201.full_name
				}
			};
			
		}
		
		
		console.log(data);
		//return;
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_students/save_rfid',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			console.log(response);
			if(response.statusText == "OK"){
				$scope.students[i] = response.data;
				console.log($scope.students[i]); 
				 
			}
			
		});
    }

});
App.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13 && element.val().length) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
				element.closest('tr').next('tr').find('input').focus();
            }
        });
    };
})