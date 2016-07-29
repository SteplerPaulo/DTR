<?php
/* FetcherRfidStudents Test cases generated on: 2016-07-13 13:38:59 : 1468417139*/
App::import('Controller', 'FetcherRfidStudents');

class TestFetcherRfidStudentsController extends FetcherRfidStudentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FetcherRfidStudentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.fetcher_rfid_student', 'app.fetcher', 'app.rfid_student');

	function startTest() {
		$this->FetcherRfidStudents =& new TestFetcherRfidStudentsController();
		$this->FetcherRfidStudents->constructClasses();
	}

	function endTest() {
		unset($this->FetcherRfidStudents);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
