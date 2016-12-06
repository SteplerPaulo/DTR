<?php
class RfidHistoriesController extends AppController {

	var $name = 'RfidHistories';
	var $helpers = array('Access');

	function index() {
		$this->RfidHistory->recursive = 0;
		$this->set('rfidHistories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rfid history', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rfidHistory', $this->RfidHistory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RfidHistory->create();
			if ($this->RfidHistory->save($this->data)) {
				$this->Session->setFlash(__('The rfid history has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid history could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid rfid history', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RfidHistory->save($this->data)) {
				$this->Session->setFlash(__('The rfid history has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rfid history could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RfidHistory->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for rfid history', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->RfidHistory->delete($id)) {
			$this->Session->setFlash(__('Rfid history deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Rfid history was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
