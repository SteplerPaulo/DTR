<?php
class FetcherRfidStudentsController extends AppController {

	var $name = 'FetcherRfidStudents';
	var $helpers = array('Access');

	function index() {
		$this->FetcherRfidStudent->recursive = 0;
		$this->set('fetcherRfidStudents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fetcher rfid student', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fetcherRfidStudent', $this->FetcherRfidStudent->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FetcherRfidStudent->create();
			if ($this->FetcherRfidStudent->save($this->data)) {
				$this->Session->setFlash(__('The fetcher rfid student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fetcher rfid student could not be saved. Please, try again.', true));
			}
		}
		$fetchers = $this->FetcherRfidStudent->Fetcher->find('list');
		$rfidStudents = $this->FetcherRfidStudent->RfidStudent->find('list');
		$this->set(compact('fetchers', 'rfidStudents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fetcher rfid student', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FetcherRfidStudent->save($this->data)) {
				$this->Session->setFlash(__('The fetcher rfid student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fetcher rfid student could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FetcherRfidStudent->read(null, $id);
		}
		$fetchers = $this->FetcherRfidStudent->Fetcher->find('list');
		$rfidStudents = $this->FetcherRfidStudent->RfidStudent->find('list');
		$this->set(compact('fetchers', 'rfidStudents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fetcher rfid student', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FetcherRfidStudent->delete($id)) {
			$this->Session->setFlash(__('Fetcher rfid student deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fetcher rfid student was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function save(){
	
		
		if (!empty($this->data)) {
			$this->FetcherRfidStudent->deleteAll(array ("FetcherRfidStudent.source_rfid" => $this->data['FetcherRfidStudent']['source_rfid']));
			
			$source_rfid = $this->data['FetcherRfidStudent']['source_rfid'];
			if(strlen($source_rfid) <= 8){
				$dec = hexdec ($source_rfid);
				$octal = decoct($dec);
				if(strlen($dec) == 7){
					$dec = '000'.$dec;
				}else if(strlen($dec) == 8){
					$dec = '00'.$dec;
				}else if(strlen($dec) == 9){
					$dec = '0'.$dec;
				}
			}else{
				$octal = decoct($source_rfid);
				$dec = $source_rfid;
				if(strlen($dec) == 7){
					$dec = '000'.$dec;
				}else if(strlen($dec) == 8){
					$dec = '00'.$dec;
				}else if(strlen($dec) == 9){
					$dec = '0'.$dec;
				}
			}
			
			$data = array();
			$i = 0;
			foreach($this->data['Fetcher'] as $fecther){
				foreach($this->data['Student'] as $student){
					$data[$i]['FetcherRfidStudent']['fetcher_id'] = $fecther['fetcher_id'];
					$data[$i]['FetcherRfidStudent']['rfid_student_id'] = $student['rfid_student_id'];
					$data[$i]['FetcherRfidStudent']['source_rfid'] = $source_rfid;
					$data[$i]['FetcherRfidStudent']['rfid'] = $octal;
					$data[$i]['FetcherRfidStudent']['dec_rfid'] = $dec;
				
					$i++;
				}
			}
		
			$this->FetcherRfidStudent->create();
			if ($this->FetcherRfidStudent->saveAll($data)) {
				$this->Session->setFlash(__('The fetcher rfid student has been saved', true));
				$this->redirect(array('action' => '../fetchers/assigning'));
			} else {
				$this->Session->setFlash(__('The fetcher rfid student could not be saved. Please, try again.', true));
			}
		}
	}
}
