<div ng-controller="PerSectionDailyAdjustmentController as $ctr" ng-init="initializeController()">
	
	<div class="row">
		<div class="col-lg-4 col-md-4 col-xs-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
	</div><hr/>
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
						<th class="text-center">In</th>
						<th class="text-center">Out</th>
						<th class="text-center">Remarks</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="PerSectionDailyAdjustmentTable" dir-paginate="stud in Students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td>{{stud.StudentName}}</td>
						<td>
							<div ng-repeat="attend in stud.Attendance" class="badge">
								{{attend.TimeIn}}
							</div>
						</td>
						<td>
							<div ng-repeat="attend in stud.Attendance" class="badge">
								{{attend.TimeOut}}
							</div>
						</td>
						<td>
							<div ng-repeat="attend in stud.Attendance" class="badge">
								{{attend.Remarks}}
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
								<td class="text-center">Status</td>
								<td class="text-center">Change</td>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="att in $ctrl.StudentData.Attendance">
								<td><input id="TimeIn" type="time" class="form-control input-sm input-group" value="{{att.TimeIn}}"></input></td>
								<td><input id="TimeOut" type="time" class="form-control input-sm input-group" value="{{att.TimeOut}}"></input></td>
								<td id="Remarks">{{att.Remarks}}</td>
								<td>
									<select id="UpdatedRemarks" class="form-control input-sm" >
										<option value="">Select</option>
										<?php foreach($remarks as $rem_k =>$rem):?>
											<option value="<?php echo $rem_k ?>"><?php echo $rem ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td class="text-center actions">
									| <a data-toggle="tooltip" title="Remove" ng-click="$ctrl.remove($index)"><i class="fa fa-cut"></i></a> | 
									<a data-toggle="tooltip" title="Change"><i class="fa fa-save"></i></a> |
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <div class="modal-footer">
            <button id="SaveButton" class="btn btn-primary" type="button" ng-click="$ctrl.save()">Save</button>
            <button class="btn btn-warning" type="button" ng-click="$ctrl.cancel()">Cancel</button>
		</div>
    </script>
</div>

<?php echo $this->Html->script('controllers/per_section_daily_adjustment',array('inline'=>false));?>