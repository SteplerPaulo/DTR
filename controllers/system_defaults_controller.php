<?php
class SystemDefaultsController extends AppController {

	var $name = 'SystemDefaults';

	function index() {
		$this->SystemDefault->recursive = 0;
		$this->set('systemDefaults', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid system default', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('systemDefault', $this->SystemDefault->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SystemDefault->create();
			if ($this->SystemDefault->save($this->data)) {
				$this->Session->setFlash(__('The system default has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The system default could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid system default', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SystemDefault->save($this->data)) {
				$this->Session->setFlash(__('The system default has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The system default could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SystemDefault->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for system default', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SystemDefault->delete($id)) {
			$this->Session->setFlash(__('System default deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('System default was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	

	
}
