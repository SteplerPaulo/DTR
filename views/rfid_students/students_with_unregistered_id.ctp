<?php
App::import('Vendor','students_with_unregistered_id');

$pr= new StudentList();



if(!empty($data)){
	//$pr->divider();
	$pr->hdr(0,$SystemDefault);
	$pr->table(0,$data);

	
}else{
	$pr->nodata();
}
$pr->output();


?>