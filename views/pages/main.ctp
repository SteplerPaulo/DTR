<?php echo $this->Html->css('main'); ?>
		
<section>
	<div class="col-lg-3">
		<?php echo $this->Form->create('Dtr',array('class'=>''));?>
		<div class="row">	
			<div class="container">
				<div id="myclock"></div>
			</div>

		</div>
		<div class="row">	
			<h4><center>
				<?php
					date_default_timezone_set("Asia/Singapore"); 
					echo date("l  d-M-y");  
				?>
				</center>
			</h4>
		</div>
		<div class="row">	
			<?php echo $this->Form->input('employee_id',array('class'=>'form-control input-sm col-lg-5','type'=>'text','label'=>'Employee ID')); ?>
		</div>
		<div class="row">	
			<?php echo $this->Form->input('name',array('class'=>'form-control input-sm','type'=>'text')); ?>
		</div>
		<div class="row">	
			<?php echo $this->Form->input('message',array('class'=>'form-control input-sm','type'=>'text')); ?>
		</div>
		<?php echo $this->Form->end();?>
	</div>

	<div class="col-lg-9">	
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center w20" rowspan="2">Date</th>
					<th class="text-center w20" rowspan="2">Day</th>
					<th class="text-center w60" colspan="2">Check</th>
				</tr>
				<tr>
					<th class="text-center">In</th>
					<th class="text-center">Out</th>
				</tr>
			</thead>
			<tbody>
				<tr class="text-center">
					<td><?php echo date("d"); ?></td>
					<td><?php echo date("l"); ?></td>
					<td class="w30"><?php echo date("g:i a");  ?></td>
					<td class="w30">--</td>
				</tr>
			</tbody>
		</table>

	</div>
</section>
<?php echo $this->Html->script('jquery.thooClock',array('inline'=>false)); ?>
<?php echo $this->Html->script('biz/clock',array('inline'=>false)); ?>

<!--CLOCK REFENRENCE: http://www.jqueryscript.net/time-clock/Customizable-Analog-Alarm-Clock-with-jQuery-Canvas-thooClock.html-->
