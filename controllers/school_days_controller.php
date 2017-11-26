<?php
class SchoolDaysController extends AppController {

	var $name = 'SchoolDays';
	var $helpers = array('Access');
	var $uses = array('SchoolDay','SchoolCalendar');

	function index() {
		$this->SchoolDay->recursive = 0;
		$this->set('schoolDays', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid school day', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schoolDay', $this->SchoolDay->read(null, $id));
	}

	function add($school_calendar_id = null) {
		//$data =  array('school_calendar_id'=>$school_calendar_id);
		//pr($school_calendar_id);
		//echo json_encode($data);
		//exit;
		if (!empty($this->data)) {
			//pr($this->data);
			//exit;
			
			
			$this->SchoolDay->create();
			if ($this->SchoolDay->saveAll($this->data)) {
				$this->data['status'] = true;
				echo json_encode($this->data);
				exit;
			} else {
				$this->data['status'] = false;
				echo json_encode($this->data);
				exit;
			}
		}
		//$schoolCalendars = $this->SchoolDay->SchoolCalendar->find('list');
		//$this->set(compact('schoolCalendars'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid school day', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SchoolDay->save($this->data)) {
				$this->Session->setFlash(__('The school day has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school day could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SchoolDay->read(null, $id);
		}
		$schoolCalendars = $this->SchoolDay->SchoolCalendar->find('list');
		$this->set(compact('schoolCalendars'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for school day', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SchoolDay->delete($id)) {
			$this->Session->setFlash(__('School day deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('School day was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function calendar(){
		$data = $this->SchoolCalendar->find('first',array('conditions'=>array('SchoolCalendar.id'=>$this->data)));
		echo json_encode($data);
		exit;
	}
}
