<style>
.onSuccess{
	background-color: #5cb85c;
}
.onEdit{
	background-color: #ec971f;
}
</style>
<div class="panel-group" id="StudentRelative">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<h4 class="panel-title col-lg-11">
					<a data-toggle="collapse" data-parent="#StudentRelative" href="#SR">Student Relatives</a>
				</h4>
			</div>
		</div>
		<div id="SR" class="panel-collapse collapse in">
			<div class="panel-body">				
				<div class="row">
					<div class="col-lg-5" id="StudentRelativeForm">
						<h4>Relative Form</h4>
						<hr>
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->Form->input('SR.id',array('field'=>'id','type'=>'hidden'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?php echo $this->Form->input('SR.relative_name',array('field'=>'relative_name'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5">
								<?php echo $this->Form->input('SR.relationship',array('field'=>'relationship','empty'=>'Select'));?>
							</div>
							<div class="col-lg-7">
								<?php echo $this->Form->input('SR.occupation',array('field'=>'occupation'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<?php echo $this->Form->input('SR.country_id',array('field'=>'country_id','empty'=>'Select'));?>
							</div>
							<div class="col-lg-6">
								<?php echo $this->Form->input('SR.province',array('field'=>'province','empty'=>'Select','id'=>'SRProvinceDropdown'));?>
								<?php echo $this->Form->input('SR.province',array('field'=>'province','type'=>'text','id'=>'SRProvinceText'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<?php echo $this->Form->input('SR.city_municipality',array('field'=>'city_municipality'));?>
							</div>
							<div class="col-lg-6">
								<?php echo $this->Form->input('SR.barangay',array('field'=>'barangay'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9">
								<?php echo $this->Form->input('SR.house_info',array('field'=>'house_info'));?>
							</div>
							<div class="col-lg-3">
								<?php echo $this->Form->input('SR.zipcode',array('field'=>'zipcode','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'));?>
							</div>
						</div>
						<hr>
						<div class="row text-right">
							<div class="col-lg-5 col-lg-offset-7">
								<button type="button" class="btn" id="ResetRelativeButton">Reset</button>
								<button type="button" class="btn btn-primary" id="AddRelativeButton">Add</button>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<table class="table table-bordered table-hovered table-condensed" id="StudentRelativeTable">
							<caption><h4>Student's Relatives</h4></caption>
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Relationship</th>
									<th class="text-center hide">Occupation</th>
									<th class="text-center hide">Country</th>
									<th class="text-center hide">Province</th>
									<th class="text-center hide">City/Municipality</th>
									<th class="text-center hide">Barangay</th>
									<th class="text-center hide">House Info</th>
									<th class="text-center hide">Zipcode</th>
									<th class="text-center">Actions</th>
								</tr>	
							</thead>
							<tbody>
								<?php if(empty($this->data['StudentRelative'])):?>
									<tr style="display:none">
										<td>
											<?php echo $this->Form->input('StudentRelative.relative_name',array('field'=>'relative_name','type'=>'text','label'=>false,'class'=>'form-control'));?>
										</td>
										<td>
											<?php echo $this->Form->input('StudentRelative.relationship',array('field'=>'relationship','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.occupation',array('field'=>'occupation','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.country_id',array('field'=>'country_id','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.province',array('field'=>'province','type'=>'text','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.city_municipality',array('field'=>'city_municipality','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.barangay',array('field'=>'barangay','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.house_info',array('field'=>'house_info','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="hide">
											<?php echo $this->Form->input('StudentRelative.zipcode',array('field'=>'zipcode','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
										</td>
										<td class="text-center" style="padding-top:10px;">						
											<a class="fa fa-arrow-circle-left view-relative" data-toggle="tooltip" data-placement="left" title="Update Row"></a>
											<a class="fa fa-trash delete-relative"  data-toggle="tooltip" data-placement="left" title="Delete Row"></a>
										</td>
									</tr>
								<?php endif; ?>

								<?php if(!empty($this->data['StudentRelative'])):?>
									<?php foreach($this->data['StudentRelative'] as $rel):?>
										<tr>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.id',array('value'=>$rel['id'],'field'=>'id','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td>
												<?php echo $this->Form->input('StudentRelative.relative_name',array('value'=>$rel['relative_name'],'field'=>'relative_name','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td>
												<?php echo $this->Form->input('StudentRelative.relationship',array('value'=>$rel['relationship'],'field'=>'relationship','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.occupation',array('value'=>$rel['occupation'],'field'=>'occupation','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.country_id',array('value'=>$rel['country_id'],'field'=>'country_id','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.province',array('value'=>$rel['province'],'field'=>'province','type'=>'text','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.city_municipality',array('value'=>$rel['city_municipality'],'field'=>'city_municipality','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.barangay',array('value'=>$rel['barangay'],'field'=>'barangay','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.house_info',array('value'=>$rel['house_info'],'field'=>'house_info','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="hide">
												<?php echo $this->Form->input('StudentRelative.zipcode',array('value'=>$rel['zipcode'],'field'=>'zipcode','empty'=>'Select','label'=>false,'class'=>'form-control'));?>
											</td>
											<td class="text-center" style="padding-top:10px;">
												<a class="fa fa-arrow-circle-left view-relative" data-toggle="tooltip" data-placement="left" title="Update Row"></a>
												<a class="fa fa-trash delete-relative"  data-toggle="tooltip" data-placement="left" title="Delete Row"></a>
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
<input type="submit" id="StudentRelativeSubmitButton" style="display:none;"></input>