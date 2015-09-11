/*
var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
$(document).ready(function(){
	
	//LOAD EMPLOYEES
	$.ajax({
		url:BASE_URL+'attendances/employees',
		method:'post',
		dataType:'json',
		beforeSend: function(){
			$('#Notify').slideDown().text('Please wait while loading 201...').delay(1000);
			$('#AttendanceEmployeeId').attr('disabled','disabled');
		},
		success:function(result){
			$('#AttendanceEmployeeId').removeAttr('disabled');
			$('#Notify').text('201 successfuly loaded...').delay(1000).slideUp();
			$.each(result,function(i,o){
				$('#Employee201').append('<option rfid="'+o.RfidStudent.rfid+'" empno="'+o.RfidStudent.employee_number+'">'+o.RfidStudent.full_name+'</option>');
			});
		}
	});
	
	//EMPLOYEE ID EVENT HANDLER
	$('#AttendanceRfid').keypress(function(e){
		if(e.which ==13 ){
			var rfid =	$(this).val();
			if(rfid.length){
				if($('#Employee201 [rfid="'+rfid+'"]').length){
					var empno = $('#Employee201 [rfid="'+rfid+'"]').attr('empno');
					var empname = $('#Employee201 [rfid="'+rfid+'"]').text();
					
					$('#AttendanceEmployeeNumber').val(empno);
					$('#AttendanceName').val(empname);
					

					
					$("#AttendanceAddForm").submit(function(e){
						var postData = $(this).serializeArray();
						var formURL = $(this).attr("action");
						$.ajax({
							url : formURL,
							type: "POST",
							data : postData,
							success:function(data, textStatus, jqXHR) {
								var d = $.parseJSON(data);
								var d = d.data.Attendance;
								console.log(d);
						
								
								var row = 	'<tr class="text-center">'+
												'<td>'+d.date+'</td>'+
												'<td>'+d.date+'</td>'+
												'<td class="w30">'+d.timein+'</td>'+
												'<td class="w30">'+(d.timeout)?d.timeout:'--';+'</td>'+
											'</tr>';
											
								console.log(row);
								if(!d.timeout){
									$('#AttendanceTable tbody').prepend(row);
								}else{
									
									$('#AttendanceTable tbody:last').html(row);
								}
								
			
								
							},
							error: function(jqXHR, textStatus, errorThrown){
								//if fails      
							}
						});
						e.preventDefault(); //STOP default action
						e.unbind(); //unbind. to stop multiple form submit.
					});
					$("#AttendanceAddForm").submit();
					
					
				}else{
					alert('Opps!Record not found.');
				}
			}
		}
	});
	
});

*/