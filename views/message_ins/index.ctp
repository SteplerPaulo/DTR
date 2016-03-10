<div ng-controller="MessageInController" ng-init="initializeController()">	
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
				<th>Sender</th>
				<th>Reciever</th>
				<th>Reference</th>
				<th>Recieved Time</th>
				<th>Message</th>
				<th class="actions text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="MessageInTable" dir-paginate="ib in inbox | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{ib.MessageOut.Id}}</td>
				<td>{{ib.MessageOut.MessageFrom}}</td>
				<td>{{ib.MessageOut.MessageTo}}</td>
				<td>~</td>
				<td>{{ib.MessageOut.SendDate}} {{ib.MessageOut.SendTime}}</td>
				<td>{{ib.MessageOut.MessageText}}</td>
				<td class="actions text-center">
					<a data-toggle="tooltip" title="Forward" href="#"><i class="fa fa-share"> </i></a> 
					<a data-toggle="tooltip" title="Move to Archive" href="#"><i class="fa fa-archive"> </i></a> 
					<a data-toggle="tooltip" title="Delete" href="#"><i class="fa fa-trash"> </i></a>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="text-center">
					<dir-pagination-controls pagination-id="MessageInTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>
<?php echo $this->Html->script('controllers/message_ins',array('inline'=>false));?>


