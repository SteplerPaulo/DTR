<?php
/* DeletedAttendance Fixture generated on: 2015-10-27 09:36:33 : 1445938593 */
class DeletedAttendanceFixture extends CakeTestFixture {
	var $name = 'DeletedAttendance';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'primary'),
		'employee_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'timein' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'timeout' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'rfid' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'remarks' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'employee_number' => 'Lorem ipsum dolor ',
			'date' => '2015-10-27',
			'timein' => '09:36:33',
			'timeout' => '09:36:33',
			'rfid' => 'Lorem ipsum dolor ',
			'remarks' => 1,
			'created' => '2015-10-27 09:36:33'
		),
	);
}
