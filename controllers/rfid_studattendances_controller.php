<?php
class RfidStudattendancesController extends AppController {

	var $name = 'RfidStudattendances';
	var $helpers = array('Access');
	var $uses = array('RfidStudattendance','RfidStudent','Remark','Schedule','User','Section','SchoolYear','Level','MessageOut');
	
	function beforeFilter(){ 
		parent::beforeFilter();
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','students','report','datetime','doc_report','daily_report','monthly_report'));	
    } 

	function admin_index() {
		if(!$this->Access->check('RfidStudattendance','*') && !$this->Access->check('RfidStudattendance','create','read','update','delete') && !$this->Access->check('RfidStudattendance','read')){
			DIE("You don't have permission to access that page.Pls. contact school's system administrator for further details. ");
		}
	}
	
	function record(){
			
	}
	
	function admin_update($fromDate=null,$toDate=null){
		//pr($this->data);exit;
		
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data['rfid_studattendance']['student_number'];
		//FIELDS DATA FOR EDITING 
		$this->data['RfidStudattendance']['id'] = $this->data['rfid_studattendance']['id'];
		$this->data['RfidStudattendance']['time_in'] = (!empty($this->data['rfid_studattendance']['time_in']))?$this->data['rfid_studattendance']['time_in']:null;
		$this->data['RfidStudattendance']['time_out'] = (!empty($this->data['rfid_studattendance']['time_out']))?$this->data['rfid_studattendance']['time_out']:null;
		$this->data['RfidStudattendance']['remarks'] = (!empty($this->data['rfid_studattendance']['remarks']))?$this->data['rfid_studattendance']['remarks']:null;
		$this->data['RfidStudattendance']['status'] = (!empty($this->data['rfid_studattendance']['time_out']) && !empty($this->data['rfid_studattendance']['time_out']))?'Saved':'Raw';
		
		//pr($this->data['RfidStudattendance']);exit;
		
		if($this->RfidStudattendance->save($this->data['RfidStudattendance'])){
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}
	
	function admin_add($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data['RfidStudattendance']['student_number'];
		$this->data['RfidStudattendance']['status'] = 'Saved';

		if($this->RfidStudattendance->save($this->data['RfidStudattendance'])){
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}

	function admin_delete($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data['rfid_studattendance']['student_number'];
		
		
		if ($this->RfidStudattendance->delete($this->data['rfid_studattendance']['id'])) {
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}
	}
	
		
	/*******PDF**********/
	function daily_report($sectionId = null, $sectionName = null, $date = null){
		$data = $this->RfidStudattendance->daily_report($sectionId,$date);
		$students = $this->RfidStudattendance->sectionStudents($sectionId);
		$hdr = array();
		$hdr['section_id'] = $sectionId;
		$hdr['section_name'] = $sectionName;
		$hdr['date'] = $date;
		$this->set(compact('data','hdr','students'));
		$this->layout='pdf';
		$this->render();
	}
		
	function monthly_report($sectionId = null, $sectionName = null, $date = null){
		
		if(!empty($sectionId)){
			$hdr = array('SectionName'=>$sectionName,'Date'=>$date);
			
			$month = date("m",strtotime($date));
			$year = date("Y",strtotime($date));
			$max_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
			
			
			$monthly_report = $this->RfidStudattendance->monthly_report($sectionId,$month,$year);
			$students = $this->RfidStudattendance->sectionStudents($sectionId);
			
			$data = array();
			foreach($students as $s_key => $student){
				$data[$s_key]['StudentNo'] = $student['rfid_students']['student_number'];
				$data[$s_key]['StudentName'] = $student[0]['full_name'];
				$data[$s_key]['StudentRFID'] = $student['rfid_students']['dec_rfid'];
				
				for($day =1;$day<=$max_day;$day++){
					$data[$s_key]['Attendance'][$day]['Date'] = $year.'-'.$month.'-'.$day;
					$data[$s_key]['Attendance'][$day]['Remarks'] = 'A';
				}
				
				foreach($monthly_report as $d_key => $monthly){
					if( $monthly['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
						$day = date("j",strtotime($monthly['rfid_studattendance']['date']));
						$data[$s_key]['Attendance'][$day]['Date'] = $monthly['rfid_studattendance']['date'];
						$data[$s_key]['Attendance'][$day]['TimeIn'] = $monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$day]['TimeOut'] = $monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$day]['TimeInDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$day]['TimeOutDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$day]['Remarks'] = $monthly['rfid_studattendance']['remarks'];
					}
				}
			}
			
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}else{
			$data = array();
			$hdr = array();
			$students = array();
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}
	}
	
	function deped_report($sectionId = null, $sectionName = null, $date = null){
		//$sectionId = 1;
		//$sectionName = "BL P CALUNGSOD";
		//$date = "2016-11";
		if(!empty($sectionId)){
			$hdr = array('SectionName'=>$sectionName,'Date'=>$date);
			
			$month = date("m",strtotime($date));
			$year = date("Y",strtotime($date));
			$max_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
			
			
			$monthly_report = $this->RfidStudattendance->monthly_report($sectionId,$month,$year);
			$students = $this->RfidStudattendance->sectionStudents($sectionId);
			
			$data = array();
			foreach($students as $s_key => $student){
				$data[$s_key]['StudentNo'] = $student['rfid_students']['student_number'];
				$data[$s_key]['StudentName'] = $student[0]['full_name'];
				$data[$s_key]['StudentRFID'] = $student['rfid_students']['dec_rfid'];
				
				for($day =1;$day<=$max_day;$day++){
					$data[$s_key]['Attendance'][$day]['Date'] = $year.'-'.$month.'-'.$day;
					$data[$s_key]['Attendance'][$day]['Remarks'] = 'A';
				}
				
				foreach($monthly_report as $d_key => $monthly){
					if( $monthly['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
						$day = date("j",strtotime($monthly['rfid_studattendance']['date']));
						$data[$s_key]['Attendance'][$day]['Date'] = $monthly['rfid_studattendance']['date'];
						$data[$s_key]['Attendance'][$day]['TimeIn'] = $monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$day]['TimeOut'] = $monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$day]['TimeInDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$day]['TimeOutDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$day]['Remarks'] = $monthly['rfid_studattendance']['remarks'];
					}
				}
			}
			
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}else{
			$data = array();
			$hdr = array();
			$students = array();
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}
	
	}
	
