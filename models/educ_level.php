<?php
class EducLevel extends AppModel {
	var $name = 'EducLevel';
	var $useDbConfig = 'isms2014';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'educ_level_id',
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
