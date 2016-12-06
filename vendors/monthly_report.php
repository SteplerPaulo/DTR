<?php
require('formsheet.php');
class MonthlyReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function MonthlyReport(){
		//$this->user = $user;
		//$this->data = $data;
		//MonthlyReport::$page_count = ceil((count($data)+count($vendors)+1)/21);//Total Page Count

		$this->showLines = !true;
		$this->FPDF(MonthlyReport::$_orient, MonthlyReport::$_unit,array(MonthlyReport::$_width,MonthlyReport::$_height));
		$this->createSheet();
	}
	
	function hdr($SystemDefault){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 10.5,
			'height'=> 0.6,
			'cols'=> 20,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 4;
		$this->GRID['font_size']=8;
		$this->DrawImage(9.5,0,0.6,0.6,'../webroot/img/'.$SystemDefault['school_logo']);
	$this->centerText(0,$y++,$SystemDefault['school_name'],$metrics['cols'],'b');
		$this->centerText(0,$y++,'School Year ',$metrics['cols'],'b');
		$this->centerText(0,$y++,'Section - ',$metrics['cols'],'b');
		$this->centerText(0,$y++,'ATTENDANCE FOR THE MONTH OF March 2016 ',$metrics['cols'],'b');
	}
	
	function table($students){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 2,
			'width'=> 10.5,
			'height'=> 6.25,
			'cols'=> 44,
			'rows'=> 33,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=8;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],$fill=null);
		$this->DrawMulitpleLines(2,32,1,'h');
		
		$this->DrawLine(1,'v');
		$ctr = 1;
		for($x=10;$x<44;$x++){
			$this->DrawLine($x,'v');
			if($ctr < 32){
				$this->centerText($x,1.3,$ctr++,1,'b');
			}
		}
		$y = 2.8;
		$ctr = 1;
		foreach($students as $stud){
			$this->leftText(0.2,$y,$ctr++,15,'');
			$this->leftText(1.2,$y,$stud[0]['full_name'],15,'');
			$y++;
		}
		
		$this->centerText(0,1.3,'NAME',10,'b');
		$this->centerText(41,1.3,'P',1,'b');
		$this->centerText(42,1.3,'L',1,'b');
		$this->centerText(43,1.3,'A',1,'b');
		
	}
	

	
	function nodata(){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 8.5,
			'height'=> 11,
			'cols'=> 4,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=16;
		$this->centerText(0,1,'NO DATA AVAILABLE',$metrics['cols'],'b');
	}
	
}
?>
	