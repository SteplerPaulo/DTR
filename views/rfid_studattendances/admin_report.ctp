<div ng-controller="StudentAttendanceReportController" ng-init="initializeController()">
	<section>
		<div class=" col-lg-5">
			<div class="row">
				<div  class="col-lg-6" >
					<label>Report Type</label>
					<select class="form-control" ng-model="typeSelected" ng-change="changedType(typeSelected)" ng-init="typeSelected = types[0]"  data-ng-options="type as type.name for type in types">
					</select>
				</div>
				
				<div  class="col-lg-6" ng-show="DailyReport">
					<label>Date</label>
					<input type="date" class="form-control input-sm" ng-model="Daily">
				</div>
				<div  class="col-lg-6" ng-hide="DailyReport">
					<label>Month</label>
					<input type="month" class="form-control input-sm" ng-model="Monthly">
				</div>
			</div>
			
			<div class="row">
				<div  class="col-lg-12" >
					<label>Search</label>
					<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
				</div>
			</div>
			<table class="table table-bordered">
				<caption style="padding-bottom: 10px;">
					<h3>
						<span class="pull-left">Sections</span>
						<a class="btn btn-primary pull-right" disabled="disabled"><i class="fa fa-print" > All</i></a>
					</h3>
				</caption>	
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">Name</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr pagination-id="Table" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{d.Section.id}}</td>
						<td class="">{{d.Section.name}}</td>
						<td class="text-center actions">
							<a ng-click="printReport(d.Section.id,d.Section.name,Daily)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9" class="text-center">
							<dir-pagination-controls pagination-id="Table"></dir-pagination-controls>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class=" col-lg-7">
			<iframe src="/DTR/rfid_studattendances/daily_report"  width="750" height="600"></iframe>
		</div>
	</section>
</div>

<?php echo $this->Html->script('controllers/stud_report',array('inline'=>false)); ?>