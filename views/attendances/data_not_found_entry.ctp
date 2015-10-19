<div ng-controller="DataNotFoundReportController" ng-init="initializeController()">
	<div class="row-fluid">

		<div class="col-lg-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control" placeholder="Filter text">
			
		</div>
		<div class="col-lg-4 col-lg-offset-4">
			<label for="search">Items per page</label>
			<input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
		</div>
	</div><br/>
	
	<table class="table table-bordered col-lg-12">
		<caption><h3>RFID DATA NOT FOUND ENTRY</h3></caption>
		<thead>
			<tr>
				<th class="text-center w10" rowspan="2">Entered RFID No.</th>
				<th class="text-center w30" rowspan="2">Name</th>
				<th class="text-center w10" rowspan="2">RFID Type</th>
				<th class="text-center w10" rowspan="2">Employee No. / Student No.</th>
				<th class="text-center w10" rowspan="2">Date</th>
				<th class="text-center w10" rowspan="2">Day</th>
				<th class="text-center w10" colspan="2">Time</th>
			</tr>
			<tr>
				<th class="text-center">In</th>
				<th class="text-center">Out</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="Table" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td class="text-center">{{d.Attendance.rfid}}</td>
				<td class="text-center">{{d.RFID201.full_name}}</td>
				<td class="text-center">{{d.RFID201.type_string}}</td>
				<td class="text-center">{{d.RFID201.student_number}}{{d.Attendance.student_number}}</td>
				<td class="text-center">{{d.Attendance.date |  date:"MMM dd, yyyy" }}</td>
				<td class="text-center">{{d.Attendance.date |  date:"EEEE" }}</td>
				<td class="text-center">{{d.Attendance.timein}}</td>
				<td class="text-center">{{d.Attendance.timeout}}</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8" class="text-center">
					<dir-pagination-controls pagination-id="Table"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php echo $this->Html->script('controllers/data_not_found_report',array('inline'=>false)); ?>