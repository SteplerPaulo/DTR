<div class="fetcherDocuments form">
<?php echo $this->Form->create('FetcherDocument');?>
	<fieldset>
		<legend><?php __('Edit Fetcher Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fetcher_id');
		echo $this->Form->input('name');
		echo $this->Form->input('dir');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FetcherDocument.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FetcherDocument.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fetcher Documents', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('controller' => 'fetchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('controller' => 'fetchers', 'action' => 'add')); ?> </li>
	</ul>
</div>