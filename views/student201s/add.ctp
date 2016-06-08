<div class="student201s form">
<?php echo $this->Form->create('Student201');?>
	<fieldset>
		<legend><?php __('Add Student201'); ?></legend>
	<?php
		echo $this->Form->input('student_number');
		echo $this->Form->input('level_id');
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('section_code');
		echo $this->Form->input('birthday');
		echo $this->Form->input('mobile');
		echo $this->Form->input('primary_name');
		echo $this->Form->input('primary_relationship');
		echo $this->Form->input('primary_mobile_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Student201s', true), array('action' => 'index'));?></li>
	</ul>
</div>