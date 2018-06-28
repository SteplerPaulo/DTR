<div ng-controller="PrintSectionMonthlyReport" ng-init="initializeController()">
	<section class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="panel-title">Section Monthly Report</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
							<label>Section</label>
							<select class='form-control input-sm' ng-model="selected" ng-options="o.Section.name for o in sections">
								<option value="">--Select--</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label>Date</label>
							<input type="month" class="form-control input-sm" ng-model="date" max="<?php echo date('Y-m')?>">
						</div>
					</div>
				</div>
				<div class="panel-footer text-right">
					<a ng-disabled="!selected || !date" href="/DTR/rfid_studattendances/monthly_report/{{selected.Section.id}}/{{selected.Section.name}}/{{date}}" target="_blank" class="btn btn-primary">Generate PDF</a>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Html->script('controllers/print_section_monthly_report',array('inline'=>false)); ?>