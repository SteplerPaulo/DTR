<div ng-controller="StudentListController" ng-init="initializeController()">	
	<div class="row">
		<div class="col-lg-1 col-md-3 col-xs-1">
			<label for="section">S.Y.</label>
			<input class="form-control input-sm" disabled="disabled" ng-value="sy.SchoolYear.name"/>
		</div>
		<div class="col-lg-3 col-md-3 col-xs-3">
			<label for="section">Section</label>
			<select class='form-control input-sm' ng-model='section'>
				<option value="">--Select--</option>
				<option ng-repeat="d in sections" ng-value="d.Section.name">{{d.Section.name}}</option>
			</select>
		</div>
		<div class="col-lg-3 col-md-3 col-xs-3">
			<label for="search">Search</label>
			<input ng-model="query" ng-value="section" id="search" class="form-control input-sm" placeholder="Filter text">
		</div>
		<div class="col-lg-2 col-lg-offset-3">
			<label for="search">Items per page</label>
			<input type="number" min="1" class="form-control input-sm" ng-model="pageSize">
		</div>
	</div><br/>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th colspan="5" class="text-left">Show ID Photo: <input type="checkbox" ng-model="photo"></th>
			</tr>
			<tr>
				<th class="actions text-center">Action</th>
				<th class="text-center" ng-show="photo">ID Photo</th>
				<th class="text-right">Student Number</th>
				<th class="text-right">Name</th>
				<th>RFID No.</th>
			</tr>
		</thead>
		<tbody>
			<tr pagination-id="StudentListTable" dir-paginate="(i,stud) in students | filter:query | filter:section | itemsPerPage: pageSize" current-page="currentPage">		
				<td class="actions text-center">
					<a href="/DTR/student201s/edit/{{stud.Student201.id}}" data-toggle="tooltip" title="Edit Student 201"><i class="fa fa-edit"></i></a>
				</td>
				<td class="text-center" ng-show="photo">
					<img src="../img/PHOTO/{{stud.Student201.student_number}}.jpg" alt="No Photo Available" height="100px" width="100px">
				</td>
				<td class="text-right">{{stud.Student201.student_number}}</td>
				<td class="text-right">{{stud.Student201.full_name}}</td>
				<td><input ng-model="stud.RfidStudent.source_rfid" ng-enter="save(i)" class="form-control input-sm" placeholder="RFID No."/></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" class="text-right">
					<dir-pagination-controls pagination-id="StudentListTable"></dir-pagination-controls>
				</td>
			</tr>
		</tfoot>
	</table>	
	
	
	

</div>



<?php echo $this->Html->script('controllers/assign_v2',array('inline'=>false));?>