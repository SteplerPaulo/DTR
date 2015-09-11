<?php
/* Attendances Test cases generated on: 2015-09-10 12:49:46 : 1441882186*/
App::import('Controller', 'Attendances');

class TestAttendancesController extends AttendancesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AttendancesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.attendance');

	function startTest() {
		$this->Attendances =& new TestAttendancesController();
		$this->Attendances->constructClasses();
	}

	function endTest() {
		unset($this->Attendances);
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
