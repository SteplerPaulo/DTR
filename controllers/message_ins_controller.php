<?php
class MessageInsController extends AppController {

	var $name = 'MessageIns';
	var $helpers = array('Access');

	function index() {
		$this->MessageIn->recursive = 0;
		$this->set('messageIns', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid message in', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('messageIn', $this->MessageIn->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MessageIn->create();
			if ($this->MessageIn->save($this->data)) {
				$this->Session->setFlash(__('The message in has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message in could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid message in', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MessageIn->save($this->data)) {
				$this->Session->setFlash(__('The message in has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message in could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MessageIn->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for message in', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MessageIn->delete($id)) {
			$this->Session->setFlash(__('Message in deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Message in was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function all(){
		$data = $this->MessageIn->find('all',
				array(
					'recursive' => 0,
				
				));
				
		echo json_encode($data);
		exit;
	}
}
