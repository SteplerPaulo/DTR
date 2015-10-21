<?php
class AttendancesController extends AppController {

	var $name = 'Attendances';
	var $helpers = array('Access');
	var $uses = array('Attendance','RfidStudent','SchoolYear');
	
	function beforeFilter(){ 
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','employees','add','checking','report','datetime','admin_report','doc_report'));	
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
		//pr($empno);
		//pr($empname);
		//pr($date);exit;

		if(!empty($empno) && !empty($empname) && !empty($date)){
		
			
			
			$fields = get_class_vars('DATABASE_CONFIG');
			$gatekeeper_db  = $fields['gatekeeper']['database'];
			$date = explode('-',$date);
			
			$year = $date[0];
			$month = $date[1];
			$empno = $empno;
			$empname = $empname;
			$data =  $this->Attendance->per_employee($month,$empno,$gatekeeper_db);
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
	
	function schedules(){
		
		 $deliverytime = new DateTime('2014-10-08 06:00:00');
		 $hour = $deliverytime->format('H');
		 if ($hour < 12) {
			pr("Morning");
		 } else {
			pr("Afternoon or evening");
		 }
		 exit;
		
		//df$time.of.day[df$time >= "00:00:00" & df$time <= "07:00:00"] <- "morning"
		//df$time.of.day[df$time >= "07:00:00" & df$time <= "10:00:00"] <- "home2work"
		//df$time.of.day[df$time >= "10:00:00" & df$time <= "16:00:00"] <- "mid_day"
		//df$time.of.day[df$time >= "16:00:00" & df$time <= "19:00:00"] <- "work2home"
		//df$time.of.day[df$time >= "19:00:00" & df$time <= "23:59:59"] <- "night"
		
	}
}
