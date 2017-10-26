<div class="schoolDays view">
<h2><?php  __('School Day');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolDay['SchoolDay']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School Calendar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($schoolDay['SchoolCalendar']['id'], array('controller' => 'school_calendars', 'action' => 'view', $schoolDay['SchoolCalendar']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolDay['SchoolDay']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolDay['SchoolDay']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School Day', true), array('action' => 'edit', $schoolDay['SchoolDay']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete School Day', true), array('action' => 'delete', $schoolDay['SchoolDay']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $schoolDay['SchoolDay']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List School Days', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Day', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List School Calendars', true), array('controller' => 'school_calendars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Calendar', true), array('controller' => 'school_calendars', 'action' => 'add')); ?> </li>
	</ul>
</div>
