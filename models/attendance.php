<?php
class Attendance extends AppModel {
	var $name = 'Attendance';
	
	var $virtualFields = array(
		'remark_string' =>"CASE Attendance.remarks
										WHEN '0' THEN 'Data Not Found'
										WHEN '1' THEN 'Ok'
									END "
	);
	

	
	public function per_employee($month,$empno,$gatekeeper_db){
		
		
		return $this->query( 
			"SELECT 
			 `attendances`.`employee_number`,
			  CONCAT(last_name,',',first_name,' ',middle_name) AS full_name,
			  `attendances`.`date`,
			  timein,
			  timeout,
			  remarks
			FROM
			  attendances 
			  INNER JOIN `$gatekeeper_db`.`rfid_students` 
				ON (
				  `rfid_students`.`employee_number` = `attendances`.`employee_number`
				) 
			WHERE `attendances`.`employee_number` = '$empno' AND MONTH(`date`)='$month'"
		);
	}
		

}
