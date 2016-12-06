<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					<h4>Add New Student</h4>
				</h3>
			</div>
			<?php echo $this->Form->create('Student201',array('action'=>'add'));?>
			<div class="panel-body">
				<div class="row" >
					<div class="col-lg-4">
						<?php echo $this->Form->input('student_number',array('class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<?php //echo $this->Form->input('level_id',array('empty'=>'Select','class'=>'form-control','required'=>'required'));
						?>
						
						<label for="Student201LevelId">Level</label>
						<select name="data[Student201][level_id]" class="form-control" required="required" id="Student201LevelId">
							<option value="">Select</option>
							<?php foreach($levels as $lvl):?>
								<option value="<?php echo $lvl['Level']['id']?>" level="<?php echo $lvl['Level']['alias']?>"><?php echo $lvl['Level']['name']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="col-lg-4">
						
						<?php //echo $this->Form->input('section_code',array('options'=>$sections,'empty'=>'Select','class'=>'form-control','required'=>'required'));?>
						
						<label for="Student201SectionCode">Section</label>
						<select name="data[Student201][section_code]" class="form-control" required="required" id="Student201SectionCode">
							<option value="">Select</option>
							<?php foreach($sections as $sec):?>
								
								<option value="<?php echo $sec['Section']['id']?>" level="<?php echo $sec['Section']['level']?>"><?php echo $sec['Section']['name']?></option>
							<?php endforeach;?>
						</select>
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
						<?php echo $this->Form->input('gender',array('empty'=>'Select','class'=>'form-control','required'=>'required'));?>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label class="control-label">Date Of Birth</label>
							<input type="date" name="data[Student201][birthday]" class="form-control" required="required">
						</div>
					</div>
					<div class="col-lg-4">
						<?php echo $this->Form->input('mobile',array('between'=>'<div class="input-group"><span class="input-group-addon">+63</span>','after' => '</div>','label'=>'Mobile No','class'=>'form-control','required'=>'required','maxlength'=>10));?>
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
						<?php echo $this->Form->input('primary_mobile_no',array('between'=>'<div class="input-group"><span class="input-group-addon">+63</span>','after' => '</div>','label'=>'Contact Mobile No','class'=>'form-control','required'=>'required','maxlength'=>10));?>
					</div>
				</div>
			</div>
			
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-default" type="reset">Reset</button>
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('biz/addStudent201',array('inline'=>false));?>