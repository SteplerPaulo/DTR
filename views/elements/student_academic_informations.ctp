<div class="modal fade" id="StudentAcademicInformations" tabindex="-1" role="dialog" aria-labelledby="StudentAcademicInformationsLabel" aria-hidden="true">	
	<?php echo $this->Form->create('StudentAcademicInformation',array(
		'action'=>'add','role'=>'form',
		'inputDefaults' => array('class'=>'form-control','div'=>array('class'=>'form-group'))
	));?>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="StudentAcademicInformationsLabel">Student Academic Informations</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<?php echo $this->Form->input('StudentAcademicInformation.admission_date',array('label'=>'Date of Admission','type'=>'text','class'=>'datepicker form-control','data-date-format'=>'yyyy-mm-dd','type'=>'text'));?>	
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('StudentAcademicInformation.id',array('type'=>'hidden'));?>	
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('StudentAcademicInformation.student_id',array('type'=>'hidden','value'=>isset($this->data['Student']['id'])?$this->data['Student']['id']:''));?>	
					</div>
					<div class="col-lg-2">
						<?php echo $this->Form->input('StudentAcademicInformation.url',array('type'=>'hidden','value'=>$_SERVER[ 'REQUEST_URI' ]));?>	
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<?php echo $this->Form->input('StudentAcademicInformation.last_enrolled_sy',array('options'=>$schoolYears,'empty'=>'Select','label'=>'Last Enrolled School Year'));?>	
					</div>
					<div class="col-lg-6">
						<?php echo $this->Form->input('StudentAcademicInformation.last_enrolled_sem',array('options'=>$semesters,'empty'=>'Select','label'=>'Last Enrolled Semester'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<?php echo $this->Form->input('StudentAcademicInformation.residency_sy_count',array('label'=>'Years in school'));?>	
					</div>
					<div class="col-lg-6">
						<?php echo $this->Form->input('StudentAcademicInformation.residency_sy_start',array('options'=>$schoolYears,'empty'=>'Select','label'=>'Years in school as of'));?>	
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
<?php echo $this->Form->end();?>
</div>
