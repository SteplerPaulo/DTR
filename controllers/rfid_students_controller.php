<?php
class RfidStudentsController extends AppController {

	var $name = 'RfidStudents';
	var $helpers = array('Access');
	var $uses = array('RfidStudent','Section','SchoolYear','Level','Student201','Employee','RfidHistory');

	function index() {
		$this->paginate = array(
			'conditions' => array('RfidStudent.type' => '1'),
			'recursive' => 0,
			'limit' => 8,
		);
		$this->set('rfidStudents', $this->paginate('RfidStudent'));
	}
	
	function students(){
		$students = $this->RfidStudent->find('all',
				array(
					'conditions'=>array('RfidStudent.type' => '1'),
					'recursive' => 0,
				
				));
				
		echo json_encode($students);
		exit;
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rfid student', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rfidStudent', $this->RfidStudent->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RfidStudent->create();
			if ($this->RfidStudent->save($this->data)) {
				$this->Session->setFlash(__('The rfid student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid student could not be saved. Please, try again.', true));
			}
		}
		$employees = $this->RfidStudent->Employee->find('list');
		$this->set(compact('employees'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid rfid student', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RfidStudent->save($this->data)) {
				$this->Session->setFlash(__('The rfid student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid student could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RfidStudent->read(null, $id);
		}
		//$employees = $this->RfidStudent->Employee->find('list');
		//$this->set(compact('employees'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for rfid student', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->RfidStudent->delete($id)) {
			$this->Session->setFlash(__('Rfid student deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Rfid student was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function assign(){
		$relationships = array('Parent'=>'Parent','Guardian'=>'Guardian');
		$levels = $this->Level->find('list');
		$sections = $this->Section->find('list');
		$sy = $this->SchoolYear->find('list',array('conditions'=>array('SchoolYear.is_default'=>1)));
		
		$this->set(compact('relationships','sections','sy','levels'));
	}
	
	function save(){
		$rfid = $this->data['RfidStudent']['source_rfid'];
		if(strlen($rfid) <= 8){
			$dec = hexdec ($rfid);
			$octal = decoct($dec);
			
			if(strlen($dec) == 7){
				$dec = '000'.$dec;
			}else if(strlen($dec) == 8){
				$dec = '00'.$dec;
			}else if(strlen($dec) == 9){
				$dec = '0'.$dec;
			}
		
			
		}else{
			$octal = decoct($rfid);
			$dec = $rfid;
			if(strlen($dec) == 7){
				$dec = '000'.$dec;
			}else if(strlen($dec) == 8){
				$dec = '00'.$dec;
			}else if(strlen($dec) == 9){
				$dec = '0'.$dec;
			}
		}
		$this->data['RfidStudent']['rfid']= $octal;
		$this->data['RfidStudent']['dec_rfid']= $dec;
		
	
		//MOBILE NO FORMAT
		if(isset($this->data['Employee'])){
			$this->data['RfidStudent']['employee_mobile_no'] = '+63'.$this->data['RfidStudent']['employee_mobile_no'];
			$this->data['RfidStudent']['emergency_contact_no'] = '+63'.$this->data['RfidStudent']['emergency_contact_no'];
		}
		if(isset($this->data['Student201'])){
			$this->data['RfidStudent']['student_mobile_no'] = '+63'.$this->data['RfidStudent']['student_mobile_no'];
			$this->data['RfidStudent']['guardian_mobile_no'] = '+63'.$this->data['RfidStudent']['guardian_mobile_no'];
		}
		
		

		
		
		
		if($this->RfidStudent->save($this->data)){
			//UPDATE EMPLOYEE 201
			if(isset($this->data['Employee'])){
				$this->data['Employee']['has_rfid'] = 1;
				$this->Employee->save($this->data['Employee']);
			}
			//UPDATE STUDENT 201
			if(isset($this->data['Student201'])){
				$this->data['Student201']['has_rfid'] = 1;
				$this->Student201->save($this->data['Student201']);
			}
			
			//CREATE RFID HISTORY
			$history['RfidHistory'] = $this->data['RfidStudent'];
			unset($history['RfidHistory']['id']);
			
			if($this->RfidHistory->save($history)){
				//REDIRECT ON SUCCESS PAGE
				$this->Session->setFlash(__('Saving successful!', true));
				$this->redirect(array('action' => 'success'));
			
			}else{
				//REDIRECT ON ERROR PAGE
				$this->Session->setFlash(__('Error on saving rfid history! Pls. contact system administrator.', true));
				$this->redirect(array('action' => 'error'));
			}
			
		}else{
			//REDIRECT ON ERROR PAGE
			$this->Session->setFlash(__("Error on assigning RFID! Pls. contact system administrator.", true));
			$this->redirect(array('action' => 'error'));
		}
		
	}

	function check_rfid(){
		/*
		if(isset($this->data['source_rfid'])){
			$conditions = array('RfidStudent.source_rfid'=>$this->data['source_rfid']);
		}else if(isset($this->data['student_number'])){
			$conditions = array('RfidStudent.student_number'=>$this->data['student_number']);
		}else if(isset($this->data['user_id'])){
			$conditions = array('RfidStudent.employee_number'=>$this->data['user_id']);
		}else if(isset($this->data['employee_no'])){
			$conditions = array('RfidStudent.employee_number'=>$this->data['employee_no']);
		}else if(isset($this->data['new_rfid'])){
			$conditions = array('RfidStudent.source_rfid'=>$this->data['new_rfid']);
		}
		*/
		
		$conditions = array('RfidStudent.source_rfid'=>$this->data['RfidStudent']['source_rfid']);
		
		$response = $this->RfidStudent->find('first',array('conditions'=>$conditions));
		echo json_encode($response);
		exit();
	}	
	
	function success(){
		
		$relationships = array('Parent'=>'Parent','Guardian'=>'Guardian');
		$sections = $this->Section->find('list');

		$this->set(compact('relationships','sections'));
		
		
	}
	
	function error(){
		
	}

	function check_by_student_number(){
		$response = $this->RfidStudent->findByStudentNumber($this->data['student_number']);
		echo json_encode($response);
		exit();
	}
	
	function check_by_employee_number(){
		
		$response = $this->RfidStudent->findByEmployeeNumber($this->data['employee_number']);
		echo json_encode($response);
		exit();
	}
	
}
