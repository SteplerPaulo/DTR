<?php
require('formsheet.php');
class DailyReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	protected static $curr_page = 1;
	protected static $page_count;
	
	function DailyReport(){
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
		$this->centerText(0,$y++,'School Year 2016 - 2017',$metrics['cols'],'b');
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
		$this->DrawLine(18,'v');
		$this->DrawLine(22,'v');
		$this->DrawLine(26,'v');
		
		$this->centerText(0,1.3,'',3,'');
		$this->centerText(0,1.3,'NAME',18,'');
		$this->centerText(18,1.3,'IN',4,'');
		$this->centerText(22,1.3,'OUT',4,'');
		$this->GRID['font_size']=6.5;
		$this->centerText(26,1.3,'REMARKS',4);
		
		$y=2.8;
		$prev_student = '';
		
		//pr($data);exit;
		//pr($students);exit;
		$i = 1;
		
		
		foreach($students as $stud){
			$isPresent = false;
			$this->GRID['font_size']=6.5;
			$this->leftText(0.2,$y,$i++.'. '.$stud[0]['full_name'],15,'');
			foreach($data as $d){
				if($stud['rfid_students']['student_number'] == $d['rfid_students']['student_number']){
					$curr_student =  $d['rfid_students']['student_number'];
					
					if($prev_student == $curr_student && $tox == 24){
						$y--;
					}
					
					//View Time In Data
					if(!empty($d['rfid_studattendance']['time_in'])){
						$this->centerText(18,$y,date('h:i', strtotime($d['rfid_studattendance']['time_in'])),4,'');
					}else{
						$this->centerText(18,$y,'---',4,'');
					}
					//View Time Out Data
					if(!empty($d['rfid_studattendance']['time_out'])){
						$this->centerText(22,$y,date('h:i', strtotime($d['rfid_studattendance']['time_out'])),4,'');
					}else{
						$this->centerText(22,$y,'---',4,'');
					}
					//Remarks
					$this->centerText(26,$y,$d['rfid_studattendance']['remarks'],4);
					$prev_student = $curr_student;
					$isPresent = true; //Row Status
				}
			}
		
			//Check If Row Has Data
			if(!$isPresent) {
				$this->centerText(18,$y,'---',4);
				$this->centerText(22,$y,'---',4);
				$this->centerText(26,$y,'A',4);
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
	