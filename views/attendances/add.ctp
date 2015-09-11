<div class="attendances form">
<?php echo $this->Form->create('Attendance');?>
	<fieldset>
		<legend><?php __('Add Attendance'); ?></legend>
	<?php
		echo $this->Form->input('employee_number');
		echo $this->Form->input('date');
		echo $this->Form->input('timein');
		echo $this->Form->input('timeout');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attendances', true), array('action' => 'index'));?></li>
	</ul>
</div>