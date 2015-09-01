<?php
/* StudentSibling Test cases generated on: 2015-03-03 13:58:59 : 1425387539*/
App::import('Model', 'StudentSibling');

class StudentSiblingTestCase extends CakeTestCase {
	var $fixtures = array('app.student_sibling', 'app.student', 'app.educ_level', 'app.year_level', 'app.student_personal_information', 'app.inquiry', 'app.religion', 'app.user', 'app.document', 'app.citizenship', 'app.student_academic_information', 'app.student_relative');

	function startTest() {
		$this->StudentSibling =& ClassRegistry::init('StudentSibling');
	}

	function endTest() {
		unset($this->StudentSibling);
		ClassRegistry::flush();
	}

}
