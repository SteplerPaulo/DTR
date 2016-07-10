<?php
App::import('Vendor','monthly_report');

$pr= new MonthlyReport();
	$pr->hdr($SystemDefault);
	$pr->table();

$pr->output();


?>