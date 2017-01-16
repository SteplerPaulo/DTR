<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>SECTION LOADING</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Section',array('action'=>'loading'));?>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<?php echo $this->Form->input('employee_number',array('empty'=>'Select','options'=>$employees,'label'=>'Employee','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-6">
						<?php echo $this->Form->input('section_id',array('multiple'=>true,'size'=>'20','class'=>'form-control','required'=>'required'));?>

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