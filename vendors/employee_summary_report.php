<?php
require('formsheet.php');
class EmpSummaryReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'L';
	protected static $curr_page = 1;
	protected static $page_count;
	
	function EmpSummaryReport(){
		$this->showLines = !true;
		$this->FPDF(EmpSummaryReport::$_orient, EmpSummaryReport::$_unit,array(EmpSummaryReport::$_width,EmpSummaryReport::$_height));
		$this->createSheet();
	}
	
	function hdr($SystemDefault){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 12.5,
			'height'=> 0.5,
			'cols'=> 20,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$this->DrawImage(6,-1.2,0.6,0.6,'../webroot/img/'.$SystemDefault['school_logo']);
		$y = 0;
		$this->GRID['font_size']=10;
		$this->centerText(0,$y++,$SystemDefault['school_name'],$metrics['cols'],'b');
		$this->GRID['font_size']=8;
		$this->centerText(0,$y++,$SystemDefault['school_address'],$metrics['cols'],'');
		$this->centerText(0,$y++,'Summary of Attendance: <period from - period to>',$metrics['cols'],'');
		
	}
	
	function body($data,$dates){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.7,
			'width'=> 12.5,
			'height'=> 7.2,
			'cols'=> 32,
			'rows'=> 36,	
		);	
		$this->section($metrics);
		
		$this->drawBox(0,0,$metrics['cols'],$metrics['rows']);
		$this->drawLine(1,'h',array(24,4));
		$this->drawLine(1,'h',array(9,15));
		$this->drawLine(2,'h');
		$this->DrawMulitpleLines(2,35,1,'h');
		
		
		$this->drawLine(1,'v');
		$this->drawLine(7,'v');
		$x= 9;
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		$this->drawLine($x++,'v');
		
		$this->drawLine(24,'v');
		$this->drawLine(26,'v',array(1,$metrics['rows']-1));
		$this->drawLine(28,'v');
		
		
		$this->GRID['font_size']=8;
		$y=1.2;
		$this->centerText(0,$y,'Cnt',1,'');
		$this->centerText(1,$y,'Name',6,'');
		$this->centerText(7,$y,'D.Code',2,'');
		$this->centerText(28,$y,'Remarks',4,'');
		$y=0.7;
		$this->centerText(24,$y,'Total',4,'');
		
		$y=1.7;
		$this->centerText(24,$y,'Late',2,'');
		$this->centerText(26,$y,'Absent',2,'');
		
		$x= 9;
		foreach($dates as $date){
			//pr($date);
			$this->centerText($x,0.7,date("M",strtotime($date)),1,'');
			$this->centerText($x,1.7,date("d",strtotime($date)),1,'');
			$x++;
		}
	}
	
	function ftr(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 7.9,
			'width'=> 12.5,
			'height'=> 0.5,
			'cols'=> 30,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$y=1;
		$this->leftText(0,$y,'Submitted By:','','');
		
		$this->drawLine($y+1,'h',array(2,5));
		$this->centerText(2,$y+2,'HR Officer/Date',5,'');
		
		
		$this->rightText(14,$y,'Submitted By:','','');
		$this->drawLine($y+1,'h',array(14,5));
		$this->centerText(14,$y+2,'Finance Staff/Date',5,'');
		
		$this->rightText(25,$y,'Checked By:','','');
		$this->drawLine($y+1,'h',array(25,5));
	}
	
	
	function nodata(){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'width'=> 13,
			'height'=> 8.5,
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
	