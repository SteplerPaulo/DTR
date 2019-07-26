
<div class="row">
	<div class="col-lg-12">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">	
						<h3><?php echo $this->data['RfidStudent']['full_name']?></h3>
						<h5 >Student No. <?php echo $this->data['RfidStudent']['student_number']?></h5>
					</h3>
				</div>
				<div class="panel-body">
					<?php echo $this->Form->create('RfidStudent',array('inputDefaults' => array('class'=>'form-control','between'=>'<div class="form-group">','after'=>'</div>')));?>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('student_mobile_no',array('label'=>'Mobile No.'));
						echo $this->Form->input('guardian_mobile_no',array('label'=>'Parent/Guardian Mobile No.'));
						echo $this->Form->input('relationship',array('empty'=>'Select','options'=>array('Parent'=>'Parent','Guardian'=>'Guardian')));
					?>	
					
				</div>
				<div class="panel-footer">	
					<div class="text-right">
						<!--
						<button class="btn btn-primary btn-sm" type="button" ng-click="save(SendSampleText)">Save & Send Sample Text</button>
						<button class="btn btn-default btn-sm" type="button" ng-click="save(SaveOnly)">Save</button>
						-->
						<button class="btn btn-primary btn-sm" type="submit">Save & Send Sample Text</button>
						<a href="/DTR/rfid_students/index/" class="btn btn-default btn-sm">Cancel</a>
					</div>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>



<?php // echo $this->Html->script('controllers/set_mobileno',array('inline'=>false));?>


