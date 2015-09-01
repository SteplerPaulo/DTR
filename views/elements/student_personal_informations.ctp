<div class="row">
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.gender',array('options'=>$gender,'empty'=>'Select'));?>
	</div>
	
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.citizenship_id',array('empty'=>'Select'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.religion_id',array('empty'=>'Select'));?>
	</div>

	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.birth_date',array('class'=>'datepicker form-control','data-date-format'=>'yyyy-mm-dd','type'=>'text'));?>
	</div>
	<div class="col-lg-4">
		<?php echo $this->Form->input('StudentPersonalInformation.birth_place');?>	
	</div>
</div>
<div class="row">
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.landline');?>						
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.mobile1',array('label'=>'Home No.'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.mobile2',array('label'=>'Mobile No.'));?>	
	</div>
</div>

<h4>Current Address</h4>	
<div class="row">
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_country_id',array('options'=>$countries,'label'=>'Country','empty'=>'Select'));?>
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_province',array('options'=>$provinces,'label'=>'Province','empty'=>'Select','id'=>'StudentPersonalInformationCurrProvinceDropdown'));?>	
		<?php echo $this->Form->input('StudentPersonalInformation.curr_province',array('type'=>'text','label'=>'Province','id'=>'StudentPersonalInformationCurrProvinceText'));?>								
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_city_municipality',array('label'=>'City/Municipality'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_barangay',array('label'=>'Barangay'));?>
	</div>
	<div class="col-lg-3">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_house_info',array('label'=>'House No & Street'));?>
	</div>
	<div class="col-lg-1">
		<?php echo $this->Form->input('StudentPersonalInformation.curr_zipcode',array('label'=>'Zipcode'));?>	
	</div>
</div>

<h4>Permanent Address</h4>	
<div class="row">
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_country_id',array('options'=>$countries,'label'=>'Country','empty'=>'Select'));?>
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_province',array('options'=>$provinces,'label'=>'Province','empty'=>'Select','id'=>'StudentPersonalInformationPermProvinceDropdown'));?>	
		<?php echo $this->Form->input('StudentPersonalInformation.perm_province',array('type'=>'text','label'=>'Province','id'=>'StudentPersonalInformationPermProvinceText'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_city_municipality',array('label'=>'City/Municipality'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_barangay',array('label'=>'Barangay'));?>
	</div>
	<div class="col-lg-3">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_house_info',array('label'=>'House No & Street'));?>
	</div>
	<div class="col-lg-1">
		<?php echo $this->Form->input('StudentPersonalInformation.perm_zipcode',array('label'=>'Zipcode'));?>	
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<label><h4>Send Mail To</h4></label>
		<div class="form-group">
			<label class="radio-inline">
				<input type="radio" name="data[StudentPersonalInformation][send_mail_to]" value="CurrentAddress" checked="" disabled="disabled">Current Address
			</label>
			<label class="radio-inline">
				<input type="radio" name="data[StudentPersonalInformation][send_mail_to]" value="PermanentAddress" disabled="disabled">Permanent Address
			</label>
		</div>
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.user_id',array('value'=>$user,'type'=>'hidden'));?>	
	</div>
	<div class="col-lg-2">
		<?php echo $this->Form->input('StudentPersonalInformation.id',array('type'=>'hidden'));?>	
	</div>
</div><hr/>