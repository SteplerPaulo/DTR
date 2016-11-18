 <?php
App::import('Vendor','deped_report');

$pr= new DepEdReport();
$pr->hdr($SystemDefault);
$pr->body();
$pr->ftr();
$pr->output();


?>