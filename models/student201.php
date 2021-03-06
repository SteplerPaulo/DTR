<?php
class Student201 extends AppModel {
	var $name = 'Student201';
	var $useDbConfig = 'gatekeeper';

	
	var $virtualFields = array(
		'full_name' => "CONCAT(
							IFNULL(Student201.last_name,''),
							', ',
							IFNULL(Student201.first_name,''),
							' ',
							IFNULL(Student201.middle_name,'')
					)",
		'has_rfid_string' =>"CASE Student201.has_rfid
										WHEN '0' THEN 'Unregistered'
										WHEN '1' THEN 'Registered'
									END "
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Level' => array(
			'className' => 'Level',
			'foreignKey' => 'level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
