<?php
/* Student Fixture generated on: 2015-02-04 03:16:46 : 1423016206 */
class StudentFixture extends CakeTestFixture {
	var $name = 'Student';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'student_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'middle_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educ_level_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'year_level_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'student_number' => 'Lorem ips',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'middle_name' => 'Lorem ipsum dolor sit amet',
			'educ_level_id' => 1,
			'year_level_id' => 1,
			'is_active' => 1
		),
	);
}
