<?php
/* YearLevel Fixture generated on: 2015-02-04 03:20:27 : 1423016427 */
class YearLevelFixture extends CakeTestFixture {
	var $name = 'YearLevel';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educ_level_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'alias' => 'Lorem ipsum d',
			'educ_level_id' => 1
		),
	);
}
