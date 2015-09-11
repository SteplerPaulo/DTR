<?php
/* Attendance Fixture generated on: 2015-09-10 12:48:37 : 1441882117 */
class AttendanceFixture extends CakeTestFixture {
	var $name = 'Attendance';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'employee_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'timein' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'timeout' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'employee_number' => 'Lorem ipsum dolor ',
			'date' => '2015-09-10',
			'timein' => '12:48:37',
			'timeout' => '12:48:37'
		),
	);
}
