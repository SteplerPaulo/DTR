<?php
class Section extends AppModel {
	var $name = 'Section';
	var $useDbConfig = 'gatekeeper';
	var $displayField = 'name';
	
	
	
	var $hasMany = array(
		'Student201' => array(
			'className' => 'Student201',
			'foreignKey' => 'section_code',
			'dependent' => false,
			'conditions' => '',
			'fields' => array('section_code','student_number'),
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
