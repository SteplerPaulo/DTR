<?php
class MessageOutsController extends AppController {

	var $name = 'MessageOuts';
	var $helpers = array('Access');

	function index() {
		$this->MessageOut->recursive = 0;
		$this->set('messageOuts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid message out', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('messageOut', $this->MessageOut->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MessageOut->create();
			if ($this->MessageOut->save($this->data)) {
				$this->Session->setFlash(__('The message out has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message out could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid message out', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MessageOut->save($this->data)) {
				$this->Session->setFlash(__('The message out has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message out could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MessageOut->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for message out', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MessageOut->delete($id)) {
			$this->Session->setFlash(__('Message out deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Message out was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function all(){
		$data = $this->MessageOut->find('all',
				array(
					'recursive' => 0,
				
				));
				
		echo json_encode($data);
		exit;
	}
	
	function create_message(){

		
	}
	
	function send_message(){
		
		if(!empty($this->data)){
			$this->data['MessageOut']['MessageFrom'] = '09181234567';
				
			if($this->MessageOut->save($this->data)){
				echo json_encode($this->data);
				exit;
			}
			
		}
	}
}
