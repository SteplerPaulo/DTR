<div ng-controller="FetchersController" ng-init="initializeController()">	
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
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="FetcherListTable" dir-paginate="s in fetchers | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{s.Fetcher.id}}</td>
				<td>{{s.Fetcher.full_name}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="View Fetcher Profile" href="/DTR/fetchers/profile/{{s.Fetcher.id}}"><i class="fa fa-eye"></i></a>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" class="text-center">
					<dir-pagination-controls pagination-id="FetcherListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Fetcher Registration', true), array('action' => 'registration')); ?></li>
	</ul>
</div>
<?php echo $this->Html->script('controllers/fetchers',array('inline'=>false));?>
