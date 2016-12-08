<?php
App::import('Vendor','monthly_report');

$chunk_data = array_chunk($data,28,true);
$i = 1;
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