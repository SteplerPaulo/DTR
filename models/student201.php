<?php
class Student201 extends AppModel {
	var $name = 'Student201';
	var $useDbConfig = 'gatekeeper';

	
	var $virtualFields = array(
		'full_name' => 'CONCAT(Student201.first_name, ", " ,Student201.last_name, " ",Student201.middle_name)',
		'has_rfid_string' =>"CASE Student201.has_rfid
										WHEN '0' THEN 'False'
										WHEN '1' THEN 'True'
									END "
	);
	

}