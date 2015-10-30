<?php
/* AttendanceCopy Fixture generated on: 2015-10-30 11:05:12 : 1446203112 */
class AttendanceCopyFixture extends CakeTestFixture {
	var $name = 'AttendanceCopy';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'employee_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'timein' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'timeout' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'employee_number' => 'Lorem ipsum dolor ',
			'date' => '2015-10-30',
			'timein' => '11:05:12',
			'timeout' => '11:05:12',
			'created' => '2015-10-30 11:05:12'
		),
	);
}
