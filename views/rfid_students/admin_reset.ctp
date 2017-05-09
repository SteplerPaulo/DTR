<div class="row" ng-controller="ResetRFIDController" ng-init="initializeController()">
	<div class="col-md-12">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Reset RFID Nos.</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('RfidStudent',array('action'=>'reset'));?>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-default">All</button>
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
									Batch <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">By Level</a></li>
									<li><a href="#">By Section</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<label for="GradeLevel">Grade/Level</label>
						<select ng-disabled="selected.section != null" class="form-control input-sm" ng-options="d.Level.alias as d.Level.name for d in levels" ng-model="selected.level">
							<option value="">--All Level--</option>
						</select>
					</div>
					<div class="col-lg-3">
						<label for="Section">Section</label>
						<select ng-disabled="selected.level == null" class="form-control input-sm" ng-options="d.Section.id as d.Section.name for d in sections | filter:selected.level:true" ng-model="selected.section">
							<option value="">--All Section--</option>
						</select>
					</div>
					<div class="col-lg-2">
						{{selected.level}} - {{selected.section}}
					</div>
				</div><br/>
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>SNo.</th>
									<th>Student Name</th>
									<th>RFID No</th>
									<th>Grade/Level</th>
									<th>Section</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="d in data | filter:selected.level:true | filter:selected.section:true">
									<td>{{d.rfid_students.student_number}}</td>
									<td>{{d[0].full_name}}</td>
									<td>{{d.rfid_students.source_rfid}}</td>
									<td>{{d.levels.name}}</td>
									<td>{{d.sections.name}}</td>
								</tr>
							</tbody>
							<tfoot>
								<tr ng-if="!data.length">
									<td colspan="5">No Data</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-default" type="reset">Cancel</button>
					<button class="btn btn-primary" type="submit">Reset</button>
				</div>
			</div>
			
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>



<?php echo $this->Html->script('controllers/reset_rfid',array('inline'=>false));?>