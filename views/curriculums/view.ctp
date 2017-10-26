<div class="curriculums view">
<h2><?php  __('Curriculum');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $curriculum['Curriculum']['alias']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Curriculum', true), array('action' => 'edit', $curriculum['Curriculum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Curriculum', true), array('action' => 'delete', $curriculum['Curriculum']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $curriculum['Curriculum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Curriculums', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curriculum', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List School Calendars', true), array('controller' => 'school_calendars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Calendar', true), array('controller' => 'school_calendars', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related School Calendars');?></h3>
	<?php if (!empty($curriculum['SchoolCalendar'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('School Year Id'); ?></th>
		<th><?php __('Curriculum Id'); ?></th>
		<th><?php __('Period Id'); ?></th>
		<th><?php __('Date From'); ?></th>
		<th><?php __('Date To'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($curriculum['SchoolCalendar'] as $schoolCalendar):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $schoolCalendar['id'];?></td>
			<td><?php echo $schoolCalendar['school_year_id'];?></td>
			<td><?php echo $schoolCalendar['curriculum_id'];?></td>
			<td><?php echo $schoolCalendar['period_id'];?></td>
			<td><?php echo $schoolCalendar['date_from'];?></td>
			<td><?php echo $schoolCalendar['date_to'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'school_calendars', 'action' => 'view', $schoolCalendar['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'school_calendars', 'action' => 'edit', $schoolCalendar['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'school_calendars', 'action' => 'delete', $schoolCalendar['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $schoolCalendar['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New School Calendar', true), array('controller' => 'school_calendars', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
