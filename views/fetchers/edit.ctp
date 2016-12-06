<div class="fetchers form">
<?php echo $this->Form->create('Fetcher');?>
	<fieldset>
		<legend><?php __('Edit Fetcher'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('img');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Fetcher.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Fetcher.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fetcher Rfid Students', true), array('controller' => 'fetcher_rfid_students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher Rfid Student', true), array('controller' => 'fetcher_rfid_students', 'action' => 'add')); ?> </li>
	</ul>
</div>