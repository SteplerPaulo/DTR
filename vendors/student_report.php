<?php
require('formsheet.php');
class StudentAttendanceReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function StudentAttendanceReport(){
		//$this->user = $user;
		//$this->data = $data;
		//StudentAttendanceReport::$page_count = ceil((count($data)+count($vendors)+1)/21);//Total Page Count

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
		
		$this->centerText(0,$y++,date("M d, Y", strtotime($hdr['fromDate'])).' - '.date("M d, Y", strtotime($hdr['toDate'])),$metrics['cols'],'');
		$y++;
		$this->leftText(0.3,$y++,'Name: '.$hdr['sname'],'','');
		$this->leftText(0.3,$y++,'Student No: '.$hdr['sno'],'','');
		
	}
	
	function table($x=0,$hdr,$data){
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
		$this->DrawLine(1,'h',array(7,12));
		$this->DrawLine(3,'v');
		$this->DrawLine(7,'v');
		$this->DrawLine(10,'v',array(1,42));
		$this->DrawLine(13,'v');
		$this->DrawLine(16,'v',array(1,42));
		
		$this->centerText(0,1.3,'DATE',3,'');
		$this->centerText(3,1.3,'DAY',4,'');
		$this->centerText(7,0.7,'AM',6,'');
		$this->centerText(7,1.7,'IN',3,'');
		$this->centerText(10,1.7,'OUT',3,'');
		$this->centerText(13,0.7,'PM',6,'');
		$this->centerText(13,1.7,'IN',3,'');
		$this->centerText(16,1.7,'OUT',3,'');
		$y=1.8;
		$prev_date = explode('-', $data[0]['rfid_studattendance']['date'])[2] - 1;

		//pr($data);exit;
		foreach($data as $d){
			$curr_date =  explode('-', $d['rfid_studattendance']['date'])[2];
			if($prev_date != $curr_date){
				$y++;
				$this->centerText(0,$y,date("M d", strtotime($d['rfid_studattendance']['date'])),3,'');	
				$date = new DateTime($d['rfid_studattendance']['date']);
				$this->centerText(3,$y,$date->format('D'),4,'');
				
			}
			$prev_date = $curr_date;
			
			if($d['rfid_studattendance']['time_in'] < '12:00:00' && $d['rfid_studattendance']['time_in'] != Null){
				$tix = 7;
				$tix2 = 13; 
			}else if($d['rfid_studattendance']['time_in'] >= '12:00:00' && $d['rfid_studattendance']['time_in'] != Null) {
				$tix = 13; 
				$tix2 = 7; 
			}else{
				$tix = 7; 
				$tix2 = 13; 
				//pr('wew');exit;
			}
			
			if ($d['rfid_studattendance']['time_out'] < '12:00:00' && $d['rfid_studattendance']['time_out'] != Null){
				$tox = 10; 
				$tox2 = 16; 
			}else if($d['rfid_studattendance']['time_out'] >= '12:00:00' && $d['rfid_studattendance']['time_out'] != Null){
				$tox = 16; 
				$tox2 = 10; 
			}else{
				$tox = 10; 
				$tox2 = 16; 
			} 
			
			$this->centerText($tix,$y,$d['rfid_studattendance']['time_in'],3,'');
			//$this->centerText($tix2,$y,'---',3,'');
			$this->centerText($tox,$y,$d['rfid_studattendance']['time_out'],3,'');
			//$this->centerText($tox2,$y,'---',3,'');
			
			if($tox == 16) $y++;
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
	