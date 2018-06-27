<div ng-controller="PrintStudentMonthlyAttendance" ng-init="initializeController()">
	<section class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="panel-title">Print Student Monthly Attendance</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
							<label>Student</label>
							<input class="form-control input-sm" ng-model="studname" id="studname"></input>
				
						
						</div>
						<div class="col-lg-4">
							<label>Date</label>
							<input type="month" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m')?>">
						</div>
					</div>
				</div>
				<div class="panel-footer text-right">
					<a ng-disabled="!studname || !date" href="/DTR/rfid_studattendances/stud_report/{{student_number}}/{{studname}}/{{date}}" target="_blank" class="btn btn-primary">Go</a>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Html->script('template/bootstrap3-typeahead.min',array('inline'=>false));?>
<?php echo $this->Html->script('controllers/print_student_monthly_attendance',array('inline'=>false)); ?>