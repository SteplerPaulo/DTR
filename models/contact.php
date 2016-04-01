<?php
class Contact extends AppModel {
	var $name = 'Contact';
	var $useDbConfig = 'gatekeeper';
		
		var $virtualFields = array(
				'is_selected' => 'false',
			);
}
