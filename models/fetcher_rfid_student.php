<?php
class FetcherRfidStudent extends AppModel {
	var $name = 'FetcherRfidStudent';
	var $useDbConfig = 'gatekeeper';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Fetcher' => array(
			'className' => 'Fetcher',
			'foreignKey' => 'fetcher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RfidStudent' => array(
			'className' => 'RfidStudent',
			'foreignKey' => 'rfid_student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
