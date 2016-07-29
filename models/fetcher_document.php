<?php
class FetcherDocument extends AppModel {
	var $name = 'FetcherDocument';
	var $useDbConfig = 'gatekeeper';

	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Fetcher' => array(
			'className' => 'Fetcher',
			'foreignKey' => 'fetcher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
}
