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
	$input.change(function() { 
		var current = $input.typeahead("getActive"); //kinukuha yung current active item
		$scope.studno = current.student_number;
		//console.log(current.student_number);
		
		if (current) { //if may laman
			if (current.name == $input.val()) {
				
				$scope.edit();
				
			}
		}
		
		
	});
	
	$scope.filterDate =  function(){
		$scope.edit();
	}
	
	
	$scope.edit = function(){
		$scope.editable=false;
		var data = {'sno':$scope.studno,'date':$scope.date};
		$http({
			method: 'POST',
			url: '/DTR/rfid_studattendances/adjust_student_monthly_attendance',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			console.log(response.data);
			if(response.data){
				$scope.data = response.data;
			}else{
				alert('No Data');
			}
			
		});
	
	}
	
	$scope.editAttendance = function(index){
		
		$scope.editable=true;
		$scope.editableIndex=index;
		//$scope.data[index].data.rfid_studattendance.time_in;
		//console.log($scope.data[index].data.rfid_studattendance.time_in);
		//$scope.data[index].data.rfid_studattendance.time_in = new Date($scope.data[index].data.rfid_studattendance.date +' '+$scope.data[index].data.rfid_studattendance.time_in);
		//console.log($scope.data[index].data.rfid_studattendance.time_in);
		
	}
	
	$scope.changeTime = function(index){
		
		var timein = new Date($scope.data[index].data.rfid_studattendance.date +' '+$scope.data[index].data.rfid_studattendance.time_in);
		var timeout = new Date($scope.data[index].data.rfid_studattendance.date +' '+$scope.data[index].data.rfid_studattendance.time_out);
		$scope.data[index].data[0].formated_timein = $filter('date')(timein, "hh:mm:ss a");
		$scope.data[index].data[0].formated_timeout = $filter('date')(timeout, "hh:mm:ss a");
		//console.log($scope.data[index].data[0].formated_timeout);
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