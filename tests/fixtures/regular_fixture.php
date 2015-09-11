<?php
/* Regular Fixture generated on: 2015-09-09 04:21:20 : 1441765280 */
class RegularFixture extends CakeTestFixture {
	var $name = 'Regular';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'primary'),
		'employee_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'in' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'out' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'employee_id' => 1,
			'date' => '2015-09-09',
			'in' => '04:21:20',
			'out' => '04:21:20'
		),
	);
}
