<?php
class AttendancesController extends AppController {

	var $name = 'Attendances';
	var $helpers = array('Access');
	var $uses = array('Attendance','RfidStudent','SchoolYear','AttendanceCopy');
	
	function beforeFilter(){ 
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','employees','add','checking','report','datetime','admin_report','doc_report','admin_adjust','data','update'));	
    } 

	function index() {
		
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attendance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attendance', $this->Attendance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			date_default_timezone_set("Asia/Singapore");
			$this->data['Attendance']['date'] = date('Y-m-d');
			
			$result = $this->Attendance->find('first',array(
												'conditions'=>array(
															'date'=>date('Y-m-d'),
															'OR'=>array(
																	array('employee_number'=>strtolower ($this->data['Attendance']['employee_number'])),
																	array('employee_number'=>strtoupper ($this->data['Attendance']['employee_number'])),
																	array('rfid'=>$this->data['Attendance']['rfid']),
																)
															),
												'order' => array('id' => 'DESC')
												));
			$type;
			if(empty($result['Attendance']['timein'])){
				$this->data['Attendance']['timein']= date("G:i:s");
				$type = 'IN';
			}else if(empty($result['Attendance']['timeout'])){
				$this->data['Attendance']['id']=$result['Attendance']['id'];
				$this->data['Attendance']['timeout']= date("G:i:s");
				$type = 'OUT';
			}else{//IF NO RESULT FOUND
				$this->data['Attendance']['timein']= date("G:i:s");
				$type = 'IN';
			}
			
			$this->Attendance->create();		
			if ($this->Attendance->saveAll($this->data['Attendance'])) {
				$response['status'] = 1;
				$response['type'] = $type;
				$response['data'] = $this->Attendance->find('all',array(
																'conditions'=>array('employee_number'=>$this->data['Attendance']['employee_number']),
																'order' => array('id'=> 'DESC')
																));
				echo json_encode($response);
				exit();
			} else {
				$response['status'] = -1;
				$response['data'] = $this->data;
				echo json_encode($response);
				exit();
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attendance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attendance->save($this->data)) {
				$this->Session->setFlash(__('The attendance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attendance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attendance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attendance->delete($id)) {
			$this->Session->setFlash(__('Attendance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attendance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function employees(){
		$sy = $this->SchoolYear->findByIsDefault(1);
		$employees = $this->RfidStudent->find('all',array('conditions'=>array('RfidStudent.type'=>2)));
		echo json_encode($employees);
		exit;
	}
	
	function test(){
		$response['data'] = $this->Attendance->find('all',array(
																'conditions'=>array('employee_number'=>'A-1981-0014'),
																'order' => array('id'=> 'DESC')
																));
		echo json_encode($response);
		exit();
		
	}
	
	function pagination(){
		
	}
	
	function dirPagination(){

	}
	
	function checking(){
		$attendance = $this->Attendance->find('all');//,array('conditions'=>array('Attendance.remarks'=>0)));
		$i =0;
		foreach ($attendance as $v){
			$response =  $this->RfidStudent->findBySourceRfid($v['Attendance']['rfid']);
			if(isset($response['RfidStudent'])){
				$data[$i]['RFID201'] = $response['RfidStudent'];
				$data[$i]['Attendance'] = $v['Attendance'];
				$i++;
			}
		}
		
		//pr($data);exit;
		echo json_encode($data);
		exit;
	}
	
	function data_not_found_entry(){
		
		
	}
	
	function datetime(){
		date_default_timezone_set("Asia/Singapore");
		$msg = date('l F d, Y');
		echo $msg;
		exit;
	}

	function admin_report(){
		
		
	}
	
	function doc_report($empno=null,$empname=null,$date=null){

		if(!empty($empno) && !empty($empname) && !empty($date)){
			$fields = get_class_vars('DATABASE_CONFIG');
			$gatekeeper_db  = $fields['gatekeeper']['database'];
			$date = explode('-',$date);
			
			$year = $date[0];
			$month = $date[1];
			$empno = $empno;
			$empname = $empname;
			$data =  $this->Attendance->per_employee($year,$month,$empno,$gatekeeper_db);
			$hdr['empname'] = $empname;
			$hdr['empno'] = $empno;
			$hdr['month'] = $month;
			$hdr['year'] = $year;
			
			
			//pr($data);exit;
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
	
	function admin_adjust($empno=null,$empname=null,$date=null){
		$this->layout='clean';
		$this->set(compact('empname','empno','date'));
	}
	
	function data($empno=null,$empname=null,$date=null){
		$fields = get_class_vars('DATABASE_CONFIG');
		$gatekeeper_db  = $fields['gatekeeper']['database'];
		$date = explode('-',$date);
		
		$year = $date[0];
		$month = $date[1];
		$empno = $empno;
		$empname = $empname;
		$data =  $this->Attendance->per_employee($year,$month,$empno,$gatekeeper_db);
		echo json_encode($data);
		exit;
	}
	
	function update(){
		$fields = get_class_vars('DATABASE_CONFIG');
		$gatekeeper_db  = $fields['gatekeeper']['database'];
		$date = explode('-',$this->data['attendances']['date']);
		
		$year = $date[0];
		$month = $date[1];
		$empno = $this->data['attendances']['employee_number'];;
		
		//FIELDS DATA FOR EDITING 
		$this->data['Attendance']['id'] = $this->data['attendances']['id'];
		$this->data['Attendance']['timein'] = $this->data['attendances']['timein'];
		$this->data['Attendance']['timeout'] = $this->data['attendances']['timeout'];
		
		if($this->Attendance->save($this->data['Attendance'])){
			$data =  $this->Attendance->per_employee($year,$month,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}
}
