<?php echo $this->Form->create('SchoolCalendar');?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default" ng-form="SchoolCalendarForm">
			<div class="panel-heading">EDIT SCHOOL CALENDAR</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">
						<?php echo $this->Form->input('id',array('class'=>'form-control input-sm'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<?php echo $this->Form->input('school_year',array('value'=>$this->data['SchoolYear']['name'],'readonly'=>'readonly','class'=>'form-control input-sm'));?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('curriculum',array('value'=>$this->data['Curriculum']['name'],'readonly'=>'readonly','class'=>'form-control input-sm'));?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('period',array('value'=>$this->data['Period']['name'],'readonly'=>'readonly','class'=>'form-control input-sm'));?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->input('level',array('value'=>$this->data['Level']['name'],'readonly'=>'readonly','class'=>'form-control input-sm'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Date From</label>
						<input type="date" class="form-control input-sm" required name="data[SchoolCalendar][date_from]" value='<?php echo $this->data['SchoolCalendar']['date_from']?>'>
					</div>
					<div class="col-md-3">
						<label>Date To</label>
						<input type="date" class="form-control input-sm" required name="data[SchoolCalendar][date_to]" value='<?php echo $this->data['SchoolCalendar']['date_to']?>'>
					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-warning" type="submit">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

