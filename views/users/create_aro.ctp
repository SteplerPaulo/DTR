	
<div class="tab-content">
	<div class="users form span8 offset2">
		<?php echo $this->Form->create('User',array(
				'action'=>'create_aro',
				'class'=>'form-horizontal',
				'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
			)));?>
		<fieldset>
			<legend><?php __('Create ARO (Access Request Object)'); ?></legend>						
				<?php
					echo $this->Session->flash('auth').'<br>';
					echo $this->Form->input('alias',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
					
				?>
		</fieldset>				
		<div class="control-group">
			<div class="controls">
				<?php echo $this->Form->submit(__('Submit', true), array('class'=>'btn'));?>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>	
</div>
