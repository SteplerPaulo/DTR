<?php
require('formsheet.php');
class ClassList extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	
	function ClassList(){
		$this->showLines = !true;
		$this->FPDF(ClassList::$_orient, ClassList::$_unit,array(ClassList::$_width,ClassList::$_height));
		$this->createSheet();
	}
	
	function hdr(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25,
			'width'=> 8,
			'height'=> 0.6,
			'cols'=> 40,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=12;
		$this->leftText(0,$y++,'HOLY TRINITY ACADEMY',$metrics['cols'],'b');
		$this->leftText(0,$y++,'Student Sectioning',$metrics['cols'],'b');
		$y+=0.5;
		$this->GRID['font_size']=10;
		$this->leftText(0,$y++,'All Students',$metrics['cols'],'b');
		$this->leftText(0,$y++,'As of '.'06/19/2018'.' (for the School Period of: '.'2018-2019)',$metrics['cols'],'b');
		
		$y=3.5;
		$this->rightText(0,$y,'',$metrics['cols'],'');
		$this->rightText(0,$y++,'Date Printed: '.'06/19/2018 01:30:21',$metrics['cols'],'');
		$this->rightText(0,$y++,'Page '.'19'.' of '.'64',$metrics['cols'],'');
	}
	
	function table(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.5,
			'width'=> 8,
			'height'=> 8.6,
			'cols'=> 40,
			'rows'=> 44,	
		);	
		$this->section($metrics);
		
		$this->GRID['font_size']=10;
		$this->centerText(0,-0.5,'G05 - G05 - PATRIOTISM',$metrics['cols'],'b');
		$y = 1.2;
		
		$this->drawBox(0,0,$metrics['cols'],$metrics['rows']);
		
	
		$this->DrawLine(2,'v');
		$this->DrawLine(7,'v');
		$this->DrawLine(20,'v');
		$this->DrawLine(22,'v');
		$this->DrawLine(27,'v');
		$this->DrawLine(2,'h');
		
		$this->DrawMulitpleLines(3,43,1,'h');
		
		$this->GRID['font_size']=9;
		$this->centerText(0,$y,'CNT',2,'b');
		$this->centerText(2,$y,'SNO.',5,'b');
		$this->centerText(7,$y,'BOY',13,'b');
		
		$this->centerText(20,$y,'CNT',2,'b');
		$this->centerText(22,$y,'SNO.',5,'b');
		$this->centerText(27,$y,'GIRL',13,'b');
		
		
		
		$y=45;
		$this->leftText(1,$y++,'Boys = '.'20',$metrics['cols'],'b');
		$this->leftText(1,$y++,'Girls = '.'22',$metrics['cols'],'b');
		$this->leftText(1,$y++,'TOTAL = '.'42',$metrics['cols'],'b');
	}
	
	
	
}
?>
	