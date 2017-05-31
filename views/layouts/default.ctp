<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
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
		echo $this->Html->css('template/sb-admin'); //Custom CSS
		echo $this->Html->css('template/plugins/morris.css'); //Morris Charts CSS
		echo $this->Html->css('template/plugins/jasny-bootstrap'); //Custom CSS
		echo $this->Html->css('template/plugins/jasny-navmenu-reveal'); //Custom CSS
		echo $this->Html->css('template/plugins/listgroup-tile'); //Custom CSS
		echo $this->Html->css('template/plugins/wizard'); //Custom CSS
		echo $this->Html->css('template/patches/side-nav'); //Custom CSS
		echo $this->Html->css('template\font-awesome-4.4.0\css\font-awesome'); //Custom Fonts
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
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<!--<div class=" col-md-3 col-sm-5 col-xs-8">-->
		<?php
			$localIP = getHostByName(getHostName()); 
			$myclass='';
			if($localIP=='192.168.0.14'||$localIP=='192.168.0.13'){
				$myclass="hidden";
			}
		?>
		<div id="eto" class="<?php echo $myclass?>">
			<div class="navmenu navmenu-inverse navmenu-fixed-left col-md-3 col-sm-5 col-xs-8">
				<a class="navmenu-brand" href="#">Menu</a>
				 <ul class="nav navmenu-nav side-nav">
				   <li>
						<?php  echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-home fa-fw')).' '.
									$this->Html->tag('span', 'Home'),
									array('admin' => false,'controller'=>'pages','action'=>'/'),
									array('escape' => false)
									);  ?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-clock-o fa-fw"></i> Attendance Daily Checking',
									array('admin' => false,'controller'=>'rfid_studattendances','action'=>'daily_checking'),
									array('escape'=>false )
								);?>
					</li>
					<li>
						<?php echo $this->Html->link('<i class="fa fa-clock-o fa-fw"></i> Employee Daily Time Record',
									array('admin' => false,'controller'=>'attendances','action'=>'/'),
									array('escape'=>false )
								);?>
					</li>
					<li>
						<?php echo $this->Html->link("<i class='fa fa-tag'></i> Assign RFID",
									array('admin' => false,'controller'=>'rfid_students','action'=>'assign'),
									array('escape'=>false )
								);?>
					</li>
					<li>
						<?php echo $this->Html->link("<i class='fa fa-tags'></i> Assign Fetcher",
									array('admin' => false,'controller'=>'fetchers','action'=>'assigning'),
									array('escape'=>false )
								);?>
					</li>
					<li>
						<?php echo $this->Html->link("<i class='fa fa-mobile fa-fw'></i> Set Student's Mobile No",
									array('admin' => false,'controller'=>'rfid_students','action'=>'/'),
									array('escape'=>false )
								);?>
					</li>
					<li>
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#ReportLinks"><i class="fa fa-file-pdf-o fa-fw "></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="ReportLinks" class="collapse">
							<li>
								<?php echo $this->Html->link("<i class='fa fa-file-text-o'></i> Student Attendance Report",
											array('admin' => true,'controller'=>'rfid_studattendances','action'=>'index'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-file-archive-o'></i> Employee Attendance Report",
											array('admin' => true,'controller'=>'attendances','action'=>'index'),
											array('escape'=>false )
										);?>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#201s"><i class="fa fa-database fa-fw "></i> 201 <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="201s" class="collapse">
							<li>
								<?php echo $this->Html->link("<i class='fa fa-street-view fa-fw'></i> Employees",
											array('admin' => false,'controller'=>'employees','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-users fa-fw'></i> Students",
											array('admin' => false,'controller'=>'student201s','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-user-secret fa-fw'></i> Fetchers",
											array('admin' => false,'controller'=>'fetchers','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-list-alt fa-fw'></i> Sections",
											array('admin' => false,'controller'=>'sections','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#MessagesLinks"><i class="fa fa-folder-open fa-fw "></i> Messages <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="MessagesLinks" class="collapse">
							<li>
								<?php echo $this->Html->link("<i class='fa fa-edit fa-fw'></i> Create",
											array('admin' => false,'controller'=>'message_outs','action'=>'create_message'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-envelope-o fa-fw'></i> Inbox",
											array('admin' => false,'controller'=>'message_ins','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-envelope fa-fw'></i> Outbox",
											array('admin' => false,'controller'=>'message_outs','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-book'></i> Contacts",
											array('admin' => false,'controller'=>'contacts','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
							<li>
								<?php echo $this->Html->link("<i class='fa fa-key'></i> Keywords",
											array('admin' => false,'controller'=>'keywords','action'=>'/'),
											array('escape'=>false )
										);?>
							</li>
						</ul>
					</li>
					
					<?php if($this->Access->check('User','create','read','update','delete')): ?>
					
					<li>
						<a href="javascript:void(0)" data-toggle="collapse" data-target="#AdminMenu"><i class="fa fa-user fa-fw "></i> Admin Menu <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="AdminMenu" class="collapse">
							<li>
								<?php echo $this->Html->link("<i class='fa fa-pencil-square fa-fw'></i> Reset RFID No.",
											array('admin' => true,'controller'=>'rfid_students','action'=>'reset'),
											array('escape'=>false )
										);?>
							</li>
						</ul>
					</li>
					
					<li>
						<?php  echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-gears fa-fw')).' '.
										$this->Html->tag('span', 'Access Control', array('class' => 'module-label')),
										array('admin' => false,'controller'=>'pages','plugin'=>null,'action'=>'access_control'), array('escape' => false)
										);  ?>	
					</li>
					<?php endif;  ?>
				</ul>
			</div>
		</div>
		<div class="canvas">
			<!-- Navigation -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="javascript:void(0)">DAILY TIME RECORD</a>
				</div>
				<!-- Top Menu Items -->
				<ul class="nav navbar-right top-nav">
					<!--
					<li style="padding-top: 16px;color: purple;padding-right: 6px;" >
						<b><span>JUAN SUMULONG MEMORIAL JUNIOR COLLEGE</span></b>
					</li>
					-->
					<li>
						<a><?php echo $SystemDefault['school_name'];?>
						</a>
					</li>
					<li class="dropdown" ng-hide="false">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						
							<?php if($this->Access->getmy('username')):?>
							<li >
								<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-user fa-fw')).' '.
											$this->Html->tag('span', $this->Access->getmy('username')),
											array('admin' => false,'controller'=>'users','action'=>'view'),
											array('escape' => false)
											);  ?>
							</li>
							
							<li>
								<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-gear fa-fw')).' '.
											$this->Html->tag('span', 'Settings'),
											array('admin' => false,'controller'=>'users','action'=>'account_setting'),
											array('escape' => false)
											);  ?>
							</li>
							<li class="divider"></li>
							<?php endif;?>
							<li>
								<?php if($this->Access->getmy('username')):?>
								<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-sign-out fa-fw')).' '.
										$this->Html->tag('span', 'Logout'),
										array('admin' => false,'controller'=>'users','action'=>'logout'),
										array('escape' => false)
										);  ?>
								<?php else:?>
									<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-sign-in fa-fw')).' '.
										$this->Html->tag('span', 'Login'),
										array('admin' => false,'controller'=>'users','action'=>'login'),
										array('escape' => false)
										);  ?>
									<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'fa fa-pencil-square fa-fw')).' '.
										$this->Html->tag('span', 'Register'),
										array('admin' => false,'controller'=>'users','action'=>'register'),
										array('escape' => false)
										);  ?>
								<?php endif;?>
							</li>
						</ul>
					</li>
				</ul>
			</nav>

			<div id="page-wrapper">
				<div class="container-fluid">
					<?php echo $this->Session->flash(); ?>
					<?php echo $content_for_layout; ?>
				</div>
			</div>
			
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
		//echo $this->Html->script(array('template/bootstrap-datepicker'));
		echo $this->Html->script(array('template/jqueryForm'));
		echo $this->Html->script(array('biz/app'));
		echo $this->Html->script(array('test/data'));
		echo $this->Html->script(array('angularUtils/directives/dirPagination'));
		echo $this->Html->script(array('angularUtils/directives/ui-bootstrap-tpls-2.3.0.min'));
		echo $this->Html->script(array('angularUtils/directives/checklist-model'));
		//echo $this->Html->script(array('template/plugins/dataTables/jquery.dataTables'));
		//echo $this->Html->script(array('template/plugins/dataTables/dataTables.bootstrap'));
	?> 
	<script type="text/javascript">(function(){window.App = angular.module('App',['angularUtils.directives.dirPagination','checklist-model','ui.bootstrap'])})();</script>
	<?php  echo $scripts_for_layout; ?>
</body>
</html>