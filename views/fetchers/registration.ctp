<div class="row" ng-controller="FetcherRegistrationController" ng-init="initializeController()">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Fetcher Registration</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Fetcher',array('action'=>'registration'));?>
			<div class="panel-body">
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('last_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('first_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('middle_name',array('class'=>'form-control','required'=>'required'));?>
					</div>
				</div><br/>
			</div>
			
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-primary" type="submit">Save</button>
					
				</div>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
