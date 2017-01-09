<?php
class AttendancesController extends AppController {

	var $name = 'Attendances';
	var $helpers = array('Access');
	var $uses = array('Attendance','RfidStudent','SchoolYear','AttendanceCopy','MessageOut','Remark');
	
	function beforeFilter(){ 
		parent::beforeFilter();
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('index','employees','add','checking','report','datetime','admin_report','doc_report','admin_adjust','data','admin_update','admin_delete','admin_copy','admin_add','modal','admin_posting'));	
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
			
			//BUILD ATTENDANCE COPY
			foreach($this->data['Attendance'] as $k =>$d){
				$this->data['AttendanceCopy'][$k] = $d; 
			}
			
			$this->Attendance->create();		
			if ($this->Attendance->saveAll($this->data['Attendance']) && $this->AttendanceCopy->saveAll($this->data['AttendanceCopy'])) {
				$response['status'] = 1;
				$response['type'] = $type;
				$response['data'] = $this->Attendance->find('all',array(
																'conditions'=>array('employee_number'=>$this->data['Attendance']['employee_number']),
																'order' => array('id'=> 'DESC')
															));
				
				$response['details'] = $this->RfidStudent->findByEmployeeNumber($this->data['Attendance']['employee_number']);
				
			
				//SAVE TO MESSAGE OUT
				$MessageFrom = '09175683891';
				$MessageTo = $response['details']['RfidStudent']['employee_mobile_no'];
				if(empty($response['data'][0]['Attendance']['timeout'])){
					$data = array('MessageOut'=>array(
										'MessageFrom'=>$MessageFrom,
										'MessageTo'=>$MessageTo,
										'MessageText'=>'Welcome '.$this->data['Attendance']['employee_name'].' ! Good day!',
										'MessageType'=>'IN',
									));

				}else{
					$data = array('MessageOut'=>array(
										'MessageFrom'=>$MessageFrom,
										'MessageTo'=>$MessageTo,
										'MessageText'=>'Goodbye '.$this->data['Attendance']['employee_name'].'! Take care!',
										'MessageType'=>'OUT',
									));
								
				}
				$this->MessageOut->save($data['MessageOut']);
				//END SAVING TO MESSAGE OUT

													
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

	function admin_index(){
		
		
	}
	
	function doc_report($fromDate=null,$toDate=null,$empno=null,$empname=null){
		if(!empty($fromDate) && !empty($toDate) && !empty($empno) && !empty($empname)){
			//GET DATE BETWEEN TWO DATES
			$dates = $this->get_dates_between_two_dates($fromDate,$toDate);
			//SET GATEKEEPER DATABASE
			$gatekeeper_db  = $this->set_gatekeeper_db();
			//INCLUSIVE DATE FORCE ENTRY
			$this->inclusive_dates_force_entry($dates,$empno,$gatekeeper_db);
			
			//CALL UPDATED ATTENDANCE ENTRY
			$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);	
			$hdr['empname'] = $empname;
			$hdr['empno'] = $empno;
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
	
	function admin_adjust($fromDate=null,$toDate=null,$empno=null,$empname=null){
		$this->layout='clean';
		$this->set(compact('fromDate','toDate','empname','empno'));
	}
	
	function data($fromDate=null,$toDate=null,$empno=null,$empname=null){
		//GET DATE BETWEEN TWO DATES
		$dates = $this->get_dates_between_two_dates($fromDate,$toDate);
		//SET GATEKEEPER DATABASE
		$gatekeeper_db  = $this->set_gatekeeper_db();
		//INCLUSIVE DATE FORCE ENTRY
		$this->inclusive_dates_force_entry($dates,$empno,$gatekeeper_db);
			
		$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);
		echo json_encode($data);
		exit;
	}
	
	function admin_update($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$empno = $this->data['attendances']['employee_number'];
		//FIELDS DATA FOR EDITING 
		$this->data['Attendance']['id'] = $this->data['attendances']['id'];
		$this->data['Attendance']['timein'] = (!empty($this->data['attendances']['timein']))?$this->data['attendances']['timein']:null;
		$this->data['Attendance']['timeout'] = (!empty($this->data['attendances']['timeout']))?$this->data['attendances']['timeout']:null;;
		$this->data['Attendance']['remarks'] = (!empty($this->data['attendances']['remarks']))?$this->data['attendances']['remarks']:null;
		$this->data['Attendance']['status'] = (!empty($this->data['attendances']['timeout']) && !empty($this->data['attendances']['timeout']))?'Saved':'Raw';
		
		//pr($this->data['Attendance']);exit;
		
		if($this->Attendance->save($this->data['Attendance'])){
			$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}
	
	function admin_delete($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$empno = $this->data['attendances']['employee_number'];
		
		if ($this->Attendance->delete($this->data['attendances']['id'])) {
			$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}
	}
	
	function admin_add($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$empno = $this->data['Attendance']['employee_number'];
		$this->data['Attendance']['remarks'] = 2; //REMARK AS ADMIN FORCE ENTRY
		$this->data['Attendance']['status'] = 'Saved';

		if($this->Attendance->save($this->data['Attendance'])){
			$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
		}
	}

	function admin_copy(){
		$data  = $this->Attendance->find('all');
		$i = 0;
		foreach($data as $d){
			$this->data[$i]['AttendanceCopy']['id'] = $d['Attendance']['id'];
			$this->data[$i]['AttendanceCopy']['employee_number'] = $d['Attendance']['employee_number'];
			$this->data[$i]['AttendanceCopy']['date'] = $d['Attendance']['date'];
			$this->data[$i]['AttendanceCopy']['timein'] = $d['Attendance']['timein'];
			$this->data[$i]['AttendanceCopy']['timeout'] = $d['Attendance']['timeout'];
			$this->data[$i]['AttendanceCopy']['rfid'] = $d['Attendance']['rfid'];
			$this->data[$i]['AttendanceCopy']['remarks'] = $d['Attendance']['remarks'];
			$this->data[$i]['AttendanceCopy']['created'] = $d['Attendance']['created'];
			$i++;
		}
		
		if ($this->AttendanceCopy->saveAll($this->data)) {
			echo 'Attendance succesfully copied';
		}else{
			echo 'Something went wrong.Pls truncate attendace_copies table and try again';
		}
		exit;
	}
	
	function modal(){
		
		
	}
	
	function admin_posting($fromDate=null,$toDate=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$empno = $this->data[0]['attendances']['employee_number'];
		
		//FIELDS DATA FOR EDITING 
		foreach($this->data as $k =>$d){
			$this->data[$k]['Attendance']['id'] = $d['attendances']['id'];
			$this->data[$k]['Attendance']['status'] = 'Posted';
		}
		
		
		if($this->Attendance->saveAll($this->data)){
			$data =  $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);
			echo json_encode($data);
			exit;
		}else{
			die('Something went wrong. Pls contact your system administrator');
			exit;
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

	function inclusive_dates_force_entry($dates,$empno,$gatekeeper_db){
		
		foreach($dates as $k => $dts){
			$data[$k] =  $this->Attendance->per_employee($dts,$dts,$empno,$gatekeeper_db);
			if(empty($data[$k])){
				$this->data[$k]['Attendance']['date'] = $dts;
				$this->data[$k]['Attendance']['employee_number'] = $empno;
				$this->data[$k]['Attendance']['status'] = 'Saved';
			}
		}
		if(!empty($this->data)){
			$this->Attendance->saveAll($this->data);
		}
		
	}

	function message_out(){
		
		$response['data'] = $this->Attendance->find('all',array(
																'conditions'=>array('employee_number'=>'95-0015 NA'),
																'order' => array('id'=> 'DESC')
																));
		$response['details'] = $this->RfidStudent->findByEmployeeNumber('95-0015 NA');
		
	
	
		$MessageFrom = '09175683891';
		$MessageTo = $response['details']['RfidStudent']['employee_mobile_no'];
		
		if(empty($response['data'][0]['Attendance']['timeout'])){
			$data = array(
				'MessageOut'=>array(
					'MessageFrom'=>$MessageFrom,
					'MessageTo'=>$MessageTo,
					'MessageText'=>'Welcome <Name> ! Good day!',
					'MessageType'=>'IN',
				));
			
		}else{
			$data = array(
				'MessageOut'=>array(
					'MessageFrom'=>$MessageFrom,
					'MessageTo'=>$MessageTo,
					'MessageText'=>'Goobye <Name>! Take care!',
					'MessageType'=>'OUT',
				));
			
		}
		$this->MessageOut->save($data['MessageOut']);
	
		
		pr($data);exit;
		
	}

	function init_remarks($fromDate=null,$toDate=null,$empno=null,$empname=null){
		$gatekeeper_db  = $this->set_gatekeeper_db();
		$attendances = $this->Attendance->per_employee($fromDate,$toDate,$empno,$gatekeeper_db);


		$data =  array();
		$i =  0;
		foreach($attendances as $att){
			if(empty($att['attendances']['remarks'])){
				
				$data[$i]['Attendance']['id'] = $att['attendances']['id'];

				if(empty($att['attendances']['timein'])){
					$data[$i]['Attendance']['remarks'] = 'A';
				}else{
					if($att['attendances']['timein'] <= '07:00:00'){
						$data[$i]['Attendance']['remarks'] = 'P';
					}else{
						$data[$i]['Attendance']['remarks'] = 'L';
					}
				}
				
				$i++;
			}
		}
		
		if(!empty($data)){
			if($this->Attendance->saveAll($data)){
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
		}else{
			$respanse['data'] = $data;
			$respanse['message'] = 'Empty data. No data to initialize!';
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
