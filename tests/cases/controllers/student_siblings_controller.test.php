<?php
/* StudentSiblings Test cases generated on: 2015-03-03 14:02:03 : 1425387723*/
App::import('Controller', 'StudentSiblings');

class TestStudentSiblingsController extends StudentSiblingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StudentSiblingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.student_sibling', 'app.student', 'app.educ_level', 'app.year_level', 'app.student_personal_information', 'app.inquiry', 'app.religion', 'app.user', 'app.document', 'app.citizenship', 'app.student_academic_information', 'app.student_relative');

	function startTest() {
		$this->StudentSiblings =& new TestStudentSiblingsController();
		$this->StudentSiblings->constructClasses();
	}

	function endTest() {
		unset($this->StudentSiblings);
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
