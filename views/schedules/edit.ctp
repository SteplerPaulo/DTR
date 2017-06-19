<div class="row">
	<div class="col-lg-8 col-lg-offset-2">	
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="panel-title">Edit Schedule</span>
			</div>
			<?php echo $this->Form->create('Schedule');?>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
						<?php echo $this->Form->input('section_id',array('empty'=>'--Select--','class'=>'form-control input-sm','disabled'=>'disabled'));?>
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('school_year_id',array('empty'=>'--Select--','class'=>'form-control input-sm'));?>
					</div>
					<div class="col-lg-2">
						<label>Start Time</label>
						<input type="time" class="form-control input-sm" name="data[Schedule][start_time]" value="<?php echo $this->data['Schedule']['start_time'];?>">
					</div>
					<div class="col-lg-2">
						<label>End Time</label>
						<input type="time" class="form-control input-sm" name="data[Schedule][end_time]" value="<?php echo $this->data['Schedule']['end_time'];?>">
					</div>
					<div class="col-lg-2 hide">
						<?php echo $this->Form->input('id',array('type'=>'text','class'=>'form-control input-sm')); ?>
					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<a href="<?php echo $this->base;?>/schedules" class="btn btn-default" type="cancel">Cancel</a>
					<button class="btn btn-primary" type="submit">Submit</button>
				</div>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>