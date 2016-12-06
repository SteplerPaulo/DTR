<div class="fetcherRfidStudents index">
	<h2><?php __('Fetcher Rfid Students');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fetcher_id');?></th>
			<th><?php echo $this->Paginator->sort('rfid_student_id');?></th>
			<th><?php echo $this->Paginator->sort('rfid');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fetcherRfidStudents as $fetcherRfidStudent):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fetcherRfidStudent['FetcherRfidStudent']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fetcherRfidStudent['Fetcher']['id'], array('controller' => 'fetchers', 'action' => 'view', $fetcherRfidStudent['Fetcher']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fetcherRfidStudent['RfidStudent']['id'], array('controller' => 'rfid_students', 'action' => 'view', $fetcherRfidStudent['RfidStudent']['id'])); ?>
		</td>
		<td><?php echo $fetcherRfidStudent['FetcherRfidStudent']['rfid']; ?>&nbsp;</td>
		<td><?php echo $fetcherRfidStudent['FetcherRfidStudent']['created']; ?>&nbsp;</td>
		<td><?php echo $fetcherRfidStudent['FetcherRfidStudent']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fetcherRfidStudent['FetcherRfidStudent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fetcherRfidStudent['FetcherRfidStudent']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fetcherRfidStudent['FetcherRfidStudent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fetcherRfidStudent['FetcherRfidStudent']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fetcher Rfid Student', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('controller' => 'fetchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('controller' => 'fetchers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rfid Students', true), array('controller' => 'rfid_students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rfid Student', true), array('controller' => 'rfid_students', 'action' => 'add')); ?> </li>
	</ul>
</div>