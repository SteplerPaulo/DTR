<?php
class FetcherDocumentsController extends AppController {

	var $name = 'FetcherDocuments';
	var $helpers = array('Access');

	function index() {
		$this->FetcherDocument->recursive = 0;
		$this->set('fetcherDocuments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fetcher document', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fetcherDocument', $this->FetcherDocument->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FetcherDocument->create();
			if ($this->FetcherDocument->save($this->data)) {
				$this->Session->setFlash(__('The fetcher document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fetcher document could not be saved. Please, try again.', true));
			}
		}
		$fetchers = $this->FetcherDocument->Fetcher->find('list');
		$this->set(compact('fetchers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fetcher document', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FetcherDocument->save($this->data)) {
				$this->Session->setFlash(__('The fetcher document has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fetcher document could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FetcherDocument->read(null, $id);
		}
		$fetchers = $this->FetcherDocument->Fetcher->find('list');
		$this->set(compact('fetchers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fetcher document', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FetcherDocument->delete($id)) {
			$this->Session->setFlash(__('Fetcher document deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fetcher document was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
