App.controller('PrintStudentMonthlyAttendance',function($scope,$rootScope,$http,$filter){
	
	$scope.initializeController = function(){
		$scope.date =  $filter("date")(Date.now(), 'yyyy-MM');
		
		$http.get("/DTR/rfid_studattendances/sections").success(function(sections) {
			$scope.sections = sections;
		});
		
		//STUDENT LIST FROM RFID STUDENT TABLE -  USE FOR STUDENT NAME TYPEAHEAD
		$http.get("/DTR/rfid_studattendances/student_list").success(function(response) {
			$input.typeahead({
					source: response,
					autoSelect: true
				});
		});
	}
	
	//TYPE AHEAD
	var $input = $("#studname");
	var $student;
	$input.change(function() { //inaabangan ang event na change
	
	
	
		var current = $input.typeahead("getActive"); //kinukuha yung current active item
		$scope.student_number = current.student_number;
		console.log(current.student_number);
		/*
		if (current) { //if may laman
			if (current.name == $input.val()) {
				student = current;
			}
		}*/
	});
	
});