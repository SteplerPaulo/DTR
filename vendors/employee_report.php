<?php
require('formsheet.php');
class EmplAttendanceReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11;
	protected static $_unit = 'in';
	protected static $_orient = 'P';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function EmplAttendanceReport(){
		//$this->user = $user;
		//$this->data = $data;
		//EmplAttendanceReport::$page_count = ceil((count($data)+count($vendors)+1)/21);//Total Page Count

		$this->showLines = !true;
		$this->FPDF(EmplAttendanceReport::$_orient, EmplAttendanceReport::$_unit,array(EmplAttendanceReport::$_width,EmplAttendanceReport::$_height));
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
		$this->centerText(0,$y++,$SystemDefault['school_name'],$metrics['cols'],'b');
		$this->centerText(0,$y++,'DAILY TIME RECORD',$metrics['cols'],'b');
		$this->DrawImage(8.525,0,0.6,0.6,'../webroot/img/'.$SystemDefault['school_logo']);
		$y++;
		$this->leftText(0.3,$y++,'Name: '.$hdr['empname'],'','');
		$this->leftText(0.3,$y,'Employee No: '.$hdr['empno'],'','');
		$this->leftText(12,$y++,'Department:','','');
		$this->leftText(0.3,$y,'From: '.date("M d, Y", strtotime($hdr['fromDate'])),'','');
		$this->leftText(12,$y++,'To: '.date("M d, Y", strtotime($hdr['toDate'])),'','');
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
		$y=2.8;
		$prev_date = $data[0]['attendances']['date'];
		$timein_ctr = $timeout_ctr = 0;
		foreach($data as $d){
			
			//FILTER TIMEIN AM OR PM
			if ($d['attendances']['timein'] < '12:00:00') {
				$this->centerText(7,$y,$d['attendances']['timein'],3,'');
				$timein_ctr++;
			}else if($d['attendances']['timein'] >= '12:00:00'){
				$this->centerText(13,$y,$d['attendances']['timein'],3,'');
				$timein_ctr++;
			} 
			//FILTER TIMEOUT AM OR PM
			if ($d['attendances']['timeout'] < '12:00:00') {
				$this->centerText(10,$y,$d['attendances']['timeout'],3,'');
				$timeout_ctr++;
			}else if($d['attendances']['timeout'] >= '12:00:00') {
				$this->centerText(16,$y,$d['attendances']['timeout'],3,'');
				$timeout_ctr++;
			}
			
			$curr_date = explode('-', $d['attendances']['date'])[2];
			if($prev_date != $curr_date){
				$this->centerText(0,$y,date("M d", strtotime($d['attendances']['date'])),3,'');	
				$date = new DateTime($d['attendances']['date']);
				$this->centerText(3,$y,$date->format('D'),4,'');
				$y++;
				$timein_ctr = $timeout_ctr = 0;
			}else if($timein_ctr > 0 ){
				$y++;
			}
			$prev_date = $curr_date;
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
	