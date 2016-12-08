 <?php
App::import('Vendor','deped_report');

$data = array_chunk($students,28,true);
$i = 1;
//pr($data);
//exit;


$pr= new DepEdReport();
foreach($data as $students){
	$pr->hdr($SystemDefault,$hdr);
	$pr->body($students);
	$pr->ftr();
	if(count($data) != ($i++)){
		$pr->createSheet();
	}
}
$pr->output();


?>