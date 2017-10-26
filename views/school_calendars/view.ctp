<div class="schoolCalendars view">
<h2><?php  __('School Calendar');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolCalendar['SchoolCalendar']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($schoolCalendar['SchoolYear']['name'], array('controller' => 'school_years', 'action' => 'view', $schoolCalendar['SchoolYear']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curriculum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($schoolCalendar['Curriculum']['name'], array('controller' => 'curriculums', 'action' => 'view', $schoolCalendar['Curriculum']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Period'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($schoolCalendar['Period']['name'], array('controller' => 'periods', 'action' => 'view', $schoolCalendar['Period']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date From'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolCalendar['SchoolCalendar']['date_from']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date To'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schoolCalendar['SchoolCalendar']['date_to']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School Calendar', true), array('action' => 'edit', $schoolCalendar['SchoolCalendar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete School Calendar', true), array('action' => 'delete', $schoolCalendar['SchoolCalendar']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $schoolCalendar['SchoolCalendar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List School Calendars', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Calendar', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List School Years', true), array('controller' => 'school_years', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Year', true), array('controller' => 'school_years', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculums', true), array('controller' => 'curriculums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum', true), array('controller' => 'curriculums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Periods', true), array('controller' => 'periods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Period', true), array('controller' => 'periods', 'action' => 'add')); ?> </li>
	</ul>
</div>
