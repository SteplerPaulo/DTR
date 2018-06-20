<?php
/* Image Test cases generated on: 2018-06-19 10:13:12 : 1529374392*/
App::import('Model', 'Image');

class ImageTestCase extends CakeTestCase {
	var $fixtures = array('app.image', 'app.rfid_student', 'app.level', 'app.section', 'app.fetcher', 'app.fetcher_document', 'app.fetcher_rfid_student');

	function startTest() {
		$this->Image =& ClassRegistry::init('Image');
	}

	function endTest() {
		unset($this->Image);
		ClassRegistry::flush();
	}

}
