<?php
/* Employee Fixture generated on: 2015-09-10 07:58:26 : 1441864706 */
class EmployeeFixture extends CakeTestFixture {
	var $name = 'Employee';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'middle_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'birthday' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'parish_school_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'employee_no' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'middle_name' => 'Lorem ipsum dolor sit amet',
			'birthday' => '2015-09-10',
			'parish_school_id' => 1,
			'employee_no' => 'Lorem ipsum dolor '
		),
	);
}
