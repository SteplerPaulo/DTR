<div class="row" ng-controller="EmployeeAddController" ng-init="initializeController()">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Add New Employee</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Employee',array('action'=>'add'));?>
			<div class="panel-body">
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('last_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('first_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('middle_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
				</div><br/>
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('employee_no',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<label for="employee_mobile_no">Employee Mobile No</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input name="data[Employee][mobile]" type="text" class="form-control" maxlength="10" required/>
						</div>
					</div>
				</div>
				<h4 class="label-warning text-center" style="">EMERGENCY</h4>
				
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('emergency_contact',array('label'=>'Contact Person','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<label for="emergency_contact_no">Contact No</label>
						<div class="input-group">
							<span class="input-group-addon">+63</span>
							<input name="data[Employee][emergency_contact_no]" type="text" class="form-control" maxlength="10" required />
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-primary" type="submit">Save</button>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="employees form">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
		<legend><?php __('Add Employee'); ?></legend>

	</fieldset>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Employees', true), array('action' => 'index'));?></li>
	</ul>
</div>
-->