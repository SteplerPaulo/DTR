<?php
class SchoolDay extends AppModel {
	var $name = 'SchoolDay';
	var $useDbConfig = 'gatekeeper';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'SchoolCalendar' => array(
			'className' => 'SchoolCalendar',
			'foreignKey' => 'school_calendar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
