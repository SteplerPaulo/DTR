<?php
App::import('Vendor','employee_summary_report');

$pr= new EmpSummaryReport();

pr($data);exit;
//pr($dates);exit;

if(!empty($data) && !empty($dates)){
	$pr->hdr($SystemDefault);
	$pr->body($data,$dates);
	$pr->ftr();
}else{
	$pr->nodata();
}




$pr->output();



?>