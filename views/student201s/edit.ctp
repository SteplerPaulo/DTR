<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Edit Student</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Student201',array('action'=>'edit'));?>
			<div class="panel-body">
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('id',array('class'=>'form-control'));?>
					</div>
				</div>
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('student_number',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('level_id',array('empty'=>'Select','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('section_code',array('options'=>$sections,'empty'=>'Select','value'=>$this->data['Student201']['section_code'],'class'=>'form-control','required'=>'required'));?>
					</div>
				</div><br/>
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
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('gender',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label class="control-label">Date</label>
							<input type="date" name="data[Student201][birthday]"  value="<?php echo $this->data['Student201']['birthday'];?>" class="form-control" required="required">
						</div>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('mobile',array('value'=>substr($this->data['Student201']['mobile'],3,11),'between'=>'<div class="input-group"><span class="input-group-addon">+63</span>','after' => '</div>','label'=>'Mobile No','class'=>'form-control','required'=>'required','maxlength'=>10));?>
					</div>
				
				</div><br/>
				
				<h4 class="label-warning text-center" style="">IN CASE OF EMERGENCY</h4>
				
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('primary_name',array('label'=>'Contact Name','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('primary_relationship',array('options'=>$relationships,'empty'=>'Select','label'=>'Relationship','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('primary_mobile_no',array('value'=>substr($this->data['Student201']['primary_mobile_no'],3,11),'between'=>'<div class="input-group"><span class="input-group-addon">+63</span>','after' => '</div>','label'=>'Contact Mobile No','class'=>'form-control','required'=>'required','maxlength'=>10));?>
					</div>
					
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<a class="btn btn-default" href="/DTR/student201s">Cancel</a>
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>