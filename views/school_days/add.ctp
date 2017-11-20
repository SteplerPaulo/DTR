<?php 
	$sy =array('2016'=>'2016-2017','2017'=>'2017-2018');
?>
<style>
	.isActive:hover{
		background-color: #e1e6ea;
		cursor:pointer;
	}
	.noClass{
		background-color: #bd1818;
		color: white;
	}
	
	.weekend{
		color:#b33838;
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
						<div class="col-md-4" ng-repeat="d in data">
							<table class="table table-bordered">
								<caption><h2><b>{{d.month}}, {{d.year}}</b></h2></caption>
								<thead>
									<tr>
										<th class="text-center weekend">Sun</th>
										<th class="text-center">Mon</th>
										<th class="text-center">Tue</th>
										<th class="text-center">Wed</th>
										<th class="text-center">Thu</th>
										<th class="text-center">Fri</th>
										<th class="text-center weekend">Sat</th>
								</thead>
								<tbody>
									<tr class="text-center">
										<td ng-class="(d.days[0])?'isActive':''" class="weekend">{{d.days[0].date}}</td>
										<td ng-class="(d.days[1])?'isActive':''">{{d.days[1].date}}</td>
										<td ng-class="(d.days[2])?'isActive':''">{{d.days[2].date}}</td>
										<td ng-class="(d.days[3])?'isActive':''">{{d.days[3].date}}</td>
										<td ng-class="(d.days[4])?'isActive':''">{{d.days[4].date}}</td>
										<td ng-class="(d.days[5])?'isActive':''">{{d.days[5].date}}</td>
										<td ng-class="(d.days[6])?'isActive':''" class="weekend">{{d.days[6].date}}</td>
									</tr>
									<tr class="text-center">
										<td ng-class="(d.days[7])?'isActive':''" class="weekend">{{d.days[7].date}}</td>
										<td ng-class="(d.days[8])?'isActive':''">{{d.days[8].date}}</td>
										<td ng-class="(d.days[9])?'isActive':''">{{d.days[9].date}}</td>
										<td ng-class="(d.days[10])?'isActive':''">{{d.days[10].date}}</td>
										<td ng-class="(d.days[11])?'isActive':''">{{d.days[11].date}}</td>
										<td ng-class="(d.days[12])?'isActive':''">{{d.days[12].date}}</td>
										<td ng-class="(d.days[13])?'isActive':''" class="weekend">{{d.days[13].date}}</td>
									</tr>
									<tr class="text-center">
										<td ng-class="(d.days[14])?'isActive':''" class="weekend">{{d.days[14].date}}</td>
										<td ng-class="(d.days[15])?'isActive':''">{{d.days[15].date}}</td>
										<td ng-class="(d.days[16])?'isActive':''">{{d.days[16].date}}</td>
										<td ng-class="(d.days[17])?'isActive':''">{{d.days[17].date}}</td>
										<td ng-class="(d.days[18])?'isActive':''">{{d.days[18].date}}</td>
										<td ng-class="(d.days[19])?'isActive':''">{{d.days[19].date}}</td>
										<td ng-class="(d.days[20])?'isActive':''" class="weekend">{{d.days[20].date}}</td>
									</tr>
									<tr class="text-center">
										<td ng-class="(d.days[21])?'isActive':''" class="weekend">{{d.days[21].date}}</td>
										<td ng-class="(d.days[22])?'isActive':''">{{d.days[22].date}}</td>
										<td ng-class="(d.days[23])?'isActive':''">{{d.days[23].date}}</td>
										<td ng-class="(d.days[24])?'isActive':''">{{d.days[24].date}}</td>
										<td ng-class="(d.days[25])?'isActive':''">{{d.days[25].date}}</td>
										<td ng-class="(d.days[26])?'isActive':''">{{d.days[26].date}}</td>
										<td ng-class="(d.days[27])?'isActive':''" class="weekend">{{d.days[27].date}}</td>
									</tr>
									<tr class="text-center">
										<td ng-class="(d.days[28])?'isActive':''" class="weekend">{{d.days[28].date}}</td>
										<td ng-class="(d.days[29])?'isActive':''">{{d.days[29].date}}</td>
										<td ng-class="(d.days[30])?'isActive':''">{{d.days[30].date}}</td>
										<td ng-class="(d.days[31])?'isActive':''">{{d.days[31].date}}</td>
										<td ng-class="(d.days[32])?'isActive':''">{{d.days[32].date}}</td>
										<td ng-class="(d.days[33])?'isActive':''">{{d.days[33].date}}</td>
										<td ng-class="(d.days[34])?'isActive':''" class="weekend">{{d.days[34].date}}</td>
									</tr>
									<tr ng-if="(d.days[35])" class="text-center">
										<td ng-class="(d.days[35])?'isActive':''" class="weekend">{{d.days[35].date}}</td>
										<td ng-class="(d.days[36])?'isActive':''">{{d.days[36].date}}</td>
										<td ng-class="(d.days[37])?'isActive':''">{{d.days[37].date}}</td>
										<td ng-class="(d.days[38])?'isActive':''">{{d.days[38].date}}</td>
										<td ng-class="(d.days[39])?'isActive':''">{{d.days[39].date}}</td>
										<td ng-class="(d.days[40])?'isActive':''">{{d.days[40].date}}</td>
										<td ng-class="(d.days[41])?'isActive':''" class="weekend">{{d.days[41].date}}</td>
									</tr>
									<tr ng-if="(!d.days[35])">
										<td colspan="7" >&nbsp;</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!--
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
					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/set_school_days',array('inline'=>false)); ?>
