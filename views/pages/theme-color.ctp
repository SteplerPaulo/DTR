<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">Theme Color</h1>
	</div>
</div>
<div class="row" id="ThemeColor">
	<div id="Default-Theme" class="col-md-2">
		<center class="panel panel-default">
			<div class="panel-body">
				<i class="fa fa-square fw" ></i>
			</div>
			<div class="panel-footer"><a theme="Default">Default</a> </div>
		</center>
	</div> 
	<div id="Purple-Theme" class="col-md-2">
		<center class="panel panel-default">
			<div class="panel-body">
				<i class="fa fa-square fw " ></i>
			</div>
			<div class="panel-footer"><a theme="Purple">Purple</a></div>
		</center>
	</div> 
	<div id="Yellow-Theme" class="col-md-2">
		<center class="panel panel-default">
			<div class="panel-body">
				<i class="fa fa-square fw " ></i>
			</div>
			<div class="panel-footer"><a theme="Yellow">Yellow</a></div>
		</center>
	</div> 
</div> 

<?php echo $this->Html->script(array('biz/theme-color'),array('inline'=>false));?>