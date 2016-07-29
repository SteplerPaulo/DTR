
<div ng-controller="SectionController" ng-init="initializeController()">	
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
				<th>Section Code</th>
				<th>Name</th>
				<th>Alias</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="StudentListTable" dir-paginate="s in sections | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{s.Section.id}}</td>
				<td>{{s.Section.name}}</td>
				<td>{{s.Section.alias}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="Edit" href="/DTR/sections/edit/{{s.Section.id}}"><i class="fa fa-edit"></i></a>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Section', true), array('action' => 'add')); ?></li>
	</ul>
</div>




<?php echo $this->Html->script('controllers/sections',array('inline'=>false));?>






