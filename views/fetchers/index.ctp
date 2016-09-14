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

	<table class="table table-hovered table-striped">
		<thead>
			<tr>
				<td colspan="2"></td>
				<td colspan="1" class="text-right"><a class="btn btn-warning btn-sm " href="/DTR/fetchers/registration">Create New Fetcher 201</a></td>
			</tr>
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
					<a data-toggle="tooltip" title="Upload Fetcher's Photo" href="/DTR/fetchers/profile/{{s.Fetcher.id}}"><i class="fa fa-file-image-o"></i></a>
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
<?php echo $this->Html->script('controllers/fetchers',array('inline'=>false));?>
