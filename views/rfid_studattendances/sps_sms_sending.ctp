<style>
table .active,.thumbnail .active{
	background-color: #bcc2e9 !important;
    border-color: #81839833 !important;
}
</style>
<div ng-controller="SPSSMSSENDING" ng-init="initializeController()">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="panel-title">SPS DAILY SMS SENDING</span>
		</div>
		<div class="panel-body">
			<section class="row">
				<div class="col-lg-2">
					<label>Date</label>
					<input type="date" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m-d')?>" ng-change="getData(level,date)">
				</div>
				<div class="col-lg-2">
					<label>Level</label>
					<select class='form-control input-sm' ng-model='level' ng-change="getData(level,date)">
						<option value="">--Select--</option>
						<option ng-repeat="d in levels" ng-value="d.Level.id">{{d.Level.name}}</option>
					</select>
				</div>
				<div class="col-lg-2">
					<label>Filter By</label>
					<select class='form-control input-sm' ng-model='q'>
						<option value="">Absent & Late</option>
						<option ng-repeat="d in filters">{{d}}</option>
					</select>
				</div>
				<div class="col-lg-2">
					<!--<label>Start Time</label>
					<input type="time" class="form-control input-sm" ng-model="start_time" ng-change="updateRemarks()">-->
				</div>
				<div class="col-lg-2 col-lg-offset-2">
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
					<table class="table table-striped table-bordered table-condensed">
						<tbody>
							<tr ng-repeat="(k,d) in students | filter:q" ng-if="d.RfidStudattendance.remarks=='A' || d.RfidStudattendance.remarks=='L'">
								<td>{{d.RfidStudattendance.student_name}}</td>
								<td>{{d.RfidStudattendance.section}}</td>
								<td class="text-center">{{d.RfidStudattendance.remark_name}}</td>
								<td ng-if="d.RfidStudattendance.time_in" class="text-center">{{d.RfidStudattendance.time_in}}</td>
								<td ng-if="!d.RfidStudattendance.time_in" style="color:red" class="text-center">No Time In</td>
								<td class="text-center">
									<span style="color:red" ng-if="d.RfidStudattendance.is_posted">Posted</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
			<section class="row" ng-if="th">
				<div class="col-lg-2 col-md-2 col-sm-2" ng-repeat="(k,d) in students | filter:q" ng-if="(d.RfidStudattendance.remarks=='A' || d.RfidStudattendance.remarks=='L')">
					<div class="thumbnail">
						<img ng-if="!d.RfidStudattendance.img_path"  src="../img/noidpicturesacred.jpg" alt="...">
						<img ng-if="d.RfidStudattendance.img_path" src="/DTR/img/fortagging/{{d.RfidStudattendance.img_path}}" onError="this.onerror=null;this.src='../img/noidpicturesacred.jpg';">
						<div class="caption" style="height:110px">
							<h6>{{d.RfidStudattendance.student_name}}</h6>
							<h6>{{d.RfidStudattendance.section}} | {{d.RfidStudattendance.remark_name}} <span style="color:red" ng-if="d.RfidStudattendance.is_posted">| Posted</span></h6>
							<h6>Time In: 
								<strong ng-if="d.RfidStudattendance.time_in">{{d.RfidStudattendance.time_in}} <!--| {{d.RfidStudattendance.start_time}}--></strong>
								<strong ng-if="!d.RfidStudattendance.time_in" style="color:red">No Time In</strong>
							</h6>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="panel-footer text-right">
			<button type="button" class="btn btn-sm btn-primary" ng-click="send()">Send SMS</button>
		</div>
	</div>
</div>

<?php echo $this->Html->script('controllers/sps_sms_sending',array('inline'=>false)); ?>