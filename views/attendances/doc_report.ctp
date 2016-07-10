<?php
App::import('Vendor','employee_report');

$pr= new EmplAttendanceReport();
if(!empty($data) && !empty($hdr)){
	$pr->divider();
	$pr->hdr(0,$hdr,$data,$SystemDefault);
	$pr->table(0,$hdr,$data);
	$pr->hdr(4.25,$hdr,$data,$SystemDefault);
	$pr->table(4.25,$hdr,$data);
}else{
	
	$pr->nodata();
}

$pr->output();


//$array_chunk =array_chunk($products, 45);
//foreach($array_chunk as $key => $products){
	//$pr->hdr();
	//$pr->details($products);	
	//if(count($array_chunk) != $key+1){$pr->createSheet();}
//}

?>