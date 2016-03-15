
<div class="row" ng-controller="AssignRFIDController" ng-init="initializeController()">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h3>Assign RFID No.</h3>
				</h3>
			</div>
			<div class="panel-body" ng-show="!SavingStatus">
				<div class="row">
					<div class="col-lg-4">
						<label for="type">SY</label>
						<!--
						<select class="form-control">
							<option ng-repeat="year in school_years" ng-model="sy" ng-init="year.SchoolYear.id">
								{{year.SchoolYear.name}}
							</option>
						</select>
						-->
						<select class="form-control" ng-model="sy" ng-change="changedValue(sy)"  data-ng-options="year as year.SchoolYear.name for year in school_years">
						</select>
					</div>
					<div class="col-lg-4">
						<label for="type">Type</label>
						<select class="form-control" ng-model="typeSelected" ng-change="changedValue(typeSelected)"  data-ng-options="type as type.name for type in types">
						</select>
					</div>
				</div><hr/>
				<div class="row" ng-show="StudentMode">
					<div class="col-lg-4">
						<?php echo $this->Form->input('student_number',array('label'=>'Student No','class'=>'form-control','ng-model'=>'student_number'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('section_id',array('options'=>$sections,'empty'=>'Select','class'=>'form-control','ng-model'=>'section_id'));?>
					</div>
				</div>
				<div class="row" ng-show="EmployeeMode">
					<div class="col-lg-4">
						<?php echo $this->Form->input('employee_number',array('label'=>'Employee No','class'=>'form-control','ng-model'=>'employee_number'));?>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('last_name',array('class'=>'form-control','ng-model'=>'last_name'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('first_name',array('class'=>'form-control','ng-model'=>'first_name'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('middle_name',array('class'=>'form-control','ng-model'=>'middle_name'));?>
					</div>
				</div>
				
				<div class="row" ng-show="StudentMode">
					<br/>
					<div class="col-lg-4">
						<?php echo $this->Form->input('student_mobile_no',array('class'=>'form-control','maxlength'=>11,'ng-model'=>'student_mobile_no'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('guardian_mobile_no',array('class'=>'form-control','maxlength'=>11,'ng-model'=>'guardian_mobile_no'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('relationship',array('options'=>$relationships,'empty'=>'Select','class'=>'form-control','ng-model'=>'relationship'));?>
					</div>	
				</div>
				
			
				
				<div class="row"><br/>
					<div class="col-lg-4">
						<?php echo $this->Form->input('source_rfid',array('required'=>'required','label'=>'RFID','class'=>'form-control','ng-model'=>'source_rfid','my-enter'=>'CheckRFID(source_rfid)'));?>
					</div>
					
					<div class="col-lg-8" ng-show="DuplicatedRFID">
						<div class="alert alert-danger" >
							ALERT: Duplicated RFID
						</div>
					</div>
					
				</div>
			</div>
			<div class="panel-body" ng-show="SavingStatus">
					<div class="alert alert-success" >
						Saving successful! 
					</div>
				</div>
			<div class="panel-footer" ng-show="!SavingStatus">	
				<div class="text-right">
					<a href="/DTR/rfid_students/" class="btn btn-default">Cancel</a>
					<button class="btn btn-primary" ng-click="save()" ng-disabled="DuplicatedRFID">Save</button>
				</div>
			</div>
			<div class="panel-footer" ng-show="SavingStatus">	
				<div class="text-right">
					<button class="btn btn-primary" ng-click="AssignNewRFID()">	
						<i class="fa fa-pencil"></i>
						Assign New RFID
					</button>
				</div>
			</div>
		</div>
	</div>
</div>



<?php echo $this->Html->script('controllers/assign',array('inline'=>false));?>