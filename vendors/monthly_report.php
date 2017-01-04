<?php
require('formsheet.php');
class MonthlyReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	protected static $curr_page = 1;
	protected static $page_count;
	
	function MonthlyReport(){
		$this->showLines = !true;
		$this->FPDF(MonthlyReport::$_orient, MonthlyReport::$_unit,array(MonthlyReport::$_width,MonthlyReport::$_height));
		$this->createSheet();
	}
	
	function hdr($SystemDefault,$hdr){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 0.25,
			'width'=> 12,
			'height'=> 1,
			'cols'=> 48,
			'rows'=> 5,	
		);	
		$this->section($metrics);
		$y = 1;
		$this->GRID['font_size']=12;
		$this->DrawImage(12,0,0.8,0.8,'../webroot/img/'.$SystemDefault['school_logo']);
		$this->centerText(0,$y++,$SystemDefault['school_name'],$metrics['cols'],'b');
		$this->GRID['font_size']=11;
		$this->centerText(0,$y++,'ATTENDANCE SLIP',$metrics['cols'],'b');
		$this->centerText(0,$y++,'School Year 2016 - 2017',$metrics['cols'],'b');
		
		$y++;
		$this->GRID['font_size']=9;
		$this->leftText(0,$y,'Section: '.$hdr['SectionName'],'','b');
		$this->leftText(32,$y,'Date: '.date("F Y",strtotime($hdr['Date'])),'','b');
	}
	
	function body($data,$hdr){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 1.35,
			'width'=> 12,
			'height'=> 6,
			'cols'=> 48,
			'rows'=> 30,	
		);
		$this->section($metrics);
	
		$this->GRID['font_size']=8;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],'');
		$this->drawLine(1,'v');
		$this->DrawMulitpleLines(12,47,1,'v');
		$this->drawLine(2,'h');
		$this->DrawMulitpleLines(3,29,1,'h');
		$y = 1.3;
		$this->centerText(0,$y,'NO.',1,'');
		$this->centerText(1,$y,'NAME OF PUPILS / STUDENTS',11,'');
		$x=12;

		
		$x_ntrvl = 1;
		
		$this->centerText($x,$y,'MA',$x_ntrvl,'');
		
	
		$this->DrawMulitpleLines(12,47,1,'v');
		
		$y = 1.3;
		$x=43;
		$this->centerText($x+=$x_ntrvl,$y,'IU',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'DY',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'HC',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'NI',$x_ntrvl,'');
		
		$y=2.8;
		foreach($data as $key => $stud){
			$this->leftText(0.1,$y,++$key.'.','','');
			$this->leftText(1.1,$y++,$stud['StudentName'],'','');
			foreach($stud['Attendance'] as $attnd){
				$date = strtotime($attnd['Date']);
				$day   = date('d',$date);
				
				if($attnd['Remarks'] == "A"){
					$this->SetTextColor(255,0,0);	
				}
				/*
				else if($attnd['Remarks'] == "P"){
					$this->SetTextColor(0,153,0);
				}
				*/
				$this->centerText(12+$day,$y,$attnd['Remarks'],$x_ntrvl,'b');
				$this->SetTextColor(0,0,0);	
			}

		}
		$x=12;
		$y = 1.7;
		for($day =1;$day<=31;$day++){
			$date = $hdr['Date'].'-'.$day;
			$this->centerText($x+=$x_ntrvl,0.7,date('D', strtotime($date)),$x_ntrvl,'');
			$this->centerText($x,$y,$day,$x_ntrvl,'');
			
			if(date('N', strtotime($date)) >= 6){
				$this->SetFillColor(0,0,0);
				$this->DrawBox($x,2,1,28,'DF');
			}
			
		}
		
	}
	
	function ftr(){
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.5,
			'base_y'=> 7.4,
			'width'=> 12,
			'height'=> 1,
			'cols'=> 48,
			'rows'=> 7,	
		);
		$this->section($metrics);
		$this->GRID['font_size']=8;
		$y =1;
		$this->leftText(0.2,$y,'CODE:','','b');
		$this->leftText(4,$y++,'P -  Present','','b');
		$this->leftText(4,$y++,'CC - Cutting Class','','b');
		$this->leftText(4,$y++,'ED - Early Dismissal','','b');
		$y =1;
		$this->leftText(12,$y++,'A - Absent','','b');
		$this->leftText(12,$y++,'L - Late','','b');
		$this->leftText(12,$y++,'AE - Absent(Excused)','','b');
		$y =1;
		$this->leftText(20,$y++,'C - Clinic','','b');
		
		$y =1;
		$this->leftText(30,$y,'VIOLATION CODE:','','b');
		$this->leftText(37,$y++,'IU -  Incomplete Uniform','','b');
		$this->leftText(37,$y,'DY - No Diary','','b');
		$this->leftText(43,$y++,'HC - Haircut','','b');
		$this->leftText(37,$y++,'NI -  No ID','','b');
		
		$y =5;
		$this->leftText(8,$y++,'Submitted by:','','b');
	
		$this->drawLine($y++,'h',array(14,10));
		$this->centerText(14,$y++,'Homeroom Adviser',10,'b');
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
	