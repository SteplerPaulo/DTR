<div class="rfidStudattendances form">
<?php echo $this->Form->create('RfidStudattendance');?>
	<fieldset>
		<legend><?php __('Edit Rfid Studattendance'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('rfid');
		echo $this->Form->input('student_number');
		echo $this->Form->input('date');
		echo $this->Form->input('time');
		echo $this->Form->input('gateno');
		echo $this->Form->input('entrystatus');
		echo $this->Form->input('sql_date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('RfidStudattendance.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('RfidStudattendance.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rfid Studattendances', true), array('action' => 'index'));?></li>
	</ul>
</div>