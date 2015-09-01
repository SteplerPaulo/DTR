<?php
/* SchoolYear Test cases generated on: 2015-02-11 00:54:47 : 1423612487*/
App::import('Model', 'SchoolYear');

class SchoolYearTestCase extends CakeTestCase {
	var $fixtures = array('app.school_year');

	function startTest() {
		$this->SchoolYear =& ClassRegistry::init('SchoolYear');
	}

	function endTest() {
		unset($this->SchoolYear);
		ClassRegistry::flush();
	}

}
