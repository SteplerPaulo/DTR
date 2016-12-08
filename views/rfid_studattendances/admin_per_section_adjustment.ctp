<div ng-controller="PerSectionDailyAdjustmentController as $ctr" ng-init="initializeController()">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-xs-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered" id="PerSectionDailyAdjustmentTable">
				<caption style="padding-bottom:10px;">
					<h3 secId="<?php echo $sectionId; ?>" date="<?php echo $date; ?>">
						<span class="pull-left" id="SectionName"><?php echo $sectionName; ?></span>				
					</h3><br/>
				</caption>
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Time In</th>
						<th class="text-center">Time Out</th>
						<th class="text-center">Remarks</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="PerSectionDailyAdjustmentTable" dir-paginate="stud in Students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td>{{stud.StudentName}}</td>
						<td>
							<div  ng-if="stud.Attendance !== undefined" ng-repeat="attend in stud.Attendance">
								<span class="badge" ng-if="attend.TimeInDate.length == '19'">{{attend.TimeInDate | cmdate:'hh:mm a'}}</span>
								<span class="badge-red" ng-if="attend.TimeInDate.length == '11'">No Time In</span>
							</div>
							<div ng-if="stud.Attendance === undefined">
								<span class="badge-red">No Time In</span>
							</div>
						</td>
						<td>
							<div ng-if="stud.Attendance !== undefined" ng-repeat="attend in stud.Attendance">
								<span class="badge" ng-if="attend.TimeOutDate.length == '19'">{{attend.TimeOutDate | cmdate:'hh:mm a'}}</span>
								<span class="badge-red" ng-if="attend.TimeOutDate.length == '11'">No Time Out</span>
							</div>
							<div ng-if="stud.Attendance === undefined">
								<span class="badge-red">No Time Out</span>
							</div>
						</td>
						<td>
							<div ng-if="stud.Attendance" ng-repeat="attend in stud.Attendance" ng-class=" attend.Remarks == 'P' ? 'badge-green' : 'badge-yellow'">
								{{attend.Remarks}}
							</div>
							<div ng-if="stud.Attendance === undefined">
								<span class="badge-red">A</span>
							</div>
						</td>
						<td class="text-center actions">
							<a data-toggle="tooltip" title="Edit" ng-click="$ctr.open(stud,'lg')"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9" class="text-center">
							**END**
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	
	<script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">{{$ctrl.StudentData.StudentName}}</h3>
        </div>
        <div class="modal-body" id="modal-body">
           	<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered" id="StudentAttendanceTable">
						<thead>	
							<tr>
								<td class="text-center">Time In</td>
								<td class="text-center">Time Out</td>
								<td class="text-center">Remarks</td>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="(key, att) in $ctrl.StudentData.Attendance">
								<td>
									<div class="input-group">
										<input ng-disabled="true" type="time" class="form-control input-sm" value="{{att.TimeIn |date:'HH:mm'}}"></input>
										<span class="input-group-btn">
											<button class="btn btn-default btn-sm" ng-click="$ctrl.copyTimeIn(att)">Copy <i class="fa fa-copy"></i></button>
										</span>
									</div>
								</td>
								<td>
									<div class="input-group">
										<input ng-disabled="true" type="time" class="form-control input-sm" value="{{att.TimeOut |date:'HH:mm'}}"></input>
										<span class="input-group-btn">
											<button class="btn btn-default btn-sm" ng-click="$ctrl.copyTimeOut(att)">Copy <i class="fa fa-copy"></i></button>
										</span>
									</div>
								</td>
								<td class="text-center">{{att.Remarks}}</td>
								<td class="text-center actions">
									<!--<button class="btn btn-default btn-sm" type="button">Copy Row <i class="fa fa-download"></i></button>-->
								</td>
							</tr>
							<tr ng-form="$ctrl.AttendanceForm">
								<td><input value="{{$ctrl.TimeInDate |date:'HH:mm'}}" type="time" class="form-control input-sm input-group" ng-disabled="!$ctrl.active" ng-model="$ctrl.TimeIn"  ng-required="true"></input></td>
								<td><input  value="{{$ctrl.TimeOutDate |date:'HH:mm'}}"  type="time" class="form-control input-sm input-group" ng-disabled="!$ctrl.active" ng-model="$ctrl.TimeOut" ng-required="true"></input></td>
								<td>
									<select class="form-control input-sm" ng-disabled="!$ctrl.active" ng-model="$ctrl.Remarks" ng-required="true">
										<option value="">Select</option>
										<?php foreach($remarks as $rem_k =>$rem):?>
											<option value="<?php echo $rem_k ?>"><?php echo $rem ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td class="text-center actions">
									<a data-toggle="tooltip" title="Activate" ng-click="$ctrl.on()" ng-if="$ctrl.active == false">
										<i class="fa fa-toggle-off" aria-hidden="true"></i>
									</a>
									<a data-toggle="tooltip" title="Activate" ng-click="$ctrl.off()" ng-if="$ctrl.active == true">
										<i class="fa fa-toggle-on" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <div class="modal-footer">
            <button id="SaveButton" class="btn btn-primary" ng-click="$ctrl.save()" ng-disabled="!$ctrl.AttendanceForm.$valid">Save</button>
            <button class="btn btn-warning" ng-click="$ctrl.cancel()">Cancel</button>
		</div>
    </script>
</div>

<?php echo $this->Html->script('controllers/per_section_daily_adjustment',array('inline'=>false));?>