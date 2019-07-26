//THIS JS IS NOT USE , THIS IS FOR INCASE CODE ONLY 

App.controller('SetMobileNo',function($scope,$rootScope,$http,$filter){
	

	//SEND MESSAGE EVENT HANDLER
	$scope.save = function(note){	
		$scope.preventDoubleClick = true;
		
		var data = {
			"RfidStudent":{
				"id":$scope.id,
				"student_mobile_no":$scope.student_mobile_no,
				"guardian_mobile_no":$scope.guardian_mobile_no,
				"relationship":$scope.relationship
			}
			
		};
		
		
		$http({
			method: 'POST',
			url: '/DTR/rfid_students/edit',
			data: $.param({data:data}),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function(response) {
			alert(response.data.message);
			window.location.href = "/DTR/rfid_students";
		});
	
	};
	
});