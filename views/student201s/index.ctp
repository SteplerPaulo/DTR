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

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Student Number</th>
				<th>Name</th>
				<th>Has RFID</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="ContactListTable" dir-paginate="s in students | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{s.Student201.id}}</td>
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
					<dir-pagination-controls pagination-id="ContactListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Student', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('controllers/student201s',array('inline'=>false));?>




