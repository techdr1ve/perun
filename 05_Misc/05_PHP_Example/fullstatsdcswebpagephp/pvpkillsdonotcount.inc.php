<?php

////////////////////CREATE PE_DEATH_TABLES FOR TRAINING, PLAYER VS PLAYER DEATHS WILL NOT COUNT/////////////////////

//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_death_dates";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_death_dates (
pe_death_dates_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_death_dates_starttime DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_death_dates_endtime DATETIME DEFAULT CURRENT_TIMESTAMP
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

// INSERT change_slots start time and +2min from pe_LogEvent
$sql = 'INSERT INTO pe_death_dates 
(pe_death_dates_starttime,
pe_death_dates_endtime) 
    SELECT 
        pe_LogEvent_datetime  AS pe_death_dates_starttime,
        pe_LogEvent_datetime + INTERVAL 0 SECOND AS pe_death_dates_endtime
    FROM pe_LogEvent 
    WHERE pe_LogEvent_pvp_killer IS NOT NULL';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


$sql = "
DELETE FROM pe_LogEvent 
WHERE pe_LogEvent_id IN (SELECT 
        pe.pe_LogEvent_id AS id
    FROM pe_LogEvent AS pe
        INNER JOIN pe_death_dates AS csd ON (pe.pe_LogEvent_datetime BETWEEN csd.pe_death_dates_starttime AND csd.pe_death_dates_endtime)
    WHERE pe.pe_LogEvent_type = 'pilot_death')
";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


?>