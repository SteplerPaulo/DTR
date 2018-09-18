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
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
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
	
	function reset_data(){
		return $this->query( 
			"SELECT 
			  `rfid_students`.`id`,
			  `rfid_students`.`student_number`,
			  CONCAT(
				IFNULL(`rfid_students`.`last_name`, ''),
				', ',
				IFNULL(
				  `rfid_students`.`middle_name`,
				  ''
				),
				' ',
				IFNULL(
				  `rfid_students`.`first_name`,
				  ''
				)
			  ) AS full_name,
			  `rfid_students`.`source_rfid`,
			  `rfid_students`.`level_id`,
			  `rfid_students`.`section_id`,
			  levels.name,
			  levels.alias,
			  sections.id,
			  sections.name ,
			  sections.level
			FROM
			  `gatekeeper`.`sections` 
			  INNER JOIN `gatekeeper`.`levels` 
				ON (
				  `sections`.`level` = `levels`.`alias`
				) 
			  INNER JOIN `gatekeeper`.`rfid_students` 
				ON (
				  `rfid_students`.`section_id` = `sections`.`id`
				)ORDER BY full_name ASC;
			");
	}
	
	
	//Update student 201 status(has rfid)
	function update_has_rfid(){
		return $this->query( 
			"UPDATE 
			  student201s sfo 
			  INNER JOIN rfid_students sfog 
				ON sfog.student_number = sfo.student_number SET sfo.has_rfid = 1 
			WHERE sfog.source_rfid IS NOT NULL;
		");

	}

}
