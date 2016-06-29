<?php
App::import('Vendor','student_report');


$pr= new StudentAttendanceReport();
if(!empty($data) && !empty($hdr)){
	$pr->divider();
	$pr->hdr(0,$hdr,$data);
	$pr->table(0,$hdr,$data);
	$pr->hdr(4.25,$hdr,$data);
	$pr->table(4.25,$hdr,$data);
}else{
	
	$pr->nodata();
}

$pr->output();


?>