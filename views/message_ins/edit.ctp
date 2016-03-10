<div class="messageIns form">
<?php echo $this->Form->create('MessageIn');?>
	<fieldset>
		<legend><?php __('Edit Message In'); ?></legend>
	<?php
		echo $this->Form->input('Id');
		echo $this->Form->input('SendTime');
		echo $this->Form->input('ReceiveTime');
		echo $this->Form->input('MessageFrom');
		echo $this->Form->input('MessageTo');
		echo $this->Form->input('SMSC');
		echo $this->Form->input('MessageText');
		echo $this->Form->input('MessageType');
		echo $this->Form->input('MessagePDU');
		echo $this->Form->input('Gateway');
		echo $this->Form->input('UserId');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MessageIn.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MessageIn.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Message Ins', true), array('action' => 'index'));?></li>
	</ul>
</div>