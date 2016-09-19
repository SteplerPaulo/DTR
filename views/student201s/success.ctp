<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Notification</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Student201',array('action'=>'add'));
				//pr($student['Student201']);exit;
			?>
			<div class="panel-body">
				Saving Successful! Would you like to assign RFID with this student?
				<br/><br/>
				<label>Student Name:</label><?php echo $student['Student201']['full_name']?>
				
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<a class="btn btn-default" href="/DTR/student201s/add">Create New Student 201</a>
					<a class="btn btn-primary" href="/DTR/rfid_students/assign/1:<?php echo $student['Student201']['student_number'];?>">Assign RFID</a>
				</div>
			</div>
		</div>
	</div>
</div>