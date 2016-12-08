<?php
class RfidStudent extends AppModel {
	var $name = 'RfidStudent';
	var $useDbConfig = 'gatekeeper';
	
	var $virtualFields = array(
		'full_name' => "CONCAT(
							IFNULL(RfidStudent.last_name,''),
							', ',
							IFNULL(RfidStudent.first_name,''),
							' ',
							IFNULL(RfidStudent.middle_name,'')
					)",
		'slug' => "CONCAT(
							IFNULL(RfidStudent.last_name,''),
							'-',
							IFNULL(RfidStudent.first_name,''),
							'-',
							IFNULL(RfidStudent.middle_name,'')
					)",
		'type_string' =>"CASE RfidStudent.type
										WHEN '0' THEN 'New Student'
										WHEN '1' THEN 'Old Student'
										WHEN '2' THEN 'Employee'
									END "
	);


	var $hasAndBelongsToMany = array(
		'Fetcher' => array(
			'className' => 'Fetcher',
			'joinTable' => 'fetcher_rfid_students',
			'foreignKey' => 'rfid_student_id',
			'associationForeignKey' => 'fetcher_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
