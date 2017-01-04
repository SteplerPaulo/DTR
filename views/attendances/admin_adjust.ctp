<div ng-controller="AttendanceAdjustmentController" ng-init="initializeController()">
	<div class="row-fluid">
		<div class="col-lg-4 col-md-4 col-xs-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
		<div class="col-lg-4  col-md-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-xs-offset-4 ">
			<label for="search">Items per page</label>
			<input type="number" min="1" max="100" class="form-control input-sm" ng-model="pageSize">
		</div>
	</div><br/>
	<div class="row-fluid">
		<div class="col-lg-12">
			<table class="table table-bordered" id="AdjustmetTable">
				<caption style="padding-bottom:10px;">
					<h3 empno="<?php echo $empno; ?>" fromdate="<?php echo $fromDate; ?>" todate="<?php echo $toDate; ?>">
						<span class="pull-left" id="EmployeeName"><?php echo $empname; ?></span>				
					</h3><br/>
				</caption>
				<thead>
					<tr>
						<th class="text-center">Date</th>
						<th class="text-center">Day</th>
						<th class="text-center">In</th>
						<th class="text-center">Out</th>
						<th class="text-center">Remarks</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="AdjustmetTable" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{d.attendances.date |  date:"MMM. dd"}}</td>
						<td class="text-center">{{d.attendances.date |  date:"EEE"}}</td>
						<td class="text-center">{{d[0].formated_timein | date:"mediumTime"}}</td>
						<td class="text-center">{{d[0].formated_timeout | date:"mediumTime"}}</td>
						<td class="text-center">{{d.attendances.remarks}}</td>
						<td class="text-center" ng-hide="{{d.attendances.status == posted}}" >
							<a data-toggle="tooltip" title="Edit"  ng-click="open(d,'lg')"><i class="fa fa-edit"></i></a>		
							<a data-toggle="tooltip" title="Delete" confirmed-click="Delete(d)" ng-confirm-click="Are you sure you want to delete this record?"><i disabled="disabled" class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9" class="text-center">
							<dir-pagination-controls pagination-id="AdjustmetTable"></dir-pagination-controls>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="row-fluid">
		<div class="col-lg-12 pull-right">
			<button class="btn btn-warning btn-md" ng-click="Post(data)"><i class="fa fa-check-square-o"> Post</i> </button>
		</div>
	</div><br/><br/>
	
	<!-- Modal 
	<div class="modal fade" id="AddNewEntryModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
				
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-6" id="NewEntryEmpName">
						</div>
						<div class="col-lg-6 col-md-6 col-xs-6" id="NewEntryEmpNo">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-xs-4">
							<div class="form-group">
								<label class="control-label">Date</label>
								<input id="NewEntryDate" type="date" min="2013-10-01" max="" class="form-control input-sm" required="required"></input>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-xs-4">
							<div class="form-group">
								<label class="control-label">Time In</label>
								<input id="NewEntryTimeIn" type="time"  class="form-control input-sm" required="required"></input>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-xs-4">
							<div class="form-group">
								<label class="control-label">Time Out</label>
								<input id="NewEntryTimeOut" type="time" class="form-control input-sm" required="required"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="SaveNewEntry">Save</button>
				</div>
			</div>
		</div>
	</div>
	-->
	
	<script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">{{$ctrl.o[0].full_name}}</h3>
        </div>
        <div class="modal-body" id="modal-body">
           	<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered" id="EmployeeAttendanceTable">
						<thead>	
							<tr>
								<td class="text-center">Time In</td>
								<td class="text-center">Time Out</td>
								<td class="text-center">Remarks</td>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-form="$ctrl.AttendanceForm">
								<td><input type="time" class="form-control input-sm" ng-disabled="!$ctrl.active" ng-model="$ctrl.TimeInDate"  ng-required="true"></input></td>
								<td><input type="time" class="form-control input-sm" ng-disabled="!$ctrl.active" ng-model="$ctrl.TimeOutDate" ng-required="true"></input></td>
								<td>
									<select class="form-control input-sm" ng-model="$ctrl.SelectedRemark" ng-disabled="!$ctrl.active" ng-required="true">
										<option value="">Select</option>
										<option ng-selected="remark.Remark.alias == $ctrl.SelectedRemark" ng-repeat="remark in remarks" value="{{remark.Remark.alias}}" >{{remark.Remark.name}}</option>
									<select>
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
            <button id="SaveButton" class="btn btn-primary" ng-click="$ctrl.save()" ng-disabled="!$ctrl.AttendanceForm.$valid || !$ctrl.active">Save</button>
            <button class="btn btn-warning" ng-click="$ctrl.cancel()">Cancel</button>
		</div>
    </script>
</div>
<?php echo $this->Html->script('controllers/employee_attendance_adjustment',array('inline'=>false));?>