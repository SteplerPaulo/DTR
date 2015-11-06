<?php
class Attendance extends AppModel {
	var $name = 'Attendance';
	
	var $virtualFields = array(
		'remark_string' =>"CASE Attendance.remarks
										WHEN '0' THEN 'Data Not Found'
										WHEN '1' THEN 'Ok'
										WHEN '2' THEN 'Admin Entry'
									END ",
		'formated_timein' =>"DATE_FORMAT(timein, '%h:%i:%s %p')",
		'formated_timeout' =>"DATE_FORMAT(timeout, '%h:%i:%s %p')",
	);
	

	
	public function per_employee($from,$to,$empno,$gatekeeper_db){
		//pr($from);exit;
		
		return $this->query( 
			"SELECT 
				`attendances`.`id`,
				`attendances`.`employee_number`,
				CONCAT(last_name,',',first_name,' ',middle_name) AS full_name,
				`attendances`.`date`,
				timein,
				timeout,
				remarks,
				is_posted,
				DATE_FORMAT(timein, '%h:%i:%s %p') AS formated_timein,
				DATE_FORMAT(timeout, '%h:%i:%s %p') AS formated_timeout
			FROM
			  attendances 
			  INNER JOIN `$gatekeeper_db`.`rfid_students` 
				ON (
				  `rfid_students`.`employee_number` = `attendances`.`employee_number`
				) 
			WHERE `attendances`.`employee_number` = '$empno'
				 AND `date` >= '$from' 
				 AND `date` <= '$to' 
			"
		);
	}

}
