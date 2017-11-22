<?php 
	$sy =array('2016'=>'2016-2017','2017'=>'2017-2018');
?>
<style>
	.focus{
		border-color: #66afe9;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
	}
	.clickable{
		background-color: #e1e6ea;
		cursor:pointer;
	}
	.clickable:hover{
		background-color: #b3bbc1;

	}
	.clickable.noClassToday:hover{
		background-color: #6f0c0c ;
	}
	.noClassToday{
		background-color: #a42525;
		color: #ffffff;
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
						<div class="col-md-6" ng-repeat="(i,d) in data">
							<div class="panel panel-primary">
								<div class="panel-body ">
									<div class="row">
										<div class="col-md-8">
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
													</tr>
												</thead>
												<tbody>
													<tr class="text-center">
														<td ng-click="setDate(i,0,d.days[0])" ng-class="{clickable:(d.days[0]),noClassToday:(d.days[0].status=='No Class')}" title="{{d.days[0].remarks}}">{{d.days[0].date}}</td>
														<td ng-click="setDate(i,1,d.days[1])" ng-class="{clickable:(d.days[1]),noClassToday:(d.days[1].status=='No Class')}" title="{{d.days[1].remarks}}">{{d.days[1].date}}</td>
														<td ng-click="setDate(i,2,d.days[2])" ng-class="{clickable:(d.days[2]),noClassToday:(d.days[2].status=='No Class')}" title="{{d.days[2].remarks}}">{{d.days[2].date}}</td>
														<td ng-click="setDate(i,3,d.days[3])" ng-class="{clickable:(d.days[3]),noClassToday:(d.days[3].status=='No Class')}" title="{{d.days[3].remarks}}">{{d.days[3].date}}</td>
														<td ng-click="setDate(i,4,d.days[4])" ng-class="{clickable:(d.days[4]),noClassToday:(d.days[4].status=='No Class')}" title="{{d.days[4].remarks}}">{{d.days[4].date}}</td>
														<td ng-click="setDate(i,5,d.days[5])" ng-class="{clickable:(d.days[5]),noClassToday:(d.days[5].status=='No Class')}" title="{{d.days[5].remarks}}">{{d.days[5].date}}</td>
														<td ng-click="setDate(i,6,d.days[6])" ng-class="{clickable:(d.days[6]),noClassToday:(d.days[6].status=='No Class')}" title="{{d.days[6].remarks}}" data-toggle="tooltip" >{{d.days[6].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,7,d.days[7])" ng-class="{clickable:(d.days[7]),noClassToday:(d.days[7].status=='No Class')}" title="{{d.days[7].remarks}}">{{d.days[7].date}}</td>
														<td ng-click="setDate(i,8,d.days[8])" ng-class="{clickable:(d.days[8]),noClassToday:(d.days[8].status=='No Class')}" title="{{d.days[8].remarks}}">{{d.days[8].date}}</td>
														<td ng-click="setDate(i,9,d.days[9])" ng-class="{clickable:(d.days[9]),noClassToday:(d.days[9].status=='No Class')}" title="{{d.days[9].remarks}}">{{d.days[9].date}}</td>
														<td ng-click="setDate(i,10,d.days[10])" ng-class="{clickable:(d.days[10]),noClassToday:(d.days[10].status=='No Class')}" title="{{d.days[10].remarks}}">{{d.days[10].date}}</td>
														<td ng-click="setDate(i,11,d.days[11])" ng-class="{clickable:(d.days[11]),noClassToday:(d.days[11].status=='No Class')}" title="{{d.days[11].remarks}}">{{d.days[11].date}}</td>
														<td ng-click="setDate(i,12,d.days[12])" ng-class="{clickable:(d.days[12]),noClassToday:(d.days[12].status=='No Class')}" title="{{d.days[12].remarks}}">{{d.days[12].date}}</td>
														<td ng-click="setDate(i,13,d.days[13])" ng-class="{clickable:(d.days[13]),noClassToday:(d.days[13].status=='No Class')}" title="{{d.days[13].remarks}}">{{d.days[13].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,14,d.days[14])" ng-class="{clickable:(d.days[14]),noClassToday:(d.days[14].status=='No Class')}" title="{{d.days[14].remarks}}">{{d.days[14].date}}</td>
														<td ng-click="setDate(i,15,d.days[15])" ng-class="{clickable:(d.days[15]),noClassToday:(d.days[15].status=='No Class')}" title="{{d.days[15].remarks}}">{{d.days[15].date}}</td>
														<td ng-click="setDate(i,16,d.days[16])" ng-class="{clickable:(d.days[16]),noClassToday:(d.days[16].status=='No Class')}" title="{{d.days[16].remarks}}">{{d.days[16].date}}</td>
														<td ng-click="setDate(i,17,d.days[17])" ng-class="{clickable:(d.days[17]),noClassToday:(d.days[17].status=='No Class')}" title="{{d.days[17].remarks}}">{{d.days[17].date}}</td>
														<td ng-click="setDate(i,18,d.days[18])" ng-class="{clickable:(d.days[18]),noClassToday:(d.days[18].status=='No Class')}" title="{{d.days[18].remarks}}">{{d.days[18].date}}</td>
														<td ng-click="setDate(i,19,d.days[19])" ng-class="{clickable:(d.days[19]),noClassToday:(d.days[19].status=='No Class')}" title="{{d.days[19].remarks}}">{{d.days[19].date}}</td>
														<td ng-click="setDate(i,20,d.days[20])" ng-class="{clickable:(d.days[20]),noClassToday:(d.days[20].status=='No Class')}" title="{{d.days[20].remarks}}">{{d.days[20].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,21,d.days[21])" ng-class="{clickable:(d.days[21]),noClassToday:(d.days[21].status=='No Class')}" title="{{d.days[21].remarks}}">{{d.days[21].date}}</td>
														<td ng-click="setDate(i,22,d.days[22])" ng-class="{clickable:(d.days[22]),noClassToday:(d.days[22].status=='No Class')}" title="{{d.days[22].remarks}}">{{d.days[22].date}}</td>
														<td ng-click="setDate(i,23,d.days[23])" ng-class="{clickable:(d.days[23]),noClassToday:(d.days[23].status=='No Class')}" title="{{d.days[23].remarks}}">{{d.days[23].date}}</td>
														<td ng-click="setDate(i,24,d.days[24])" ng-class="{clickable:(d.days[24]),noClassToday:(d.days[24].status=='No Class')}" title="{{d.days[24].remarks}}">{{d.days[24].date}}</td>
														<td ng-click="setDate(i,25,d.days[25])" ng-class="{clickable:(d.days[25]),noClassToday:(d.days[25].status=='No Class')}" title="{{d.days[25].remarks}}">{{d.days[25].date}}</td>
														<td ng-click="setDate(i,26,d.days[26])" ng-class="{clickable:(d.days[26]),noClassToday:(d.days[26].status=='No Class')}" title="{{d.days[26].remarks}}">{{d.days[26].date}}</td>
														<td ng-click="setDate(i,27,d.days[27])" ng-class="{clickable:(d.days[27]),noClassToday:(d.days[27].status=='No Class')}" title="{{d.days[27].remarks}}">{{d.days[27].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,28,d.days[28])" ng-class="{clickable:(d.days[28]),noClassToday:(d.days[28].status=='No Class')}" title="{{d.days[28].remarks}}">{{d.days[28].date}}</td>
														<td ng-click="setDate(i,29,d.days[29])" ng-class="{clickable:(d.days[29]),noClassToday:(d.days[29].status=='No Class')}" title="{{d.days[29].remarks}}">{{d.days[29].date}}</td>
														<td ng-click="setDate(i,30,d.days[30])" ng-class="{clickable:(d.days[30]),noClassToday:(d.days[30].status=='No Class')}" title="{{d.days[30].remarks}}">{{d.days[30].date}}</td>
														<td ng-click="setDate(i,31,d.days[31])" ng-class="{clickable:(d.days[31]),noClassToday:(d.days[31].status=='No Class')}" title="{{d.days[31].remarks}}">{{d.days[31].date}}</td>
														<td ng-click="setDate(i,32,d.days[32])" ng-class="{clickable:(d.days[32]),noClassToday:(d.days[32].status=='No Class')}" title="{{d.days[32].remarks}}">{{d.days[32].date}}</td>
														<td ng-click="setDate(i,33,d.days[33])" ng-class="{clickable:(d.days[33]),noClassToday:(d.days[33].status=='No Class')}" title="{{d.days[33].remarks}}">{{d.days[33].date}}</td>
														<td ng-click="setDate(i,34,d.days[34])" ng-class="{clickable:(d.days[34]),noClassToday:(d.days[34].status=='No Class')}" title="{{d.days[34].remarks}}">{{d.days[34].date}}</td>
													</tr>
													<tr ng-if="(d.days[35])" class="text-center">
														<td ng-click="setDate(i,35,d.days[35])" ng-class="{clickable:(d.days[35]),noClassToday:(d.days[35].status=='No Class')}" title="{{d.days[35].remarks}}">{{d.days[35].date}}</td>
														<td ng-click="setDate(i,26,d.days[36])" ng-class="{clickable:(d.days[36]),noClassToday:(d.days[36].status=='No Class')}" title="{{d.days[36].remarks}}">{{d.days[36].date}}</td>
														<td ng-click="setDate(i,37,d.days[37])" ng-class="{clickable:(d.days[37]),noClassToday:(d.days[37].status=='No Class')}" title="{{d.days[37].remarks}}">{{d.days[37].date}}</td>
														<td ng-click="setDate(i,38,d.days[38])" ng-class="{clickable:(d.days[38]),noClassToday:(d.days[38].status=='No Class')}" title="{{d.days[38].remarks}}">{{d.days[38].date}}</td>
														<td ng-click="setDate(i,39,d.days[39])" ng-class="{clickable:(d.days[39]),noClassToday:(d.days[39].status=='No Class')}" title="{{d.days[39].remarks}}">{{d.days[39].date}}</td>
														<td ng-click="setDate(i,40,d.days[40])" ng-class="{clickable:(d.days[40]),noClassToday:(d.days[40].status=='No Class')}" title="{{d.days[40].remarks}}">{{d.days[40].date}}</td>
														<td ng-click="setDate(i,41,d.days[41])" ng-class="{clickable:(d.days[41]),noClassToday:(d.days[41].status=='No Class')}" title="{{d.days[41].remarks}}">{{d.days[41].date}}</td>
													</tr>
													<tr ng-if="(!d.days[35])">
														<td colspan="7" >&nbsp;</td>
													</tr>
												</tbody>
											</table>
										</div>
										<br/><br/><br/>
										<div class="col-md-4">
											<div class="row">
												<div class="col-md-12 hide">
													<label>Object</label>
													<input ng-model="calendarObject[i]" class="form-control input-sm" readonly="readonly">
												</div>
												<div class="col-md-12">
													<label>Date</label>
													<input type="date" ng-model="calendarDate[i]" class="form-control"  ng-class="class[i]" readonly="readonly">
												</div>
												<div class="col-md-12">
													<label>Status</label>
													<select ng-disabled="(!calendarObject[i])?true:false" ng-model="dayStatus[i]" ng-options="d.name for d in statuses" class="form-control input-sm">
														<option value="">-- Select --</option>
													</select>
												</div>
												<div class="col-md-12">
													<label>Remarks</label>
													<input ng-model="dayRemark[i]" type="text" class="form-control input-sm">
												</div>
												<div class="col-md-12"><br/>
													<button ng-disabled="(!calendarObject[i] || !dayStatus[i])?true:false"  ng-click="add(i,calendarObject[i])" class="btn btn-warning btn-sm pull-right">ADD</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="text-right">
						<button class="btn btn-primary" type="button" ng-click="save()">Save Calendar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/set_school_days',array('inline'=>false)); ?>
