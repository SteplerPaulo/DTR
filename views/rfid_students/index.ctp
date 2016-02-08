<div class="rfidStudents index">
	<h2><?php __('Students List ');?></h2>(With registered RFID) <br/>
	<table class="table table-bordered">
		<tr>
			<th><?php echo $this->Paginator->sort('student_number');?></th>
			<th><?php echo $this->Paginator->sort('full_name');?></th>
			<th><?php echo $this->Paginator->sort('student_mobile_no');?></th>
			<th><?php echo $this->Paginator->sort('guardian_mobile_no');?></th>
			<th><?php echo $this->Paginator->sort('relationship');?></th>
			<th class="actions text-center"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($rfidStudents as $rfidStudent):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $rfidStudent['RfidStudent']['student_number']; ?>&nbsp;</td>
			<td><?php echo $rfidStudent['RfidStudent']['full_name']; ?>&nbsp;</td>
			<td><?php echo $rfidStudent['RfidStudent']['student_mobile_no']; ?>&nbsp;</td>
			<td><?php echo $rfidStudent['RfidStudent']['guardian_mobile_no']; ?>&nbsp;</td>
			<td><?php echo $rfidStudent['RfidStudent']['relationship']; ?>&nbsp;</td>
			<td class="actions text-center">
				<a href="/DTR/rfid_students/edit/<?php echo $rfidStudent['RfidStudent']['id']?>"><i  class="fa fa-edit"></i></a>
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