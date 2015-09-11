<?php
/* RfidStudents Test cases generated on: 2015-09-10 08:14:24 : 1441865664*/
App::import('Controller', 'RfidStudents');

class TestRfidStudentsController extends RfidStudentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RfidStudentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.rfid_student');

	function startTest() {
		$this->RfidStudents =& new TestRfidStudentsController();
		$this->RfidStudents->constructClasses();
	}

	function endTest() {
		unset($this->RfidStudents);
		ClassRegistry::flush();
	}

}
