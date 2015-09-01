<?php
/* StudentRelatives Test cases generated on: 2015-02-04 08:08:47 : 1423033727*/
App::import('Controller', 'StudentRelatives');

class TestStudentRelativesController extends StudentRelativesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StudentRelativesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.student_relative', 'app.student', 'app.educ_level', 'app.year_level', 'app.student_personal_information', 'app.inquiry', 'app.religion', 'app.user', 'app.document', 'app.citizenship', 'app.student_academic_information');

	function startTest() {
		$this->StudentRelatives =& new TestStudentRelativesController();
		$this->StudentRelatives->constructClasses();
	}

	function endTest() {
		unset($this->StudentRelatives);
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
