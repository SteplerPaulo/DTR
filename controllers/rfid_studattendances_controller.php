<?php
class RfidStudattendancesController extends AppController {

	var $name = 'RfidStudattendances';
	var $helpers = array('Access');
	var $uses = array('RfidStudattendance','RfidStudent','Remark','Schedule');
	
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
			
			$monthly_report = $this->RfidStudattendance->monthly_report($sectionId,$date);
			$students = $this->RfidStudattendance->sectionStudents($sectionId);
			
			$data = array();
			foreach($students as $s_key => $student){
				$data[$s_key]['StudentNo'] = $student['rfid_students']['student_number'];
				$data[$s_key]['StudentName'] = $student[0]['full_name'];
				$data[$s_key]['StudentRFID'] = $student['rfid_students']['dec_rfid'];
				
				foreach($monthly_report as $d_key => $monthly){
					$i = 0;
					if( $monthly['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
						$data[$s_key]['Attendance'][$i]['Date'] = $monthly['rfid_studattendance']['date'];
						$data[$s_key]['Attendance'][$i]['TimeIn'] = $monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$i]['TimeOut'] = $monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$i]['TimeInDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_in'];
						$data[$s_key]['Attendance'][$i]['TimeOutDate'] = $monthly['rfid_studattendance']['date'].' '.$monthly['rfid_studattendance']['time_out'];
						$data[$s_key]['Attendance'][$i]['Remarks'] = $monthly['rfid_studattendance']['remarks'];
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
		//$sectionId = 110;
		//$sectionName = "Archdiocese of Manila";
		//$date = "2016-11-10";
		
		
		$daily_report = $this->RfidStudattendance->daily_report($sectionId,$date);
		$students = $this->RfidStudattendance->sectionStudents($sectionId);
		
		
		foreach($daily_report as $d_key => $daily){
			foreach($students as $s_key => $student){
				if( $daily['rfid_students']['student_number'] == $student['rfid_students']['student_number']){
					if($daily['rfid_studattendance']['time_in'] < '12:00:00' && $daily['rfid_studattendance']['time_in'] != Null){
						$students[$s_key]['Attendance']['AM']['time_in'] = $daily['rfid_studattendance']['time_in'];
					}else{
						$students[$s_key]['Attendance']['PM']['time_in'] = $daily['rfid_studattendance']['time_in'];
					}
					
					
					if ($daily['rfid_studattendance']['time_out'] < '12:00:00' && $daily['rfid_studattendance']['time_out'] != Null){
						$students[$s_key]['Attendance']['AM']['time_out'] = $daily['rfid_studattendance']['time_out'];
					}else{
						$students[$s_key]['Attendance']['PM']['time_out'] = $daily['rfid_studattendance']['time_out'];
					}
					$students[$s_key]['Attendance']['remarks'] = $daily['rfid_studattendance']['remarks'];
					$students[$s_key]['Attendance']['date'] = $daily['rfid_studattendance']['date'];
				}
			}
		}
		

		$hdr = array();
		$hdr['section_id'] = $sectionId;
		$hdr['section_name'] = $sectionName;
		$hdr['date'] = $date;
		$this->set(compact('hdr','students'));
		$this->layout='pdf';
		$this->render();
	
	}

	function test(){
		$this->layout='clean';
		
	}
	
	function init_remarks($sectionId = null, $sectionName = null, $date = null){
		//$sectionId = 9;
		//$date = '2016-11-16';
		
		$sy = date("Y",strtotime($date));
		$sched =  $this->Schedule->find('first',array('conditions'=>array('Schedule.section_id'=>$sectionId,'Schedule.sy'=>$sy)));
		$attendances = $this->RfidStudattendance->monthly_report($sectionId,$date);
		$students = $data['Students'] = $this->RfidStudattendance->sectionStudents($sectionId);
	

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
}
