
		
<section>
<?php echo $this->Form->create('Dtr',array('class'=>''));?>
	<div class="row">
	
		<div class="col-lg-2">
			<img src="img/200x200.gif" alt="..." class="img-thumbnail">
		</div>

		<div class="col-lg-10">	<br><br><br>
			<div class="row">	
				<div class="col-lg-2">
					<?php echo $this->Form->input('employee_id',array('class'=>'form-control input-sm','type'=>'text','label'=>'Employee ID')); ?>
				</div>
			</div>
			<div class="row">	
			<div class="col-lg-4">
				<?php echo $this->Form->input('name',array('class'=>'form-control input-sm','type'=>'text')); ?>
			</div>
		</div>
	</div>
	
<?php echo $this->Form->end();?>
</section>
<br/>
<section>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center">Date</th>
				<th class="text-center">Day</th>
				<th class="text-center">Check</th>
				<th class="text-center" colspan="2">Break</th>
				<th class="text-center">Check</th>
				<th class="text-center" colspan="2">OverTime</th>
				<th class="text-center" rowspan="2">LOW</th>
				<th class="text-center" rowspan="2">OT 1.5</th>
				<th class="text-center" rowspan="2">OT 2.0</th>
				<th class="text-center" rowspan="2">UT</th>
				<th class="text-center" rowspan="2">LT</th>
				<th class="text-center" colspan="2">Others</th>
				<th class="text-center" rowspan="2">Remarks</th>
			</tr>
			<tr>
				<th class="text-center"></th>
				<th class="text-center"></th>
				<th class="text-center">In</th>
				<th class="text-center">Out</th>
				<th class="text-center">In</th>
				<th class="text-center">Out</th>
				<th class="text-center">In</th>
				<th class="text-center">Out</th>
				<th class="text-center">Status</th>
				<th class="text-center">Holidays</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-center">
				<td><?php echo date("j"); ?></td>
				<td><?php echo date("D"); ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</section>