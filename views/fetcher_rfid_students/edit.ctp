<div class="fetcherRfidStudents form">
<?php echo $this->Form->create('FetcherRfidStudent');?>
	<fieldset>
		<legend><?php __('Edit Fetcher Rfid Student'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fetcher_id');
		echo $this->Form->input('rfid_student_id');
		echo $this->Form->input('rfid');
		echo $this->Form->input('relationship');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FetcherRfidStudent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FetcherRfidStudent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fetcher Rfid Students', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('controller' => 'fetchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('controller' => 'fetchers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rfid Students', true), array('controller' => 'rfid_students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rfid Student', true), array('controller' => 'rfid_students', 'action' => 'add')); ?> </li>
	</ul>
</div>