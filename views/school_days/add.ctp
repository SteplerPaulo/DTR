<?php 
	$sy =array('2016'=>'2016-2017','2017'=>'2017-2018');
?>
<style>
	.fa-check{
		color:#428bca;
	}
	.fa-question{
		color:#ff9200;
	}
	.fa-close{
		color:#ff0000;
	}
	a{
		color: black;
	}
	a:hover{
		color: black;
		text-decoration: none;
	}
	tbody td:hover{
		background-color: #e1e6ea;
	}
	sup{
		float: right;
	}
	.fa-toggle-off,.fa-toggle-on{
		cursor:pointer;
	}
</style>
<div ng-controller="SetSchoolDaysController" ng-init="initializeController()">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">SCHOOL DAYS</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<?php echo $this->Form->input('school_year',array('value'=>'2017-2018','readonly'=>'readonly','label'=>'S.Y','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('curriculum',array('value'=>'Grade School','readonly'=>'readonly','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('level',array('value'=>'Grade 1','readonly'=>'readonly','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('period',array('value'=>'1st Period','readonly'=>'readonly','class'=>'form-control inline input-sm'));?>
						</div>
					</div><br/>
					
					<div class="row">
						<div class="col-md-3" ng-repeat="d in data">
							<table class="table table-bordered">
								<caption><b>{{d.month}}, {{d.year}}</b></caption>
								<thead>
									<tr>
										<th class="text-center w5">Date</th>
										<th class="text-center">Day</th>
										<th class="text-center">Status</th>
										<th class="text-center"></th>
								
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="days in d.days" >
										<td class="text-center">{{days.date}}</td>
										<td>{{days.day}}</td>
										<td><span ng-if="days.isWeekend">No Class<span></td>
										<td class="text-center"><i ng-class="days.isWeekend?'fa fa-toggle-on':'fa fa-toggle-off'" ng-model="toggle" ng-click="toggle()"></i></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php echo $this->Html->script('controllers/set_school_days',array('inline'=>false)); ?>


<!--
<div class="schoolDays form">
<?php echo $this->Form->create('SchoolDay');?>
	<fieldset>
		<legend><?php __('Add School Day'); ?></legend>
	<?php
		echo $this->Form->input('school_calendar_id');
		echo $this->Form->input('date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List School Days', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List School Calendars', true), array('controller' => 'school_calendars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Calendar', true), array('controller' => 'school_calendars', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->