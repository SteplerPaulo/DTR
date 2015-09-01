<?php
/* StudentPersonalInformation Fixture generated on: 2015-02-04 03:03:07 : 1423015387 */
class StudentPersonalInformationFixture extends CakeTestFixture {
	var $name = 'StudentPersonalInformation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'student_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'inquiry_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'gender' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'birth_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'birth_place' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'citizenship_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'religion_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'landline' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mobile1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mobile2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'curr_country_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'curr_province' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'curr_city_municipality' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'curr_barangay' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'curr_house_info' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'curr_zipcode' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perm_country_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'perm_province' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perm_city_municipality' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perm_barangay' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perm_house_info' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perm_zipcode' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 4, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'send_mail_to' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'comment' => '1=Home Address; 2=Provincial Address', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'student_id' => 1,
			'inquiry_id' => 'Lorem ips',
			'gender' => 'Lorem ipsum dolor sit ame',
			'birth_date' => '2015-02-04',
			'birth_place' => 'Lorem ipsum dolor sit amet',
			'citizenship_id' => 1,
			'religion_id' => 1,
			'landline' => 'Lorem ip',
			'mobile1' => 'Lorem ips',
			'mobile2' => 'Lorem ips',
			'curr_country_id' => 1,
			'curr_province' => 'Lorem ipsum dolor sit amet',
			'curr_city_municipality' => 'Lorem ipsum dolor sit amet',
			'curr_barangay' => 'Lorem ipsum dolor sit amet',
			'curr_house_info' => 'Lorem ipsum dolor sit amet',
			'curr_zipcode' => 'Lor',
			'perm_country_id' => 1,
			'perm_province' => 'Lorem ipsum dolor sit amet',
			'perm_city_municipality' => 'Lorem ipsum dolor sit amet',
			'perm_barangay' => 'Lorem ipsum dolor sit amet',
			'perm_house_info' => 'Lorem ipsum dolor sit amet',
			'perm_zipcode' => 'Lo',
			'send_mail_to' => 'Lorem ipsum dolor sit ame',
			'created' => '2015-02-04 03:03:07',
			'user_id' => 1
		),
	);
}
