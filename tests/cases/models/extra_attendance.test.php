<?php
/* ExtraAttendance Test cases generated on: 2015-09-10 07:35:35 : 1441863335*/
App::import('Model', 'ExtraAttendance');

class ExtraAttendanceTestCase extends CakeTestCase {
	function startTest() {
		$this->ExtraAttendance =& ClassRegistry::init('ExtraAttendance');
	}

	function endTest() {
		unset($this->ExtraAttendance);
		ClassRegistry::flush();
	}

}
