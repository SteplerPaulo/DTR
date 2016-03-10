<div class="row">
	<div class="col-lg-12">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">	
						<h3>Edit Keyword</h3>
					</h3>
				</div>
				<div class="panel-body">
					<?php echo $this->Form->create('Keyword',array('inputDefaults' => array('class'=>'form-control','between'=>'<div class="form-group">','after'=>'</div>')));?>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('keyword');
						echo $this->Form->input('message_response',array('type'=>'textarea'));
					?>
					
				</div>
				<div class="panel-footer">	
					<div class="text-right">
						<a href="/DTR/keywords/" class="btn btn-default">Cancel</a>
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>