<?php
App::import('Vendor','daily_report');

$pr= new DailyReport();
if(!empty($data) && !empty($hdr)){
	$pr->divider();
	$pr->hdr(0,$hdr,$SystemDefault);
	$pr->table(0,$data);
	$pr->hdr(4.25,$hdr,$SystemDefault);
	$pr->table(4.25,$data);

	
	}else{
	
		$pr->nodata();
	}
$pr->output();


?>