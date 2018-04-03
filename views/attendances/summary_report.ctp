<?php
App::import('Vendor','employee_summary_report');

$pr= new EmpSummaryReport();


//pr($data);exit;
//pr($dates);exit;

if(!empty($data) && !empty($hdr) && !empty($dates)){
	$pr->hdr($SystemDefault,$hdr);
	$pr->body($data,$dates,$hdr['fromDate']);
	$pr->ftr();
}else{
	$pr->nodata();
}




$pr->output();



?>