<?php
require('formsheet.php');
class StudentAttendanceReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $curr_page = 1;
	protected static $page_count;
	
	function StudentAttendanceReport(){
		$this->showLines = !true;
		$this->FPDF(StudentAttendanceReport::$_orient, StudentAttendanceReport::$_unit,array(StudentAttendanceReport::$_width,StudentAttendanceReport::$_height));
		$this->createSheet();
	}
	
	function hdr($x=0,$hdr,$data,$SystemDefault){
		$metrics = array(
			'base_x'=> 0.125+$x,
			'base_y'=> 0.125,
			'width'=> 4,
			'height'=> 0.6,
			'cols'=> 20,
			'rows'=> 3,	
		);	
		$this->section($metrics);
		$y = 4;
		$this->GRID['font_size']=8;
		$this->DrawImage(8.525,0,0.6,0.6,'../webroot/img/'.$SystemDefault['school_logo']);
		$this->centerText(0,$y++,$SystemDefault['school_name'],$metrics['cols'],'b');
		$this->centerText(0,$y++,'DAILY TIME RECORD',$metrics['cols'],'b');
		
		$this->centerText(0,$y++,date("F Y", strtotime($hdr['date'])),$metrics['cols'],'');
		$y++;
		$this->leftText(0.3,$y++,'Name: '.$hdr['sname'],'','');
		$this->leftText(0.3,$y++,'Student No: '.$hdr['sno'],'','');
		
	}
	
	function table($x=0,$hdr,$data){
		//pr($data);exit;
		$metrics = array(
			'base_x'=> 0.125+$x,
			'base_y'=> 2,
			'width'=> 4,
			'height'=> 8.6,
			'cols'=> 19,
			'rows'=> 43,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=8;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],$fill=null);
		$this->DrawMulitpleLines(2,43,1,'h');
		$this->DrawLine(5,'v');
		$this->DrawLine(10,'v');
		$this->DrawLine(13,'v');
		$this->DrawLine(16,'v');
		
		$this->centerText(0,1.3,'DATE',5,'');
		$this->centerText(5,1.3,'DAY',5,'');
		$this->centerText(10,1.3,'IN',3,'');
		$this->centerText(13,1.3,'OUT',3,'');
		$this->centerText(16,1.3,'REMARKS',3,'');
		$y=2.8;
		
		foreach($data as $d){
			$this->centerText(0,$y,date("M d", strtotime($d['date'])),5,'');	
			$this->centerText(5,$y,date("D", strtotime($d['date'])),5,'');
			if(isset($d['data'])){
				$this->centerText(10,$y,$d['data']['rfid_studattendance']['time_in'],3,'');
				$this->centerText(13,$y,$d['data']['rfid_studattendance']['time_out'],3,'');
				$this->centerText(16,$y,$d['data']['rfid_studattendance']['remarks'],3,'');
				
			}
			$y++;
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
	