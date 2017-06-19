<div ng-controller="SchedulesController" ng-init="initializeController()" class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="panel-title">Schedules</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-5 col-md-5 col-xs-5">
						<label for="search">Search</label>
						<input ng-model="q" class="form-control input-sm" placeholder="Filter text">
					</div>
					<div class="col-lg-2 col-md-2 col-xs-2 col-lg-offset-5 col-md-offset-5 col-xs-offset-5">
						<label for="search">Items per page</label>
						<input type="number" min="1" max="100" class="form-control input-sm" ng-model="pageSize">
					</div>
				</div><br/>
				<table class="table table-bordered table-condensed table-striped">
					<thead>
						<tr>
							<th class="text-right" colspan="5">
								<a href="<?php echo $this->base;?>/schedules/add" class="btn btn-warning btn-sm" >Add Schedule</a>
							</th>
						</tr>
						<tr>
							<th class="text-center">Section</th>
							<th class="text-center">Start Time</th>
							<th class="text-center">End Time</th>
							<th class="text-center">S.Y.</th>
							<th class="text-center actions w8">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr pagination-id="SchedulesTable" dir-paginate="(i,o) in schedules | filter:q | itemsPerPage: pageSize">
							<td>{{o.Section.name}}</td>
							<td class="text-center">{{o.Schedule.start_time}}</td>
							<td class="text-center">{{o.Schedule.end_time}}</td>
							<td class="text-center">{{o.SchoolYear.name}}</td>
							<td class="text-center">
								<a href="/DTR/schedules/edit/{{o.Schedule.id}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5" class="text-center">
								<dir-pagination-controls pagination-id="SchedulesTable"></dir-pagination-controls>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/schedules',array('inline'=>false)); ?>