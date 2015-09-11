<div class="attendances form">
<?php echo $this->Form->create('Attendance');?>
	<fieldset>
		<legend><?php __('Edit Attendance'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Attendance.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Attendance.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attendances', true), array('action' => 'index'));?></li>
	</ul>
</div>