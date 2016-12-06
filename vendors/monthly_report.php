<?php
require('formsheet.php');
class MonthlyReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
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
	
	function body($data){
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
		$this->centerText($x+=$x_ntrvl,$y,'1',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'2',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'3',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'4',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'5',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'6',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'7',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'8',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'9',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'10',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'11',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'12',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'13',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'14',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'15',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'16',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'17',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'18',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'19',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'20',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'21',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'22',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'23',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'24',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'25',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'26',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'27',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'28',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'29',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'30',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'31',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'IU',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'DY',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'HC',$x_ntrvl,'');
		$this->centerText($x+=$x_ntrvl,$y,'NI',$x_ntrvl,'');
		$y=2.8;
		
		foreach($data as $key => $stud){
			$this->leftText(0.1,$y,++$key.'.','','');
			$this->leftText(1.1,$y++,$stud['StudentName'],'','');
			if(isset($stud['Attendance'])){
				foreach($stud['Attendance'] as $attnd){
					$date = strtotime($attnd['Date']);
					$day   = date('d',$date);
					$this->centerText(12+$day,$y,$attnd['Remarks'],$x_ntrvl,'');
				}
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
	