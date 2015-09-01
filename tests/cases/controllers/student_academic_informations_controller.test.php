<?php
/* StudentAcademicInformations Test cases generated on: 2015-02-11 01:09:13 : 1423613353*/
App::import('Controller', 'StudentAcademicInformations');

class TestStudentAcademicInformationsController extends StudentAcademicInformationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StudentAcademicInformationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.student_academic_information', 'app.student', 'app.educ_level', 'app.year_level', 'app.student_personal_information', 'app.inquiry', 'app.religion', 'app.user', 'app.document', 'app.citizenship', 'app.student_relative');

	function startTest() {
		$this->StudentAcademicInformations =& new TestStudentAcademicInformationsController();
		$this->StudentAcademicInformations->constructClasses();
	}

	function endTest() {
		unset($this->StudentAcademicInformations);
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
