<?php
/* Keyword Test cases generated on: 2016-03-07 06:20:00 : 1457331600*/
App::import('Model', 'Keyword');

class KeywordTestCase extends CakeTestCase {
	var $fixtures = array('app.keyword');

	function startTest() {
		$this->Keyword =& ClassRegistry::init('Keyword');
	}

	function endTest() {
		unset($this->Keyword);
		ClassRegistry::flush();
	}

}
