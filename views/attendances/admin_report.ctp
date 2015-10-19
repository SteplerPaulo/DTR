<div ng-controller="ReportController" ng-init="initializeController()">

	<div class=" col-lg-5">
		<div class="row-fluid">
			<div class="col-lg-9">
				<label for="search">Search</label>
				<input ng-model="q" id="search" class="form-control" placeholder="Filter text">
			</div>
		</div>
		<table class="table table-bordered">
			<caption><h3>Employees<a class="btn btn-primary btn-sm pull-right"><i class="fa fa-print"></i> Print all</a></h3></caption>
			<br/>
			<thead>
				<tr>
					<th class="text-center">Employee No.</th>
					<th class="text-center">Name</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr pagination-id="Table" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
					<td class="text-center">{{d.RfidStudent.employee_number}}</td>
					<td class="">{{d.RfidStudent.full_name}}</td>
					<td class="text-center actions"><a ng-click="PrintReport()" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i></td>
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
		<iframe src="/DTR/attendances/doc_report"  width="750" height="600"></iframe>
	</div>
</div>
<?php echo $this->Html->script('controllers/report',array('inline'=>false)); ?>