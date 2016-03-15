<?php
App::import('Vendor','monthly_report');

$pr= new MonthlyReport();
	$pr->hdr();
	$pr->table();

$pr->output();


?>