<style>
.thumbnail{
	margin-bottom:0px;
}
.alert {
    padding: 0px;
}
.caption {
    font-size: 10px;
	padding: 0px;
}
</style>
<div class="row" ng-controller="FetcherAssigningController" ng-init="initializeController()">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Fetchers</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<input ng-model="FetcherFilter" placeholder="Search" class="form-control input-sm">
					</div>
				</div><br/>
				<div class="list-group">
					<div class="list-group-canvas list-group-search-results">
						<div class="list-group-item text-center"  ng-show="!fetchers.length">
							Loading...
						</div>
						<a class="list-group-item" pagination-id="FetcherList" dir-paginate="d in fetchers | filter:FetcherFilter | itemsPerPage: pageSize" ng-click="fetcherSelected(d)" ng-hide="isSelected[d.Fetcher.slug]">
							<h5 class="list-group-item-heading">
								{{d.Fetcher.full_name}}
							</h5>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">	
					Fetcher-Student Assigning
				</h3>
			</div>
			<?php echo $this->Form->create('FetcherRfidStudent',array('action'=>'save'))?>
			<div class="panel-body">
				<center class="alert alert-info"><b>Fetchers' Info</b></center>
				<div class="row">
					<div class="col-md-4" ng-repeat="(k,d) in FINALFETCHERS" ng-if="!isRemoved[d.Fetcher.slug]">
						<a class="thumbnail">
							<img  src="/DTR/fetchers/download/{{d.FetcherDocument.id}}"/>
							<div class="caption">
								<p>{{d.Fetcher.full_name}}</p>
								<button class="btn btn-danger btn-xs text-left" ng-click="removeFetcher(d)"><i class="fa fa-trash"></i> Remove</button>
							</div>
						</a>
						<div class="hide">
							<?php echo $this->Form->input('Fetcher.{{k}}.fetcher_id',array('ng-model'=>'d.Fetcher.id','type'=>'text'))?>
						</div>
					</div>
				</div>
				<hr/>
				<center class="alert alert-info"><b>Students' Info</b></center>
				<div class="row">
					<div class = "col-md-4" ng-repeat="(k,d) in FINALSTUDENTS" ng-if="!isRemoved[d.RfidStudent.slug]">
						<div class="thumbnail">
							<img src="/DTR/img/100x100.gif" alt="Generic placeholder thumbnail"/>
							<div class="caption">
								<p>{{d.RfidStudent.full_name}}</p>
								<button class="btn btn-danger btn-xs text-left" ng-click="removeStudent(d)"><i class="fa fa-trash"></i> Remove</button>
							</div>
						</div>
						<div class="hide">
							<?php echo $this->Form->input('Student.{{k}}.rfid_student_id',array('ng-model'=>'d.RfidStudent.id','type'=>'text'))?>
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-7 pull-right">
						<?php echo $this->Form->input('source_rfid',array('class'=>'form-control inline input-sm','label'=>false,'placeholder'=>'RFID','required'=>'required'));?>
					</div>
				</div>
			</div>
			<div class="panel-footer">	
				<div class="text-right">
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Students</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<input ng-model="StudentFilter" placeholder="Search" class="form-control input-sm">
					</div>
				</div><br/>
				<div class="list-group">
					<div class="list-group-canvas list-group-search-results">
						<div class="list-group-item text-center"  ng-show="!students.length">
							Loading...
						</div>
						<a class="list-group-item" pagination-id="StudentList" dir-paginate="d in students | filter:StudentFilter | itemsPerPage: pageSize" ng-click="studentSelected(d)">
							<h5 class="list-group-item-heading">
								{{d.RfidStudent.full_name}}
							</h5>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('controllers/fetcher_assigning',array('inline'=>false));?>