<?php
class SectionsController extends AppController {

	var $name = 'Sections';
	var $helpers = array('Access');
	var $uses = array('Section','RfidStudent','Employee');

	function index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid section', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid section', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for section', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Section->delete($id)) {
			$this->Session->setFlash(__('Section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Section was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function all(){
		$sections = $this->Section->find('all');
		echo json_encode($sections);
		exit;
	}
	
	function loading(){
		
		
		$data = array();
		if(!empty($this->data)){
			$i=0;
			foreach($this->data['Section']['section_id'] as $d ){
				$data[$i]['Section']['employee_number'] = $this->data['Section']['employee_number'];
				$data[$i]['Section']['id'] = $d;
				$i++;
			}
			pr($data);exit;
			if ($this->Section->saveAll($data)) {
				$this->Session->setFlash(__('The section has been assigned', true));
				$this->redirect(array('action' => 'loading'));
			
			}
			
		}
		/*
		$employees = $this->RfidStudent->find('list',array(
													'conditions'=>array('RfidStudent.type'=>2),
													'fields'=>array('RfidStudent.employee_number','RfidStudent.full_name'),
												));*/
												
		$employees = $this->Employee->find('list',array(
													'fields'=>array('Employee.employee_no','Employee.full_name'),
												));										
												
		//pr($employees);exit;
		$sections = $this->Section->find('list');
		$this->set(compact('sections','employees'));
		
	}
	
	 function force_section_load(){
		 
		$employees = $this->Employee->find('all');									
							//pr($employees);exit;								
		$sections = $this->Section->find('all');
		
		$data = array();
		$i=0;
		foreach($employees as $emp){
			//pr($emp);exit;
			foreach($sections as $sec){
				
				if($emp['Employee']['sectioncode'] == $sec['Section']['id']){
				
					$data[$i]['Section']['id'] = $sec['Section']['id']; 
					$data[$i]['Section']['employee_number'] = $emp['Employee']['employee_no']; 
					$i++;
				}
			}
			
		}
		//pr($data);exit;
		if($this->Section->saveAll($data)){
			echo json_encode($data);
			exit;
		}
		 
	 }
}
