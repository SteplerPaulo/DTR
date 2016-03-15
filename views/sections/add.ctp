<div class="sections form">
<?php echo $this->Form->create('Section');?>
	<fieldset>
		<legend><?php __('Add Section'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('year_level_id');
		echo $this->Form->input('type');
		echo $this->Form->input('order_index');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sections', true), array('action' => 'index'));?></li>
	</ul>
</div>