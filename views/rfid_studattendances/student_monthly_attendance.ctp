<div ng-controller="PrintStudentMonthlyAttendance" ng-init="initializeController()">
	<section class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="panel-title">Student Monthly Attendance</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<label>Student</label>
							<input class="form-control input-sm" ng-model="studname" id="studname"></input>
						</div>
						<div class="col-lg-4">
							<label>Date</label>
							<input ng-change="filterDate()" type="month" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m')?>">
						</div><!--
						<div class="col-lg-2">
							<button ng-click="edit()" class="btn btn-default" title="Adjust Student Attendance">Edit</button>
						</div>-->
					</div><br/>
					<!--
					<div class="row">
						<div class="col-lg-12">
						
							<table class="table table-bordered">
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
									<tr ng-repeat="(index,d) in data | filter:q">
										<td class="text-center">{{d.date |  date:"MMM. dd"}}</td>
										<td class="text-center">{{d.date |  date:"EEE"}}</td>
										<td class="text-center w20">
											<span ng-if="!editable || index != editableIndex">{{data[index].data[0].formated_timein | date:"HH:mm:ss a"}}</span>
											<input ng-change="changeTime(index)" ng-if="editable && index == editableIndex" type="time" class="form-control input-sm" ng-model="data[index].data.rfid_studattendance.time_in"></input>
										</td>
										<td class="text-center w20">
											<span ng-if="!editable || index != editableIndex">{{data[index].data[0].formated_timeout | date:"HH:mm:ss a"}}</span>
											<input ng-change="changeTime(index)" ng-if="editable && index == editableIndex" type="time" class="form-control input-sm" ng-model="data[index].data.rfid_studattendance.time_out"></input>
										</td>
										<td class="text-center">{{d.data.rfid_studattendance.remarks}}</td>
										<td class="text-center">
											<a ng-if="d.data" ng-click="editAttendance(index)" title="Edit"><i class="fa fa-edit"></i></a>		
											<a ng-if="d.data" title="Delete" confirmed-click="Delete(d)" ng-confirm-click="Are you sure you want to delete this record?"><i disabled="disabled" class="fa fa-trash"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							
							
						
						
						
							
							
						</div>
					</div>
					-->
					
				</div>
				<div class="panel-footer text-right">
					<button ng-disabled="!studname || !date || !editable" class="btn btn-default" ng-click="Update(data)">Update</button>
					<a ng-disabled="!studname ||  !date" href="/DTR/rfid_studattendances/student_attendance_report/{{studno}}/{{studname}}/{{date}}" target="_blank" class="btn btn-primary">Generate PDF</a>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Html->script('template/bootstrap3-typeahead.min',array('inline'=>false));?>
<?php echo $this->Html->script('controllers/rfid_studattendances/student_monthly_attendance',array('inline'=>false)); ?>