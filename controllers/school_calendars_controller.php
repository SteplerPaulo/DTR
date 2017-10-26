<?php
class SchoolCalendarsController extends AppController {

	var $name = 'SchoolCalendars';
	var $helpers = array('Access');
	var $uses = array('SchoolCalendar','Level');

	function index() {
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid school calendar', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schoolCalendar', $this->SchoolCalendar->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			
			$data = array();
			foreach($this->data['SchoolCalendar']['levels'] as $k => $d){
				$data[$k]['SchoolCalendar'] = array(
								'school_year_id'=>$this->data['SchoolCalendar']['school_year_id'],
								'curriculum_id'=>$this->data['SchoolCalendar']['curriculum_id'],
								'period_id'=>$this->data['SchoolCalendar']['period_id'],
								'date_from'=>$this->data['SchoolCalendar']['date_from'],
								'date_to'=>$this->data['SchoolCalendar']['date_to'],
								'level_id'=>$d,
							);
			}
			
			$this->SchoolCalendar->create();
			if ($this->SchoolCalendar->saveAll($data)) {
				$data['status'] = true;
				echo json_encode($data);
				exit;
				
			} else {
				$data['status'] = false;
				echo json_encode($data);
				exit;
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid school calendar.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->SchoolCalendar->save($this->data)) {
				$this->Session->setFlash(__('The school calendar has been updated', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school calendar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SchoolCalendar->read(null, $id);
			//pr($this->data);exit;
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for school calendar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SchoolCalendar->delete($id)) {
			$this->Session->setFlash(__('School calendar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('School calendar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function set_init_data(){
		
		$data = array();
		$data['school_years'] = $this->SchoolCalendar->SchoolYear->find('all',array('recursive'=>0,'order' => array('SchoolYear.id' => 'DESC')));
		$data['curriculums'] = $this->SchoolCalendar->Curriculum->find('all',array('recursive'=>0));
		$data['periods'] = $this->SchoolCalendar->Period->find('all',array('recursive'=>0));
		$data['levels'] = $this->Level->find('all',array('recursive'=>0,'order'=>'index_order'));
		echo json_encode($data);
		exit;
		
	}
	
	function index_init_data(){
		$data = array();
		$data['school_years'] = $this->SchoolCalendar->SchoolYear->find('all',array('recursive'=>0,'order' => array('SchoolYear.id' => 'DESC')));
		echo json_encode($data);
		exit;
		
	}
	
	
	function sy_data(){
		$school_years = $this->SchoolCalendar->SchoolYear->find('all',array('recursive'=>0,'order' => array('SchoolYear.id' => 'DESC')));
		$levels = $this->Level->find('all',array('recursive'=>0,'order'=>'index_order'));
		
		$school_calendars = $this->SchoolCalendar->find('all',array(
											"group" => array(
												"SchoolCalendar.school_year_id", 
												"SchoolCalendar.period_id", 
												"SchoolCalendar.level_id"
											)));
		$data = array();
		foreach($levels as $lvl){
			//$data[$lvl['Level']['name']] = null;
			foreach($school_calendars as $sc){
				if($lvl['Level']['id'] == $sc['SchoolCalendar']['level_id']){
					$data[$lvl['Level']['name']][$sc['SchoolCalendar']['period_id']] = $sc['SchoolCalendar'];
				}
			}
		}
		echo json_encode($data);
		exit;
	 }
	
}
