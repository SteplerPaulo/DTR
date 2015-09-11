<?php
/* SchoolYears Test cases generated on: 2015-09-10 08:36:55 : 1441867015*/
App::import('Controller', 'SchoolYears');

class TestSchoolYearsController extends SchoolYearsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchoolYearsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.school_year');

	function startTest() {
		$this->SchoolYears =& new TestSchoolYearsController();
		$this->SchoolYears->constructClasses();
	}

	function endTest() {
		unset($this->SchoolYears);
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