	function student_attendance_report($sno=null,$sname=null,$date=null){
		
		if(!empty($sno) && !empty($sname) && !empty($date)){
		
			$month = date("m",strtotime($date));
			$year = date("Y",strtotime($date));
			$max_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
			
			$attendance = $this->RfidStudattendance->student_monthly_attendance($sno,$month,$year);
			
			$i=0;
			$data = array();
			for($day=1;$day<=$max_day;$day++){
				
				$data[$i]['date'] = date("Y-m-d", mktime(0,0,0,$month,$day,$year));
				
				foreach($attendance as $at){
					if($data[$i]['date'] == $at['rfid_studattendance']['date']){
						$data[$i]['data'] = $at;
					}
				}
				$i++;
			}
			
			
			$hdr['sname'] = $sname;
			$hdr['sno'] = $sno;
			$hdr['date'] = $date;
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}else{
			$data = array();
			$hdr = array();
			$this->set(compact('data','hdr'));
			$this->layout='pdf';
			$this->render();
		}
	}
	/******END PDF******/
	
	/****DAILY CHECKING****/
	function daily_checking(){
		$sy = $this->SchoolYear->find('list',array('order'=>'SchoolYear.id DESC'));
		$this->set(compact('sy'));
	}
	
	function daily_checking_init_data(){
		$data = $this->Section->find('all',array('order'=>'Section.name'));
		echo json_encode($data);
		exit;
	}
	
	function get_section_sched($sectionId){
		$data = $this->Schedule->find('first',array('conditions'=>array('Schedule.id'=>$sectionId)));
		echo json_encode($data);
		exit;
	}
	
