<div class="row">
	<div class="col-lg-12">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Assigning Permmission</h3>
				</div>
				<div class="panel-body">
					<?php echo $this->Form->create('User',array('action'=>'assigning_permission','inputDefaults' => array('class'=>'form-control','between'=>'<div class="form-group">','after'=>'</div>')));?>
								
					<?php
						echo $this->Session->flash('auth').'<br>';
						echo $this->Form->input('user_id',array('empty'=>'Select','required'=>'required'));
						echo $this->Form->input('roles',array('empty'=>'Select','required'=>'required'));
				
					?>			
					<?php echo $this->Form->submit(__('Submit', true), array('class'=>'btn btn-success pull-right'));?>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</div>
</div>
