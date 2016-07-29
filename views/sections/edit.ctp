<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>EDIT SECTION</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Section',array('action'=>'add'));?>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->Form->input('id',array('class'=>'form-control'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->Form->input('name',array('class'=>'form-control','required'=>'required'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->Form->input('alias',array('class'=>'form-control','required'=>'required'));?>

					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-primary" type="submit">Save</button>
					
				</div>
			</div>
		</div>
	</div>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<!--
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Section.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Section.id'))); ?></li>
		-->
		<li><?php echo $this->Html->link(__('List Sections', true), array('action' => 'index'));?></li>
	</ul>
</div>