<?php
class Employee extends AppModel {
	var $name = 'Employee';
	var $useDbConfig = 'gatekeeper';

	var $virtualFields = array(
		'full_name' => 'CONCAT(Employee.first_name, ", " ,Employee.last_name, " ",Employee.middle_name)',
		'has_rfid_string' =>"CASE Employee.has_rfid
										WHEN '0' THEN 'False'
										WHEN '1' THEN 'True'
									END "
	);
}
