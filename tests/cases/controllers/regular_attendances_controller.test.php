<?php
/* RegularAttendances Test cases generated on: 2015-09-10 07:39:29 : 1441863569*/
App::import('Controller', 'RegularAttendances');

class TestRegularAttendancesController extends RegularAttendancesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RegularAttendancesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.regular_attendance');

	function startTest() {
		$this->RegularAttendances =& new TestRegularAttendancesController();
		$this->RegularAttendances->constructClasses();
	}

	function endTest() {
		unset($this->RegularAttendances);
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
