<style>
	#SelectedContactsContainer{   
		height: 60px;
		overflow-y: scroll;
	}
	textarea{   
		resize: none;
	}
</style>
<div class="row" ng-controller="SendingMessageController" ng-init="initializeController()">
		<div class="col-md-6">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">	
						<h3>Contacts</h3>
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
							<input ng-model="filterContacts" placeholder="Find contacts" class="form-control">
						</div>
					</div><br/>
					<div class="list-group">
						<div class="list-group-item list-group-header">
				
							 <div class="row">
								<div class="col-lg-1">
									<input type="checkbox" ng-model="checkbox.all" ng-change="checkAllContacts(checkbox.all)"/> 
								</div>	
								<div class="col-lg-4">
									Select All
								</div>
							</div>
							 
						</div>
						<div class="list-group-canvas list-group-search-results">
							<div class="list-group-item text-center"  ng-show="!contacts.length">
								Loading...
							</div>
							<div class="list-group-item" ng-repeat="(k, d)  in contacts | filter:filterContacts">
								<div class="row">
									<div class="col-lg-1">
										  <input type="checkbox" ng-model="Checkbox" ng-change="addContact(k)" isChecked="isChecked[k]">
									</div>
									<div class="col-lg-11">
										<h4 class="list-group-item-heading">
											{{d.Contact.name}}
										</h4>
										<p class="list-group-item-text">Mobile {{d.Contact.mobile_no}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">	
						<h3>Send Message
							<a href="/DTR/message_outs/" class="btn btn-default pull-right"><i class="fa fa-times"></i> </a>
						</h3>
					</h3>
				</div>
				<div class="panel-body" ng-show="!SendingStatus">
					<?php echo $this->Form->create('MessageOut',array('inputDefaults' => array('class'=>'form-control','between'=>'<div class="form-group">','after'=>'</div>')));?>
					

					<?php echo $this->Form->input('MessageTo',array('label'=>'Mobile No','maxlength'=>11,'ng-model'=>'MessageTo'));?>
					<div class="well" id="SelectedContactsContainer">
						<button class="btn btn-default btn-xs" type="button" ng-repeat="(k,d) in contacts | filter:filterContacts" ng-if="d.Contact.is_selected">
						{{d.Contact.name}} <span class="badge"><i class="fa fa-times"></i></span>
						<input ng-model="selectedContacts[k]" type="hidden"></input>
						</button>
						
					</div>
					
					<?php echo $this->Form->input('MessageText',array('class'=>'form-control','type'=>'textarea','placeholder'=>'Type your message here','ng-model'=>'MessageText'));?>
				</div>
				<div class="panel-body" ng-show="SendingStatus">
					<div class="alert alert-success" >
						Message Sent! 
					</div>
				</div>
				
				<div class="panel-footer" ng-show="!SendingStatus">	
					<div class="text-right">
						<button class="btn btn-primary" type="button" ng-click="Send()"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
				<div class="panel-footer" ng-show="SendingStatus">	
					<div class="text-right">
						<button class="btn btn-primary" type="button" ng-click="CreateNewMessage()">	
							<i class="fa fa-envelope-o"></i>
							Create New Message
						</button>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
</div>




<?php echo $this->Html->script('controllers/create_message',array('inline'=>false));?>


