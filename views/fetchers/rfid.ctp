<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h3>ENTER RFID</h3>
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<?php echo $this->Form->create('Fetcher',array('action'=>'registration'));?>
						<?php echo $this->Form->input('rfid',array('class'=>'form-control','label'=>false));?>	
						<?php echo $this->Form->end();?>						
					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-primary" type="submit">Go</button>
					
				</div>
			</div>
		</div>
	</div>
</div>