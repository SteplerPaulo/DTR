<?php
/* RegularAttendance Test cases generated on: 2015-09-10 07:35:07 : 1441863307*/
App::import('Model', 'RegularAttendance');

class RegularAttendanceTestCase extends CakeTestCase {
	function startTest() {
		$this->RegularAttendance =& ClassRegistry::init('RegularAttendance');
	}

	function endTest() {
		unset($this->RegularAttendance);
		ClassRegistry::flush();
	}

}
