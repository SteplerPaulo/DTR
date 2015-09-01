<?php
/* StudentAcademicInformation Test cases generated on: 2015-02-11 01:08:43 : 1423613323*/
App::import('Model', 'StudentAcademicInformation');

class StudentAcademicInformationTestCase extends CakeTestCase {
	var $fixtures = array('app.student_academic_information', 'app.student', 'app.educ_level', 'app.year_level', 'app.student_personal_information', 'app.inquiry', 'app.religion', 'app.user', 'app.document', 'app.citizenship', 'app.student_relative');

	function startTest() {
		$this->StudentAcademicInformation =& ClassRegistry::init('StudentAcademicInformation');
	}

	function endTest() {
		unset($this->StudentAcademicInformation);
		ClassRegistry::flush();
	}

}
