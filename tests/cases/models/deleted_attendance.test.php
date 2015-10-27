<?php
/* DeletedAttendance Test cases generated on: 2015-10-27 09:36:33 : 1445938593*/
App::import('Model', 'DeletedAttendance');

class DeletedAttendanceTestCase extends CakeTestCase {
	var $fixtures = array('app.deleted_attendance');

	function startTest() {
		$this->DeletedAttendance =& ClassRegistry::init('DeletedAttendance');
	}

	function endTest() {
		unset($this->DeletedAttendance);
		ClassRegistry::flush();
	}

}
