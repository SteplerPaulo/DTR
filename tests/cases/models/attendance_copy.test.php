<?php
/* AttendanceCopy Test cases generated on: 2015-10-30 11:05:12 : 1446203112*/
App::import('Model', 'AttendanceCopy');

class AttendanceCopyTestCase extends CakeTestCase {
	var $fixtures = array('app.attendance_copy');

	function startTest() {
		$this->AttendanceCopy =& ClassRegistry::init('AttendanceCopy');
	}

	function endTest() {
		unset($this->AttendanceCopy);
		ClassRegistry::flush();
	}

}
