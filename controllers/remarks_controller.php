<?php
class RemarksController extends AppController {

	var $name = 'Remarks';

	function index() {
		$this->Remark->recursive = 0;
		$this->set('remarks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid remark', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('remark', $this->Remark->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Remark->create();
			if ($this->Remark->save($this->data)) {
				$this->Session->setFlash(__('The remark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid remark', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Remark->save($this->data)) {
				$this->Session->setFlash(__('The remark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Remark->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for remark', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Remark->delete($id)) {
			$this->Session->setFlash(__('Remark deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Remark was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Remark->recursive = 0;
		$this->set('remarks', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid remark', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('remark', $this->Remark->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Remark->create();
			if ($this->Remark->save($this->data)) {
				$this->Session->setFlash(__('The remark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid remark', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Remark->save($this->data)) {
				$this->Session->setFlash(__('The remark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Remark->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for remark', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Remark->delete($id)) {
			$this->Session->setFlash(__('Remark deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Remark was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function active(){
		$remarks = $this->Remark->find('all',array('conditions'=>array('Remark.is_active'=>1)));
		echo json_encode($remarks);
		exit;
	}
}
