<?php
class RfidStudentsController extends AppController {

	var $name = 'RfidStudents';
	var $helpers = array('Access');

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
}
