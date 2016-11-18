<?php
class RfidStudattendancesController extends AppController {

	var $name = 'RfidStudattendances';
	var $helpers = array('Access');
	var $uses = array('RfidStudattendance','RfidStudent','Remark');
	
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
		$this->RfidStudattendance->recursive = 0;
		$this->set('rfidStudattendances', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rfid studattendance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rfidStudattendance', $this->RfidStudattendance->read(null, $id));
	}

	function admin_add($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data['RfidStudattendance']['student_number'];
		$this->data['RfidStudattendance']['remarks'] = 2; //REMARK AS ADMIN FORCE ENTRY
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

	function admin_edit($id = null) {
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

	function admin_delete($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$sno = $this->data['rfid_studattendance']['student_number'];
		
		
		if ($this->RfidStudattendance->delete($this->data['rfid_studattendance']['id'])) {
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$sno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}
	}
	
	function admin_report(){
		
		
	}
	
	function students(){
		$students = $this->RfidStudent->find('all',array('conditions'=>array('RfidStudent.type'=>1)));
		echo json_encode($students);
		exit;
	}
	
	function admin_adjust($fromDate=null,$toDate=null,$sno=null,$sname=null){
		$this->layout='clean';
		$this->set(compact('fromDate','toDate','sno','sname'));
	}
	
	function admin_per_section_adjustment($sectionId = null, $sectionName = null, $date = null){
		$this->layout='clean';
		$remarks = $this->Remark->find('list');//,array('fields'=>array('Remark.name','Remark.name')));
		//pr($remarks);exit;
		$this->set(compact('sectionId','sectionName','date','remarks'));
		
	}

	function admin_per_section_saving(){
		pr($this->data);
		
		//$existing = $this->RfidStudattendance->find('all',array('conditions'=>array('RfidStudAttendance.student_number'=>$this->data['sno'],'RfidStudAttendance.date'=>$this->data['date'])));
		
		$this->RfidStudattendance->deleteAll([
				'RfidStudattendance.student_number' => $this->data['sno'], 
				'RfidStudattendance.date' => $this->data['date']
			]);
			
		$data =  array();
		if(!empty($this->data['AMTimeIn']) && !empty($this->data['AMTimeOut']) && !empty($this->data['PMTimeIn']) && !empty($this->data['PMTimeOut'])){
			$data[0]['RfidStudattendance']['date'] =  $this->data['date'];
			$data[0]['RfidStudattendance']['student_number'] =  $this->data['sno'];
			$data[0]['RfidStudattendance']['rfid'] =  $this->data['rfid'];
			$data[0]['RfidStudattendance']['time_in'] =  $this->data['AMTimeIn'];
			$data[0]['RfidStudattendance']['time_out'] =  $this->data['AMTimeOut'];
			$data[0]['RfidStudattendance']['remarks'] =  $this->data['remarks'];
			$data[0]['RfidStudattendance']['status'] =  'S';
			
			$data[1]['RfidStudattendance']['date'] =  $this->data['date'];
			$data[1]['RfidStudattendance']['student_number'] =  $this->data['sno'];
			$data[1]['RfidStudattendance']['rfid'] =  $this->data['rfid'];
			$data[1]['RfidStudattendance']['time_in'] =  $this->data['PMTimeIn'];
			$data[1]['RfidStudattendance']['time_out'] =  $this->data['PMTimeOut'];
			$data[1]['RfidStudattendance']['remarks'] =  $this->data['remarks'];
			$data[1]['RfidStudattendance']['status'] =  'S';
		}
		
		

		
	
		//pr($data);
		//exit;
		if($this->RfidStudattendance->saveAll($data)){
			echo 'SAVING SUCCEFULL';
			exit;
			
		}else{
			echo 'Please Try Again';
			exit;
		}
		
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
				}
			}
		}
	
		echo json_encode($students);
		exit;
	}
	
	function monthly_report($sectionId = ""){
		if(!empty($sectionId)){
			$data = array();
			$hdr = array();
			$students = $this->RfidStudattendance->sectionStudents($sectionId);
			$this->set(compact('data','hdr','students'));
			$this->layout='pdf';
			$this->render();
		}else{
			$data = array();
			$hdr = array();
			$students = array();
			$this->set(compact('data','hdr','students'));
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
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$empno = $this->data['rfid_studattendance']['student_number'];
		//FIELDS DATA FOR EDITING 
		$this->data['RfidStudattendance']['id'] = $this->data['rfid_studattendance']['id'];
		$this->data['RfidStudattendance']['time_in'] = (!empty($this->data['rfid_studattendance']['time_in']))?$this->data['rfid_studattendance']['time_in']:null;
		$this->data['RfidStudattendance']['time_out'] = (!empty($this->data['rfid_studattendance']['time_out']))?$this->data['rfid_studattendance']['time_out']:null;;
		$this->data['RfidStudattendance']['status'] = (!empty($this->data['rfid_studattendance']['time_out']) && !empty($this->data['rfid_studattendance']['time_out']))?'Saved':'Raw';
		
		if($this->RfidStudattendance->save($this->data['RfidStudattendance'])){
			$data =  $this->RfidStudattendance->per_student($fromDate,$toDate,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
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

	function deped_report(){
		$this->layout='pdf';
		$this->render();
	}
}
