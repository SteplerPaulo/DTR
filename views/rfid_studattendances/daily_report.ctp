<?php
App::import('Vendor','daily_report');

$array_chunk =array_chunk($students, 52);
$pr= new DailyReport();

if(!empty($data) && !empty($hdr)){
	foreach($array_chunk as $key => $student){
		$pr->divider();
		$pr->hdr(0,$hdr,$SystemDefault);
		$pr->table(0,$data,$student);
		$pr->hdr(4.25,$hdr,$SystemDefault);
		$pr->table(4.25,$data,$student);
		if(count($array_chunk) != $key+1){$pr->createSheet();}
	}
}else{
	$pr->nodata();
}

$pr->output();


?>