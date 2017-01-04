<?php
require('formsheet.php');
class DepEdReport extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 13;
	protected static $_unit = 'in';
	protected static $_orient = 'L';	
	//protected static $_available_line = 37;	
	//protected static $_curr_page = 1;
	protected static $curr_page = 1;
	protected static $page_count;
	
	function DepEdReport(){
		$this->showLines = !true;
		$this->FPDF(DepEdReport::$_orient, DepEdReport::$_unit,array(DepEdReport::$_width,DepEdReport::$_height));
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
		$this->leftText(32,$y,'Date: '.$hdr['Date'],'','b');
	}
	
	function body($data,$hdr){
		//pr($hdr);exit;
		$this->showLines = !true;
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 1.35,
			'width'=> 12.5,
			'height'=> 6,
			'cols'=> 63,
			'rows'=> 30,	
		);
		$this->section($metrics);
	
		$this->GRID['font_size']=6.5;
		$this->DrawBox(0,0,$metrics['cols'],$metrics['rows'],'');
		$this->drawLine(1,'v');
		$this->drawLine(9,'v');
		$this->drawLine(11,'v');
		$this->drawLine(12,'v');
		$this->drawLine(14,'v');
		$this->drawLine(20,'v',array(1,$metrics['rows']-1));
		$this->drawLine(24,'v',array(1,$metrics['rows']-1));
		$this->drawLine(61.5,'v',array(1,$metrics['rows']-1));
		$this->DrawMulitpleLines(29,60,1,'v');
		$this->drawLine(1,'h',array(14,15));
		$this->drawLine(1,'h',array(60,3));
		$this->drawLine(2,'h');
		$this->DrawMulitpleLines(3,29,1,'h');
		
		$y = 1.3;
		$this->centerText(0,$y,'No.',1,'');
		$this->centerText(1,$y,'Name',9,'');
		$this->centerText(9,$y,'Birthdate',2,'');
		$this->centerText(11,$y,'Age',1,'');
		$this->centerText(12,$y,'Religion',2,'');
		$this->centerText(14,$y-0.5,'Address',15,'');
		$this->centerText(14,$y+0.4,'House/Street/Sitio/Purok',6,'');
		$this->centerText(20,$y+0.4,'Barangay',4,'');
		$this->centerText(24,$y+0.4,'Municipality/City',5,'');
		$this->centerText(60,$y-0.5,'Total',3,'');
		$this->centerText(60,$y+0.4,'Tardy',1.5,'');
		$this->centerText(61.5,$y+0.4,'Absent',1.5,'');
		
		
		
		$this->centerText(9,$y+1.5,'10/20/90',2,'');
		$this->centerText(11,$y+1.5,'8',1,'');
		$this->centerText(12,$y+1.5,'Catholic',2,'');
		$this->centerText(14,$y+1.5,'#450 Pres. Laurel Highway',6,'');
		$this->centerText(20,$y+1.5,'Poblacion',4,'');
		$this->centerText(24,$y+1.5,'Malvar,Batangas',5,'');
		
		$x=28;
		$x_ntrvl = 1;
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
		
		
		
		
		$y=2.8;
		foreach($data as $key => $stud){
			$this->leftText(0.1,$y,++$key.'.','','');
			$this->leftText(1.1,$y++,$stud['StudentName'],'','');
			if(isset($stud['Attendance'])){
				foreach($stud['Attendance'] as $attnd){
					$date = strtotime($attnd['Date']);
					$day   = date('d',$date);
					$this->centerText(28+$day,$y,$attnd['Remarks'],$x_ntrvl,'');
				}
			}else{
				//$this->centerText(12,$y,'---',$x_ntrvl,'');
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
	