	function daily_checking_data($sectionId = null, $date = null){
		
		//$sectionId = 15; $date = '2018-03-16';
		
		$daily_report = $data['DailyReport'] = $this->RfidStudattendance->daily_report($sectionId,$date);
		$students = $data['Students'] = $this->RfidStudattendance->sectionStudents($sectionId);
	
		//pr($students);exit;
		
		
		
		$data = array(); $i=0;
		foreach($students as $s_key => $student){
			$data[$s_key]['RfidStudattendance']['student_number'] = $student['rfid_students']['student_number'];
			$data[$s_key]['RfidStudattendance']['student_name'] = strToUpper($student[0]['full_name']);
			$data[$s_key]['RfidStudattendance']['rfid'] = $student['rfid_students']['dec_rfid'];
			$data[$s_key]['RfidStudattendance']['img_path'] = $student['images']['img_path'];
			
			foreach($daily_report as $d_key => $daily){
				if( $daily['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
				
					//REMINDER: GET LAST DATA INPUT BY THE PARTICULAR STUDENT ON GATE FOR THE DAY
					$data[$s_key]['RfidStudattendance']['id'] = $daily['rfid_studattendance']['id'];
					$data[$s_key]['RfidStudattendance']['date'] = $daily['rfid_studattendance']['date'];
					
					if($daily['rfid_studattendance']['time_in']){//AVOID SAVING 00:00:00 On DB
						$data[$s_key]['RfidStudattendance']['time_in'] = $daily['rfid_studattendance']['time_in'];
					}
					if($daily['rfid_studattendance']['time_out']){//AVOID SAVING 00:00:00 On DB
						$data[$s_key]['RfidStudattendance']['time_out'] = $daily['rfid_studattendance']['time_out'];
					}
					
					$data[$s_key]['RfidStudattendance']['remarks'] = $daily['rfid_studattendance']['remarks'];
					$data[$s_key]['RfidStudattendance']['remark_name'] = $daily['remarks']['name'];
					
					//USE THIS IF GOT TO GET ALL DATA INPUT BY THE PARTICULAR STUDENT ON GATE FOR THE DAY  "$d_key"
					//$data[$s_key]['RfidStudattendance'][$d_key]['remarks'] = $daily['remarks']['name'];
				}
			}
			
			if(!isset($data[$s_key]['RfidStudattendance']['id'])){
				$data[$s_key]['RfidStudattendance']['date'] = $date;
			}
		}
		
		//pr($data);
		//exit;
		echo json_encode($data);
		exit;
		
	}
	
	function daily_checking_posting(){
		if (!empty($this->data)) {
			$this->RfidStudattendance->create();
			if ($this->RfidStudattendance->saveAll($this->data)) {
				//echo debug( $this->RfidStudattendance->invalidFields() );
				$data['data'] = $this->data;
				$data['message'] = 'Daily attendance successfuly posted!';
			    $data['status'] = 1;
			    echo json_encode($data);
			    exit;
			} else {
			    $data['message'] = 'Error on updating daily attendance. Pls. contact your system administrator.';
			    $data['status'] = 0; 
			    echo json_encode($data);
			    exit;
			}
		}
		
	}
	//END
	
	/****INTENT TO ADJUST DATA****/
	function adjust_section_daily_report(){
		
	}
	
	function adjust_student_monthly_attendance(){
		//pr($this->data);exit;
		
		$sno = '2012-00421';//$this->data['sno'];
		$date = '2018-03'; //$this->data['date'];
		//$sno = $this->data['sno'];
		//$date = $this->data['date'];
		
		$month = date("m",strtotime($date));
		$year = date("Y",strtotime($date));
		$max_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
		
		$attendance = $this->RfidStudattendance->student_monthly_attendance($sno,$month,$year);
		
		$i=0;
		$data = array();
		for($day=1;$day<=$max_day;$day++){
			
			$data[$i]['date'] = date("Y-m-d", mktime(0,0,0,$month,$day,$year));
			
			foreach($attendance as $at){
				if($data[$i]['date'] == $at['rfid_studattendance']['date']){
					$data[$i]['data'] = $at;
				}
			}
			$i++;
		}
	
		echo json_encode($data);
		exit;
		
	}
	//END
	
	/****INTENT TO PRINT GUI****/
	function section_daily_report(){
	
	}
	
	function section_monthly_report(){
		
	}
	
	function section_deped_report(){
		
	}
	
	function student_monthly_attendance(){
		
	}
	//END
	
	/****INTENT TO PRINT INIT DATA****/
	function sections(){
		$data = $this->Section->find('all',array('order'=>'Section.name'));
		echo json_encode($data);
		exit;
	}
	
	function student_list(){
		$students = $this->RfidStudent->find('all');
		
		
		$data = array();
		foreach($students as $student){
			$obj = array(
				//'id'=>$student['RfidStudent']['id'],
				'student_number'=>$student['RfidStudent']['student_number'],
				'name'=>$student['RfidStudent']['last_name'].', '.$student['RfidStudent']['first_name'].' '.$student['RfidStudent']['middle_name'],
			);
			array_push($data,$obj);
		}
		

		echo json_encode($data);
		exit;
	}
	//END
	
	//SPS SMS SENDING
	function sps_sms_sending(){
		
	}
	
	function sps_init_data(){
		$data = $this->Level->find('all',array('order'=>'Level.index_order'));
		echo json_encode($data);
		exit;
	}
	
	function sps_data($levelId = null, $date =  null){
		$sps_report = $data['DailyReport'] = $this->RfidStudattendance->sps_data($levelId,$date);
		
		$students = $data['Students'] = $this->RfidStudattendance->levelStudents($levelId);
		//pr($students);exit;
		//pr($sps_report);exit;
		
		
		$data = array(); $i=0;
		foreach($students as $s_key => $student){
			$data[$s_key]['RfidStudattendance']['student_number'] = $student['rfid_students']['student_number'];
			$data[$s_key]['RfidStudattendance']['student_name'] = strToUpper($student[0]['full_name']);
			$data[$s_key]['RfidStudattendance']['rfid'] = $student['rfid_students']['dec_rfid'];
			$data[$s_key]['RfidStudattendance']['img_path'] = $student['images']['img_path'];
			$data[$s_key]['RfidStudattendance']['section'] = $student['sections']['name'];
			$data[$s_key]['RfidStudattendance']['guardian_mobile_no'] = $student['rfid_students']['guardian_mobile_no'];
			
			foreach($sps_report as $d_key => $daily){
				if( $daily['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
				
					//echo $i++.'. '.$daily['rfid_students']['student_number'].' = '.$student['rfid_students']['student_number'].'<br/>';
					
					//REMINDER: GET LAST DATA INPUT BY THE PARTICULAR STUDENT ON GATE FOR THE DAY
					$data[$s_key]['RfidStudattendance']['id'] = $daily['rfid_studattendance']['id'];
					$data[$s_key]['RfidStudattendance']['date'] = $daily['rfid_studattendance']['date'];
					$data[$s_key]['RfidStudattendance']['remarks'] = $daily['rfid_studattendance']['remarks'];
					$data[$s_key]['RfidStudattendance']['remark_name'] = $daily['remarks']['name'];
					
					if($daily['rfid_studattendance']['time_in']){//AVOID SAVING 00:00:00 On DB
						$data[$s_key]['RfidStudattendance']['time_in'] = $daily['rfid_studattendance']['time_in'];
					}
					if($daily['rfid_studattendance']['time_out']){//AVOID SAVING 00:00:00 On DB
						$data[$s_key]['RfidStudattendance']['time_out'] = $daily['rfid_studattendance']['time_out'];
					}
				
					//USE THIS IF GOT TO GET ALL DATA INPUT BY THE PARTICULAR STUDENT ON GATE FOR THE DAY  "$d_key"
					//$data[$s_key]['Attendance'][$d_key]['remarks'] = $daily['remarks']['name'];
				}
				$data[$s_key]['RfidStudattendance']['is_posted'] = $daily['rfid_studattendance']['is_posted'];
			
			}
			
			if(!isset($data[$s_key]['RfidStudattendance']['id'])){
				$data[$s_key]['RfidStudattendance']['date'] = $date;
				$data[$s_key]['RfidStudattendance']['is_posted'] = null;
			}
		}
		echo json_encode($data);
		exit;
		
		
	}
	
	function sps_sms_posting(){
		//pr($this->data);
		//exit;
		
		//CREATE MESSAGE OUT DATA
		$msgout =  array(); $i = 0;
		foreach($this->data as $k=>$d){
			if($d['RfidStudattendance']['remarks'] == "A"){
				$msgout[$i]['MessageOut']['MessageTo']= '+639175683891';//$d['RfidStudattendance']['guardian_mobile_no'];
				$msgout[$i]['MessageOut']['MessageFrom']= '+09175686999';
				$msgout[$i]['MessageOut']['MessageText']= $d['RfidStudattendance']['student_name'].' - Absent';
				$msgout[$i]['MessageOut']['Gateway']= 'Globe';
				$msgout[$i]['MessageOut']['Port']= 19;
				$i++;
			}else if($d['RfidStudattendance']['remarks'] == "L"){
				$msgout[$i]['MessageOut']['MessageTo']= '+639175683891';//$d['RfidStudattendance']['guardian_mobile_no'];
				$msgout[$i]['MessageOut']['MessageFrom']= '+09175686999';
				$msgout[$i]['MessageOut']['MessageText']= $d['RfidStudattendance']['student_name'].' - Late';
				$msgout[$i]['MessageOut']['Gateway']= 'Globe';
				$msgout[$i]['MessageOut']['Port']= 19;
				$i++;
			}
			$this->data[$k]['RfidStudattendance']['is_posted'] = true;//update is_posted field
		}
		
		if (!empty($this->data)) {
			$this->RfidStudattendance->create();
			if ($this->RfidStudattendance->saveAll($this->data)) {
				$this->MessageOut->create();
				if($this->MessageOut->saveAll($msgout)){
					$data['message'] = 'Message Sent!';
					$data['status'] = 1;
					echo json_encode($data);
					exit;
				}else{
					$data['message'] = 'Failed sending SMS . Pls. contact your system administrator.';
					$data['status'] = 0; 
					echo json_encode($data);
					exit;
				}
			} else {
			    $data['message'] = 'Saving DB Error . Pls. contact your system administrator.';
			    $data['status'] = 0; 
			    echo json_encode($data);
			    exit;
			}
		}
		
	}
}
