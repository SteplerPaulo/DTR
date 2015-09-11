<?php echo $this->Html->css('main'); ?>
<div ng-controller="AttendanceController" ng-init="initializeController()">
	<div class="col-lg-3" >
		<section>
			<div class="row">	
				<div class="container"><div id="myclock"></div></div>
			</div>
			<div class="row">		
				<h4><center><?php date_default_timezone_set("Asia/Singapore"); echo date("l F d, Y");  ?></center></h4>
			</div>
		</section>
		<section>
			<div class="row">	
				<?php echo $this->Form->input('rfid',array('class'=>'form-control input-sm','type'=>'text','label'=>'RFID','my-enter'=>'PostRFID()','ng-model'=>'RFID')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('employee_number',array('id'=>'EmployeeNumber','class'=>'form-control input-sm','type'=>'hidden','ng-model'=>'empno')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('name',array('id'=>'EmployeeName','class'=>'form-control input-sm','ng-model'=>'empname')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('message',array('class'=>'form-control input-sm')); ?>
			</div>
		</section>
	</div>
	<div class="col-lg-9">	
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center w20" rowspan="2">Date</th>
					<th class="text-center w20" rowspan="2">Day</th>
					<th class="text-center w60" colspan="2">Time</th>
				</tr>
				<tr>
					<th class="text-center">In</th>
					<th class="text-center">Out</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="h in History | limitTo: 12">
					<td class="text-center">{{h.Attendance.date |  date:"MMM dd, yyyy" }}</td>
					<td class="text-center">{{h.Attendance.date |  date:"EEEE" }}</td>
					<td class="text-center">{{h.Attendance.timein}}</td>
					<td class="text-center">{{h.Attendance.timeout}}</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>



<?php echo $this->Html->script('jquery.thooClock',array('inline'=>false)); ?>
<?php echo $this->Html->script('biz/clock',array('inline'=>false)); ?>
<?php echo $this->Html->script('controllers/attendance',array('inline'=>false)); ?>

<!--CLOCK REFENRENCE: http://www.jqueryscript.net/time-clock/Customizable-Analog-Alarm-Clock-with-jQuery-Canvas-thooClock.html-->
