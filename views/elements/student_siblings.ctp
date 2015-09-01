<div class="panel-group" id="StudentSibling">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<h4 class="panel-title col-lg-11">
					<a data-toggle="collapse" data-parent="#StudentSibling" href="#SS">Student Siblings</a>
				</h4>
			</div>
		</div>
		<div id="SS" class="panel-collapse collapse in">
			<div class="panel-body">				
				<div class="row">
					<div class="col-lg-5" id="StudentSiblingForm">
						<h4>Sibling Form</h4>
						<hr>
						<div class="row">
							<div class="col-lg-6">
								<?php echo $this->Form->input('SS.id',array('field'=>'id','type'=>'hidden'));?>
							</div>
							<div class="col-lg-6">
								<?php echo $this->Form->input('SS.student_id',array('field'=>'student_id','type'=>'hidden'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->Form->input('SS.sibling_name',array('field'=>'sibling_name'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->Form->input('SS.year_level_id',array('field'=>'year_level_id','options'=>$yearLevels,'empty'=>'Select'));?>
							</div>
						</div>
						<hr>
						<div class="row text-right">
							<div class="col-lg-5 col-lg-offset-7">
								<button type="button" class="btn" id="ResetSiblingButton">Reset</button>
								<button type="button" class="btn btn-primary" id="AddSiblingButton">Add</button>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<table class="table table-bordered table-hovered table-condensed" id="StudentSiblingTable">
							<caption><h4>Student's Sibling</h4></caption>
							<thead>
								<tr class="text-center">
									<th>Name</th>
									<th>Year Level</th>
									<th>Actions</th>
								</tr>	
							</thead>
							<tbody>
								<?php if(empty($this->data['StudentSibling'])):?>
									<tr style="display:none">
										<td>
											<?php echo $this->Form->input('StudentSibling.sibling_name',array('field'=>'sibling_name','type'=>'text','label'=>false,'class'=>'form-control'));?>
										</td>
										<td>
											<?php echo $this->Form->input('StudentSibling.year_level_id',array('field'=>'year_level_id','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="text-center" style="padding-top:10px;">						
											<a class="fa fa-arrow-circle-left view-sibling" data-toggle="tooltip" data-placement="left" title="Update Row"></a>
											<a class="fa fa-trash delete-sibling"  data-toggle="tooltip" data-placement="left" title="Delete Row"></a>
										</td>
									</tr>
								<?php endif; ?>

								<?php if(!empty($this->data['StudentSibling'])):?>
									<?php foreach($this->data['StudentSibling'] as $rel):?>
										<tr>
											<td class="hide">
												<?php echo $this->Form->input('StudentSibling.id',array('value'=>$rel['id'],'field'=>'id','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentSibling.student_id',array('value'=>$rel['student_id'],'field'=>'student_id','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td>
												<?php echo $this->Form->input('StudentSibling.sibling_name',array('value'=>$rel['sibling_name'],'field'=>'sibling_name','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td>
												<?php echo $this->Form->input('StudentSibling.year_level_id',array('value'=>$rel['year_level_id'],'field'=>'year_level_id','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="text-center" style="padding-top:10px;">
												<a class="fa fa-arrow-circle-left view-sibling" data-toggle="tooltip" data-placement="left" title="Update Row"></a>
												<a class="fa fa-trash delete-sibling"  data-toggle="tooltip" data-placement="left" title="Delete Row"></a>
											</td>
										</tr>
									<?php endforeach;?>
								<?php endif;?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="9">NO DATA AVAILABLE</td>
								</tr>
							</tfoot>
						</table>
						<?php echo $this->Session->flash(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="submit" id="StudentSiblingSubmitButton" style="display:none;"></input>