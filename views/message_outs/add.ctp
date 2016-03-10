<div class="messageOuts form">
<?php echo $this->Form->create('MessageOut');?>
	<fieldset>
		<legend><?php __('Add Message Out'); ?></legend>
	<?php
		echo $this->Form->input('MessageTo');
		echo $this->Form->input('MessageFrom');
		echo $this->Form->input('MessageText');
		echo $this->Form->input('MessageType');
		echo $this->Form->input('Gateway');
		echo $this->Form->input('UserId');
		echo $this->Form->input('UserInfo');
		echo $this->Form->input('Priority');
		echo $this->Form->input('Scheduled');
		echo $this->Form->input('IsSent');
		echo $this->Form->input('IsRead');
		echo $this->Form->input('RfId');
		echo $this->Form->input('SendDate');
		echo $this->Form->input('SendTime');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Message Outs', true), array('action' => 'index'));?></li>
	</ul>
</div>