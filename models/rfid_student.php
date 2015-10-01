<?php
class RfidStudent extends AppModel {
	var $name = 'RfidStudent';
	var $useDbConfig = 'gatekeeper';

	var $virtualFields = array(
		'full_name' => 'CONCAT(RfidStudent.first_name, ", " ,RfidStudent.last_name, " ",RfidStudent.middle_name, ".")',
		'type_string' =>"CASE RfidStudent.type
										WHEN '0' THEN 'New Student'
										WHEN '1' THEN 'Old Student'
										WHEN '2' THEN 'Employee'
									END "
	);

}
