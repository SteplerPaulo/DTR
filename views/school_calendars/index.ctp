<div class="row" ng-controller="CalendarController" ng-init="initializeController()">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">SCHOOL CALENDAR</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<label for="sy">SY</label>
						<select ng-model="sy" ng-options="d.SchoolYear.name for d in school_years" class="form-control input-sm"></select>
					</div>
					<div class="col-md-10">
						<label>&nbsp;</label>
						<div class="text-right">
							<a href="/DTR/school_calendars/add" class="btn btn-warning btn-sm">
								Add School Calendar <i class="fa fa-calendar" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th rowspan="2" class="text-center">Grade/Level</th>
									<th colspan="8" class="text-center">Period</th>
								</tr>
								<tr>
									<th class="text-center" colspan="2">1st</th>
									<th class="text-center" colspan="2">2nd</th>
									<th class="text-center" colspan="2">3rd</th>
									<th class="text-center" colspan="2">4th</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="(k,d) in data">
									<td>{{k}}</td>
									<td class="text-center">
										<a ng-if="d != null && d[1]">{{d[1].date_from | date:'MMM dd,yyyy'}} - {{d[1].date_to | date:'MMM dd,yyyy'}}</a>
										<span ng-if="d == null || !d[1]">----</span>
									</td>
									<td class="text-center">
										<div class="btn-group" ng-if="d != null && d[1]">
											<a href="/DTR/school_calendars/edit/{{d[1].id}}" title="Edit start/end date" class="btn btn-xs btn-default" ><i class="fa fa-edit"></i></a>
											<a href="/DTR/school_days/add/school_calendar_id:{{d[1].id}}" title="Set School Days" class="btn btn-xs btn-default"><i class="fa fa-calendar-check-o"></i></a>
										</div>
									</td>
									<td class="text-center">
										<a ng-if="d != null && d[2]">{{d[2].date_from | date:'MMM dd,yyyy'}} - {{d[2].date_to | date:'MMM dd,yyyy'}}</a>
										<span ng-if="d == null || !d[2]">----</span>
									</td>
									<td class="text-center">
										<div class="btn-group" ng-if="d != null && d[2]">
											<a href="/DTR/school_calendars/edit/{{d[2].id}}" title="Edit start/end date" class="btn btn-xs btn-default" ><i class="fa fa-edit"></i></a>
											<a href="/DTR/school_days/add/school_calendar_id:{{d[2].id}}" title="Set School Days" class="btn btn-xs btn-default" ><i class="fa fa-calendar-check-o"></i></a>
										</div>
									</td>	
									<td class="text-center">
										<a ng-if="d != null && d[3]">{{d[3].date_from | date:'MMM dd,yyyy'}} - {{d[3].date_to | date:'MMM dd,yyyy'}}</a>
										<span ng-if="d == null || !d[3]">----</span>
									</td>
									<td class="text-center">
										<div class="btn-group" ng-if="d != null && d[3]">
											<a href="/DTR/school_calendars/edit/{{d[3].id}}" title="Edit start/end date" class="btn btn-xs btn-default" ><i class="fa fa-edit"></i></a>
											<a href="/DTR/school_days/add/school_calendar_id:{{d[3].id}}" title="Set School Days" class="btn btn-xs btn-default" ><i class="fa fa-calendar-check-o"></i></a>
										</div>
									</td>
									<td class="text-center">
										<a ng-if="d != null && d[4]">{{d[4].date_from | date:'MMM dd,yyyy'}} - {{d[4].date_to | date:'MMM dd,yyyy'}}</a>
										<span ng-if="d == null || !d[4]">----</span>
									</td>
									<td class="text-center">
										<div class="btn-group" ng-if="d != null && d[4]">
											<a href="/DTR/school_calendars/edit/{{d[4].id}}" title="Edit start/end date" class="btn btn-xs btn-default" ><i class="fa fa-edit"></i></a>
											<a href="/DTR/school_days/add/school_calendar_id:{{d[4].id}}" title="Set School Days" class="btn btn-xs btn-default" ><i class="fa fa-calendar-check-o"></i></a>
										</div>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<td colspan="13"></td>
							</tfoot>
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/school_calendar',array('inline'=>false)); ?>