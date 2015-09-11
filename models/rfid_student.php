<?php
class RfidStudent extends AppModel {
	var $name = 'RfidStudent';
	var $useDbConfig = 'gatekeeper';

	var $virtualFields = array(
		'full_name' => 'CONCAT(RfidStudent.last_name, ", ", RfidStudent.first_name," ",RfidStudent.middle_name)'
	);

}
