<?php 
	$sy =array('2016'=>'2016-2017','2017'=>'2017-2018');
?>
<style>
	.fa-check{
		color:#428bca;
	}
	.fa-question{
		color:#ff9200;
	}
	.fa-close{
		color:#ff0000;
	}
	a{
		color: black;
	}
	a:hover{
		color: black;
		text-decoration: none;
	}
	tbody td:hover{
		background-color: #e1e6ea;
	}
	sup{
		float: right;
	}
</style>
<div ng-controller="SetSchoolDaysController" ng-init="initializeController()">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">SCHOOL DAYS</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<?php echo $this->Form->input('sy',array('value'=>'2017-2018','readonly'=>'readonly','label'=>'S.Y','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('grade_level',array('value'=>'Grade 1','readonly'=>'readonly','class'=>'form-control inline input-sm'));?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('period',array('value'=>'1st Period','readonly'=>'readonly','class'=>'form-control inline input-sm'));?>
						</div>
					</div><br/>
					<div class="row">
						<div class="col-md-4">
							<table class="table table-bordered">
								<caption><b>JULY, 2017</b></caption>
								<thead>
									<tr>
										<th class="text-center">Sun</th>
										<th class="text-center">Mon</th>
										<th class="text-center">Tue</th>
										<th class="text-center">Wed</th>
										<th class="text-center">Thu</th>
										<th class="text-center">Fri</th>
										<th class="text-center">Sat</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td>
											<a href="#" title="Regular School Day">1</a> 
											<a href="#" title="Click to toggle">
												<sup><i class="fa fa-check"></i></sup>
											</a>
										</td>
										<td>
											<a href="#" title="Regular Holiday">2</a> 
											<a href="#" title="Click to toggle">
												<sup><i class="fa fa-close"></i></sup>
											</a>
										</td>
										<td>3 <sup><i class="fa fa-check"></i></sup></td>
										<td>4 <sup><i class="fa fa-check"></i></sup></td>
										<td>5 <sup><i class="fa fa-check"></i></sup></td>
										<td>6 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>7 <sup><i class="fa fa-question"></i></sup></td>
										<td>8 <sup><i class="fa fa-check"></i></sup></td>
										<td>9 <sup><i class="fa fa-check"></i></sup></td>
										<td>10 <sup><i class="fa fa-check"></i></sup></td>
										<td>11 <sup><i class="fa fa-check"></i></sup></td>
										<td>12 <sup><i class="fa fa-check"></i></sup></td>
										<td>13 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>14 <sup><i class="fa fa-question"></i></sup></td>
										<td>15 <sup><i class="fa fa-check"></i></sup></td>
										<td>16 <sup><i class="fa fa-check"></i></sup></td>
										<td>17 <sup><i class="fa fa-check"></i></sup></td>
										<td>18 <sup><i class="fa fa-check"></i></sup></td>
										<td>19 <sup><i class="fa fa-check"></i></sup></td>
										<td>20 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>21 <sup><i class="fa fa-question"></i></sup></td>
										<td>22 <sup><i class="fa fa-check"></i></sup></td>
										<td>23 <sup><i class="fa fa-check"></i></sup></td>
										<td>24 <sup><i class="fa fa-check"></i></sup></td>
										<td>25 <sup><i class="fa fa-check"></i></sup></td>
										<td>26 <sup><i class="fa fa-check"></i></sup></td>
										<td>27 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>28 <sup><i class="fa fa-question"></i></sup></td>
										<td>29 <sup><i class="fa fa-check"></i></sup></td>
										<td>30 <sup><i class="fa fa-check"></i></sup></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7" class="text-right">
											<button class="btn btn-sm btn-default" type="reset">Reset</button>
											<button class="btn btn-sm btn-primary">Save</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					
					
						<div class="col-md-4">
							<table class="table table-bordered">
								<caption><b>AUGUST, 2017</b></caption>
								<thead>
									<tr>
										<th class="text-center">Sun</th>
										<th class="text-center">Mon</th>
										<th class="text-center">Tue</th>
										<th class="text-center">Wed</th>
										<th class="text-center">Thu</th>
										<th class="text-center">Fri</th>
										<th class="text-center">Sat</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td>
											<a href="#" title="Regular School Day">1</a> 
											<a href="#" title="Click to toggle">
												<sup><i class="fa fa-check"></i></sup>
											</a>
										</td>
										<td>
											<a href="#" title="Regular Holiday">2</a> 
											<a href="#" title="Edit">
												<sup><i class="fa fa-close"></i></sup>
											</a>
										</td>
										<td>3 <sup><i class="fa fa-check"></i></sup></td>
										<td>4 <sup><i class="fa fa-check"></i></sup></td>
										<td>5 <sup><i class="fa fa-check"></i></sup></td>
										<td>6 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>7 <sup><i class="fa fa-question"></i></sup></td>
										<td>8 <sup><i class="fa fa-check"></i></sup></td>
										<td>9 <sup><i class="fa fa-check"></i></sup></td>
										<td>10 <sup><i class="fa fa-check"></i></sup></td>
										<td>11 <sup><i class="fa fa-check"></i></sup></td>
										<td>12 <sup><i class="fa fa-check"></i></sup></td>
										<td>13 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>14 <sup><i class="fa fa-question"></i></sup></td>
										<td>15 <sup><i class="fa fa-check"></i></sup></td>
										<td>16 <sup><i class="fa fa-check"></i></sup></td>
										<td>17 <sup><i class="fa fa-check"></i></sup></td>
										<td>18 <sup><i class="fa fa-check"></i></sup></td>
										<td>19 <sup><i class="fa fa-check"></i></sup></td>
										<td>20 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>21 <sup><i class="fa fa-question"></i></sup></td>
										<td>22 <sup><i class="fa fa-check"></i></sup></td>
										<td>23 <sup><i class="fa fa-check"></i></sup></td>
										<td>24 <sup><i class="fa fa-check"></i></sup></td>
										<td>25 <sup><i class="fa fa-check"></i></sup></td>
										<td>26 <sup><i class="fa fa-check"></i></sup></td>
										<td>27 <sup><i class="fa fa-question"></i></sup></td>
									</tr>
									<tr>
										<td>28 <sup><i class="fa fa-question"></i></sup></td>
										<td>29 <sup><i class="fa fa-check"></i></sup></td>
										<td>30 <sup><i class="fa fa-check"></i></sup></td>
										<td>31 <sup><i class="fa fa-check"></i></sup></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7" class="text-right">
											<button class="btn btn-sm btn-default" type="reset">Reset</button>
											<button class="btn btn-sm btn-primary">Save</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php echo $this->Html->script('controllers/set_school_days',array('inline'=>false)); ?>