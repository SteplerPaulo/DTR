<div ng-controller="SectionController" ng-init="initializeController()">	
	<div class="row">
		<div class="col-lg-4">
			<label for="search">Search</label>
			<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
		<div class="col-lg-2">
			<label for="search">Items per page</label>
			<input type="number" min="1" max="100" class="form-control input-sm" ng-model="pageSize">
		</div>
		<div class="col-lg-6 text-right">
			<br>
			<a class="btn btn-warning" href="/DTR/sections/add">Create New Section</a></td>
		</div>
	</div><br/>
	<table class="table table-hovered table-striped">
		<thead>
			<tr>
				<th>Section Code</th>
				<th class="text-center"class="actions text-center">Name</th>
				<th class="text-center">Enrolled Student(s)</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="StudentListTable" dir-paginate="s in sections | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td >{{s.Section.id}}</td>
				<td class="text-center">{{s.Section.name}}</td>
				<td class="text-center">{{s.Student201.length}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="Edit" href="/DTR/sections/edit/{{s.Section.id}}"><i class="fa fa-edit"></i></a>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
					<dir-pagination-controls pagination-id="StudentListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<?php echo $this->Html->script('controllers/sections',array('inline'=>false));?>