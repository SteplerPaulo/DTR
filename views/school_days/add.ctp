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
	.grey{
		background-color: #e1e6ea;
	}
	.red{
		background-color: #e1e6ea;
	}
	.clickable{
		cursor:pointer;
	}
	.clickable:hover{
		background-color: #b3bbc1;
	}
	.clickable.noclass:hover{
		background-color: #6f0c0c !important;
	}
	.noclass{
		background-color: #a42525 !important;
		color: #ffffff;
	}
	
	.notIncluded{
		cursor:not-allowed;
		text-decoration:line-through;
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
														<td ng-click="setDate(i,0)" ng-class="d.days[0].tdClass" title="{{d.days[0].remarks}}">{{d.days[0].date}}</td>
														<td ng-click="setDate(i,1)" ng-class="d.days[1].tdClass" title="{{d.days[1].remarks}}">{{d.days[1].date}}</td>
														<td ng-click="setDate(i,2)" ng-class="d.days[2].tdClass" title="{{d.days[2].remarks}}">{{d.days[2].date}}</td>
														<td ng-click="setDate(i,3)" ng-class="d.days[3].tdClass" title="{{d.days[3].remarks}}">{{d.days[3].date}}</td>
														<td ng-click="setDate(i,4)" ng-class="d.days[4].tdClass" title="{{d.days[4].remarks}}">{{d.days[4].date}}</td>
														<td ng-click="setDate(i,5)" ng-class="d.days[5].tdClass" title="{{d.days[5].remarks}}">{{d.days[5].date}}</td>
														<td ng-click="setDate(i,6)" ng-class="d.days[6].tdClass" title="{{d.days[6].remarks}}" data-toggle="tooltip" >{{d.days[6].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,7)"  ng-class="d.days[7].tdClass" title="{{d.days[7].remarks}}">{{d.days[7].date}}</td>
														<td ng-click="setDate(i,8)"  ng-class="d.days[8].tdClass" title="{{d.days[8].remarks}}">{{d.days[8].date}}</td>
														<td ng-click="setDate(i,9)"  ng-class="d.days[9].tdClass" title="{{d.days[9].remarks}}">{{d.days[9].date}}</td>
														<td ng-click="setDate(i,10)" ng-class="d.days[10].tdClass" title="{{d.days[10].remarks}}">{{d.days[10].date}}</td>
														<td ng-click="setDate(i,11)" ng-class="d.days[11].tdClass" title="{{d.days[11].remarks}}">{{d.days[11].date}}</td>
														<td ng-click="setDate(i,12)" ng-class="d.days[12].tdClass" title="{{d.days[12].remarks}}">{{d.days[12].date}}</td>
														<td ng-click="setDate(i,13)" ng-class="d.days[13].tdClass" title="{{d.days[13].remarks}}">{{d.days[13].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,14)" ng-class="d.days[14].tdClass" title="{{d.days[14].remarks}}">{{d.days[14].date}}</td>
														<td ng-click="setDate(i,15)" ng-class="d.days[15].tdClass" title="{{d.days[15].remarks}}">{{d.days[15].date}}</td>
														<td ng-click="setDate(i,16)" ng-class="d.days[16].tdClass" title="{{d.days[16].remarks}}">{{d.days[16].date}}</td>
														<td ng-click="setDate(i,17)" ng-class="d.days[17].tdClass" title="{{d.days[17].remarks}}">{{d.days[17].date}}</td>
														<td ng-click="setDate(i,18)" ng-class="d.days[18].tdClass"  title="{{d.days[18].remarks}}">{{d.days[18].date}}</td>
														<td ng-click="setDate(i,19)" ng-class="d.days[19].tdClass"  title="{{d.days[19].remarks}}">{{d.days[19].date}}</td>
														<td ng-click="setDate(i,20)" ng-class="d.days[20].tdClass"  title="{{d.days[20].remarks}}">{{d.days[20].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,21)" ng-class="d.days[21].tdClass" title="{{d.days[21].remarks}}">{{d.days[21].date}}</td>
														<td ng-click="setDate(i,22)" ng-class="d.days[22].tdClass" title="{{d.days[22].remarks}}">{{d.days[22].date}}</td>
														<td ng-click="setDate(i,23)" ng-class="d.days[23].tdClass" title="{{d.days[23].remarks}}">{{d.days[23].date}}</td>
														<td ng-click="setDate(i,24)" ng-class="d.days[24].tdClass" title="{{d.days[24].remarks}}">{{d.days[24].date}}</td>
														<td ng-click="setDate(i,25)" ng-class="d.days[25].tdClass" title="{{d.days[25].remarks}}">{{d.days[25].date}}</td>
														<td ng-click="setDate(i,26)" ng-class="d.days[26].tdClass" title="{{d.days[26].remarks}}">{{d.days[26].date}}</td>
														<td ng-click="setDate(i,27)" ng-class="d.days[27].tdClass" title="{{d.days[27].remarks}}">{{d.days[27].date}}</td>
													</tr>
													<tr class="text-center">
														<td ng-click="setDate(i,28)" ng-class="d.days[28].tdClass" title="{{d.days[28].remarks}}">{{d.days[28].date}}</td>
														<td ng-click="setDate(i,29)" ng-class="d.days[29].tdClass" title="{{d.days[29].remarks}}">{{d.days[29].date}}</td>
														<td ng-click="setDate(i,30)" ng-class="d.days[30].tdClass" title="{{d.days[30].remarks}}">{{d.days[30].date}}</td>
														<td ng-click="setDate(i,31)" ng-class="d.days[31].tdClass" title="{{d.days[31].remarks}}">{{d.days[31].date}}</td>
														<td ng-click="setDate(i,32)" ng-class="d.days[32].tdClass" title="{{d.days[32].remarks}}">{{d.days[32].date}}</td>
														<td ng-click="setDate(i,33)" ng-class="d.days[33].tdClass" title="{{d.days[33].remarks}}">{{d.days[33].date}}</td>
														<td ng-click="setDate(i,34)" ng-class="d.days[34].tdClass"title="{{d.days[34].remarks}}">{{d.days[34].date}}</td>
													</tr>
													<tr ng-if="(d.days[35])" class="text-center">
														<td ng-click="setDate(i,35)" ng-class="d.days[35].tdClass" title="{{d.days[35].remarks}}">{{d.days[35].date}}</td>
														<td ng-click="setDate(i,26)" ng-class="d.days[36].tdClass" title="{{d.days[36].remarks}}">{{d.days[36].date}}</td>
														<td ng-click="setDate(i,37)" ng-class="d.days[37].tdClass" title="{{d.days[37].remarks}}">{{d.days[37].date}}</td>
														<td ng-click="setDate(i,38)" ng-class="d.days[38].tdClass" title="{{d.days[38].remarks}}">{{d.days[38].date}}</td>
														<td ng-click="setDate(i,39)" ng-class="d.days[39].tdClass" title="{{d.days[39].remarks}}">{{d.days[39].date}}</td>
														<td ng-click="setDate(i,40)" ng-class="d.days[40].tdClass" title="{{d.days[40].remarks}}">{{d.days[40].date}}</td>
														<td ng-click="setDate(i,41)" ng-class="d.days[41].tdClass" title="{{d.days[41].remarks}}">{{d.days[41].date}}</td>
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
						<button class="btn btn-primary" type="button" ng-click="save()" ng-disabled="preventDoubleClick">Save Calendar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/set_school_days',array('inline'=>false)); ?>
