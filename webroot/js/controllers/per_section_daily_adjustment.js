App.controller('PerSectionDailyAdjustmentController',function($scope,$rootScope,$http){

	$scope.initializeController = function(){
		$scope.currentPage = 1; 
		$scope.pageSize = null;
		
		//TRANSLATE DATA FROM MAIN PAGE
		$scope.secId = $('#PerSectionDailyAdjustmentTable caption h3').attr('secId');
		$scope.date = $('#PerSectionDailyAdjustmentTable caption h3').attr('date');
		$scope.secName =  $('#PerSectionDailyAdjustmentTable caption h3 #SectionName').text();
		$http.get('/DTR/rfid_studattendances/per_sec_data_adjsutment/'+$scope.secId+'/'+$scope.secName+'/'+$scope.date).success(function(response) {
			$scope.students = response;
		});	
	}
	
	
	$scope.edit = function(data){		
		console.log(data);
		if(data.Attendance){
			if(data.Attendance.AM){
				$('#AMTimeIn').val(data.Attendance.AM.time_in);
				$('#AMTimeOut').val(data.Attendance.AM.time_out);
			}
			if(data.Attendance.PM){
				$('#PMTimeIn').val(data.Attendance.PM.time_in);
				$('#PMTimeOut').val(data.Attendance.PM.time_out);
			}
			
			
		}else{
			$('#AMTimeIn').val('');
			$('#AMTimeOut').val('');
			$('#PMTimeIn').val('');
			$('#PMTimeOut').val('');
		}
		
		$('#EditModal').modal();
		$('#EditModal .modal-title').attr('sno',data.rfid_students.student_number);
		$('#EditModal .modal-title').attr('rfid',data.rfid_students.dec_rfid);
		$('#EditModal .modal-title').text(data[0].full_name);
	}


	$('#SaveButton').click(function(){
		var sno = $('#EditModal .modal-title').attr('sno');
		var rfid = $('#EditModal .modal-title').attr('rfid');
		var date = $scope.date;
		var AMTimeIn = $('#AMTimeIn').val();
		var AMTimeOut = $('#AMTimeOut').val();
		var PMTimeIn = $('#PMTimeIn').val();
		var PMTimeOut = $('#PMTimeOut').val();
		console.log($scope.date);
		
		$.ajax({
			url: '/DTR/admin/rfid_studattendances/per_section_saving',
			dataType:'json',
			data:{'data':{'AMTimeIn':AMTimeIn,'AMTimeOut':AMTimeOut,'PMTimeIn':PMTimeIn,'PMTimeOut':PMTimeOut,'date':date,'sno':sno,'rfid':rfid}},
			type:'post',
		}).done(function( response ) {
			//$rootScope.$broadcast('RefreshAttendance',response);
		});		
		
	});
	
});

