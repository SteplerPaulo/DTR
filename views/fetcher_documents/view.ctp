<div class="fetcherDocuments view">
<h2><?php  __('Fetcher Document');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherDocument['FetcherDocument']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fetcher'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fetcherDocument['Fetcher']['id'], array('controller' => 'fetchers', 'action' => 'view', $fetcherDocument['Fetcher']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherDocument['FetcherDocument']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dir'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherDocument['FetcherDocument']['dir']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherDocument['FetcherDocument']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcherDocument['FetcherDocument']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fetcher Document', true), array('action' => 'edit', $fetcherDocument['FetcherDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fetcher Document', true), array('action' => 'delete', $fetcherDocument['FetcherDocument']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fetcherDocument['FetcherDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetcher Documents', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher Document', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('controller' => 'fetchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('controller' => 'fetchers', 'action' => 'add')); ?> </li>
	</ul>
</div>
