<?php
/* StudentAcademicInformation Fixture generated on: 2015-02-11 01:08:43 : 1423613323 */
class StudentAcademicInformationFixture extends CakeTestFixture {
	var $name = 'StudentAcademicInformation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'student_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'admission_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'last_enrolled_sy' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 4),
		'last_enrolled_sem' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'residency_sy_count' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2, 'comment' => 'Years in School'),
		'residency_sy_start' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 4, 'comment' => 'As of School Year'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'student_id' => 1,
			'admission_date' => '2015-02-11',
			'last_enrolled_sy' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'last_enrolled_sem' => 1,
			'residency_sy_count' => 1,
			'residency_sy_start' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
