<?php
App::import('Vendor','students_with_unregistered_id');

$pr= new StudentList();

if(!empty($data)){
	
	$chunk_data = array_chunk($data,46,true);
	$i = 1;
	foreach($chunk_data as $dt){
		$pr->hdr(0,$SystemDefault);
		$pr->table(0,$dt);
		if(count($chunk_data) != ($i++)){
			$pr->createSheet();
		}
	}
	$pr->output();
}else{
	$pr->nodata();
	$pr->output();
}

















$pr= new MonthlyReport();
foreach($chunk_data as $dt){
	$pr->hdr($SystemDefault,$hdr);
	$pr->body($dt,$hdr);
	$pr->ftr();
	if(count($chunk_data) != ($i++)){
		$pr->createSheet();
	}
}
$pr->output();






?>