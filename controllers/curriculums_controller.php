<?php
class CurriculumsController extends AppController {

	var $name = 'Curriculums';
	var $helpers = array('Access');

	function index() {
		$this->Curriculum->recursive = 0;
		$this->set('curriculums', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curriculum', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curriculum', $this->Curriculum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Curriculum->create();
			if ($this->Curriculum->save($this->data)) {
				$this->Session->setFlash(__('The curriculum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curriculum', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Curriculum->save($this->data)) {
				$this->Session->setFlash(__('The curriculum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curriculum could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Curriculum->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curriculum', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Curriculum->delete($id)) {
			$this->Session->setFlash(__('Curriculum deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curriculum was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
