<?php
class RfidStudattendancesController extends AppController {

	var $name = 'RfidStudattendances';
	var $helpers = array('Access');
	var $uses = array('RfidStudattendance','RfidStudent');
	
	function beforeFilter(){ 
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','students','report','datetime','admin_report','doc_report','admin_adjust','data','admin_update','admin_delete','admin_copy','admin_add','admin_posting','daily_report','monthly_report'));	
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
	
	function daily_report($sectionId = '', $sectionName = '', $date = ''){
		
		if(!empty($sectionId) && !empty($sectionName) &&!empty($date)){
			$data = $this->RfidStudattendance->daily_report($sectionId,$date);
		
			$hdr = array();
			$hdr['section_id'] = $sectionId;
			$hdr['section_name'] = $sectionName;
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
	function monthly_report($sectionId = ""){
		if(!empty($sectionId)){
			$data = array();
			$hdr = array();
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
}
