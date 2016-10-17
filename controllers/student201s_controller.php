<?php
class Student201sController extends AppController {

	var $name = 'Student201s';
	var $helpers = array('Access');
	var $uses = array('Student201','Section','Level');

	function index() {
		$this->Student201->recursive = 0;
		$this->set('student201s', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid student201', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('student201', $this->Student201->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->data['Student201']['mobile'] = '+63'.$this->data['Student201']['mobile'];
			$this->data['Student201']['primary_mobile_no'] = '+63'.$this->data['Student201']['primary_mobile_no'];
			
			if ($this->Student201->save($this->data)) {
				//$this->Session->setFlash(__('The student201 has been saved', true));
				$this->redirect(array('action' => 'success/'.$this->Student201->id));
			} else {
				$this->Session->setFlash(__('The student201 could not be saved. Please, try again.', true));
			}
		}
		
		$relationships = array('Parent'=>'Parent','Guardian'=>'Guardian');
		$levels = $this->Level->find('all');
		$sections = $this->Section->find('all');
		$genders = array('M'=>'Male','F'=>'Female');
		//pr($levels );exit;
		$this->set(compact('relationships','sections','levels','genders'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid student201', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Student201']['mobile'] = '+63'.$this->data['Student201']['mobile'];
			$this->data['Student201']['primary_mobile_no'] = '+63'.$this->data['Student201']['primary_mobile_no'];
			
			if ($this->Student201->save($this->data)) {
				$this->Session->setFlash(__('The student201 has been updated', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student201 could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Student201->read(null, $id);
		}
		
		
		
		$relationships = array('Parent'=>'Parent','Guardian'=>'Guardian');
		$levels = $this->Level->find('list');
		$sections = $this->Section->find('list');
		$genders = array('M'=>'Male','F'=>'Female');
		
		$this->set(compact('relationships','sections','levels','genders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for student201', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Student201->delete($id)) {
			$this->Session->setFlash(__('Student201 deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Student201 was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

		
	function all(){
		$students = $this->Student201->find('all');
		echo json_encode($students);
		exit;
	}
	
	function find_by_student_no(){
		$response = $this->Student201->findByStudentNumber($this->data['Student']['student_number']);
		echo json_encode($response);
		exit();
	}
	
	function success($id  = null){
		
		$student = $this->Student201->findById($id);
		$this->set(compact('student'));
	}
	
	 function onSaveData(){
		 
		 
	 }
	
}
