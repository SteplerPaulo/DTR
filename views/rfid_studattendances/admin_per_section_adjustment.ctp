<div ng-controller="PerSectionDailyAdjustmentController" ng-init="initializeController()">
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
						<th class="text-center" rowspan='2'>Name</th>
						<th class="text-center" colspan="2">AM</th>
						<th class="text-center" colspan="2">PM</th>
						<th class="text-center" rowspan='2'>Remarks</th>
						<th class="text-center" rowspan='2'>Actions</th>
					</tr>
					<tr>
						<th class="text-center">In</th>
						<th class="text-center">Out</th>
						<th class="text-center">In</th>
						<th class="text-center">Out</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="PerSectionDailyAdjustmentTable" dir-paginate="stud in students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td>{{stud[0].full_name}}</td>
						<td>{{stud.Attendance.AM.time_in}}</td>
						<td>{{stud.Attendance.AM.time_out}}</td>
						<td>{{stud.Attendance.PM.time_in}}</td>
						<td>{{stud.Attendance.PM.time_out}}</td>
						<td>{{stud.Attendance.remarks}}</td>
						<td class="text-center actions">
							<a data-toggle="tooltip" title="Edit" ng-click="edit(stud)"><i class="fa fa-edit"></i></a>
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
	<!-- Modal -->
	<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>	
									<tr class="alert alert-info">
										<td class="text-center" colspan="2">AM</td>
										<td class="text-center" colspan="2">PM</td>
										<td class="text-center" colspan="2"></td>
									</tr>
									<tr>
										<td>Time In</td>
										<td>Time Out</td>
										<td>Time In</td>
										<td>Time Out</td>
										<td>Status</td>
										<td>Change</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="AMTimeIn" type="time" class="form-control input-sm input-group"></td>
										<td><input id="AMTimeOut" type="time" class="form-control input-sm input-group"></input></td>
										<td><input id="PMTimeIn" type="time" class="form-control input-sm input-group"></input></td>
										<td><input id="PMTimeOut" type="time" class="form-control input-sm input-group"></input></td>
										<td id="Remarks"></td>
										<td>
											<select class="form-control input-sm" id="UpdatedRemarks">
												<option>Select</option>
												<?php foreach($remarks as $rem):?>
													<option value="<?php echo $rem ?>"><?php echo $rem ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="SaveButton">Save</button>
				</div>
			</div>
		</div>
	</div>

</div>
<?php echo $this->Html->script('controllers/per_section_daily_adjustment',array('inline'=>false));?>