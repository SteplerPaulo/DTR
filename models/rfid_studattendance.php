<?php
class RfidStudattendance extends AppModel {
	var $name = 'RfidStudattendance';
	var $useDbConfig = 'gatekeeper';
	var $useTable = 'rfid_studattendance';	
		
	public function per_student($from,$to,$sno,$gatekeeper_db){
		//pr($from);exit;
		
		return $this->query( 
			"SELECT 
				  `rfid_studattendance`.`id`,
				  `rfid_studattendance`.`student_number`,
				  CONCAT(
					last_name,
					',',
					first_name,
					' ',
					middle_name
				  ) AS full_name,
				  `rfid_studattendance`.`date`,
				  `status`,
				  time_in,
				  time_out,
				  DATE_FORMAT(time_in, '%h:%i:%s %p') AS formated_timein,
				  DATE_FORMAT(time_out, '%h:%i:%s %p') AS formated_timeout
				FROM
				  rfid_studattendance 
				  INNER JOIN `$gatekeeper_db`.`rfid_students` 
					ON (
					  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
					) 
				WHERE `rfid_studattendance`.`student_number` = '$sno'
					AND `date` >= '$from' 
					AND `date` <= '$to' 
				ORDER BY `date`"
		);
	}

}
