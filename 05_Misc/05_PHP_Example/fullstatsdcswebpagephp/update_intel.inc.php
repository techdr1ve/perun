<?php

////////////////////CREATE pe_intel FOR CREATING A TABLE OF ALL secret intel////////////////
//Creating intel unit column in pe_logchat DB as `pe_logchat_intelunit`
$sql = "ALTER TABLE pe_logchat ADD IF NOT EXISTS `pe_logchat_intelunit` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// INSERT pe_DataMissionHashes_instance into logchat_instance in order to input it into pe_onlinestatus_time_in_mission
/*$sql = ' UPDATE pe_logchat 
JOIN( SELECT pe_DataMissionHashes_id, pe_DataMissionHashes_instance
	FROM pe_DataMissionHashes) x ON pe_DataMissionHashes_id = pe_LogChat_missionhash_id
	SET pe_logchat_instance = pe_DataMissionHashes_instance

';
*/ 

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 1' 
		WHERE pe_LogChat_msg LIKE('%POW 1%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 2' 
		WHERE pe_LogChat_msg LIKE('%POW 2%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 3' 
		WHERE pe_LogChat_msg LIKE('%POW 3%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 4' 
		WHERE pe_LogChat_msg LIKE('%POW 4%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 5' 
		WHERE pe_LogChat_msg LIKE('%POW 5%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 1' 
		WHERE pe_LogChat_msg LIKE('%VIP 1%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 2' 
		WHERE pe_LogChat_msg LIKE('%VIP 2%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 3' 
		WHERE pe_LogChat_msg LIKE('%VIP 3%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 4' 
		WHERE pe_LogChat_msg LIKE('%VIP 4%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 5' 
		WHERE pe_LogChat_msg LIKE('%VIP 5%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='Target 1' 
		WHERE pe_LogChat_msg LIKE('%Target 1%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='Target 2' 
		WHERE pe_LogChat_msg LIKE('%Target 2%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}
$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='Target 3' 
		WHERE pe_LogChat_msg LIKE('%Target 3%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}
$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='Target 4' 
		WHERE pe_LogChat_msg LIKE('%Target 4%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}
$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='Target 5' 
		WHERE pe_LogChat_msg LIKE('%Target 5%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 1' 
		WHERE pe_LogChat_msg LIKE('Secret Intel 1:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 2' 
		WHERE pe_LogChat_msg LIKE('Secret Intel 2:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 3' 
		WHERE pe_LogChat_msg LIKE('Secret Intel 3:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 4' 
		WHERE pe_LogChat_msg LIKE('Secret Intel 4:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='VIP 5' 
		WHERE pe_LogChat_msg LIKE('Secret Intel 5:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 1'
		WHERE pe_LogChat_msg LIKE('Informant Intel 1:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 2' 
		WHERE pe_LogChat_msg LIKE('Informant Intel 2:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 3' 
		WHERE pe_LogChat_msg LIKE('Informant Intel 3:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 4' 
		WHERE pe_LogChat_msg LIKE('Informant Intel 4:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = "UPDATE pe_logchat SET pe_logchat_intelunit='POW 5' 
		WHERE pe_LogChat_msg LIKE('Informant Intel 5:%')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_intel";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_intel
$sql = 'CREATE TABLE IF NOT EXISTS pe_intel (
pe_intel_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_intel_unit VARCHAR(100) DEFAULT NULL,
pe_intel_status VARCHAR(100) DEFAULT NULL,
pe_intel_location VARCHAR(100) DEFAULT NULL,
pe_intel_latest_timestamp datetime,
pe_intel_secret_intel VARCHAR(4000) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//INSERT intel info
$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("POW 1")';
//    VALUES("POW1","VIP1","TGT1","POW2","VIP2","TGT2","POW3","VIP3","TGT3","POW4","VIP4","TGT4","POW5","VIP5","TGT5")

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("VIP 1")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("Target 1")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("POW 2")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("VIP 2")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("Target 2")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("POW 3")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("VIP 3")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("Target 3")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("POW 4")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("VIP 4")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("Target 4")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("POW 5")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("VIP 5")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'INSERT INTO pe_intel(pe_intel_unit) VALUES("Target 5")';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//INSERT intel info
/*
$sql = 'INSERT INTO pe_intel
    (
	pe_intel_latest_timestamp
	)
    SELECT DISTINCT
	pe_LogChat_msg

    FROM pe_LogChat
	WHERE pe_LogChat_msg LIKE("%POW1%")
	ORDER BY pe_LogChat_datetime DESC LIMIT 1

	';


$sql = 'UPDATE pe_intel
JOIN ( SELECT xyz
		
	   FROM pe_logchat
	   WHERE 
	   GROUP BY xyz ) x ON 
';

*/

//set latest timestamp for pe_intel_latest_timestamp
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_intelunit IS NOT NULL AND pe_logchat_msg NOT LIKE("Secret%")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_unit = pe_logchat_intelunit
SET pe_intel_latest_timestamp = pe_logchat_datetime
';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status KIA
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%KIA!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "KIA"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status MIA
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%MIA!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "RELEASED & MIA"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%Rescued!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "RESCUED"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%Captured!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "CAPTURED"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%Restored!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "SAVED & RESTORED"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_status - Executed
$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg, 
	   pe_logchat_datetime
       FROM pe_logchat 
	   WHERE pe_logchat_msg LIKE("%Executed!")
	   ORDER BY pe_LogChat_datetime ASC
	   ) x ON pe_intel_latest_timestamp = pe_logchat_datetime
SET pe_intel_status = "EXECUTED"
WHERE pe_intel_unit = pe_logchat_intelunit
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_secret_intel

$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg,
	   pe_logchat_datetime
       FROM pe_logchat
	   WHERE pe_logchat_msg LIKE("Secret Intel%")
	   ) x ON pe_intel_unit = pe_logchat_intelunit
SET pe_intel_secret_intel = pe_logchat_msg
WHERE pe_intel_unit = pe_logchat_intelunit

';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_secret_intel

$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg,
	   pe_logchat_datetime
       FROM pe_logchat
	   WHERE pe_logchat_msg LIKE("Informant Intel%")
	   ) x ON pe_intel_unit = pe_logchat_intelunit
SET pe_intel_secret_intel = pe_logchat_msg
WHERE pe_intel_unit = pe_logchat_intelunit

';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//set status for pe_intel_secret_intel

$sql = 'UPDATE pe_intel
JOIN ( SELECT pe_logchat_intelunit,
	   pe_logchat_msg,
	   pe_logchat_datetime
       FROM pe_logchat
	   WHERE pe_logchat_msg LIKE("%Intel%")
	   ) x ON pe_intel_unit = pe_logchat_intelunit
SET pe_intel_location = SUBSTRING(pe_logchat_msg, POSITION("location:" IN pe_logchat_msg) + 11, 19)
WHERE pe_intel_unit = pe_logchat_intelunit

';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

?>