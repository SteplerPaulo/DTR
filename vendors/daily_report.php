<?php
require('formsheet.php');
class DailyReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function DailyReport(){
		//$this->user = $user;
		//$this->data = $data;
		//DailyReport::$page_count = ceil((count($data)+count($vendors)+1)/21);//Total Page Count

		$this->showLines = !true;
		$this->FPDF(DailyReport::$_orient, DailyReport::$_unit,array(DailyReport::$_width,DailyReport::$_height));
		$this->createSheet();
	}
	
	function hdr($x=0,$hdr,$SystemDefault){
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
		$this->centerText(0,$y++,'School Year 2015 - 2016',$metrics['cols'],'b');
		$this->centerText(0,$y++,'Section - '.$hdr['section_name'],$metrics['cols'],'b');
		$this->centerText(0,$y++,'DAILY ATTENDANCE ',$metrics['cols'],'b');
		$y++;
		$this->leftText(0.3,$y,'Date: '.$hdr['date'],'','');
		$this->leftText(6,$y++,date('l', strtotime($hdr['date'])),'','');
	}
	
	function table($x=0,$data,$students){
		$metrics = array(
			'base_x'=> 0.125+$x,
			'base_y'=> 2,
			'width'=> 4,
			'height'=> 8.6,
			'cols'=> 30,
			'rows'=> 43,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=8;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],$fill=null);
		$this->DrawMulitpleLines(2,42,1,'h');
		$this->DrawLine(1,'h',array(15,12));
		
		$this->DrawLine(15,'v');
		$this->DrawLine(18,'v',array(1,42));
		$this->DrawLine(21,'v');
		$this->DrawLine(24,'v',array(1,42));
		$this->DrawLine(27,'v');
		
		$this->centerText(0,1.3,'',3,'');
		$this->centerText(0,1.3,'NAME',15,'');
		$this->centerText(15,0.7,'AM',6,'');
		$this->centerText(15,1.7,'In',3,'');
		$this->centerText(18,1.7,'Out',3,'');
		$this->centerText(21,0.7,'PM',6,'');
		$this->centerText(21,1.7,'In',3,'');
		$this->centerText(24,1.7,'Out',3,'');
		$this->GRID['font_size']=6.5;
		$this->centerText(27,1.3,'Remarks',3);
		$this->GRID['font_size']=8;
		$y=2.8;
		$prev_student = '';
		
		//pr($data);exit;
		/*
		foreach($data as $d){
			//pr($d);
			$curr_student =  $d['rfid_students']['student_number'];
			if($prev_student != $curr_student){
				$this->leftText(0.2,$y,$d[0]['full_name'],15,'');
			}
			if($prev_student == $curr_student){
				$y--;
			}
				
			if($d['rfid_studattendance']['time_in'] < '12:00:00' && $d['rfid_studattendance']['time_in'] != Null) $tix = 15;
			else if($d['rfid_studattendance']['time_in'] >= '12:00:00' && $d['rfid_studattendance']['time_in'] != Null) $tix = 21; 
			else $tix = null; 
			
			if ($d['rfid_studattendance']['time_out'] < '12:00:00' && $d['rfid_studattendance']['time_out'] != Null) $tox = 18; 	
			else if($d['rfid_studattendance']['time_out'] >= '12:00:00' && $d['rfid_studattendance']['time_out'] != Null) $tox = 24; 
			else $tox = null; 
			
			$this->centerText($tix,$y,date('h:i', strtotime($d['rfid_studattendance']['time_in'])),3,'');
			$this->centerText($tox,$y,date('h:i', strtotime($d['rfid_studattendance']['time_out'])),3,'');
			$y++;
			
			$prev_student = $curr_student;
		}*/
		//exit;
		$i = 1;
		//pr($students);exit;
		foreach($students as $stud){
			$this->leftText(0.2,$y,$i++.'. '.$stud[0]['full_name'],15,'');
		
			foreach($data as $d){
				if($stud['rfid_students']['student_number'] == $d['rfid_students']['student_number']){
					$curr_student =  $d['rfid_students']['student_number'];
					
					if($prev_student == $curr_student){
						$y--;
					}
						
					if($d['rfid_studattendance']['time_in'] < '12:00:00' && $d['rfid_studattendance']['time_in'] != Null) $tix = 15;
					else if($d['rfid_studattendance']['time_in'] >= '12:00:00' && $d['rfid_studattendance']['time_in'] != Null) $tix = 21; 
					else $tix = null; 
					
					if ($d['rfid_studattendance']['time_out'] < '12:00:00' && $d['rfid_studattendance']['time_out'] != Null) $tox = 18; 	
					else if($d['rfid_studattendance']['time_out'] >= '12:00:00' && $d['rfid_studattendance']['time_out'] != Null) $tox = 24; 
					else $tox = null; 
					
					if(!empty($d['rfid_studattendance']['time_in'])){
						$this->centerText($tix,$y,date('h:i', strtotime($d['rfid_studattendance']['time_in'])),3,'');
					}
					if(!empty($d['rfid_studattendance']['time_out'])){
						$this->centerText($tox,$y,date('h:i', strtotime($d['rfid_studattendance']['time_out'])),3,'');
					}
					$prev_student = $curr_student;
				}
				
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
	