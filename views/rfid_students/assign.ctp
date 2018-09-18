<div class="row" ng-controller="AssignRFIDController" ng-init="initializeController()">
	<div class="col-md-8 col-md-offset-2">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>ID REGISTRATION <sup>(Assigning RFID No.)</sup></h4>
				</h3>
			</div>
			<?php echo $this->Form->create('RfidStudent',array('action'=>'save'));?>
			<div class="panel-body">
				<div class="row" >
					<div class="col-lg-3">
						<?php echo $this->Form->input('sy',array('options'=>$sy,'label'=>'SY','class'=>'form-control'));?>
					</div>
					<div class="col-lg-3">
						<label for="type">Type</label>
						<select  ng-disabled="HaveAnExistingRFID" class="form-control" ng-model="typeSelected" ng-change="changedType(typeSelected)"  data-ng-options="type as type.name for type in types">
						</select>
						<input class="hide" name="data[RfidStudent][type]" ng-model="type"/>
					</div>
					<div class="col-lg-4 hide">
						<?php echo $this->Form->input('id',array('class'=>'form-control','ng-model'=>'Field.id','type'=>'text','label'=>'RFID ID'));?>
					</div>
				</div>
				<div class="row hide">
					<div class="col-lg-4 col-lg-offset-8" ng-if="StudentMode">
						<?php echo $this->Form->input('Student201.id',array('class'=>'form-control','ng-model'=>'Field.student_id','type'=>'text','label'=>'Student ID'));?>
					</div>
					<div class="col-lg-4 col-lg-offset-8" ng-if="EmployeeMode">
						<?php echo $this->Form->input('Employee.id',array('class'=>'form-control','ng-model'=>'Field.employee_id','type'=>'text','label'=>'Employee ID'));?>
					</div>
				</div>
				<hr/>
				<div class="row" ng-if="StudentMode">
					<div class="col-lg-3">
						<?php echo $this->Form->input('student_number',array('ng-disabled'=>'HaveAnExistingRFID','ng-blur'=>'getStudDetails(Field.student_number)','required'=>'required','label'=>'Student No','class'=>'form-control','ng-model'=>'Field.student_number'));?>
					</div>
					<div class="col-lg-3">
						<?php echo $this->Form->input('level_id',array('ng-disabled'=>'HaveAnExistingRFID','required'=>'required','options'=>$levels,'empty'=>'--Select--','class'=>'form-control','ng-model'=>'Field.level_id'));?>
					</div>
					<div class="col-lg-6">
						<?php echo $this->Form->input('section_id',array('ng-disabled'=>'HaveAnExistingRFID','required'=>'required','options'=>$sections,'empty'=>'--Select--','class'=>'form-control ','ng-model'=>'Field.section_id'));?>
					</div>
				</div>
				<div class="row" ng-if="EmployeeMode">
					<div class="col-lg-3">
						<?php echo $this->Form->input('employee_number',array('ng-disabled'=>'HaveAnExistingRFID','ng-blur'=>'getEmpDetails(Field.employee_number)','required'=>'required','label'=>'Employee No','class'=>'form-control','ng-model'=>'Field.employee_number'));?>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('last_name',array('ng-disabled'=>'HaveAnExistingRFID','readonly'=>'readonly','class'=>'form-control','ng-model'=>'Field.last_name'));?>
					</div>
					<div class="col-lg-3">
						<?php echo $this->Form->input('first_name',array('ng-disabled'=>'HaveAnExistingRFID','readonly'=>'readonly','class'=>'form-control','ng-model'=>'Field.first_name'));?>
					</div>
					<div class="col-lg-3">
						<?php echo $this->Form->input('middle_name',array('ng-disabled'=>'HaveAnExistingRFID','readonly'=>'readonly','class'=>'form-control','ng-model'=>'Field.middle_name'));?>
					</div>
					
					<div class="col-lg-3" ng-if="StudentMode">
						<?php echo $this->Form->input('gender',array('ng-disabled'=>'HaveAnExistingRFID','required'=>'required','options'=>$genders,'empty'=>'Select','class'=>'form-control ','ng-model'=>'Field.gender'));?>
					</div>
				</div>
				
				<div class="row" ng-if="EmployeeMode">
					<br/>
					<div class="col-lg-3">
						<label for="employee_mobile_no">Employee Mobile No</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input ng-disabled="HaveAnExistingRFID" name="data[RfidStudent][employee_mobile_no]" type="text" class="form-control" maxlength="10" ng-model="Field.employee_mobile_no"/>
						</div>
					</div>
					<div class="col-lg-3">
						<label for="emergency_contact_no">Emergency Contact No.</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input ng-disabled="HaveAnExistingRFID" name="data[RfidStudent][emergency_contact_no]" type="text" class="form-control" maxlength="10" ng-model="Field.emergency_contact_no"/>
						</div>
					</div>
					<div class="col-lg-3">
						<?php echo $this->Form->input('emergency_contact_person',array('ng-disabled'=>'HaveAnExistingRFID','label'=>'Person to Contact','class'=>'form-control ','ng-model'=>'Field.emergency_contact_person'));?>
					</div>
				</div>
				
				<div class="row" ng-if="StudentMode">
					<br/>
					<div class="col-lg-3">
						<?php echo $this->Form->input('LRN',array('class'=>'form-control','ng-model'=>'Field.LRN'));?>
					</div>
					<div class="col-lg-3">
						<label for="student_mobile_no">Student Mobile No</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input ng-readonly="HaveAnExistingRFID" name="data[RfidStudent][student_mobile_no]" type="text" class="form-control" maxlength="10" ng-model="Field.student_mobile_no"/>
						</div>
					</div>
					<div class="col-lg-3">
						<label for="guardian_mobile_no">Guardian Mobile No</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input ng-readonly="HaveAnExistingRFID" name="data[RfidStudent][guardian_mobile_no]" type="text" class="form-control ng-pristine ng-valid" maxlength="10" ng-model="Field.guardian_mobile_no"/>
						</div>
					</div>
					<div class="col-lg-3">
						<?php echo $this->Form->input('relationship',array('ng-disabled'=>'HaveAnExistingRFID','options'=>$relationships,'empty'=>'Select','class'=>'form-control','ng-model'=>'Field.relationship'));?>
					</div>	
				</div>	
				<div class="row" ng-if="StudentMode" ><br/>
					<div class="col-lg-12">
						<?php echo $this->Form->input('guardian_address',array('type'=>'text','class'=>'form-control','ng-model'=>'Field.guardian_address'));?>
					</div>
				</div>
				
				<div class="row"><br/>
					<div class="col-lg-3">
						<?php echo $this->Form->input('source_rfid',array('ng-disabled'=>'HaveAnExistingRFID','required'=>'required','label'=>'RFID','class'=>'form-control','ng-model'=>'Field.source_rfid','my-enter'=>'CheckRFID(Field.source_rfid)'));?>
					</div>
					<div class="col-lg-8">
						<div class="panel panel-danger" ng-show="HaveAnExistingRFID">
							<div class="panel-heading"><b>Alert</b></div>
							<div class="panel-body">
								Record found. What would you like to do?
							</div>
							<div class="panel-footer text-right">
								<button type="button" class="btn btn-default btn-sm" ng-click="reset(ReloadPage)">Cancel</button>
								<button type="button" class="btn btn-info btn-sm" ng-click="update()">Update</button>
							</div>
						</div>
						<div class="panel panel-danger" ng-show="DuplicatedRFID">
							<div class="panel-heading"><b>Alert</b></div>
							<div class="panel-body">
								Duplicate RFID No. Found
							</div>
						</div>
						<div class="panel panel-danger" ng-show="No201">
							<div class="panel-heading"><b>Alert</b></div>
							<div class="panel-body">
								Student Number not found in the 201 list.  Register as new student/employee?
							</div>
							
							<div class="panel-footer text-right">
								<button type="button" class="btn btn-default btn-sm" ng-click="reset()">Cancel</button>
								<a href="../student201s/add" class="btn btn-info btn-sm" >Yes</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-default" type="reset">Reset</button>
					<button class="btn btn-primary" type="submit" ng-disabled="DuplicatedRFID || HaveAnExistingRFID || No201">Save</button>
				</div>
			</div>
			
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>



<?php echo $this->Html->script('controllers/assign',array('inline'=>false));?>