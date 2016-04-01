<div ng-controller="ContactListController" ng-init="initializeController()">	
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
				<th>Name</th>
				<th>Mobile No</th>
				<th>Tags</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="ContactListTable" dir-paginate="c in contacts | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{c.Contact.id}}</td>
				<td>{{c.Contact.name}}</td>
				<td>{{c.Contact.mobile_no}}</td>
				<td>{{c.Contact.tags}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="Edit" href="/DTR/contacts/edit/{{c.Contact.id}}"><i class="fa fa-edit"></i></a>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="text-center">
					<dir-pagination-controls pagination-id="ContactListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Contact', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('controllers/contacts',array('inline'=>false));?>
