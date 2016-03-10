<div ng-controller="MessageOutController" ng-init="initializeController()">	
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
				<th colspan="7">
					<div class="text-right">
						<a href="/DTR/message_outs/create_message" class="btn btn-primary" ng-click="CreateNewMessage()">	
							<i class="fa fa-envelope-o"></i>
							Create New Message
						</a>
					</div>
				</th>
			</tr>
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
			<tr pagination-id="MessageOutTable" dir-paginate="ob in outbox | filter:q | itemsPerPage: pageSize" current-page="currentPage">
				<td>{{ob.MessageOut.Id}}</td>
				<td>{{ob.MessageOut.MessageFrom}}</td>
				<td>{{ob.MessageOut.MessageTo}}</td>
				<td>~</td>
				<td>{{ob.MessageOut.SendDate}} {{ob.MessageOut.SendTime}}</td>
				<td>{{ob.MessageOut.MessageText}}</td>
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
					<dir-pagination-controls pagination-id="MessageOutTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
</div>

<!--
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Message Out', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('controllers/message_outs',array('inline'=>false));?>



-->