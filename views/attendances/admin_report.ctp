<div ng-controller="ReportController" ng-init="initializeController()">
	<section>
		<div class=" col-lg-5">
			<div class="row-fluid">
				<div class="col-lg-9">
					<label for="search">Search</label>
					<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
				</div>
			</div>
			<table class="table table-bordered">
				<caption><h3>Employees<a class="btn btn-primary btn-sm pull-right" disabled="disabled"><i class="fa fa-print" ></i> All</a></h3></caption>
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
						<td class="text-center actions">
							<a ng-click="AdjustButton(d.RfidStudent.full_name,d.RfidStudent.employee_number)" data-toggle="tooltip" title="Adjust"><i class="fa fa-edit"></a></i>&nbsp;
							<a ng-click="DateFilterModal(d.RfidStudent.full_name,d.RfidStudent.employee_number)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
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
			<iframe src="/DTR/attendances/doc_report"  width="750" height="600"></iframe>
		</div>
	</section>
	<!-- Modal -->
	<div class="modal fade" id="DateFilterModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					Generate report for the month of:
					<input  type="month" id="Month" class="form-control" value="<?php echo date("Y-m")?>">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="GenerateReport">Generate</button>
				</div>
			</div>
		</div>
	</div>

</div>

<?php echo $this->Html->script('controllers/report',array('inline'=>false)); ?>