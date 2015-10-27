<?php
class Attendance extends AppModel {
	var $name = 'Attendance';
	
	var $virtualFields = array(
		'remark_string' =>"CASE Attendance.remarks
										WHEN '0' THEN 'Data Not Found'
										WHEN '1' THEN 'Ok'
									END ",
		'formated_timein' =>"DATE_FORMAT(timein, '%h:%i:%s %p')",
		'formated_timeout' =>"DATE_FORMAT(timeout, '%h:%i:%s %p')",
	);
	

	
	public function per_employee($year,$month,$empno,$gatekeeper_db){
		
		
		return $this->query( 
			"SELECT 
				`attendances`.`id`,
				`attendances`.`employee_number`,
				CONCAT(last_name,',',first_name,' ',middle_name) AS full_name,
				`attendances`.`date`,
				timein,
				timeout,
				remarks,
				DATE_FORMAT(timein, '%h:%i:%s %p') AS formated_timein,
				DATE_FORMAT(timeout, '%h:%i:%s %p') AS formated_timeout
			FROM
			  attendances 
			  INNER JOIN `$gatekeeper_db`.`rfid_students` 
				ON (
				  `rfid_students`.`employee_number` = `attendances`.`employee_number`
				) 
			WHERE `attendances`.`employee_number` = '$empno' AND MONTH(`date`)='$month' AND YEAR(`date`)='$year'"
		);
	}

}
