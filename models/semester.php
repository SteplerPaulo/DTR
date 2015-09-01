<?php
class Semester extends AppModel {
	var $name = 'Semester';
	var $useDbConfig = 'isms2014';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'EducLevel' => array(
			'className' => 'EducLevel',
			'foreignKey' => 'educ_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
