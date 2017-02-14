<?php
class RfidStudattendancesController extends AppController {

	var $name = 'RfidStudattendances';
	var $helpers = array('Access');
	var $uses = array('RfidStudattendance','RfidStudent','Remark','Schedule','User','Section','SchoolYear');
	
	function beforeFilter(){ 
		parent::beforeFilter();
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','students','report','datetime','doc_report','daily_report','monthly_report'));	
    } 


	function index() {
		$this->RfidStudattendance->recursive = 0;
		$this->set('rfidStudattendances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rfid studattendance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rfidStudattendance', $this->RfidStudattendance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RfidStudattendance->create();
			if ($this->RfidStudattendance->save($this->data)) {
				$this->Session->setFlash(__('The rfid studattendance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid studattendance could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid rfid studattendance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RfidStudattendance->save($this->data)) {
				$this->Session->setFlash(__('The rfid studattendance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid studattendance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RfidStudattendance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for rfid studattendance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->RfidStudattendance->delete($id)) {
			$this->Session->setFlash(__('Rfid studattendance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Rfid studattendance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_index() {
		if(!$this->Access->check('RfidStudattendance','*') && !$this->Access->check('RfidStudattendance','create','read','update','delete') && !$this->Access->check('RfidStudattendance','read')){
			DIE("You don't have permission to access that page.Pls. contact school's system administrator for further details. ");
		}
	}
	
	function admin_adjust($fromDate=null,$toDate=null,$sno=null,$sname=null){
		$this->layout='clean';
		$this->set(compact('fromDate','toDate','sno','sname'));
	}
	
	function data($fromDate=null,$toDate=null,$sno=null,$empname=null){
		//GET DATE BETWEEN TWO DATES
		$dates = $this->get_dates_between_two_dates($fromDate,$toDate);
		//SET GATEKEEPER DATABASE
		$gatekeeper_db  = $this->set_gatekeeper_db();
		//INCLUSIVE DATE FORCE ENTRY
		$this->inclusive_dates_force_entry($dates,$sno,$gatekeeper_db);
			
		$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
		echo json_encode($data);
		exit;
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
	
	
	function students(){
		$students = $this->RfidStudent->find('all',array('conditions'=>array('RfidStudent.type'=>1)));
		echo json_encode($students);
		exit;
	}
	
	function admin_per_section_adjustment($sectionId = null, $sectionName = null, $date = null){
		//$sectionId = 110;
		//$sectionName = 'Archdiocese of Manila';
		//$date = '2016-11-30';
		
		
		$this->layout='clean';
		$remarks = $this->Remark->find('list',array('fields'=>array('Remark.alias','Remark.name')));
		$this->set(compact('sectionId','sectionName','date','remarks'));
		
	}

	function doc_report($fromDate=null,$toDate=null,$sno=null,$sname=null){
		if(!empty($fromDate) && !empty($toDate) && !empty($sno) && !empty($sname)){
			
			//GET DATE BETWEEN TWO DATES
			$dates = $this->get_dates_between_two_dates($fromDate,$toDate);
			//SET GATEKEEPER DATABASE
			$gatekeeper_db  = $this->set_gatekeeper_db();
			//INCLUSIVE DATE FORCE ENTRY
			$this->inclusive_dates_force_entry($dates,$sno,$gatekeeper_db);
			
			//CALL UPDATED ATTENDANCE ENTRY
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);	
			
			$hdr['sname'] = $sname;
			$hdr['sno'] = $sno;
			$hdr['fromDate'] = $fromDate;
			$hdr['toDate'] = $toDate;
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
	
	function per_sec_data_adjustment($sectionId = null, $sectionName = null, $date = null){
		//$sectionId = 110;
		//$sectionName = 'Archdiocese of Manila';
		//$date = '2016-11-30';
		
		$daily_report = $data['DailyReport'] = $this->RfidStudattendance->daily_report($sectionId,$date);
		$students = $data['Students'] = $this->RfidStudattendance->sectionStudents($sectionId);
	
		$data = array();
		foreach($students as $s_key => $student){
			
			$data[$s_key]['StudentNo'] = $student['rfid_students']['student_number'];
			$data[$s_key]['StudentName'] = $student[0]['full_name'];
			$data[$s_key]['StudentRFID'] = $student['rfid_students']['dec_rfid'];
			
			foreach($daily_report as $d_key => $daily){
				if( $daily['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
					$data[$s_key]['Attendance'][$d_key]['Date'] = $daily['rfid_studattendance']['date'];
					$data[$s_key]['Attendance'][$d_key]['TimeIn'] = $daily['rfid_studattendance']['time_in'];
					$data[$s_key]['Attendance'][$d_key]['TimeOut'] = $daily['rfid_studattendance']['time_out'];
					$data[$s_key]['Attendance'][$d_key]['TimeInDate'] = $daily['rfid_studattendance']['date'].' '.$daily['rfid_studattendance']['time_in'];
					$data[$s_key]['Attendance'][$d_key]['TimeOutDate'] = $daily['rfid_studattendance']['date'].' '.$daily['rfid_studattendance']['time_out'];
					$data[$s_key]['Attendance'][$d_key]['Remarks'] = $daily['rfid_studattendance']['remarks'];
				}
			}
		}
		echo json_encode($data);
		exit;
	}
	
	function admin_per_section_saving(){
		$this->RfidStudattendance->deleteAll([
				'RfidStudattendance.student_number' => $this->data['sno'], 
				'RfidStudattendance.date' => $this->data['date']
			]);
			
		$data =  array();
		
		$data['RfidStudattendance']['date'] =  $this->data['date'];
		$data['RfidStudattendance']['student_number'] =  $this->data['sno'];
		$data['RfidStudattendance']['rfid'] =  $this->data['rfid'];
		$data['RfidStudattendance']['time_in'] =  $this->data['TimeIn'];
		$data['RfidStudattendance']['time_out'] =  $this->data['TimeOut'];
		$data['RfidStudattendance']['remarks'] =  $this->data['remarks'];
		$data['RfidStudattendance']['status'] =  'S';
		
		
		if($this->RfidStudattendance->saveAll($data)){
			$data['message'] = 'Saving succesfull!';
			$data['status'] = 1;
			echo json_encode($data);
			exit;
			
		}else{
			$data['message'] = 'Please try again!';
			$data['status'] = 0; 
			echo json_encode($data);
			exit;
		}
		
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
	
	function get_dates_between_two_dates($fromDate,$toDate){
		//GET DATE BETWEEN TWO DATES
		$dates=array();
		$iDateFrom=mktime(1,0,0,substr($fromDate,5,2),     substr($fromDate,8,2),substr($fromDate,0,4));
		$iDateTo=mktime(1,0,0,substr($toDate,5,2),     substr($toDate,8,2),substr($toDate,0,4));

		if ($iDateTo>=$iDateFrom){
			array_push($dates,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo){
				$iDateFrom+=86400; // add 24 hours
				array_push($dates,date('Y-m-d',$iDateFrom));
			}
		}
		
		return $dates;
	}
	
	function set_gatekeeper_db(){
		$fields = get_class_vars('DATABASE_CONFIG');
		$gatekeeper_db  = $fields['gatekeeper']['database'];
		return $gatekeeper_db;
	}
	
	function inclusive_dates_force_entry($dates,$sno,$gatekeeper_db){
		foreach($dates as $k => $dts){
			$data[$k] =  $this->RfidStudattendance->per_student($dts,$dts,$sno,$gatekeeper_db);
			if(empty($data[$k])){
				$this->data[$k]['RfidStudattendance']['date'] = $dts;
				$this->data[$k]['RfidStudattendance']['student_number'] = $sno;
				$this->data[$k]['RfidStudattendance']['status'] = 'Saved';
			}
		}
		if(!empty($this->data)){
			$this->RfidStudattendance->saveAll($this->data);
		
		}
	}

	function admin_posting($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data[0]['rfid_studattendance']['student_number'];
		
		//FIELDS DATA FOR EDITING 
		foreach($this->data as $k =>$d){
			$this->data[$k]['RfidStudattendance']['id'] = $d['rfid_studattendance']['id'];
			$this->data[$k]['RfidStudattendance']['status'] = 'P';
		}
		
		
		if($this->RfidStudattendance->saveAll($this->data)){
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}

	function record(){
		
		
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

	function test(){
		$this->layout='clean';
		
	}
	
	function init_remarks($sectionId = null, $sectionName = null, $date = null){
		//$sectionId = 9;
		//$date = '2016-11-16';
		$month = date("m",strtotime($date));
		$year = date("Y",strtotime($date));
		
		$default_sy =  $this->SchoolYear->find('first',array('conditions'=>array('SchoolYear.is_default'=>1)));
		$sy = $default_sy['SchoolYear']['id'];
		//pr($default_sy );exit;
		
		
		$sched =  $this->Schedule->find('first',array('conditions'=>array('Schedule.section_id'=>$sectionId,'Schedule.sy'=>$sy)));
		$attendances = $this->RfidStudattendance->monthly_report($sectionId,$month,$year);
		$students = $data['Students'] = $this->RfidStudattendance->sectionStudents($sectionId);
		//pr($sched);
		//pr($month);
		//pr($year);
		//pr($attendances );exit;

		$data =  array();
		$i =  0;
		foreach($attendances as $att){
			if(empty($att['rfid_studattendance']['remarks'])){
				
				$data[$i]['RfidStudattendance']['id'] = $att['rfid_studattendance']['id'];

				if($att['rfid_studattendance']['time_in'] <= $sched['Schedule']['start_time']){
					$data[$i]['RfidStudattendance']['remarks'] = 'P';
				}else{
					$data[$i]['RfidStudattendance']['remarks'] = 'L';
				}
				
				$i++;
			}
			
		}
		
		//pr($data);exit;
		
		if($this->RfidStudattendance->saveAll($data)){
			$respanse['data'] = $data;
			$respanse['message'] = 'Successful';
			echo json_encode($data);
			exit;
		}else{
			$respanse['data'] = $data;
			$respanse['message'] = 'Error!';
			echo json_encode($data);
			exit;
		}
		
	}
	
	function remarks(){
		$remarks = $this->Remark->find('all');
		echo json_encode($remarks);
		exit;
	}
	
	
	function intent_report_data(){
		$data = array();
		
		//GET STUDENTS
		
		if($this->Access->check('RfidStudent','*') || $this->Access->check('RfidStudent','create','read','update','delete')){
			$data['perStudentOnly'] = false;
			$conditions = array('RfidStudent.type'=>1);
		}else if($this->Access->check('RfidStudent','read')){
			$userDtls =  $this->User->findById($this->Access->getmy('id'));
			$conditions = array('RfidStudent.type'=>1,'RfidStudent.student_number'=>$userDtls['User']['id_number']);
			$data['perStudentOnly'] = true;
		}else{
			$conditions = array('RfidStudent.type'=>3);
			$data['perStudentOnly'] = false;
		}
		
		$data['students'] = $this->RfidStudent->find('all',array('conditions'=>$conditions));
		
		//GET SECTIONS
		
		if($this->Access->check('Section','*') || $this->Access->check('Section','create','read','update','delete')){
			$data['perSectionOnly'] = false;
			$conditions = array();
		}else if($this->Access->check('Section','read')){
			$userDtls =  $this->User->findById($this->Access->getmy('id'));
			$conditions = array('Section.employee_number'=>$userDtls['User']['id_number']);
			$data['perSectionOnly'] = true;
		}else{
			$conditions = array();
			$data['perSectionOnly'] = false;
		}
		$data['sections'] = $this->Section->find('all',array('conditions'=>$conditions));
	
		
		echo json_encode($data);
		exit;
	}
	

}
