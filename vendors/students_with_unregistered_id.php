<?php
require('formsheet.php');
class StudentList extends Formsheet{
	protected static $_width = 4.25;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	
	function StudentList(){
		$this->showLines = !true;
		$this->FPDF(StudentList::$_orient, StudentList::$_unit,array(StudentList::$_width,StudentList::$_height));
		$this->createSheet();
	}
	
	function hdr($x=0,$SystemDefault){
		$metrics = array(
			'base_x'=> 0.125+$x,
			'base_y'=> 0.125,
			'width'=> 4,
			'height'=> 0.5,
			'cols'=> 20,
			'rows'=> 3,	
		);	
		$this->section($metrics);

		$this->GRID['font_size']=8;
		$this->DrawImage(0.2,0,0.7,0.7,'../webroot/img/'.$SystemDefault['school_logo']);
		$this->centerText(0,1,$SystemDefault['school_name'],$metrics['cols'],'bi');
		$this->centerText(0,3.5,'S.Y. 2018 - 2019',$metrics['cols'],'');
		$this->GRID['font_size']=10;
		$this->centerText(0,2.5,'STUDENTS WITH UNREGISTERED ID',$metrics['cols'],'b');
	
	}
	
	function table($x=0,$data){
		$metrics = array(
			'base_x'=> 0.125+$x,
			'base_y'=> 1,
			'width'=> 4,
			'height'=> 9.6,
			'cols'=> 9,
			'rows'=> 48,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=8;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],$fill=null);
		$this->DrawMulitpleLines(2,47,1,'h');
		$this->DrawLine(1,'v');
		$this->DrawLine(7,'v');
		$this->centerText(0,1.3,'No.',1,'');
		$this->centerText(1,1.3,'NAME',6,'');
		$this->centerText(7,1.3,'Student No.',2,'');
		
		$y=2.8;
		$i=1;
		foreach($data as $d){
			$this->centerText(0,$y,$i,1,'');
			$this->leftText(1.2,$y,$d['Student201']['full_name'],'','');
			$this->centerText(7,$y,$d['Student201']['student_number'],2,'');			
			$y++;
			$i++;
		}
	}
	
	function divider(){
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
		$this->GRID['font_size']=11;
		$this->drawLine(2,'v');
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
	