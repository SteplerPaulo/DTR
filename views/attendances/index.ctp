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
				<?php echo $this->Form->input('rfid',array('class'=>'form-control input-sm','type'=>'text','label'=>'RFID','ng-blur'=>'refocus()','my-enter'=>'PostRFID()','ng-model'=>'RFID','ng-disabled'=>'isSaving','focus-on'=>'focusMe')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('employee_number',array('id'=>'EmployeeNumber','class'=>'form-control input-sm','type'=>'hidden','ng-model'=>'empno')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('name',array('id'=>'EmployeeName','readonly'=>'readonly','class'=>'form-control input-sm','ng-model'=>'empname')); ?>
			</div>
			<div class="row">	
				<?php echo $this->Form->input('message',array('class'=>'form-control input-sm')); ?>
			</div>
		</section>
	</div>
	<div class="col-lg-9">	
		<div class="row-fluid">
			<div class="col-lg-12">
				<h1><span class="{{INFO}}"> {{ empname }}</span> <span class="label {{BADGE}}"><i class="fa {{ICON}}"></i> {{TYPE}}</span></h1>
				
			</div>
			<div class="col-xs-4">
				<!--<label for="search">Search</label>
				<input ng-model="q" id="search" class="form-control" placeholder="Filter text">
				-->
			</div>
			<!--
			<div class="col-xs-4">
				<label for="search">Items per page</label>
				<input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
			</div>
			-->
		</div><br/>
		<div class="row-fluid">
			<table class="table table-bordered col-lg-12">
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
					<tr dir-paginate="h in History | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{h.Attendance.date |  date:"MMM dd, yyyy" }}</td>
						<td class="text-center">{{h.Attendance.date |  date:"EEEE" }}</td>
						<td class="text-center">{{h.Attendance.timein}}</td>
						<td class="text-center">{{h.Attendance.timeout}}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="text-center">
							<dir-pagination-controls></dir-pagination-controls>
						</td>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>

<?php echo $this->Html->script('jquery.thooClock',array('inline'=>false)); ?>
<?php echo $this->Html->script('biz/clock',array('inline'=>false)); ?>
<?php echo $this->Html->script('controllers/attendance',array('inline'=>false)); ?>

<!--CLOCK REFENRENCE: http://www.jqueryscript.net/time-clock/Customizable-Analog-Alarm-Clock-with-jQuery-Canvas-thooClock.html-->
