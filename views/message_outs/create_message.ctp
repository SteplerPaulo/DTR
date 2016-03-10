<div class="row" ng-controller="SendingMessageController" ng-init="initializeController()">
	<div class="col-lg-12">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">	
						<h3>Send Message
							<a href="/DTR/message_outs/" class="btn btn-default pull-right"><i class="fa fa-times"></i> </a>
						</h3>
					</h3>
				</div>
				<div class="panel-body" ng-if="!SendingStatus">
					
					<?php echo $this->Form->create('MessageOut',array('inputDefaults' => array('class'=>'form-control','between'=>'<div class="form-group">','after'=>'</div>')));?>
					<?php
						echo $this->Form->input('MessageTo',array('label'=>'Mobile No','maxlength'=>11,'ng-model'=>'MessageTo'));
						echo $this->Form->input('MessageText',array('type'=>'textarea','placeholder'=>'Type your message here','ng-model'=>'MessageText'));
					?>
				</div>
				<div class="panel-body" ng-if="SendingStatus">
					<div class="alert alert-success" >
						Message Sent! 
					</div>
				</div>
				
				<div class="panel-footer" ng-if="!SendingStatus">	
					<div class="text-right">
						<button class="btn btn-primary" type="button" ng-click="Send()"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
				<div class="panel-footer" ng-if="SendingStatus">	
					<div class="text-right">
						<button class="btn btn-primary" ng-click="CreateNewMessage()">	
							<i class="fa fa-envelope-o"></i>
							Create New Message
						</button>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>




<?php echo $this->Html->script('controllers/create_message',array('inline'=>false));?>


