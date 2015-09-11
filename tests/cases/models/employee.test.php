<?php
/* Employee Test cases generated on: 2015-09-10 07:58:26 : 1441864706*/
App::import('Model', 'Employee');

class EmployeeTestCase extends CakeTestCase {
	var $fixtures = array('app.employee');

	function startTest() {
		$this->Employee =& ClassRegistry::init('Employee');
	}

	function endTest() {
		unset($this->Employee);
		ClassRegistry::flush();
	}

}
