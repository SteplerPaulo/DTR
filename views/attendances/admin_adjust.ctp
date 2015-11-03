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
	
	<table class="table table-bordered col-lg-12" id="AdjustmetTable">
		<caption><h3 empno="<?php echo $empno; ?>" fromdate="<?php echo $fromDate; ?>" todate="<?php echo $toDate; ?>"><?php echo $empname; ?></h3></caption>
		<thead>
			<tr>
				<th class="text-center" rowspan="2">Date</th>
				<th class="text-center" rowspan="2">Day</th>
				<th class="text-center" rowspan="2">In</th>
				<th class="text-center" rowspan="2">Out</th>
				<th class="text-center" rowspan="2">Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="AdjustmetTable" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td class="text-center">{{d.attendances.date |  date:"MMM. dd"}}</td>
				<td class="text-center">{{d.attendances.date |  date:"EEE"}}</td>
				<td class="text-center" rowspan="1">
					<div ng-hide="editingData[d.attendances.id]">{{d[0].formated_timein | date:"mediumTime"}}</div>
					<div ng-show="editingData[d.attendances.id]"><input type="time" step="any" class="form-control input-sm" ng-model="d.attendances.timein" /></div>
				</td>
				<td class="text-center">
					<div ng-hide="editingData[d.attendances.id]">{{d[0].formated_timeout}}</div>
					<div ng-show="editingData[d.attendances.id]"><input type="time" step="any" class="form-control input-sm" ng-model="d.attendances.timeout" /></div>
				</td>
				<td class="text-center">
					<a data-toggle="tooltip" title="Modify" ng-hide="editingData[d.attendances.id]" ng-click="modify(d)"><i class="fa fa-edit"></i></a>
					<a data-toggle="tooltip" title="Update" ng-show="editingData[d.attendances.id]" ng-click="update(d)"><i class="fa fa-save"></i></a>&nbsp;
					<!--<a data-toggle="tooltip" title="Delete" ng-hide="viewField"><i disabled="disabled" class="fa fa-trash"></i></a>-->
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
<?php echo $this->Html->script('controllers/attendance_adjustment',array('inline'=>false));?>