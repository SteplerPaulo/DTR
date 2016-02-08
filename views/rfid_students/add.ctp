<div class="rfidStudents form">
<?php echo $this->Form->create('RfidStudent');?>
	<fieldset>
		<legend><?php __('Add Rfid Student'); ?></legend>
	<?php
		echo $this->Form->input('rfid');
		echo $this->Form->input('source_rfid');
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('student_number');
		echo $this->Form->input('sy');
		echo $this->Form->input('employee_number');
		echo $this->Form->input('type');
		echo $this->Form->input('dec_rfid');
		echo $this->Form->input('student_mobile_no');
		echo $this->Form->input('guardian_mobile_no');
		echo $this->Form->input('relationship');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rfid Students', true), array('action' => 'index'));?></li>
	</ul>
</div>