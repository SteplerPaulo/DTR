<?php
class RfidStudent extends AppModel {
	var $name = 'RfidStudent';
	var $useDbConfig = 'gatekeeper';

	var $virtualFields = array(
		'full_name' => 'CONCAT(RfidStudent.first_name, ", " ,RfidStudent.last_name, " ",RfidStudent.middle_name, ".")'
	);

}
