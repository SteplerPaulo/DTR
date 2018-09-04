<style>
img{
	margin: 4px 0;
    max-height: 373px;
	max-width: 373px;
    border: solid #9c9696;
    border-radius: 30px;
}

.table-wrapper{
    display: block;
    max-height: 70vh;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
.img-wrapper{
	padding-top: 15px;	
    padding-bottom: 15px;
    background-color: #f9f9f9;
}

td{
	cursor:pointer;
}
.selected{
	background-color: #428bca !important;
    color: white;
}


</style>

<div ng-controller="ImageTaggingController" ng-init="initializeController()">	
	{{img_id}}
	<div class="row-fluid">
		<div class="col-lg-4">
			<input ng-model="ntfilter" class="form-control" placeholder="Search Grade - Section">
			<br/>
			<label>NO TAG IMG</label>
			<div class="table-wrapper">
				<table class="table table-hovered table-striped table-condensed">
					<tbody>
						<tr ng-repeat="d in notagimage | filter:ntfilter track by $index" current-page="currentPage">
							
							<td title="Click Me" ng-click="tagImg(d)" ng-class="{selected: d.Image.id === selected}">{{d.Image.img_path}}</td>
						</tr>
					</tbody>
				</table>	
			</div>
		</div>
		<div class="col-lg-4 img-wrapper" >
			<center>
				<img src="{{fullimgpath}}" class="img-rounded">
			</center>
			<div class="input-group">
				<input ng-model="studname" ng-disabled="intent=='Change'" type="text" class="form-control" id="name">
				<span class="input-group-btn">
					<button ng-click="intentTo(intent)" class="btn btn-primary" type="button">{{intent}}</button>
				</span>
			</div>
		</div>
		<div class="col-lg-4">
			<input ng-model="wtfilter" class="form-control" placeholder="Search Grade - Section">
			<br/>
			<label>WITH TAG IMG</label>
			<div class="table-wrapper">
				<table class="table table-hovered table-striped table-condensed">
					<tbody>
						<tr ng-repeat="d in withtagimage | orderBy:'d.Image.modified' | filter:wtfilter track by $index " current-page="currentPage">
							
							<td ng-click="changeTag(d)" ng-class="{selected: d.Image.id === selected}">{{d.Image.img_path}}</td>
						</tr>
					</tbody>
				</table>	
			</div>
		
		</div>
	</div>
	
	
</div>





<?php echo $this->Html->script('template/bootstrap3-typeahead.min',array('inline'=>false));?>
<?php echo $this->Html->script('controllers/tagging',array('inline'=>false));?>