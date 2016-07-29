<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h3>Fetcher Profile</h3>
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
							<a class="pull-left thumbnail " href="#ProfilePictureModal"  role="button" data-toggle="modal">
								<?php 
									if(!empty($fetcher['FetcherDocument']['id'])){
										echo $this->Html->image('/fetchers/download/'.$fetcher['FetcherDocument']['id'],array('alt'=>'','class'=>'media-object','style'=>'width:167px;height:200px'));
									}else{
										echo $this->Html->image('/img/200x200.gif',array('alt'=>'','class'=>'media-object','style'=>'width:167px;height:200px'));
									}
								?>
							</a>
							<?php echo $this->Form->create('Fetcher', array('enctype' => 'multipart/form-data','action'=>'upload'));?>
							<?php echo $this->Form->file('FetcherDocument');?><br />
							<?php
								if(isset($fetcher['FetcherDocument']['id'])){
									echo $this->Form->input('Fetcher.FetcherDocument.id',array('value'=>$fetcher['FetcherDocument']['id'],'type'=>'hidden'));
								}
							?>
							<?php echo $this->Form->input('Fetcher.FetcherDocument.fetcher_id',array('value'=>$fetcher['Fetcher']['id'],'type'=>'hidden'));?>
							
							<input class="btn" type="submit" value="Upload Picture" />
							<?php echo $this->Form->end(); ?>					
					</div>
					<div class="col-lg-4">
						<dl>
							<dd><b>Last Name: </b><?php echo $fetcher['Fetcher']['last_name']; ?></dd>
							<dd><b>First Name: </b><?php echo $fetcher['Fetcher']['first_name']; ?></dd>
							<dd><b>Middle Name: </b><?php echo $fetcher['Fetcher']['middle_name']; ?></dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div class="fetchers view">
<h2><?php  __('Fetcher');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Middle Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['middle_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Img'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['img']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fetcher['Fetcher']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fetcher', true), array('action' => 'edit', $fetcher['Fetcher']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fetcher', true), array('action' => 'delete', $fetcher['Fetcher']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fetcher['Fetcher']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetchers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fetcher Rfid Students', true), array('controller' => 'fetcher_rfid_students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fetcher Rfid Student', true), array('controller' => 'fetcher_rfid_students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fetcher Rfid Students');?></h3>
	<?php if (!empty($fetcher['FetcherRfidStudent'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Fetcher Id'); ?></th>
		<th><?php __('Rfid Student Id'); ?></th>
		<th><?php __('Rfid'); ?></th>
		<th><?php __('Relationship'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fetcher['FetcherRfidStudent'] as $fetcherRfidStudent):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fetcherRfidStudent['id'];?></td>
			<td><?php echo $fetcherRfidStudent['fetcher_id'];?></td>
			<td><?php echo $fetcherRfidStudent['rfid_student_id'];?></td>
			<td><?php echo $fetcherRfidStudent['rfid'];?></td>
			<td><?php echo $fetcherRfidStudent['relationship'];?></td>
			<td><?php echo $fetcherRfidStudent['created'];?></td>
			<td><?php echo $fetcherRfidStudent['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fetcher_rfid_students', 'action' => 'view', $fetcherRfidStudent['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fetcher_rfid_students', 'action' => 'edit', $fetcherRfidStudent['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fetcher_rfid_students', 'action' => 'delete', $fetcherRfidStudent['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fetcherRfidStudent['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fetcher Rfid Student', true), array('controller' => 'fetcher_rfid_students', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
-->