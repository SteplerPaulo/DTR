<div ng-controller="StudentListController" ng-init="initializeController()">	
	<div class="row">
		<div class="col-lg-4 col-md-4 col-xs-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
		<div class="col-lg-4  col-md-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-xs-offset-4 ">
			<label for="search">Items per page</label>
			<input type="number" min="1" max="100" class="form-control input-sm" ng-model="pageSize">
		</div>
	</div><br/>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Student Number</th>
				<th>Name</th>
				<th>Student Mobile No</th>
				<th>Guardian Mobile No</th>
				<th>Relationship</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="StudentListTable" dir-paginate="stud in students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{stud.RfidStudent.student_number}}</td>
				<td>{{stud.RfidStudent.full_name}}</td>
				<td>{{stud.RfidStudent.student_mobile_no}}</td>
				<td>{{stud.RfidStudent.guardian_mobile_no}}</td>
				<td>{{stud.RfidStudent.relationship}}</td>
				<td class="actions text-center">
					<a href="/DTR/rfid_students/edit/{{stud.RfidStudent.id}}" data-toggle="tooltip" title="Add or edit contact informations"><i class="fa fa-edit"></i></a>
				</td>
		
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="text-center">
					<dir-pagination-controls pagination-id="StudentListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<?php echo $this->Html->script('controllers/students',array('inline'=>false));?>