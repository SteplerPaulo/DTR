<div class="fetcherRfidStudents view">
<h2><?php  __('Fetcher Rfid Student');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherRfidStudent['FetcherRfidStudent']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fetcher'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fetcherRfidStudent['Fetcher']['id'], array('controller' => 'fetchers', 'action' => 'view', $fetcherRfidStudent['Fetcher']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rfid Student'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fetcherRfidStudent['RfidStudent']['id'], array('controller' => 'rfid_students', 'action' => 'view', $fetcherRfidStudent['RfidStudent']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rfid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherRfidStudent['FetcherRfidStudent']['rfid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Relationship'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherRfidStudent['FetcherRfidStudent']['relationship']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherRfidStudent['FetcherRfidStudent']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherRfidStudent['FetcherRfidStudent']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fetcher Rfid Student', true), array('action' => 'edit', $fetcherRfidStudent['FetcherRfidStudent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fetcher Rfid Student', true), array('action' => 'delete', $fetcherRfidStudent['FetcherRfidStudent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fetcherRfidStudent['FetcherRfidStudent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetcher Rfid Students', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher Rfid Student', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('controller' => 'fetchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('controller' => 'fetchers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rfid Students', true), array('controller' => 'rfid_students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rfid Student', true), array('controller' => 'rfid_students', 'action' => 'add')); ?> </li>
	</ul>
</div>
