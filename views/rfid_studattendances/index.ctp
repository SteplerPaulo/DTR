<div class="rfidStudattendances index">
	<h2><?php __('Rfid Studattendances');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('rfid');?></th>
			<th><?php echo $this->Paginator->sort('student_number');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('time');?></th>
			<th><?php echo $this->Paginator->sort('gateno');?></th>
			<th><?php echo $this->Paginator->sort('entrystatus');?></th>
			<th><?php echo $this->Paginator->sort('sql_date');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($rfidStudattendances as $rfidStudattendance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['id']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['rfid']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['student_number']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['date']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['time']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['gateno']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['entrystatus']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['sql_date']; ?>&nbsp;</td>
		<td><?php echo $rfidStudattendance['RfidStudattendance']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $rfidStudattendance['RfidStudattendance']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $rfidStudattendance['RfidStudattendance']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $rfidStudattendance['RfidStudattendance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $rfidStudattendance['RfidStudattendance']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rfid Studattendance', true), array('action' => 'add')); ?></li>
	</ul>
</div>