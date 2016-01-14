
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('DTR:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-Equiv="Cache-Control" Content="no-cache" />
    <meta http-Equiv="Pragma" Content="no-cache" />
    <meta http-Equiv="Expires" Content="0" />

	<?php
		echo $this->Html->meta('icon',"/new-erb/img/school_logo.png", array('type' =>'icon'));
		echo $this->Html->css('template/bootstrap.min'); //Bootstrap Core CSS
	//	echo $this->Html->css('template/sb-admin'); //Custom CSS
		echo $this->Html->css('template/plugins/morris.css'); //Morris Charts CSS
		echo $this->Html->css('template/plugins/jasny-bootstrap'); //Custom CSS
		echo $this->Html->css('template/plugins/jasny-navmenu-reveal'); //Custom CSS
		echo $this->Html->css('template/plugins/listgroup-tile'); //Custom CSS
		echo $this->Html->css('template/plugins/wizard'); //Custom CSS
		echo $this->Html->css('template/patches/side-nav'); //Custom CSS
		echo $this->Html->css('template\font-awesome-4.4.0\css\font-awesome'); //Custom Fonts
		echo $this->Html->css('template\jquery-ui-1.11.2.custom\jquery-ui'); //Custom Fonts
		echo $this->Html->css('ss/ssMetrics'); //Submodule CSS
		echo $this->Html->css('submodule'); //Submodule CSS
		echo $this->Html->css('datepicker'); 
		echo $this->Html->css('dtr'); 
		//echo $this->Html->css('template/plugins/dataTables.bootstrap');		
	?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="">
	<div ng-app="App">

				<div class="container-fluid">
					<?php echo $this->Session->flash(); ?>
					<?php echo $content_for_layout; ?>
				</div>
			
    </div>
	<?php
		echo $this->Html->script(array('template/jquery-1.11.0')); //jQuery Version 1.11.0
		echo $this->Html->script(array('template/bootstrap.min')); //Bootstrap Core JavaScript
		echo $this->Html->script(array('template/plugins/metisMenu/metisMenu.min')); //Metis Menu Plugin JavaScript
		echo $this->Html->script(array('template/sb-admin'));
		echo $this->Html->script(array('template/jquery-ui-1.11.2.custom/jquery-ui'));
		echo $this->Html->script(array('template/plugins/jasny/jasny-bootstrap')); //Bootstrap Jasny JavaScript
		echo $this->Html->script(array('template/plugins/jasny/jasny-modal-patch')); //Patch modal z-index
		echo $this->Html->script(array('template/plugins/wizard/wizard'));
		echo $this->Html->script(array('template/angular'));	
		echo $this->Html->script(array('template/bootstrap-datepicker'));
		echo $this->Html->script(array('template/jqueryForm'));
		echo $this->Html->script(array('biz/app'));
		echo $this->Html->script(array('test/data'));
		echo $this->Html->script(array('angularUtils/directives/dirPagination'));
		echo $this->Html->script(array('angularUtils/directives/ui-bootstrap-tpls-0.14.3.min'));
		//echo $this->Html->script(array('template/plugins/dataTables/jquery.dataTables'));
		//echo $this->Html->script(array('template/plugins/dataTables/dataTables.bootstrap'));
	?> 
	<script type="text/javascript">(function(){window.App = angular.module('App',['angularUtils.directives.dirPagination'])})();</script>

	<?php  echo $scripts_for_layout; ?>
</body>
</html>