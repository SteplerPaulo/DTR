<style>
.active{
	background-color:lawngreen !important;
}
</style>
<div ng-controller="DailyCheckingController" ng-init="initializeController()">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="panel-title">Daily Attendance</span>
			<button class="btn btn-default pull-right">
				<i class="fa fa-user-secret" aria-hidden="true" title="Login as subtitute adviser"></i>
			</button>
		</div>
		<div class="panel-body">
			<section class="row">
				<div class="col-lg-2">
					<label>Section</label>
					<select class='form-control input-sm' ng-model='section' ng-change="getData(section,date)">
						<option value="">--Select--</option>
						<option ng-repeat="d in sections" ng-value="d.Section.id">{{d.Section.name}}</option>
					</select>
				</div>
				<div class="col-lg-2">
					<label>Date</label>
					<input type="date" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m-d')?>" ng-change="getData(section,date)">
				</div>
				<div class="col-lg-2">
					<label>Filter By</label>
					<select class='form-control input-sm' ng-model='q'>
						<option value="">All Students</option>
						<option ng-repeat="d in filters">{{d}}</option>
					</select>
				</div>
				<div class="col-lg-2">
					<label>View</label><br/>
					<button class="btn btn-default" ng-model="th" ng-click="viewStyle('th')" ng-class="th?'active':''">
						<i class="fa fa-th" aria-hidden="true"></i>
					</button>
					<button class="btn btn-default" ng-model="list" ng-click="viewStyle('list')" ng-class="list?'active':''">
						<i class="fa fa-list-ol" aria-hidden="true"></i>
					</button>
				</div>
			</section><br/>
			<section class="row" ng-if="list">
				<div class="col-lg-12">
					<table class="table table-striped">
						<tbody>
							<tr ng-repeat="(k,d) in students | filter:q">
								<td class="w3">{{k+1}}.</td>
								<td>{{d.RfidStudattendance.student_name}}</td>
								<td class="text-right" ng-if="!d.RfidStudattendance.is_posted">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'P'?'active':''" ng-click="remark(k,'P','Present')">Present</button>
										<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'L'?'active':''" ng-click="remark(k,'L','Late')">Late</button>
										<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'A'?'active':''" ng-click="remark(k,'A','Absent')">Absent</button>
									</div>
								</td>
								<td class="text-right" ng-if="d.RfidStudattendance.is_posted">
									<span class="label" ng-class="d.RfidStudattendance.remarks == 'P' ? 'label-success' : (d.RfidStudattendance.remarks == 'L' ? 'label-success' : 'label-danger')">{{d.RfidStudattendance.remark_name}}</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
			<section class="row" ng-if="th">
				<div class="col-lg-2 col-md-2 col-sm-2" ng-repeat="d in students | filter:q">
					<div class="thumbnail">
						<img src="http://placehold.it/400x250" alt="...">
						<div class="caption" style="height:110px">
							<h6 style="padding-bottom:2px">{{d.StudentName}}</h6>
							<div class="btn-group" ng-if="!d.RfidStudattendance.is_posted">
								<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'P'?'active':''" ng-click="remark(k,'P','Present')">Present</button>
								<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'L'?'active':''" ng-click="remark(k,'L','Late')">Late</button>
								<button type="button" class="btn btn-xs btn-default" ng-class="d.RfidStudattendance.remarks == 'A'?'active':''" ng-click="remark(k,'A','Absent')">Absent</button>
							</div>
							<div ng-if="d.RfidStudattendance.is_posted">
								<span class="label" ng-class="d.RfidStudattendance.remarks == 'P' ? 'label-success' : (d.RfidStudattendance.remarks == 'L' ? 'label-success' : 'label-danger')">{{d.RfidStudattendance.remark_name}}</span>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="panel-footer text-right">
			<button type="button" class="btn btn-sm btn-primary" ng-click="post()">Post</button>
		</div>
	</div>
</div>

<?php echo $this->Html->script('controllers/daily_checking',array('inline'=>false)); ?>