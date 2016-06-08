<div class="levels view">
<h2><?php  __('Level');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $level['Level']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $level['Level']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $level['Level']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Educ Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $level['Level']['educ_level']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Level', true), array('action' => 'edit', $level['Level']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Level', true), array('action' => 'delete', $level['Level']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $level['Level']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Levels', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Level', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
