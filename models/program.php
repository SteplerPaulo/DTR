<?php
class Program extends AppModel {
	var $name = 'Program';
	var $useDbConfig = 'isms2014';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FeeStructure' => array(
			'className' => 'FeeStructure',
			'foreignKey' => 'program_id',
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
