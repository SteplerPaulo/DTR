<?php
class RfidStudattendance extends AppModel {
	var $name = 'RfidStudattendance';
	var $useDbConfig = 'gatekeeper';
	var $useTable = 'rfid_studattendance';	
	
	
	public function daily_report($sectionId,$date){
		return $this->query( 
			"SELECT 
				`rfid_students`.`section_id`,
				`sections`.`name`,
				CONCAT(
					IFNULL(`rfid_students`.`first_name`,''),
					', ',
					IFNULL(`rfid_students`.`middle_name`,''),
					' ',
					IFNULL(`rfid_students`.`last_name`,'')
					) AS full_name,
				`rfid_students`.`student_number`,
				`rfid_studattendance`.`id`,
				`rfid_studattendance`.`date`,
				`rfid_studattendance`.`time_in`,
				`rfid_studattendance`.`time_out`,
				`rfid_studattendance`.`remarks`,
				`remarks`.`name`,
				`images`.`img_path`
			FROM
				`rfid_students` 
					INNER JOIN `sections` 
					ON (
					  `rfid_students`.`section_id` = `sections`.`id`
					) 
					LEFT JOIN `rfid_studattendance` 
					ON (
					  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
					) 
					LEFT JOIN `remarks` 
					ON (
					  `rfid_studattendance`.`remarks` = `remarks`.`alias`
					) 
					LEFT JOIN `images` 
					ON (
					  `images`.`source_rfid` = `rfid_students`.`source_rfid`
					) 
				WHERE (
					`rfid_students`.`section_id` = '$sectionId'
					AND `rfid_studattendance`.`date` = '$date'
				) ;
			"
		);
	}
	
	public function monthly_report($sectionId,$month,$year){
		
		
		return $this->query( 
			"SELECT 
			  `rfid_students`.`section_id`,
			  `sections`.`name`,
			  CONCAT(
					IFNULL(`rfid_students`.`first_name`,''),
					', ',
					IFNULL(`rfid_students`.`middle_name`,''),
					' ',
					IFNULL(`rfid_students`.`last_name`,'')
				) AS full_name,
			  `rfid_students`.`student_number`,
			  `rfid_studattendance`.`id`,
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
						`rfid_students`.`dec_rfid`,
						`rfid_students`.`gender`,
						`rfid_students`.`guardian_mobile_no`,
						`images`.`img_path`
					FROM
					  rfid_students
					LEFT JOIN `images` 
					ON (
					  `images`.`source_rfid` = `rfid_students`.`source_rfid`
					)
					WHERE section_id = '$sectionId' 
					  AND `type` = 1 
					ORDER BY `last_name`,
					  `first_name`,
					  `middle_name` 
			");
		
	}

	function student_monthly_attendance($sno,$month,$year){
		return $this->query( 
			"SELECT 
			  `rfid_studattendance`.`id`,
			  `rfid_studattendance`.`student_number`,
			  CONCAT(
				IFNULL(`rfid_students`.`last_name`, ''),
				', ',
				IFNULL(
				  `rfid_students`.`middle_name`,
				  ''
				),
				' ',
				IFNULL(
				  `rfid_students`.`first_name`,
				  ''
				)
			  ) AS full_name,
			  `rfid_studattendance`.`date`,
			  `status`,
			  `remarks`,
			  time_in,
			  time_out,
			  DATE_FORMAT(time_in, '%h:%i:%s %p') AS formated_timein,
			  DATE_FORMAT(time_out, '%h:%i:%s %p') AS formated_timeout 
			FROM
			  rfid_studattendance 
			  INNER JOIN `rfid_students` 
				ON (
				  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
				) 
			WHERE `rfid_studattendance`.`student_number` = '$sno' 
			  AND MONTH(`rfid_studattendance`.`date`) = '$month' 
			  AND YEAR(`rfid_studattendance`.`date`) = '$year' 
			ORDER BY `date` "
		);
	}
	
	function sps_data($level,$date){
		 return $this->query( 
			 "SELECT 
				  `rfid_students`.`level_id`,
				  `levels`.`name`,
				  `rfid_students`.`section_id`,
				  `sections`.`name`,
				  `schedules`.`start_time`,
				  CONCAT(
					IFNULL(
					  `rfid_students`.`first_name`,
					  ''
					),
					', ',
					IFNULL(
					  `rfid_students`.`middle_name`,
					  ''
					),
					' ',
					IFNULL(`rfid_students`.`last_name`, '')
				  ) AS full_name,
				  `rfid_students`.`student_number`,
				  `rfid_studattendance`.`id`,
				  `rfid_studattendance`.`date`,
				  `rfid_studattendance`.`time_in`,
				  `rfid_studattendance`.`time_out`,
				  `rfid_studattendance`.`is_posted`,
				  `rfid_studattendance`.`remarks`,
				  `remarks`.`name`,
				  `images`.`img_path` 
				FROM
				  `rfid_students` 
				  INNER JOIN `levels` 
					ON (
					  `rfid_students`.`level_id` = `levels`.`id`
					) 
				  INNER JOIN `sections` 
					ON (
					  `rfid_students`.`section_id` = `sections`.`id`
					) 
				  INNER JOIN `schedules` 
					ON (
					  `sections`.`id` = `schedules`.`section_id`
					) 
				  LEFT JOIN `rfid_studattendance` 
					ON (
					  `rfid_students`.`student_number` = `rfid_studattendance`.`student_number`
					) 
				  LEFT JOIN `remarks` 
					ON (
					  `rfid_studattendance`.`remarks` = `remarks`.`alias`
					) 
				  LEFT JOIN `images` 
					ON (
					  `images`.`source_rfid` = `rfid_students`.`source_rfid`
					) 
				WHERE (
					`rfid_students`.`level_id` = '$level' 
					AND `rfid_studattendance`.`date` = '$date'
				  )
				  ORDER BY `sections`.`name`, full_name"
			); 
	 }
	 
	function levelStudents($level){
		return $this->query("
				SELECT 
				  CONCAT(
					IFNULL(`rfid_students`.`last_name`, ''),
					', ',
					IFNULL(
					  `rfid_students`.`first_name`,
					  ''
					),
					' ',
					IFNULL(
					  `rfid_students`.`middle_name`,
					  ''
					)
				  ) AS full_name,
				  `rfid_students`.`student_number`,
				  `rfid_students`.`dec_rfid`,
				  `rfid_students`.`gender`,
				  `rfid_students`.`guardian_mobile_no`,
				  `images`.`img_path`,
				  `sections`.`id`,
				  `sections`.`name` 
				FROM
				  rfid_students 
				  LEFT JOIN `images` 
					ON (
					  `images`.`source_rfid` = `rfid_students`.`source_rfid`
					) 
				  LEFT JOIN `sections` 
					ON (
					  `sections`.`id` = `rfid_students`.`section_id`
					) 
				WHERE `rfid_students`.level_id = '$level' 
				  AND `rfid_students`.`type` = '1' 
				ORDER BY `rfid_students`.`last_name`,
				  `rfid_students`.`first_name`,
				  `rfid_students`.`middle_name`  
				");
		
	}

}
