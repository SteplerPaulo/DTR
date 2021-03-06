<div ng-controller="ReportController" ng-init="initializeController()" >
	<section ng-if="summary">
		<div class=" col-lg-2">
			<div class="row">
				<div class="col-lg-12">
					<div class="btn-group btn-group-sm" >
						<button class="btn btn-sm btn-default active" ng-click="toggle(true)">Summary</button>
						<button class="btn btn-sm btn-default" ng-click="toggle(false)">Per Employee</button>
					</div>
				</div>
			</div><hr/>
			<div class="row">
				<div  class="col-lg-12" >
					<label>Date From</label>
					<input type="date" class="form-control input-sm" id="FromDate" ng-model="fromDate" max="{{toDate}}">
				</div>
				<div  class="col-lg-12" >
					<label>Date To</label>
					<input type="date" class="form-control input-sm" id="ToDate" ng-model="toDate" max="{{toDate}}">
				</div>
			</div></br>
			<div class="row">
				<div  class="col-lg-12">
					<button class="btn btn-sm btn-primary pull-right" ng-click="printSummary(fromDate,toDate)">Print</button>
				</div>
			</div>
		</div>
		<div class=" col-lg-10">
			<iframe src="/DTR/attendances/summary_report"  width="1080" height="600"></iframe>
		</div>
	</section>
	<section  ng-if="!summary">
		<div class=" col-lg-5">
			<div class="row">
				<div class="col-lg-12">
					<div class="btn-group btn-group-sm" >
						<button class="btn btn-sm btn-default" ng-click="toggle(true)">Summary</button>
						<button class="btn btn-sm btn-default active" ng-click="toggle(false)">Per Employee</button>
					</div>
				</div>
			</div><hr/>
		
			<div class="row">
				<div  class="col-lg-6" >
					<label>Date From</label>
					<input type="date" class="form-control input-sm" id="FromDate" ng-model="fromDate" max="{{toDate}}">
				</div>
				<div  class="col-lg-6" >
					<label>Date To</label>
					<input type="date" class="form-control input-sm" id="ToDate" ng-model="toDate" max="{{toDate}}">
				</div>
			</div>
			<div class="row" >
				<div  class="col-lg-12" >
					<label>Search</label>
					<input ng-model="q" id="search" class="form-control input-sm" placeholder="Filter text">
				</div>
			</div>
			<table class="table table-bordered">
				<caption style="padding-bottom: 10px;">
					<h3>
						<span class="pull-left">Employees</span>
						<a class="btn btn-primary pull-right" disabled="disabled"><i class="fa fa-print" > All</i></a>
					</h3>
				</caption>	
				<thead>
					<tr>
						<th class="text-center">Employee No.</th>
						<th class="text-center">Name</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-if="data.length" pagination-id="Table" dir-paginate="d in data | filter:q | itemsPerPage: pageSize" current-page="currentPage">
						<td class="text-center">{{d.RfidStudent.employee_number}}</td>
						<td class="">{{d.RfidStudent.full_name}}</td>
						<td class="text-center actions">
							<a empno_adjust="{{d.RfidStudent.employee_number}}" ng-click="AdjustButton(fromDate,toDate,d.RfidStudent.full_name,d.RfidStudent.employee_number)" data-toggle="tooltip" title="Adjust"><i class="fa fa-edit"></a></i>&nbsp;
							<a ng-click="DateFilterModal(fromDate,toDate,d.RfidStudent.full_name,d.RfidStudent.employee_number)" data-toggle="tooltip" title="Print"><i class="fa fa-print"></a></i>
						</td>
					</tr>
					<tr ng-if="!data.length">
						<td colspan="3"> NO DATA</td>
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
		<div class=" col-lg-7" ng-if="!summary">
			<iframe src="/DTR/attendances/doc_report"  width="750" height="600"></iframe>
		</div>
	</section>
</div>

<?php echo $this->Html->script('controllers/employee_report',array('inline'=>false)); ?>