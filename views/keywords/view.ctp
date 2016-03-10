<div class="keywords view">
<h2><?php  __('Keyword');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $keyword['Keyword']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Keyword'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $keyword['Keyword']['keyword']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Message Response'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $keyword['Keyword']['message_response']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Keyword', true), array('action' => 'edit', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Keyword', true), array('action' => 'delete', $keyword['Keyword']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Keywords', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Keyword', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
