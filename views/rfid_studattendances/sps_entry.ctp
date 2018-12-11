<div ng-controller="DailyCheckingController" ng-init="initializeController()">
	
	<div class="row">	
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="panel-title">SPS ENTRY</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<label>Student No.</label>
							<input class="form-control input-sm" ng-model="studno">
						</div>
						<div class="col-lg-4">
							<label>Date</label>
							<input type="date" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m-d')?>">
						</div>
						<div class="col-lg-4">
							<label>Remark</label>
							<select class='form-control input-sm' ng-model='remark'>
								<option value="">--Select--</option>
								<option ng-repeat="d in remarks">{{d}}</option>
							</select>
						</div>
					</div><br/>
					<div class="row">
						<div class="col-lg-12">
							<label>Reason</label>
							<textarea style="resize: none;" rows="3" class='form-control input-sm' ng-model="reason"></textarea>
						</div>
					</div>
				</div>
				<div class="panel-footer text-right">
					<button ng-disabled="!studno || !date || !remark" class="btn btn-primary" disabled="disabled" ng-click="save()">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/sps_entry',array('inline'=>false)); ?>