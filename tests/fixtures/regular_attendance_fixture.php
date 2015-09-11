<?php
/* RegularAttendance Fixture generated on: 2015-09-10 07:36:20 : 1441863380 */
class RegularAttendanceFixture extends CakeTestFixture {
	var $name = 'RegularAttendance';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'primary'),
		'employee_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'timein' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'timeout' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'employee_id' => 1,
			'date' => '2015-09-10',
			'timein' => '07:36:20',
			'timeout' => '07:36:20'
		),
	);
}
