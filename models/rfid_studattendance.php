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
	
	function daily_report($sectionId,$date){
		return $this->query( 
			"SELECT 
			  `rfid_students`.`section_id`,
			  `sections`.`name`,
			  CONCAT(`rfid_students`.`first_name`,' ',`rfid_students`.`middle_name`,' ',`rfid_students`.`last_name`) AS full_name,
			  `rfid_students`.`student_number`,
			  `rfid_studattendance`.`date`,
			  `rfid_studattendance`.`time_in`,
			  `rfid_studattendance`.`time_out`,
			  `rfid_studattendance`.`remarks`
			FROM
			 `rfid_students` 
			  INNER JOIN `sections` 
				ON (
				  `rfid_students`.`section_id` = `sections`.`id`
				) 
			  INNER JOIN `rfid_studattendance` 
				ON (
				  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
				) 
			WHERE (
				`rfid_students`.`section_id` = '$sectionId'
				 AND `rfid_studattendance`.`date` = '$date'
			  ) ;
			"
		);
	}
	
	function monthly_report($sectionId,$date){
		
		$month = 11;//date("m",strtotime($date));
		$year = 2016;//date("Y",strtotime($date));
	
		return $this->query( 
			"SELECT 
			  `rfid_students`.`section_id`,
			  `sections`.`name`,
			  CONCAT(`rfid_students`.`first_name`,' ',`rfid_students`.`middle_name`,' ',`rfid_students`.`last_name`) AS full_name,
			  `rfid_students`.`student_number`,
			  `rfid_studattendance`.`date`,
			  `rfid_studattendance`.`time_in`,
			  `rfid_studattendance`.`time_out`,
			  `rfid_studattendance`.`remarks`
			FROM
			  `rfid_students` 
			  INNER JOIN `sections` 
				ON (
				  `rfid_students`.`section_id` = `sections`.`id`
				) 
			  INNER JOIN `rfid_studattendance` 
				ON (
				  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
				) 
			WHERE (
				`rfid_students`.`section_id` = '$sectionId' 
				AND MONTH(`rfid_studattendance`.`date`) = '$month' 
				AND YEAR(`rfid_studattendance`.`date`) = '$year'
			  );"
		);
		
	}
	
	function sectionStudents($sectionId){
		return $this->query("
					SELECT 
						CONCAT(
							IFNULL(`rfid_students`.`last_name`,''),
							', ',
							IFNULL(`rfid_students`.`first_name`,''),
							' ',
							 IFNULL(`rfid_students`.`middle_name`,'')
							) AS full_name,
							`rfid_students`.`student_number` ,
							`rfid_students`.`dec_rfid`
						FROM
						  rfid_students 
						WHERE section_id = '$sectionId' 
						  AND `type` = 1 
						ORDER BY `last_name`,
						  `first_name`,
						  `middle_name` 
				");
		
	}

}
