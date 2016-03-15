<?php
App::import('Vendor','daily_report');

$pr= new DailyReport();

if(!empty($data) && !empty($hdr)){
	$pr->divider();
	$pr->hdr(0,$hdr);
	$pr->table(0,$data);
	$pr->hdr(4.25,$hdr);
	$pr->table(4.25,$data);

	
	}else{
	
		$pr->nodata();
	}
$pr->output();


?>