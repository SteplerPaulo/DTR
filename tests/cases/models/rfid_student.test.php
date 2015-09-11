<?php
/* RfidStudent Test cases generated on: 2015-09-10 08:08:03 : 1441865283*/
App::import('Model', 'RfidStudent');

class RfidStudentTestCase extends CakeTestCase {
	var $fixtures = array('app.rfid_student');

	function startTest() {
		$this->RfidStudent =& ClassRegistry::init('RfidStudent');
	}

	function endTest() {
		unset($this->RfidStudent);
		ClassRegistry::flush();
	}

}
