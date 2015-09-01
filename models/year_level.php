<?php
class YearLevel extends AppModel {
	var $name = 'YearLevel';
	var $useDbConfig = 'isms2014';
	var $displayField = 'name';
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
