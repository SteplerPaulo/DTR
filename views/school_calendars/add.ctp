<div ng-controller="SetSchoolCalendarController" ng-init="initializeController()">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default" ng-form="SchoolCalendarForm">
				<div class="panel-heading">SET SCHOOL CALENDAR</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<label for="sy">SY</label>
							<select ng-model="sy" ng-options="d.SchoolYear.name for d in school_years" class="form-control input-sm" ng-required="true">
								<option value="">-- Select --</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="curriculum">Curriculum</label>
							<select ng-model="curri" ng-options="d.Curriculum.name for d in curriculums" class="form-control input-sm" ng-required="true" ng-change="changeCurri()">
								<option value="">-- Select --</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="period">Period</label>
							<select ng-model="prd" ng-options="d.Period.name for d in periods" class="form-control input-sm" ng-required="true">
								<option value="">-- Select --</option>
							</select>
						</div>
					</div><br/>
				
					<div class="row">
						<div class="col-md-2">
							<label>Date From</label>
							<input type="date" class="form-control input-sm" id="FromDate" ng-model="date_from" ng-required="true">
						</div>
						<div class="col-md-2">
							<label>Date To</label>
							<input type="date" class="form-control input-sm" id="ToDate" ng-model="date_to" ng-required="true">
						</div>
						
						
						<div class="col-md-6" ng-if="curri">
							<label>Applicable To:</label><br/>
							<div class="checkbox-inline" ng-repeat="d in levels"  ng-if="curri.Curriculum.alias == d.Level.educ_level">
								<label>
									<input type="checkbox" checklist-model="selected.levels" checklist-value="d.Level.id">
									{{d.Level.name}}
								</label>
							</div>
						</div>
						
					</div>
				</div>
				<div class="panel-footer">	
					<div class="text-right">
						<button class="btn btn-warning" ng-click="Save()" ng-disabled="!SchoolCalendarForm.$valid || preventDoubleClick">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/set_school_calendar',array('inline'=>false)); ?>