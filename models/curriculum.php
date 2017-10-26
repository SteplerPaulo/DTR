<?php
class Curriculum extends AppModel {
	var $name = 'Curriculum';
	var $useDbConfig = 'gatekeeper';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'SchoolCalendar' => array(
			'className' => 'SchoolCalendar',
			'foreignKey' => 'curriculum_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
