<?php
class ImagesController extends AppController {

	var $name = 'Images';
	var $helpers = array('Access');
	var $uses = array('Image','RfidStudent');

	function index() {
		$this->Image->recursive = 0;
		$this->set('images', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('image', $this->Image->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Image->create();
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Image->save($this->data)) {
				$this->Session->setFlash(__('The image has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Image->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for image', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function tagging(){
		
	}
	
	function savetag(){
		$data = $this->data;
		//pr($data);exit;
		if ($this->Image->save($data)) {
			$data['status'] = 1;
			$data['message'] = 'Saved!';
			
			
			echo json_encode($data);
			exit;
		}else{
			$data['status'] = 0;
			$data['message'] = 'Error!';
			echo json_encode($data);
			exit;
		}
		
	}
	
	function notag(){
		$data = $this->Image->find('all',array(
								'conditions'=>array(
									'OR' => array(
												array('Image.source_rfid' => null),
												array('Image.source_rfid = ""')
											),
										)
									));
		echo json_encode($data);
		exit;
	}
	
	function withtag(){
		//BIND
		/*
		$this->Image->bindModel(
			array('belongsTo' => array(
					'RfidStudent' => array(
						'className' => 'RfidStudent',
						'foreignKey' => false,
						'conditions' => array('Image.source_rfid' => 'RfidStudent.source_rfid')
					)
				)
			)
		);
		*/
		//UNBIND
		//$this->RfidStudent->unbindModel(array(
			//'hasAndBelongsToMany' => array('Fetcher'),
			//'belongsTo' => array('Level','Section'),
		//));
		
		
		
		$data = $this->Image->find('all', array(
								'conditions' => array(
									'OR' => array(
												array(
													array('NOT' => array('Image.source_rfid' => null)),
													array('NOT' => array('Image.source_rfid = "" ')),
												),
											)
										)
									));
									
																		
		echo json_encode($data);
		exit;
	}
	
	function student_list(){
		$students = $this->RfidStudent->find('all');
		
		
		$data = array();
		foreach($students as $student){
			$obj = array(
				//'id'=>$student['RfidStudent']['id'],
				'source_rfid'=>$student['RfidStudent']['source_rfid'],
				'name'=>$student['RfidStudent']['first_name'].' '.$student['RfidStudent']['last_name'],
			);
			array_push($data,$obj);
		}
		

		echo json_encode($data);
		exit;
	}
	
	//Save new img_path on images table
	//Note: Check if new image has a duplicated data on an existing images folder  
	function init_new_images(){
		die("You're not Authorize to access this page");
	
		$folders = glob('C:/Users/Paulo/Pictures/Additional Pics NCS/*', GLOB_BRACE);

		$data = array();
		$i=0;
		foreach($folders as $fdr){
			$folderImages = glob($fdr.'/*.{jpg,JPG}', GLOB_BRACE);
			
			if(!empty($folderImages)){
				
				foreach($folderImages as $images){
					$img = explode("/",$images);
					$data[$i++]['Image']['img_path']  = $img[5].'/'.$img[6];
					
				}
			}
			
		}
		//pr($data);exit;
		//$this->Image->create();
		if ($this->Image->saveAll($data)) {
			$data['status'] = 1;
			$data['message'] = 'Saved!';
			echo json_encode($data);
			exit;
		}else{
			$data['status'] = 0;
			$data['message'] = 'Error!';
			echo json_encode($data);
			exit;
		}
	}
	
	
}
