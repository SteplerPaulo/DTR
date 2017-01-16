<div ng-controller="StudentAttendanceReportController" ng-init="initializeController()">
	<section class="row">
		<div class="col-lg-12">
			<!--
			Per Student Only: {{perStudentOnly}} <br/>
			Per Section Only: {{perSectionOnly}}<br/>
			-->
			<div class="btn-group btn-group-sm" >
				<button ng-if="perSectionOnly || (!perSectionOnly&&!perStudentOnly)" type="button" class="btn btn-warning" ng-class="{active: perSection}" ng-click="perWhat('Section')">Per Section Report</button>
				<button ng-if="perStudentOnly || (!perSectionOnly&&!perStudentOnly)"type="button" class="btn btn-warning" ng-class="{active: perStudent}" ng-click="perWhat('Student')">Per Student Report</button>
			</div>
		</div>
	</section>
	<hr>
	<section class="row" ng-if="perSection">
		<div class=" col-lg-5">
			<div class="row">
				<div  class="col-lg-6" >
					<label>Report Type</label>
					<select class="form-control" ng-model="typeSelected" ng-change="changedType(typeSelected)" ng-init="typeSelected = types[0]"  data-ng-options="type as type.name for type in types">
					</select>
				</div>
				
				<div  class="col-lg-6" ng-show="DailyReport">
					<label>Date</label>
					<input type="date" class="form-control input-sm" ng-model="Daily" max="<?php echo date('Y-m-d')?>">
				</div>
				<div  class="col-lg-6" ng-hide="DailyReport">
					<label>Month</label>
					<input type="month" class="form-control input-sm" ng-model="Monthly" max="<?php echo date('Y-m')?>">
				</div>
			</div>
			<div class="row">
				<div  class="col-lg-12" >
					<label>Search</label>
					<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
				</div>
			</div>
			<table class="table table-bordered">
				<caption style="padding-bottom: 10px;">
					<h3>
						<span class="pull-left">Sections</span>
						<a class="btn btn-primary pull-right" disabled="disabled"><i class="fa fa-print" > All</i></a>
					</h3>
				</caption>	
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">Name</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="Table" dir-paginate="d in sections | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{d.Section.id}}</td>
						<td class="">{{d.Section.name}}</td>
						<td class="text-center actions">
							<a ng-if="typeSelected.id == 1 && !perSectionOnly" ng-click="perSectionDailyReportAdjustButton(d.Section.id,d.Section.name,Daily)" data-toggle="tooltip" title="Adjust"><i class="fa fa-edit"></a></i>&nbsp;
							<a ng-show="DailyReport" ng-click="printReport(d.Section.id,d.Section.name,Daily)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
							<a ng-hide="DailyReport" ng-click="printReport(d.Section.id,d.Section.name,Monthly)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9" class="text-center">
							<dir-pagination-controls pagination-id="Table"></dir-pagination-controls>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class=" col-lg-7">
			<iframe src="/DTR/rfid_studattendances/daily_report"  width="750" height="600" ></iframe>
		</div>
	</section>

	<section class="row" ng-if="perStudent">
		<div class=" col-lg-5">
			<div class="row">
				<div  class="col-lg-6" >
					<label>Date From</label>
					<input type="date" class="form-control input-sm" id="FromDate" ng-model="fromDate">
				</div>
				<div  class="col-lg-6" >
					<label>Date To</label>
					<input type="date" class="form-control input-sm" id="ToDate" ng-model="toDate" max="{{toDate}}">
				</div>
			</div>
			<div class="row">
				<div  class="col-lg-12" >
					<label>Search</label>
					<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
				</div>
			</div>
			<table class="table table-bordered">
				<caption style="padding-bottom: 10px;">
					<h3>
						<span class="pull-left">Students</span>
						<a class="btn btn-primary pull-right" disabled="disabled"><i class="fa fa-print" > All</i></a>
					</h3>
				</caption>	
				<thead>
					<tr>
						<th class="text-center">Student No.</th>
						<th class="text-center">Name</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="Table" dir-paginate="d in students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{d.RfidStudent.student_number}}</td>
						<td class="">{{d.RfidStudent.full_name}}</td>
						<td class="text-center actions">
							<a ng-if="!perStudentOnly" empno_adjust="{{d.RfidStudent.student_number}}" ng-click="AdjustButton(fromDate,toDate,d.RfidStudent.full_name,d.RfidStudent.student_number)" data-toggle="tooltip" title="Adjust"><i class="fa fa-edit"></a></i>&nbsp;
							<a ng-click="DateFilterModal(fromDate,toDate,d.RfidStudent.full_name,d.RfidStudent.student_number)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9" class="text-center">
							<dir-pagination-controls pagination-id="Table"></dir-pagination-controls>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class=" col-lg-7">
			<iframe src="/DTR/attendances/doc_report"  width="750" height="600"></iframe>
		</div>
	
	</section>
	
	

</div>

<?php echo $this->Html->script('controllers/stud_attendance_report',array('inline'=>false)); ?>