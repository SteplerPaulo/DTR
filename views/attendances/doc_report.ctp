<?php
App::import('Vendor','report');


//$array_chunk =array_chunk($products, 45);


$pr= new DocRerpot();
$pr->divider();

$pr->hdr(0,$hdr,$data);
$pr->table(0,$hdr,$data);

$pr->hdr(4.25,$hdr,$data);
$pr->table(4.25,$hdr,$data);

$pr->output();


//foreach($array_chunk as $key => $products){
	//$pr->hdr();
	//$pr->details($products);	
	//if(count($array_chunk) != $key+1){$pr->createSheet();}
//}

?>