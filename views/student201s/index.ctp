<div ng-controller="Student201Controller" ng-init="initializeController()">	
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

	<table class="table table-hovered table-striped">
		<thead>
			<tr>
				<td colspan="3"></td>
				<td colspan="1" class="text-right"><a class="btn btn-warning btn-sm " href="/DTR/student201s/add">Create New Student 201</a></td>
			</tr>
			<tr>
				<th>Student Number</th>
				<th>Name</th>
				<th>Has RFID</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="StudentListTable" dir-paginate="s in students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{s.Student201.student_number}}</td>
				<td>{{s.Student201.full_name}}</td>
				<td>{{s.Student201.has_rfid_string}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="Assign RFID" href="/DTR/rfid_students/assign/1:{{s.Student201.student_number}}"><i class="fa fa-tags"></i></a>
					<a data-toggle="tooltip" title="Edit" href="/DTR/student201s/edit/{{s.Student201.id}}"><i class="fa fa-edit"></i></a>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" class="text-center">
					<dir-pagination-controls pagination-id="StudentListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<?php echo $this->Html->script('controllers/student201s',array('inline'=>false));?>





