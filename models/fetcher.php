<?php
class Fetcher extends AppModel {
	var $name = 'Fetcher';
	var $useDbConfig = 'gatekeeper';
	var $virtualFields = array(
		'full_name' => 'CONCAT(Fetcher.last_name, ", " ,Fetcher.first_name, " ",Fetcher.middle_name)',
		'slug' => 'CONCAT(Fetcher.last_name, "-" ,Fetcher.first_name,"-",Fetcher.middle_name)',
	);
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FetcherRfidStudent' => array(
			'className' => 'FetcherRfidStudent',
			'foreignKey' => 'fetcher_id',
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
	
	var $hasOne = array(
		'FetcherDocument' => array(
			'className' => 'FetcherDocument',
			'foreignKey' => 'fetcher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	public function all(){		
		return $this->query(
			'SELECT
				`fetchers`.`last_name`
				, `fetchers`.`first_name`
				, `fetchers`.`middle_name`
				, `fetcher_documents`.`name`
				, `fetcher_documents`.`dir`
			FROM
				`gatekeeper_hta_2016`.`fetcher_documents`
				INNER JOIN `gatekeeper_hta_2016`.`fetchers` 
					ON (`fetcher_documents`.`fetcher_id` = `fetchers`.`id`)'
		);
	
	}

}
