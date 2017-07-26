<?php 
	$sy =array('2016'=>'2016-2017','2017'=>'2017-2018');
	$curriculums =array('PS'=>'Primary School','GS'=>'Grade School','HS'=>'High School','SH'=>'Senior High School');
	$periods =array('1'=>'1st','2'=>'2nd','3'=>'3rd','4'=>'4th');
?>
<div ng-controller="SchoolCalendarController" ng-init="initializeController()">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">SCHOOL CALENDAR</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<?php echo $this->Form->input('sy',array('options'=>$sy,'empty'=>'--Select--','label'=>'S.Y','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('curriculum',array('options'=>$curriculums,'empty'=>'--Select--','ng-model'=>'curriculum','ng-change'=>'changeCurri(curriculum)','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('period',array('options'=>$periods,'empty'=>'--Select--','class'=>'form-control inline input-sm'));?>
						</div>
					</div><br/>
				
					<div class="row">
						<div class="col-md-2">
							<label>Date From</label>
							<input type="date" class="form-control input-sm" id="FromDate" ng-model="fromDate">
						</div>
						<div class="col-md-2">
							<label>Date To</label>
							<input type="date" class="form-control input-sm" id="ToDate" ng-model="toDate">
						</div>
						<div class="col-md-6" ng-if="curriculum">
							<label>Applicable To:</label><br/>
							<div class="checkbox-inline" ng-repeat="lvl in levels">
								<label><input type="checkbox" name="optradio">{{lvl}}</label>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">	
					<div class="text-right">
						<button class="btn btn-warning" ng-click="Save()">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/school_calendar',array('inline'=>false)); ?>