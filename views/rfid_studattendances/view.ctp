<div class="rfidStudattendances view">
<h2><?php  __('Rfid Studattendance');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rfid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['rfid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Student Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['student_number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gateno'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['gateno']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entrystatus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['entrystatus']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sql Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['sql_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rfidStudattendance['RfidStudattendance']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rfid Studattendance', true), array('action' => 'edit', $rfidStudattendance['RfidStudattendance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Rfid Studattendance', true), array('action' => 'delete', $rfidStudattendance['RfidStudattendance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $rfidStudattendance['RfidStudattendance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rfid Studattendances', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rfid Studattendance', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
