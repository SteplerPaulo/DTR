<?php
App::import('Vendor','student_report');



$pr= new StudDocRerpot();
if(!empty($data) && !empty($hdr)){
	$pr->divider();
	$pr->hdr(0);
	$pr->table(0);
	$pr->hdr(4.25);
	$pr->table(4.25);
}else{
	
	$pr->nodata();
}

$pr->output();


?>