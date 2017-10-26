<div class="schoolDays index">
	<h2><?php __('School Days');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('school_calendar_id');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($schoolDays as $schoolDay):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $schoolDay['SchoolDay']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($schoolDay['SchoolCalendar']['id'], array('controller' => 'school_calendars', 'action' => 'view', $schoolDay['SchoolCalendar']['id'])); ?>
		</td>
		<td><?php echo $schoolDay['SchoolDay']['date']; ?>&nbsp;</td>
		<td><?php echo $schoolDay['SchoolDay']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $schoolDay['SchoolDay']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $schoolDay['SchoolDay']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $schoolDay['SchoolDay']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $schoolDay['SchoolDay']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New School Day', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List School Calendars', true), array('controller' => 'school_calendars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School Calendar', true), array('controller' => 'school_calendars', 'action' => 'add')); ?> </li>
	</ul>
</div>