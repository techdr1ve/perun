<?php
//updates.inc.php are all the operations completed to alter/add/modify the current database tables
	
	require "pvpkillsdonotcount.inc.php"; //Training server PVP pilot_deaths DO NOT COUNT

////////////
////////////
//******STUFF I CANNOT FIX YET aka BUGS
//1. If you kill BLUE ON BLUE it counts as a2a kill  (if want to explore more ... look below at Friendly Fire Killer section below)
//2. If you don't die you don't show up in the stats :( might fix in query rather than updates.inc.php file
////////////

//Creating time_in_mission column in pe_onlinestatus DB as `pe_OnlineStatus_time_in_mission`
$sql = "ALTER TABLE pe_onlinestatus ADD IF NOT EXISTS `pe_OnlineStatus_time_in_mission` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Creating date_in_mission column in pe_onlinestatus DB as `pe_OnlineStatus_date_in_mission`
//$sql = "ALTER TABLE pe_onlinestatus ADD IF NOT EXISTS `pe_OnlineStatus_date_in_mission` VARCHAR(100)";

//if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
//} else {
//  echo "Error updating record: " . $mysqli->error;
//  echo "<br><br>";
//}

//Creating instance column in pe_logchat DB as `pe_logchat_instance`
$sql = "ALTER TABLE pe_logchat ADD IF NOT EXISTS `pe_logchat_instance` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// INSERT pe_DataMissionHashes_instance into logchat_instance in order to input it into pe_onlinestatus_time_in_mission
$sql = ' UPDATE pe_logchat 
JOIN( SELECT pe_DataMissionHashes_id, pe_DataMissionHashes_instance
	FROM pe_DataMissionHashes) x ON pe_DataMissionHashes_id = pe_LogChat_missionhash_id
	SET pe_logchat_instance = pe_DataMissionHashes_instance

';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating pe_OnlineStatus_time_in_mission from pe_logchat

// INSERT current time in mission into pe_onlinestatus_time_in_mission
$sql = ' UPDATE pe_onlinestatus 
JOIN( SELECT pe_LogChat_msg, pe_LogChat_datetime, pe_LogChat_instance, SUBSTRING(pe_LogChat_msg,26,8) AS time_in_mission
	FROM pe_logchat) x ON pe_OnlineStatus_instance = pe_LogChat_instance
	SET pe_OnlineStatus_time_in_mission = time_in_mission
	WHERE pe_LogChat_msg LIKE("Current Time in Mission:%") ORDER BY pe_LogChat_datetime DESC LIMIT 1

';

// SUBSTRING(pe_LogEvent_CoPilotName4,1,1)

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// INSERT current date in mission into pe_onlinestatus_date_in_mission
//$sql = ' UPDATE pe_onlinestatus  
//JOIN( SELECT pe_LogChat_msg, pe_LogChat_datetime, pe_LogChat_instance
//	FROM pe_logchat) x ON pe_OnlineStatus_instance = pe_LogChat_instance
//	SET pe_OnlineStatus_date_in_mission = pe_LogChat_msg
//	WHERE pe_LogChat_msg LIKE("%_ ____") AND pe_LogChat_msg NOT LIKE("%MIA!") AND pe_LogChat_msg NOT LIKE("%KIA!") AND pe_LogChat_msg NOT LIKE("%MIA!")
//	ORDER BY pe_LogChat_datetime DESC LIMIT 1 

//';

// SUBSTRING(pe_LogEvent_CoPilotName4,1,1)

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Creating Coalition column in DB as `pe_LogEvent_coalition`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_coalition` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition='BLUE' WHERE pe_LogEvent_content LIKE('BLUE%')AND (pe_LogEvent_type = 'change_slot' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'friendly_fire')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating name for Omin
$sql = "UPDATE pe_dataplayers SET pe_DataPlayers_lastname='Omin' WHERE pe_DataPlayers_ucid = '4b8e66a874867c1446b8080450cabb87'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating name for Omin
$sql = "UPDATE pe_dataplayers SET pe_DataPlayers_lastname='Maude Lebowski' WHERE pe_DataPlayers_ucid = '23beb67acab162efb8d0ae765b02ed8e'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating coalition on -> change_slot -> RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition='RED' WHERE pe_LogEvent_content LIKE('RED%') AND (pe_LogEvent_type = 'change_slot' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'friendly_fire')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition='?' WHERE pe_LogEvent_content LIKE('?%')AND (pe_LogEvent_type = 'change_slot' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'friendly_fire')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Creating PlayervsAI Column in DB as `pe_LogEvent_playervsai`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_playervsai` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating or Populating player column
$sql = "UPDATE pe_logevent SET pe_LogEvent_playervsai='Player' WHERE (pe_LogEvent_content LIKE('____ player%') OR pe_LogEvent_content LIKE('___ player%') OR pe_LogEvent_content LIKE('_ player%'))";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating or Populating AI column
$sql = "UPDATE pe_logevent SET pe_LogEvent_playervsai='AI' WHERE (pe_LogEvent_content LIKE('___ AI %') OR pe_LogEvent_content LIKE('____ AI %')) ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating or Populating player column - REMOVE Friendly Fire Kills -> 
$sql = "UPDATE pe_logevent SET pe_LogEvent_playervsai='Player' WHERE (pe_LogEvent_content LIKE('____ player%') OR pe_LogEvent_content LIKE('___ player%'))";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING AIRFRAMES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_airframe";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_airframe`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_airframe` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//refreshing dataset to update all airframe values as NULL
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = NULL";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'kill'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' killed ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'crash'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_type = 'crash')";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'eject'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' ejected ' IN pe_LogEvent.`pe_LogEvent_content`) + 8, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' ejected ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_type = 'eject')";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'pilot_death'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' died' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('took off in' IN pe_LogEvent.`pe_LogEvent_content`) + 12, (POSITION(' from ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('took off in' IN pe_LogEvent.`pe_LogEvent_content`) - 12))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Populating airframe for each pilot for pe_LogEvent_type = 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('landed in' IN pe_LogEvent.`pe_LogEvent_content`) + 9, (POSITION(' at ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('landed in' IN pe_LogEvent.`pe_LogEvent_content`) - 9))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'takeoff' ... have to get non-airport named ones too
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 4, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_arg1 = '') AND (pe_LogEvent_type = 'takeoff') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'landing' ... have to get non-airport named ones too
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 4, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_arg1 = '') AND (pe_LogEvent_type = 'landing') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' (' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'change_slot') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_coalition ='BLUE' OR pe_LogEvent_coalition ='RED') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = LTRIM(pe_LogEvent_airframe)";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = RTRIM(pe_LogEvent_airframe)";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////////////////////END ADDING AIRFRAMES/////////////////////

//Populating airframe each pilot for pe_LogEvent_type = 'change_slot' for F-14B_2 slot co-pilot seat
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' (' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'change_slot') AND pe_LogEvent_airframe = 'F-14B' AND pe_LogEvent_playervsai ='Player' "; */

/////////////////////ADDING MILITARY BRANCH////////////////////

$sql = "DROP TABLE IF EXISTS pe_LogEvent_militarybranch";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_airframe`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_militarybranch` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'UPDATE pe_logevent 
JOIN (SELECT pe_militarybranch_datatype,
             pe_militarybranch_branch
       FROM pe_militarybranch 
  ) x ON pe_LogEvent_airframe = pe_militarybranch_datatype
SET pe_LogEvent_militarybranch = pe_militarybranch_branch
WHERE pe_LogEvent_airframe IS NOT NULL';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




////////////////////////////////////////////





$sql = "DROP TABLE IF EXISTS pe_LogEvent_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) + 10, (POSITION(',' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) - 10))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player' ";





if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


/////////UPDATING STATS EVENTS/////////////////... basically have to get the position of characters in order to extract a substring to display it

//Populating pilot name for all events
$sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) + 10, (POSITION(',' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) - 10))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//////ADDING Copilotname2 to LogEvent/////////////
//Creating copilot column in DB as `pe_LogEvent_CoPilotName2`
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_CoPilotName2` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Filtering out to build CoPilotName2   varchar(#,#,#)
$sql = "UPDATE pe_logevent SET pe_LogEvent_CoPilotName2=SUBSTRING(pe_LogEvent_content, POSITION(pe_LogEvent_pilotname IN pe_LogEvent_content) + CHAR_LENGTH(pe_LogEvent_pilotname)+2,((CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 2))-2)-CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 1)))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player'  ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set set garbage back to NULL CoPilotName2 that are not actual names where space is in the first character of name
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilotName2 = NULL WHERE SUBSTRING(pe_LogEvent_CoPilotName2,1,1) = ' ' ";

//$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilotName2 = NULL WHERE CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 2)) - CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 3)) = '0' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////ADDING Copilotname3 to LogEvent/////////////
//Creating copilot column in DB as `pe_LogEvent_CoPilotName3`
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_CoPilotName3` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Filtering out to build CoPilotName3   varchar(#,#,#)
$sql = "UPDATE pe_logevent SET pe_LogEvent_CoPilotName3=SUBSTRING(pe_LogEvent_content, POSITION(pe_LogEvent_CoPilotName2 IN pe_LogEvent_content) + CHAR_LENGTH(pe_LogEvent_CoPilotName2)+2,((CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 3))-2)-CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 2)))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player'  ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set set garbage back to NULL CoPilotName3 that are not actual names where space is in the first character of name
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilotName3 = NULL WHERE SUBSTRING(pe_LogEvent_CoPilotName3,1,1) = ' ' ";

//$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilotName3 = NULL WHERE CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 2)) - CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 3)) = '0' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////ADDING Copilotname4 to LogEvent/////////////
//Creating copilot column in DB as `pe_LogEvent_CoPilotName3`
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_CoPilotName4` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Filtering out to build CoPilotName4   varchar(#,#,#)
$sql = "UPDATE pe_logevent SET pe_LogEvent_CoPilotName4=SUBSTRING(pe_LogEvent_content, POSITION(pe_LogEvent_CoPilotName3 IN pe_LogEvent_content) + CHAR_LENGTH(pe_LogEvent_CoPilotName3)+2,((CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 3))-2)-CHAR_LENGTH(SUBSTRING_INDEX(pe_LogEvent_content, ',', 2)))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player'  ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set set garbage back to NULL CoPilotName4 that are not actual names where space is in the first character of name
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilotName4 = NULL WHERE SUBSTRING(pe_LogEvent_CoPilotName4,1,1) = ' ' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

/////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////ADDING CoPilot_Duplicate to LogEvent/////////////
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_CoPilot_Duplicate` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Delet
$sql = "DELETE FROM pe_LogEvent WHERE pe_LogEvent_CoPilot_Duplicate = 'YES' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create duplicate entry for CoPilotName2 as Pilotname so records are recorded for CopilotName2
$sql = 'INSERT INTO pe_LogEvent
(pe_LogEvent_datetime, pe_LogEvent_missionhash_id, pe_LogEvent_type, pe_LogEvent_content, pe_LogEvent_arg1, pe_LogEvent_arg2, pe_LogEvent_argPlayers, pe_LogEvent_coalition, pe_LogEvent_playervsai, pe_LogEvent_pilotname,  pe_LogEvent_CoPilotName2, pe_LogEvent_CoPilotName3, pe_LogEvent_CoPilotName4, pe_LogEvent_militarybranch)
    SELECT
	pe_LogEvent_datetime AS pe_LogEvent_datetime, 
	pe_LogEvent_missionhash_id AS pe_LogEvent_missionhash_id, 
	pe_LogEvent_type AS pe_LogEvent_type, 
	pe_LogEvent_content AS pe_LogEvent_content, 
	pe_LogEvent_arg1 AS pe_LogEvent_arg1, 
	pe_LogEvent_arg2 AS pe_LogEvent_arg2, 
	pe_LogEvent_argPlayers AS pe_LogEvent_argPlayers,
	pe_LogEvent_coalition AS pe_LogEvent_coalition, 
	pe_LogEvent_playervsai AS pe_LogEvent_playervsai, 
	pe_LogEvent_CoPilotName2 AS pe_LogEvent_pilotname, 
	pe_LogEvent_CoPilotName2 AS pe_LogEvent_CoPilotName2, 
	pe_LogEvent_CoPilotName3 AS pe_LogEvent_CoPilotName3, 
	pe_LogEvent_CoPilotName4 AS pe_LogEvent_CoPilotName4,
	pe_LogEvent_militarybranch AS pe_LogEvent_militarybranch
	FROM pe_LogEvent
	WHERE pe_LogEvent_CoPilotName2 IS NOT NULL AND pe_LogEvent_CoPilot_Duplicate IS NULL
	';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set pe_LogEvent_CoPilot_Duplicate = "YES"
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilot_Duplicate = 'YES' 
WHERE pe_LogEvent_pilotname = pe_LogEvent_CoPilotName2 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create duplicate entry for CoPilotName3 as Pilotname so records are recorded for CopilotName3
$sql = 'INSERT INTO pe_LogEvent
(pe_LogEvent_datetime, pe_LogEvent_missionhash_id, pe_LogEvent_type, pe_LogEvent_content, pe_LogEvent_arg1, pe_LogEvent_arg2, pe_LogEvent_argPlayers, pe_LogEvent_coalition, pe_LogEvent_playervsai, pe_LogEvent_pilotname,  pe_LogEvent_CoPilotName2, pe_LogEvent_CoPilotName3, pe_LogEvent_CoPilotName4, pe_LogEvent_militarybranch)
    SELECT
	pe_LogEvent_datetime AS pe_LogEvent_datetime, 
	pe_LogEvent_missionhash_id AS pe_LogEvent_missionhash_id, 
	pe_LogEvent_type AS pe_LogEvent_type, 
	pe_LogEvent_content AS pe_LogEvent_content, 
	pe_LogEvent_arg1 AS pe_LogEvent_arg1, 
	pe_LogEvent_arg2 AS pe_LogEvent_arg2, 
	pe_LogEvent_argPlayers AS pe_LogEvent_argPlayers,
	pe_LogEvent_coalition AS pe_LogEvent_coalition, 
	pe_LogEvent_playervsai AS pe_LogEvent_playervsai, 
	pe_LogEvent_CoPilotName3 AS pe_LogEvent_pilotname, 
	pe_LogEvent_CoPilotName2 AS pe_LogEvent_CoPilotName2, 
	pe_LogEvent_CoPilotName3 AS pe_LogEvent_CoPilotName3, 
	pe_LogEvent_CoPilotName4 AS pe_LogEvent_CoPilotName4,
	pe_LogEvent_militarybranch AS pe_LogEvent_militarybranch
	FROM pe_LogEvent
	WHERE pe_LogEvent_CoPilotName3 IS NOT NULL AND pe_LogEvent_CoPilot_Duplicate IS NULL
	';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set pe_LogEvent_CoPilot_Duplicate = "YES" for CoPilotName3
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilot_Duplicate = 'YES' 
WHERE pe_LogEvent_pilotname = pe_LogEvent_CoPilotName3 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create duplicate entry for CoPilotName4 as Pilotname so records are recorded for CopilotName4
$sql = 'INSERT INTO pe_LogEvent
(pe_LogEvent_datetime, pe_LogEvent_missionhash_id, pe_LogEvent_type, pe_LogEvent_content, pe_LogEvent_arg1, pe_LogEvent_arg2, pe_LogEvent_argPlayers, pe_LogEvent_coalition, pe_LogEvent_playervsai, pe_LogEvent_pilotname,  pe_LogEvent_CoPilotName2, pe_LogEvent_CoPilotName3, pe_LogEvent_CoPilotName4, pe_LogEvent_militarybranch)
    SELECT
	pe_LogEvent_datetime AS pe_LogEvent_datetime, 
	pe_LogEvent_missionhash_id AS pe_LogEvent_missionhash_id, 
	pe_LogEvent_type AS pe_LogEvent_type, 
	pe_LogEvent_content AS pe_LogEvent_content, 
	pe_LogEvent_arg1 AS pe_LogEvent_arg1, 
	pe_LogEvent_arg2 AS pe_LogEvent_arg2, 
	pe_LogEvent_argPlayers AS pe_LogEvent_argPlayers,
	pe_LogEvent_coalition AS pe_LogEvent_coalition, 
	pe_LogEvent_playervsai AS pe_LogEvent_playervsai, 
	pe_LogEvent_CoPilotName4 AS pe_LogEvent_pilotname, 
	pe_LogEvent_CoPilotName2 AS pe_LogEvent_CoPilotName2, 
	pe_LogEvent_CoPilotName3 AS pe_LogEvent_CoPilotName3, 
	pe_LogEvent_CoPilotName4 AS pe_LogEvent_CoPilotName4,
	pe_LogEvent_militarybranch AS pe_LogEvent_militarybranch
	FROM pe_LogEvent
	WHERE pe_LogEvent_CoPilotName4 IS NOT NULL AND pe_LogEvent_CoPilot_Duplicate IS NULL
	';
		
if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Set pe_LogEvent_CoPilot_Duplicate = "YES" for CoPilotName4
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_CoPilot_Duplicate = 'YES' 
WHERE pe_LogEvent_pilotname = pe_LogEvent_CoPilotName4 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Adding pilotid to pe_LogEvent_pilotid
$sql = '
UPDATE pe_logevent 
JOIN ( SELECT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name ) x ON pe_LogLogins_name = pe_LogEvent_pilotname
SET pe_LogEvent_pilotid = pe_LogLogins_playerid
WHERE pe_LogEvent_pilotname IS NOT NULL
';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//////ADDING TeamName to LogLogins/////////////
//Creating teamname column in DB as `pe_LogLogins_TeamName`
$sql = "ALTER TABLE pe_LogLogins ADD IF NOT EXISTS `pe_LogLogins_TeamName` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_LogEvent_pilotid
/* $sql = 'update pe_logevent set
   pe_LogEvent_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogEvent_pilotname = pe_LogLogins_Name
   )'; */

//Filtering out to build TeamName
$sql = "UPDATE pe_LogLogins SET pe_LogLogins_TeamName=(SUBSTRING(pe_LogLogins_name, POSITION('[' IN pe_LogLogins_name) + 1, (POSITION(']' IN pe_LogLogins_name) - POSITION('[' IN pe_LogLogins_name) - 1))) WHERE pe_LogLogins_name LIKE('%[%') AND pe_LogLogins_name LIKE('%]%') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//////ADDING SquadronName to LogLogins/////////////
//Creating teamname column in DB as `pe_LogLogins_SquadronName`
$sql = "ALTER TABLE pe_LogLogins ADD IF NOT EXISTS `pe_LogLogins_SquadronName` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_LogEvent_pilotid
/* $sql = 'update pe_logevent set
   pe_LogEvent_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogEvent_pilotname = pe_LogLogins_Name
   )'; */

//Filtering out to build TeamName

$sql = "UPDATE pe_LogLogins SET pe_LogLogins_SquadronName=(SUBSTRING(pe_LogLogins_name, 1, (CHAR_LENGTH(pe_LogLogins_name) - POSITION('-' IN pe_LogLogins_name)))) WHERE pe_LogLogins_name LIKE('%-%') AND pe_LogLogins_name LIKE('%|%') ";

 //NCHAR try this to seclude only - without needing |

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////ADDING TeamName to LogEvent/////////////
//Creating teamname column in DB as `pe_LogLogins_TeamName`
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_TeamName` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_LogEvent_pilotid
/* $sql = 'update pe_logevent set
   pe_LogEvent_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogEvent_pilotname = pe_LogLogins_Name
   )'; */

//Filtering out to build TeamName
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_TeamName=(SUBSTRING(pe_LogEvent_pilotname, POSITION('[' IN pe_LogEvent_pilotname) + 1, (POSITION(']' IN pe_LogEvent_pilotname) - POSITION('[' IN pe_LogEvent_pilotname) - 1))) WHERE pe_LogEvent_pilotname LIKE('%[%') AND pe_LogEvent_pilotname LIKE('%]%') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//////ADDING SquadronName to LogEvent/////////////
//Creating teamname column in DB as `pe_LogLogins_SquadronName`
$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_SquadronName` VARCHAR(100) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Filtering out to build SquadronName
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_SquadronName=(SUBSTRING(pe_LogEvent_pilotname, 1, (CHAR_LENGTH(pe_LogEvent_pilotname) - (CHAR_LENGTH(pe_LogEvent_pilotname)-(POSITION(' ' IN pe_LogEvent_pilotname)-0))))) WHERE pe_LogEvent_pilotname LIKE('%-%') AND pe_LogEvent_pilotname LIKE('%|%') ";

 //NCHAR try this to seclude only - without needing |

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////CREATE PE_TEAMS FOR CREATING A TABLE OF ALL TEAMS////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_teams";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_teams
$sql = 'CREATE TABLE IF NOT EXISTS pe_teams (
pe_teams_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_teams_name VARCHAR(100) DEFAULT NULL

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

//INSERT mission_name and mission_name_short
$sql = 'INSERT INTO pe_teams
    (
	pe_teams_name
	)
    SELECT DISTINCT
	pe_LogEvent_teamname AS pe_teams_name

	   
    FROM pe_LogEvent
	WHERE pe_LogEvent_teamname IS NOT NULL

	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

///////////////////CREATE PE_SQUADRONS FOR CREATING A TABLE OF ALL SQUADRONS////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_squadrons";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_squadrons
$sql = 'CREATE TABLE IF NOT EXISTS pe_squadrons (
pe_squadrons_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_squadrons_name VARCHAR(100) DEFAULT NULL

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

//INSERT mission_name and mission_name_short
$sql = 'INSERT INTO pe_squadrons
    (
	pe_squadrons_name
	)
    SELECT DISTINCT
	pe_LogEvent_squadronname AS pe_squadrons_name

	   
    FROM pe_LogEvent
	WHERE pe_LogEvent_squadronname IS NOT NULL

	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



/////////////////////////////
//////ADDING STATISTICS//////

//***ADDING KILLS PLANES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_planes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_planes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'planes'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_planes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING KILLS HELICOPTERS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_helicopters";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_helicopters` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'helicopters'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_helicopters=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Helicopters') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING KILLS ARMOR***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_armor";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_armor` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'armor'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_armor=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Armor') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS AIR DEFENSE***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_air_defense";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_air_defense` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'air_defense'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_air_defense=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Air Defence') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS INFANTRY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_infantry";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_infantry` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Infantry'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_infantry=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Infantry') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS UNARMED***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_unarmed";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_unarmed` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Unarmed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_unarmed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Unarmed') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS SHIPS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_ships";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_ships` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Ships'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_ships=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Ships') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS FORTIFICATIONS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_fortifications";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_fortifications` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Fortifications'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_fortifications=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Fortification') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS WAREHOUSES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_warehouses";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_warehouses` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Warehouses'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_warehouses=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Warehouse') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS ARTILLERY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_artillery";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_artillery` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Artillery'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_artillery=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Artillery') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS MISSILES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_missiles";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_missiles` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'MissilesSS'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_missiles=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'MissilesSS') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS OTHER***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_kills_other";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_kills_other` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Other'
$sql = "UPDATE pe_logevent SET pe_LogEvent_kills_other=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Other') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING TAKEOFFS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_takeoffs";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_takeoffs` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_takeoffs=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING LANDINGS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_landings";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_landings` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_landings=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS, TAKEOFF, LANDING, FriendlyFireKiller - AIR FORCE Military Branch*****//////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//***ADDING KILLS PLANES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_planes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_planes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'planes'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_planes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING KILLS HELICOPTERS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_helicopters";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_helicopters` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'helicopters'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_helicopters=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Helicopters') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING KILLS ARMOR***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_armor";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_armor` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'armor'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_armor=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Armor') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS AIR DEFENSE***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_air_defense";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_air_defense` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'air_defense'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_air_defense=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Air Defence') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS INFANTRY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_infantry";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_infantry` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Infantry'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_infantry=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Infantry') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS UNARMED***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_unarmed";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_unarmed` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Unarmed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_unarmed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Unarmed') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS SHIPS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_ships";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_ships` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Ships'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_ships=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Ships') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS FORTIFICATIONS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_fortifications";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_fortifications` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Fortifications'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_fortifications=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Fortification') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS WAREHOUSES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_warehouses";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_warehouses` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Warehouses'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_warehouses=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Warehouse') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS ARTILLERY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_artillery";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_artillery` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Artillery'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_artillery=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Artillery') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS MISSILES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_missiles";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_missiles` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'MissilesSS'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_missiles=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'MissilesSS') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS OTHER***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_kills_other";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_kills_other` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Other'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_kills_other=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Other') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING TAKEOFFS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_takeoffs";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_takeoffs` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_takeoffs=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING LANDINGS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_landings";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_landings` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_landings=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_AF_friendly_fire_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AF__pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AF_friendly_fire_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_AF__friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_AF_friendly_fire_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Air Force' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED')) ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////END ADDING MILITARY BRANCH TO KILLS/TAKEOFFS/LANDINGS/FRIENDLYFIREKILLER ////////////////




//***ADDING KILLS, TAKEOFF, LANDING, FriendlyFireKiller - ARMY Military Branch*****//////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//***ADDING KILLS PLANES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_planes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_planes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'planes'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_planes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING KILLS HELICOPTERS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_helicopters";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_helicopters` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'helicopters'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_helicopters=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Helicopters') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING KILLS ARMOR***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_armor";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_armor` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'armor'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_armor=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Armor') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS AIR DEFENSE***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_air_defense";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_air_defense` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'air_defense'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_air_defense=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Air Defence') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS INFANTRY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_infantry";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_infantry` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Infantry'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_infantry=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Infantry') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS UNARMED***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_unarmed";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_unarmed` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Unarmed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_unarmed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Unarmed') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS SHIPS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_ships";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_ships` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Ships'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_ships=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Ships') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS FORTIFICATIONS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_fortifications";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_fortifications` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Fortifications'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_fortifications=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Fortification') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS WAREHOUSES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_warehouses";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_warehouses` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Warehouses'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_warehouses=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Warehouse') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS ARTILLERY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_artillery";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_artillery` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Artillery'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_artillery=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Artillery') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS MISSILES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_missiles";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_missiles` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'MissilesSS'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_missiles=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'MissilesSS') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS OTHER***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_kills_other";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_kills_other` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Other'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_kills_other=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Other') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING TAKEOFFS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_takeoffs";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_takeoffs` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_takeoffs=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING LANDINGS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_landings";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_landings` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_landings=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_AR_friendly_fire_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_AR__pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_AR_friendly_fire_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_AR__friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_AR_friendly_fire_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Army' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED')) ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////END ADDING MILITARY BRANCH TO KILLS/TAKEOFFS/LANDINGS/FRIENDLYFIREKILLER ////////////////







//***ADDING KILLS, TAKEOFF, LANDING, FriendlyFireKiller - MARINES Military Branch*****//////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//***ADDING KILLS PLANES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_planes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_planes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'planes'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_planes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING KILLS HELICOPTERS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_helicopters";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_helicopters` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'helicopters'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_helicopters=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Helicopters') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING KILLS ARMOR***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_armor";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_armor` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'armor'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_armor=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Armor') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS AIR DEFENSE***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_air_defense";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_air_defense` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'air_defense'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_air_defense=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Air Defence') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS INFANTRY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_infantry";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_infantry` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Infantry'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_infantry=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Infantry') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS UNARMED***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_unarmed";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_unarmed` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Unarmed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_unarmed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Unarmed') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS SHIPS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_ships";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_ships` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Ships'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_ships=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Ships') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS FORTIFICATIONS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_fortifications";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_fortifications` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Fortifications'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_fortifications=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Fortification') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS WAREHOUSES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_warehouses";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_warehouses` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Warehouses'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_warehouses=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Warehouse') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS ARTILLERY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_artillery";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_artillery` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Artillery'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_artillery=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Artillery') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS MISSILES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_missiles";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_missiles` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'MissilesSS'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_missiles=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'MissilesSS') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS OTHER***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_kills_other";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_kills_other` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Other'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_kills_other=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Other') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING TAKEOFFS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_takeoffs";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_takeoffs` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_takeoffs=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING LANDINGS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_landings";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_landings` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_landings=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_MA_friendly_fire_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_MA__pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_MA_friendly_fire_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_MA__friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_MA_friendly_fire_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Marines' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED')) ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////END ADDING MILITARY BRANCH TO KILLS/TAKEOFFS/LANDINGS/FRIENDLYFIREKILLER ////////////////





//***ADDING KILLS, TAKEOFF, LANDING, FriendlyFireKiller - NAVY Military Branch*****//////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//***ADDING KILLS PLANES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_planes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_planes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'planes'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_planes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING KILLS HELICOPTERS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_helicopters";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_helicopters` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'helicopters'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_helicopters=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Helicopters') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING KILLS ARMOR***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_armor";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_armor` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'armor'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_armor=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Armor') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS AIR DEFENSE***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_air_defense";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_air_defense` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'air_defense'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_air_defense=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Air Defence') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS INFANTRY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_infantry";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_infantry` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Infantry'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_infantry=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Infantry') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS UNARMED***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_unarmed";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_unarmed` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Unarmed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_unarmed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Unarmed') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS SHIPS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_ships";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_ships` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Ships'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_ships=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Ships') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS FORTIFICATIONS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_fortifications";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_fortifications` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Fortifications'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_fortifications=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Fortification') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS WAREHOUSES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_warehouses";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_warehouses` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Warehouses'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_warehouses=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Warehouse') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING KILLS ARTILLERY***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_artillery";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_artillery` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Artillery'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_artillery=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Artillery') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS MISSILES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_missiles";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_missiles` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'MissilesSS'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_missiles=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'MissilesSS') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING KILLS OTHER***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_kills_other";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_kills_other` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'Other'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_kills_other=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Other') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING TAKEOFFS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_takeoffs";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_takeoffs` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_takeoffs=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING LANDINGS***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_landings";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_landings` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'kill' AND 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_landings=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_NV_friendly_fire_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_NV__pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_NV_friendly_fire_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_NV__friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_NV_friendly_fire_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_militarybranch = 'Navy' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED')) ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////END ADDING MILITARY BRANCH TO KILLS/TAKEOFFS/LANDINGS/FRIENDLYFIREKILLER ////////////////



//***ADDING AIRFRAMES***

$sql = "DROP TABLE IF EXISTS pe_LogEvent_airframe";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_airframe`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_airframe` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//refreshing dataset to update all airframe values as NULL
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = NULL";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'kill'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' killed ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'crash'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_type = 'crash')";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'eject'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' ejected ' IN pe_LogEvent.`pe_LogEvent_content`) + 8, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' ejected ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_type = 'eject')";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'pilot_death'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' died' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe for each pilot for pe_LogEvent_type = 'takeoff'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('took off in' IN pe_LogEvent.`pe_LogEvent_content`) + 12, (POSITION(' from ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('took off in' IN pe_LogEvent.`pe_LogEvent_content`) - 12))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Populating airframe for each pilot for pe_LogEvent_type = 'landing'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('landed in' IN pe_LogEvent.`pe_LogEvent_content`) + 9, (POSITION(' at ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('landed in' IN pe_LogEvent.`pe_LogEvent_content`) - 9))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'landing') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'takeoff' ... have to get non-airport named ones too
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 4, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_arg1 = '') AND (pe_LogEvent_type = 'takeoff') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'landing' ... have to get non-airport named ones too
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) + 4, (CHAR_LENGTH(pe_LogEvent_content) - POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - 1))) WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_arg1 = '') AND (pe_LogEvent_type = 'landing') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' (' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'change_slot') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_coalition ='BLUE' OR pe_LogEvent_coalition ='RED') ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = LTRIM(pe_LogEvent_airframe)";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating airframe each pilot for pe_LogEvent_type = 'change_slot'
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_airframe = RTRIM(pe_LogEvent_airframe)";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////////////////////END ADDING AIRFRAMES/////////////////////

//Populating airframe each pilot for pe_LogEvent_type = 'change_slot' for F-14B_2 slot co-pilot seat
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_airframe=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) + 3, (POSITION(' (' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION(' to ' IN pe_LogEvent.`pe_LogEvent_content`) - 3))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'change_slot') AND pe_LogEvent_airframe = 'F-14B' AND pe_LogEvent_playervsai ='Player' "; */

/////////////////////ADDING MILITARY BRANCH////////////////////

$sql = "DROP TABLE IF EXISTS pe_LogEvent_militarybranch";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_airframe`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_militarybranch` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = 'UPDATE pe_logevent 
JOIN (SELECT pe_militarybranch_datatype,
             pe_militarybranch_branch
       FROM pe_militarybranch 
  ) x ON pe_LogEvent_airframe = pe_militarybranch_datatype
SET pe_LogEvent_militarybranch = pe_militarybranch_branch
WHERE pe_LogEvent_airframe IS NOT NULL';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////////////////////////////////////////////////////
/////////ADDING KILLER (COALITION) & KILLED (COALITION) COLUMN AND POPULATING///////
//////////////////////////////////////////////////////////////////

//***ADDING KILLED COALITION***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_coalition_killed_player";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_coalition_killed_player` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating Coalition for killed team: BLUE
//NOTE: IF YOU WANT TO ADD IN FRIENDLY FIRE, ADD LINE !!!!BELOW
// OR pe_LogEvent_type = 'friendly_fire'
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_killed_player = 'BLUE' 
WHERE pe_LogEvent_content LIKE('%killed BLUE player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//Updating Coalition for killed team: RED
//NOTE: IF YOU WANT TO ADD IN FRIENDLY FIRE, ADD LINE !!!!BELOW
// OR pe_LogEvent_type = 'friendly_fire'
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_killed_player = 'RED' 
WHERE pe_LogEvent_content LIKE('%killed RED player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Populating pilot name for 'kill' AND 'player' AND 'BLUE'
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_killed=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */











//***ADDING FRIENDLY FIRE KILLED***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_killed_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create friendly_fire_killed Column in DB as `pe_LogEvent_friendly_fire_killed`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_killed_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'friendly_fire_killed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_killed_pilotname=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) + 20, (POSITION(' in ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) - 20))) WHERE pe_LogEvent_content LIKE('%RED Player%') AND (pe_LogEvent_coalition = 'BLUE') AND(pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' ";

//charindex(' in', pe_LogEvent.`pe_LogEvent_content`, POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`)))

//charindex('_', [TEXT], (charindex('_', [TEXT], 1))+1)
// charindex(' in ', pe_LogEvent.`pe_LogEvent_content`, (charindex(' in ', pe_LogEvent.`pe_LogEvent_content`, 1))+2)
// where +1 is the nth time you will want to find.
//syntax CHARINDEX(substring, string, start)

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



///////////////////////////////////////////////////////
///////////////////END FRIENDLY FIRE STATS/////////////////////////////
//////////////////////////////////////////////////////////////////








///////////////////////////////////////////////////////////////
/////////ADDING FRIENDLY FIRE COLUMN AND POPULATING///////
//////////////////////////////////////////////////////////////////

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_friendly_fire_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_friendly_fire_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED'))  ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***ADDING FRIENDLY FIRE Kamakazi check KILLER***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_friendly_fire_killer_kamakazi";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create friendly_fire_killed Column in DB as `pe_LogEvent_friendly_fire_killed`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_friendly_fire_killer_kamakazi` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'friendly_fire_killed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_killer_kamakazi=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('BLUE' IN pe_LogEvent.`pe_LogEvent_content`) + 0, (POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('BLUE' IN pe_LogEvent.`pe_LogEvent_content`) - 0))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE')  ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating pilot names for 'friendly_fire_killed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_killer_kamakazi=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('RED' IN pe_LogEvent.`pe_LogEvent_content`) + 0, (POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('RED' IN pe_LogEvent.`pe_LogEvent_content`) - 0))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED')  ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING FRIENDLY FIRE Kamakazi check KILLED***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_friendly_fire_killed_kamakazi";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create friendly_fire_killed Column in DB as `pe_LogEvent_friendly_fire_killed`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_friendly_fire_killed_kamakazi` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'friendly_fire_killed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_killed_kamakazi=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) + 7, (POSITION('using' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed' IN pe_LogEvent.`pe_LogEvent_content`) - 7))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND ((pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'RED'))  ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create SELF BOMB Column in DB as `pe_LogEvent_friendly_fire_selfbomb`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_friendly_fire_selfbomb` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for '....selfbomb'
$sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_selfbomb = pe_LogEvent_friendly_fire_killer WHERE (pe_LogEvent_friendly_fire_killer_kamakazi = pe_LogEvent_friendly_fire_killed_kamakazi)  ";




if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////////////////////////////////////////////
///////////////////END FRIENDLY FIRE STATS/////////////////////////////
//////////////////////////////////////////////////////////////////










///////////////////////////////////////////////////////////////
/////////ADDING PVP COLUMN AND POPULATING///////
//////////////////////////////////////////////////////////////////

//***ADDING FRIENDLY FIRE KILLER***//
$sql = "DROP TABLE IF EXISTS pe_LogEvent_pvp_killer";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_pvp_killer` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot name for 'pe_LogEvent_friendly_fire_killer' to add pilotname as the friendly fire killer on BLUE or RED
$sql = "UPDATE pe_logevent SET pe_LogEvent_pvp_killer=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND pe_LogEvent_playervsai ='Player' AND ((pe_LogEvent_coalition_killed_player = 'RED' AND pe_LogEvent_coalition = 'BLUE') OR (pe_LogEvent_coalition_killed_player = 'BLUE' AND pe_LogEvent_coalition = 'RED'))  ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}







///////////////////////////////////////////////////////////////
//END///////ADDING PVP COLUMN AND POPULATING//// END///
//////////////////////////////////////////////////////////////////










//***ADDING CRASHES***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_crashes";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilot name Column in DB
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_crashes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'crash'
$sql = "UPDATE pe_logevent SET pe_LogEvent_crashes=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING EJECTIONS***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_ejections";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilot name Column in DB for eject
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_ejections` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'eject'
$sql = "UPDATE pe_logevent SET pe_LogEvent_ejections=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'eject') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING PILOT DEATHS***
$sql = "DROP TABLE IF EXISTS pe_LogEvent_deaths";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create friendly_fire_killed Column in DB as `pe_LogEvent_friendly_fire_killed`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_deaths` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating pilot names for 'friendly_fire_killed'
$sql = "UPDATE pe_logevent SET pe_LogEvent_deaths=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}






///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////get killed unit detailed name blue killed red ai unit//////////////////////////

//get killed unit detailed name blue killed red ai unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_bluekilledredAIunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_bluekilledredAIunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_bluekilledredAIunit_name=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed RED AI ' IN pe_LogEvent.`pe_LogEvent_content`) + 18, (POSITION(' using ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed RED AI' IN pe_LogEvent.`pe_LogEvent_content`) - 18))) WHERE (pe_LogEvent_type = 'kill') AND (pe_LogEvent_arg2 <> 'Other') AND (pe_LogEvent_arg2 IS NOT NULL) AND (pe_LogEvent_coalition = 'BLUE') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_friendly_fire_selfbomb IS NULL) AND (pe_LogEvent_pvp_killer IS NULL) AND (pe_LogEvent_friendly_fire_killer IS NULL) AND (pe_LogEvent_coalition_killed_player IS NULL)";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_bluekilledredAIunit_name = NULL 
WHERE pe_LogEvent_bluekilledredAIunit_name LIKE'%BLUE AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_bluekilledredAIunit_name = NULL 
WHERE pe_LogEvent_bluekilledredAIunit_name LIKE'%? AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////


//////////////////get killed unit detailed name blue killed red ai unit//////////////////////////

//get killed unit detailed name blue killed red ai unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_bluekilledunknownAIunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_bluekilledunknownAIunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_bluekilledunknownAIunit_name=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed ? AI ' IN pe_LogEvent.`pe_LogEvent_content`) + 16, (POSITION(' using ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed ? AI' IN pe_LogEvent.`pe_LogEvent_content`) - 16))) WHERE (pe_LogEvent_type = 'kill') AND ((pe_LogEvent_arg2 = 'Fortification') OR (pe_LogEvent_arg2 = 'Warehouse')) AND (pe_LogEvent_arg2 <> 'Other') AND (pe_LogEvent_arg2 IS NOT NULL) AND (pe_LogEvent_coalition = 'BLUE') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NULL)AND (pe_LogEvent_friendly_fire_selfbomb IS NULL) AND (pe_LogEvent_pvp_killer IS NULL) AND (pe_LogEvent_friendly_fire_killer IS NULL) AND (pe_LogEvent_arg2 <> 'Planes')  ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_bluekilledunknownAIunit_name = NULL 
WHERE pe_LogEvent_bluekilledunknownAIunit_name LIKE'%BLUE AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_bluekilledunknownAIunit_name = NULL 
WHERE pe_LogEvent_bluekilledunknownAIunit_name LIKE'%RED AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
/* $sql = "UPDATE pe_LogEvent SET pe_LogEvent_bluekilledunknownAIunit_name = NULL 
WHERE pe_LogEvent_bluekilledunknownAIunit_name LIKE'%? AI%'"; */



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////

//get killed unit detailed name blue killed red ai unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_bluekilledplayerunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_bluekilledplayerunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating pilot name for all events
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player' "; */

//populating blue killed player unit planes
$sql = "UPDATE pe_logevent SET pe_LogEvent_bluekilledplayerunit_name = 'Planes'
WHERE pe_logevent_arg2 = 'Planes' AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent_coalition = 'BLUE') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NOT NULL) 
 ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//populating blue killed player unit helicopters
$sql = "UPDATE pe_logevent SET pe_LogEvent_bluekilledplayerunit_name = 'Helicopters'
WHERE pe_logevent_arg2 = 'Helicopters' AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent_coalition = 'BLUE') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NOT NULL) 
 ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



////////////////////////////////////////////
///////////////////////////////////////////
/////////////////get killed unit detailed name RED killed blue unit///////////////////////////

//get killed unit detailed name RED killed blue unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_redkilledblueAIunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_redkilledblueAIunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_redkilledblueAIunit_name=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed BLUE AI ' IN pe_LogEvent.`pe_LogEvent_content`) + 18, (POSITION(' using ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed BLUE AI' IN pe_LogEvent.`pe_LogEvent_content`) - 18))) WHERE (pe_LogEvent_type = 'kill') AND (pe_LogEvent_arg2 <> 'Other') AND (pe_LogEvent_arg2 IS NOT NULL) AND (pe_LogEvent_coalition = 'RED') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_friendly_fire_selfbomb IS NULL) AND (pe_LogEvent_pvp_killer IS NULL) AND (pe_LogEvent_friendly_fire_killer IS NULL) AND (pe_LogEvent_coalition_killed_player IS NULL)";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_redkilledblueAIunit_name = NULL 
WHERE pe_LogEvent_redkilledblueAIunit_name LIKE'%RED AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_redkilledblueAIunit_name = NULL 
WHERE pe_LogEvent_redkilledblueAIunit_name LIKE'%? AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//////////////////get killed unit detailed name red killed blue ai unit//////////////////////////

//get killed unit detailed name red killed blue ai unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_redkilledunknownAIunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_redkilledunknownAIunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_redkilledunknownAIunit_name=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('killed ? AI ' IN pe_LogEvent.`pe_LogEvent_content`) + 16, (POSITION(' using ' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('killed ? AI' IN pe_LogEvent.`pe_LogEvent_content`) - 16))) WHERE (pe_LogEvent_type = 'kill') AND ((pe_LogEvent_arg2 = 'Fortification') OR (pe_LogEvent_arg2 = 'Warehouse')) AND (pe_LogEvent_arg2 <> 'Other') AND (pe_LogEvent_arg2 IS NOT NULL) AND (pe_LogEvent_coalition = 'RED') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NULL)AND (pe_LogEvent_friendly_fire_selfbomb IS NULL) AND (pe_LogEvent_pvp_killer IS NULL) AND (pe_LogEvent_friendly_fire_killer IS NULL) AND (pe_LogEvent_arg2 <> 'Planes')  ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_redkilledunknownAIunit_name = NULL 
WHERE pe_LogEvent_redkilledunknownAIunit_name LIKE'%RED AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_LogEvent SET pe_LogEvent_redkilledunknownAIunit_name = NULL 
WHERE pe_LogEvent_redkilledunknownAIunit_name LIKE'%BLUE AI%'";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



////////////////////////////////////////////

//get killed unit detailed name blue killed red ai unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_redkilledplayerunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_redkilledplayerunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Populating pilot name for all events
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player' "; */

//populating blue killed player unit 
$sql = "UPDATE pe_logevent SET pe_LogEvent_redkilledplayerunit_name = 'planes'
WHERE pe_logevent_arg2 = 'Planes' AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent_coalition = 'RED') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NOT NULL) 
 ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////

//populating red killed player unit helicopters
$sql = "UPDATE pe_logevent SET pe_LogEvent_redkilledplayerunit_name = 'Helicopters'
WHERE pe_logevent_arg2 = 'Helicopters' AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent_coalition = 'RED') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NOT NULL) 
 ";



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////
//COMBINE ALL BLUE AND RED KILLED UNITS TOGETHER
///////////////////////////////////////////
//get detailed name of killed unit
$sql = "DROP TABLE IF EXISTS pe_LogEvent_killedunit_name";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create KilledUnit_name Column in DB as `pe_LogEvent_killedunit_name`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_killedunit_name` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_bluekilledplayerunit_name
WHERE (pe_LogEvent_type = 'kill') AND (pe_LogEvent_playervsai = 'Player') AND pe_LogEvent_bluekilledplayerunit_name IS NOT NULL
 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_redkilledplayerunit_name
WHERE (pe_LogEvent_type = 'kill') AND (pe_LogEvent_playervsai = 'Player') AND pe_LogEvent_redkilledplayerunit_name IS NOT NULL
 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_bluekilledredAIunit_name
WHERE (pe_LogEvent_type = 'kill') 
AND (pe_LogEvent_playervsai = 'Player') 
AND pe_LogEvent_bluekilledredAIunit_name IS NOT NULL 
AND pe_LogEvent_killedunit_name IS NULL
 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_redkilledblueAIunit_name
WHERE (pe_LogEvent_type = 'kill') 
AND (pe_LogEvent_playervsai = 'Player') 
AND pe_LogEvent_redkilledblueAIunit_name IS NOT NULL 
AND pe_LogEvent_killedunit_name IS NULL
 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_bluekilledunknownAIunit_name
WHERE (pe_LogEvent_type = 'kill') 
AND (pe_LogEvent_playervsai = 'Player') 
AND pe_LogEvent_bluekilledunknownAIunit_name IS NOT NULL
AND pe_LogEvent_killedunit_name IS NULL

 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//add in each of 6 columns into 1 column
$sql = "UPDATE pe_logevent SET pe_LogEvent_killedunit_name = pe_LogEvent_redkilledunknownAIunit_name
WHERE (pe_LogEvent_type = 'kill') 
AND (pe_LogEvent_playervsai = 'Player') 
AND pe_LogEvent_redkilledunknownAIunit_name IS NOT NULL
AND pe_LogEvent_killedunit_name IS NULL
 ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

///////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////










//////////////////////CREATING PIE CHART STATS TABLE & ADDING STATS TO IT!////////////


//Creating Coalition column in DB as `pe_LogEvent_coalition`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_coalition_piechartstats` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

///ADDING BLUE STATS TO PIE CHART TABLE ..........///////

//***ADDING B:CRASHES TO PIE CHART TABLE***
//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_piechartstats='B:Crashes' WHERE pe_LogEvent_content LIKE('BLUE%') AND (pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING B:SORTIES TO PIE CHART TABLE***
//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_piechartstats='B:Sorties' WHERE pe_LogEvent_content LIKE('BLUE%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



///////////ADDING RED STATS TO PIE CHART TABLE.......... //////////////

//***ADDING R:SORTIES TO PIE CHART TABLE***
//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_piechartstats='R:Sorties' WHERE pe_LogEvent_content LIKE('RED%') AND (pe_LogEvent_type = 'takeoff') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***ADDING R:CRASHES TO PIE CHART TABLE***
//Updating Coalition for logevent table-> change_slot -> BLUE
$sql = "UPDATE pe_logevent SET pe_LogEvent_coalition_piechartstats='R:Crashes' WHERE pe_LogEvent_content LIKE('RED%') AND (pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='Player'";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
  //sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


/////////////////////////////////////////////////END CRASHES PIE CHART TABLES





//Removing Pilot Names for kamakazi (player killed themselves) from pe_LogEvent_friendly_fire_killer
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_friendly_fire_killer = 'JOE' 
WHERE 
	pe_LogEvent_friendly_fire IN (
		pe_LogEvent_friendly_fire 
	 (
		 
			pe_LogEvent_friendly_fire,
			ROW_NUMBER() OVER (
				PARTITION BY pe_LogEvent_friendly_fire_killed
				ORDER BY pe_LogEvent_friendly_fire_killed) AS row_num
		 
			
		
	) t
    HAVING row_num > 1
"; */

//WHERE (pe_LogEvent_friendly_fire IN( pe_LogEvent_friendly_fire_killed ))";


/* $sql = '
DELETE FROM pe_logevent 
WHERE 
	pe_LastPilotDeath_pilotname IN (
	SELECT 
		pe_LastPilotDeath_pilotname 
	FROM (
		SELECT 
			pe_LastPilotDeath_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_LastPilotDeath_datetime
				ORDER BY pe_LastPilotDeath_datetime) AS row_num
		FROM 
			pe_LastPilotDeath
		
	) t
    WHERE row_num > 1
)'; */




//SELECT *
//FROM tableTest
//WHERE val IN (SELECT ecr FROM tableTest)

// update employees
//       set first_name='Tim'
//       where id in ( select id from emp2 );

/* if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */



//Setting Friendly Fire Kills as NULL for 'friendly_fire'
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_kill_planes= NULL WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent.`pe_Logevent_arg2` = 'Planes') AND pe_LogEvent_playervsai ='Player' AND pe_LogEvent_content HAVING COUNT(LIKE('%BLUE%')) > 1 "; */

/* SELECT DISTINCT pe_LogEvent_content, COUNT(*)
FROM pe_logevent
WHERE 
GROUP BY pe_LogEvent_content, email
HAVING COUNT(*) > 1 */

//////////////////////END//////////////////////


//Updating or Populating AI Pilot Name ... KEEP THIS FOR LATER!!!
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname= 'AI' WHERE pe_LogEvent_content LIKE('%AI%') AND (pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'crash') AND pe_LogEvent_playervsai ='AI' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */

//Updating or Populating Pilot Name to change_slot value
$sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=(SUBSTRING(pe_LogEvent.`pe_LogEvent_content`, POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) + 7, (POSITION('ange' IN pe_LogEvent.`pe_LogEvent_content`) - POSITION('Player' IN pe_LogEvent.`pe_LogEvent_content`) - 10))) WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'change_slot') AND pe_LogEvent_playervsai ='Player' ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////////////////////////////////////////////////////////////

$sql = "DROP TABLE IF EXISTS pe_LogEvent_lastpilotdeathname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Creating LastPilotDeath Column in DB as `pe_LogEvent_lastpilotdeathtime`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_lastpilotdeathname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_lastpilotdeathname=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND (pe_LogEvent_type = 'pilot_death') AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//////////////////////////////////////////////////////////////////////////////////






/* //Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_pilotname=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_playervsai = 'Player' AND pe_LogEvent_type = 'kill' "; */


//Prior work that allowed me to complete this, use below in a query
//SUBSTRING(pe_LogeEvent.`pe_LogEvent_content`, POSITION('Player' IN pe_LogeEvent.`pe_LogEvent_content`) + 2, 3) AS value_mission_short







/* //Updating or Populating Pilot Name ... basically have to get the position of characters in order to extract a substring to display it
$sql = "UPDATE pe_logevent SET pe_LogEvent_LastPilotDeathName= pe_LogEvent_PilotName WHERE ((pe_LogEvent_content LIKE('%Player%')) AND (pe_LogEvent_type = 'pilot_death') AND (pe_LogEvent_playervsai ='Player')) "; */




/* //Clearing LastPilotDeath Column in DB as `pe_LogEvent_lastpilotdeathtime` to write all NULL values
$sql = "UPDATE pe_logevent SET `pe_LogEvent_lastpilotdeathtime` = NULL ";

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


/* //Updating or Populating LastPilotDeathtime column -> pilot name AND pe_LogEvent_type='pilot_death' AND pe_LogEvent_datetime = MOST RECENT TIME??? 
// USE THIS TO FIND MOST RECENT TIME https://stackoverflow.com/questions/17038193/select-row-with-most-recent-date-per-user/17038667
$sql = "UPDATE pe_logevent SET pe_LogEvent_lastpilotdeathtime=pe_LogEvent_datetime WHERE(pe_LogEvent_type='pilot_death') ";

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


//-------------------Creating new table for most recent pilot death--------


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
//$sql = "IF NOT EXISTS CREATE TABLE pe_lastpilotdeath ADD  `pe_lastpilotdeath_pilotname` VARCHAR(100)";


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Reference Table for Ancestory Addition -> sets stage for Hardcore mode / Stats Reset on Last Death
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//DROP TABLE if pe_LastPilotDeath exists
/* $sql = "DROP TABLE IF EXISTS pe_ancestors";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_ancestors (
pe_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_sufCode VARCHAR(100) DEFAULT NULL,
pe_sufLetter VARCHAR(100) DEFAULT NULL
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

$sql = "INSERT INTO pe_ancestors(
        pe_sufCode,
        pe_sufLetter)
    VALUES
        ('0',''),('1','Jr.'),('2','III'),('3','IV'),('4','V'),
        ('5','VI'),('6','VII'),('7','VIII'),('8','IX'),('9','X'),
        ('10','XI'),('11','XII'),('12','XIII'),('13','XIV'),('14','XV'),
        ('15','XVI'),('16','XVII'),('17','XVIII'),('18','XIX'),('19','XX'),
        ('20','XXI'),('21','XXII'),('22','XXIII'),('23','XXIV'),
        ('24','XXV'),('25','XXVI'),('26','XXVII'),('27','XXVIII'),
        ('28','XXIX'),('29','XXX')";

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: pe_LogEvent -> delete glitch issues when loading in airframe between  'change_slot' and 'takeoff'
//Delete 'pilot_death', 'crash', or 'eject'
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


// how to delete this data
// 1. Find all take off data times
// 2. Find all change_slot times
// 3. CASE if data is death, crash, or eject, then delete data between change slot and takeoff
       //3a. make sure that change_slot is always before takeoff ... If change_slot is time < takeoff
	   //3b. caveot will be ... bc it's hardcore mode ... if you airstart then your death/crash/ejection won't count ... invulnerability
	   
// 4. Find out how to delete data between two different time stamps for crash, death, and eject
// 

/*     DELETE FROM pe_LogEvent WHERE pe_LogEvent_id IN (
            Select pe_LogEvent_id
            from pe_LogEvent
            where pe_LogEvent_datetime
            between pe_LogEvent_datetime AND (SELECT DATE_ADD(pe_LogEvent_datetime, INTERVAL 2 MINUTE))
            AND pe_LogEvent_type IN ('change_slot','pilot_death','eject')
        ); 
 */

/* // THIS WORKS TO DELETE ONLY 'CRASH' 'PILOT_DEATH' and 'EJECT'
$sql = 'DELETE FROM pe_LogEvent WHERE pe_LogEvent_id IN (
	SELECT pe_LogEvent_id 
	FROM pe_LogEvent
	WHERE pe_LogEvent_datetime
	BETWEEN pe_LogEvent_datetime AND (SELECT DATE_ADD(pe_LogEvent_datetime, INTERVAL 2 MINUTE))
            AND pe_LogEvent_type IN ("crash","pilot_death","eject") )'; */


/* $sql = "DELETE FROM pe_LogEvent WHERE pe_LogEvent_type IN (
    SELECT inTimeRange.pe_LogEvent_type FROM
            (
                Select pe_LogEvent_id, pe_LogEvent_type
                from pe_LogEvent
                where pe_LogEvent_datetime
                between pe_LogEvent_datetime AND (SELECT DATE_ADD(pe_LogEvent_datetime, INTERVAL 2 MINUTE))
            ) as inTimeRange
    WHERE inTimeRange.pe_LogEvent_type IN ('crash','pilot_death','eject')
)"; */

//MOST RECENT ONE!!!
/* $sql = "
DELETE FROM pe_LogEvent WHERE pe_LogEvent_id IN (
    SELECT inTimeRange.pe_LogEvent_id FROM
            (
                Select pe_LogEvent_id, pe_LogEvent_type
                from pe_LogEvent
                where pe_LogEvent_datetime
                between pe_LogEvent_datetime AND (
                    SELECT DATE_ADD(pe_LogEvent_datetime, INTERVAL 2 MINUTE)
                        where pe_LogEvent_type = 'change_slot'
						ORDER BY pe_LogEvent_datetime DESC
						LIMIT 1
                    )
            ) as inTimeRange
    WHERE inTimeRange.pe_LogEvent_type IN ('crash','pilot_death','eject')
) "; */


////////////////////CREATE PE_CHANGE_SLOTS_DATES TO RESOLVE LOAD IN CHANGE_SLOT PILOT_DEATH/CRASH/EJECT ISSUE////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_change_slots_dates";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_change_slots_dates (
pe_change_slots_dates_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_change_slots_dates_starttime DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_change_slots_dates_endtime DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_change_slots_dates_endtimelanding DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_change_slots_pilotname VARCHAR(100) DEFAULT NULL,
pe_change_slots_deletedeath VARCHAR(100) DEFAULT NULL
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
$sql = 'INSERT INTO pe_change_slots_dates
(pe_change_slots_dates_starttime,
pe_change_slots_dates_endtime,
pe_change_slots_dates_endtimelanding,
pe_change_slots_pilotname)
    SELECT
        pe_LogEvent_datetime AS pe_change_slots_dates_starttime,
        pe_LogEvent_datetime + INTERVAL 2 MINUTE AS pe_change_slots_dates_endtime,
       pe_LogEvent_datetime + INTERVAL 15 SECOND AS pe_change_slots_dates_endtimelanding,		
		pe_LogEvent_pilotname AS pe_change_slots_pilotname
    FROM pe_LogEvent
    WHERE pe_LogEvent_type = "change_slot"';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE crash, death, eject between change_slot starttime to + 2min **ONLY AFFECTS BLUE or RED coalition and not ? from slot blocking
$sql = "
DELETE FROM pe_LogEvent  
WHERE pe_LogEvent_id IN (SELECT 
        pe.pe_LogEvent_id AS id

    FROM pe_LogEvent AS pe
        INNER JOIN pe_change_slots_dates AS csd ON (pe.pe_LogEvent_datetime BETWEEN csd.pe_change_slots_dates_starttime AND csd.pe_change_slots_dates_endtime)
    WHERE (pe.pe_LogEvent_PilotName = csd.pe_change_slots_pilotname) AND (pe.pe_LogEvent_type = 'crash' OR pe.pe_LogEvent_type = 'pilot_death' OR pe.pe_LogEvent_type = 'eject') AND (pe.pe_LogEvent_coalition = 'BLUE' OR pe.pe_LogEvent_coalition = 'RED') )
";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//DELETE landing after change_slot happens starttime to + 15 seconds
$sql = "
DELETE FROM pe_LogEvent  
WHERE pe_LogEvent_id IN (SELECT 
        pe.pe_LogEvent_id AS id

    FROM pe_LogEvent AS pe
        INNER JOIN pe_change_slots_dates AS csd ON (pe.pe_LogEvent_datetime BETWEEN csd.pe_change_slots_dates_starttime AND csd.pe_change_slots_dates_endtimelanding)
    WHERE (pe.pe_LogEvent_PilotName = csd.pe_change_slots_pilotname) AND ((pe.pe_LogEvent_type = 'landing') OR (pe.pe_LogEvent_type = 'takeoff')))
";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE crash, death, eject between change_slot starttime to + 2min
/* $sql = "
INSERT INTO  
	SELECT pe.pe_LogEvent_id AS id
    CASE WHEN (pe.pe_LogEvent_PilotName) = csd.pe_change_slots_pilotname THEN csd.pe_change_slots_deletedeath = 'YES' ELSE csd.pe_change_slots_deletedeath = 'NO' END
    FROM pe_LogEvent AS pe
        INNER JOIN pe_change_slots_dates AS csd ON (pe.pe_LogEvent_datetime BETWEEN csd.pe_change_slots_dates_starttime AND csd.pe_change_slots_dates_endtime)
"; */


//WORKS KEEP IT IF FAIL!!!
/* $sql = "
DELETE FROM pe_LogEvent WHERE pe_LogEvent_datetime BETWEEN 
	(SELECT pe_LogEvent_datetime FROM pe_LogEvent WHERE pe_LogEvent_type = 'change_slot' ORDER BY pe_LogEvent_datetime DESC LIMIT 1 ) 
	AND 
	(SELECT pe_LogEvent_datetime + INTERVAL 2 MINUTE FROM pe_LogEvent WHERE pe_LogEvent_type = 'change_slot' ORDER BY pe_LogEvent_datetime DESC LIMIT 1) 
	AND pe_LogEvent_type IN ('crash', 'pilot_death', 'eject')"; */


////////////////////CREATE PE_PREPFLIGHTDURATION TO ADD 1 SECOND TO CHANGE_SLOT/////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_prepflightduration";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_prepflightduration (
pe_prepflightduration_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_prepflightduration_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_prepflightduration_type VARCHAR(100) DEFAULT NULL,
pe_prepflightduration_pilotid VARCHAR(100) DEFAULT NULL,
pe_prepflightduration_pilotname VARCHAR(100) DEFAULT NULL

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

// INSERT LogEvent as prepflightduration
$sql = 'INSERT INTO pe_prepflightduration
(pe_prepflightduration_datetime,
pe_prepflightduration_type,
pe_prepflightduration_pilotid,
pe_prepflightduration_pilotname
)
    SELECT
        pe_LogEvent_datetime AS pe_prepflightduration_datetime,
        pe_LogEvent_type AS pe_prepflightduration_type,
       pe_LogEvent_pilotid AS pe_prepflightduration_pilotid,		
		pe_LogEvent_pilotname AS pe_prepflightduration_pilotname
    FROM pe_LogEvent
    WHERE (pe_LogEvent_type = "landing" OR pe_LogEvent_type = "takeoff" OR pe_LogEvent_type = "crash" OR pe_LogEvent_type = "eject" OR pe_LogEvent_type = "pilot_death" OR pe_LogEvent_type = "change_slot") 
	ORDER BY pe_prepflightduration_datetime ASC
	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//************************
//IF pe_LogEvent_type CURRENT row = 'change_slot' AND (CURRENT ROW AND PREVIOUS ROW datetime match) then ADD 1 SECOND to row TYPE 'change_slot' ... point it to force change_slot to be below for any events that happen at the same time.
$sql = '
UPDATE pe_prepflightduration 
   SET pe_prepflightduration_datetime = DATE_ADD(pe_prepflightduration_datetime, INTERVAL 1 SECOND)
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_prepflightduration_id, pe_prepflightduration_type, pe_prepflightduration_datetime, lead(pe_prepflightduration_datetime) OVER (PARTITION BY pe_prepflightduration_pilotid ORDER BY pe_prepflightduration_id) AS lead_pe_prepflightduration_datetime 
      FROM pe_prepflightduration
  ) AS t 
  WHERE t.pe_prepflightduration_datetime = t.lead_pe_prepflightduration_datetime
    AND t.pe_prepflightduration_type = "change_slot"
  AND t.pe_prepflightduration_id = pe_prepflightduration.pe_prepflightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




////////////////////CREATE PE_FLIGHTDURATION FOR FORMATION OF FLIGHT DURATION CALCULATION////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_flightduration";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_flightduration (
pe_flightduration_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_flightduration_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
pe_flightduration_type VARCHAR(100) DEFAULT NULL,
pe_flightduration_takeofflandingnum BIGINT(20) DEFAULT NULL,
pe_flightduration_pilotid VARCHAR(100) DEFAULT NULL,
pe_flightduration_pilotname VARCHAR(100) DEFAULT NULL,
pe_flightduration_nolanding VARCHAR(100) DEFAULT NULL
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
$sql = 'INSERT INTO pe_flightduration
(pe_flightduration_datetime,
pe_flightduration_type,
pe_flightduration_pilotid,
pe_flightduration_pilotname
)
    SELECT
        pe_prepflightduration_datetime AS pe_flightduration_datetime,
        pe_prepflightduration_type AS pe_flightduration_type,
       pe_prepflightduration_pilotid AS pe_flightduration_pilotid,		
		pe_prepflightduration_pilotname AS pe_flightduration_pilotname
    FROM pe_prepflightduration
    WHERE (pe_prepflightduration_type = "landing" OR pe_prepflightduration_type = "takeoff" OR pe_prepflightduration_type = "crash" OR pe_prepflightduration_type = "eject" OR pe_prepflightduration_type = "pilot_death" OR pe_prepflightduration_type = "change_slot") 
	ORDER BY pe_flightduration_datetime ASC
	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//************************
//IF pe_flightduration_type CURRENT row = 'change_slot' AND if the NEXT row is 'crash' THEN CHANGE 'crash' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "crash" 
    AND t.lag_pe_flightduration_type = "change_slot"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'change_slot' AND if the NEXT row is 'pilot_death' THEN CHANGE 'pilot_death' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "pilot_death" 
    AND t.lag_pe_flightduration_type = "change_slot"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





//IF pe_flightduration_type CURRENT row = 'change_slot' AND if the NEXT row is 'eject' THEN CHANGE 'eject' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "eject" 
    AND t.lag_pe_flightduration_type = "change_slot"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'change_slot' AND if the NEXT row is 'landing' THEN CHANGE 'landing' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "landing" 
    AND t.lag_pe_flightduration_type = "change_slot"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'delete' AND if the NEXT row is 'eject' THEN CHANGE 'eject' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "eject" 
    AND t.lag_pe_flightduration_type = "delete"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'delete' AND if the NEXT row is 'crash' THEN CHANGE 'crash' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "crash" 
    AND t.lag_pe_flightduration_type = "delete"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//IF pe_flightduration_type CURRENT row = 'delete' AND if the NEXT row is 'pilot_death' THEN CHANGE 'pilot_death' to 'delete'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "pilot_death" 
    AND t.lag_pe_flightduration_type = "delete"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE any row that is change_slot or delete ... first iteration of delete
$sql = '
DELETE FROM pe_flightduration 
WHERE(pe_flightduration_type = "change_slot" OR pe_flightduration_type = "delete")
';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//****************************************************

// Create variable to save @a = 0 for the purpose of incrementing by one
$sql = '
SET @a = 0'; 


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//this code works, but does not iterate over all pilotids
/* $sql = '
UPDATE pe_flightduration 
SET CASE WHEN pe_flightduration_type = "takeoff" AND (pe_flightduration_id + 1) = pe_flightduration_type = "crash"  THEN pe_flightduration_type = "landing" END
'; */

//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'landing' THEN add 'landed' to flightduration_nolanding for this 'takeoff'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_nolanding = "landed"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lead(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lead_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "takeoff" 
    AND t.lead_pe_flightduration_type = "landing"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//LOGIC COLUMNS NEEDED TO GET FLIGHT DURATION ACCURATE
//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'crash' THEN CHANGE 'crash' to 'landing'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "landing"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "crash" 
    AND t.lag_pe_flightduration_type = "takeoff"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'crash' THEN CHANGE 'crash' to 'landing'
/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "crash"
THEN "landing" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'eject' THEN CHANGE 'eject' to 'landing'
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "landing"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "eject" 
    AND t.lag_pe_flightduration_type = "takeoff"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "eject"
THEN "landing" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */



if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'pilot_death' THEN CHANGE NEXT row 'pilot_death' to 'landing'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "landing"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "pilot_death" 
    AND t.lag_pe_flightduration_type = "takeoff"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "pilot_death"
THEN "landing" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the NEXT row is 'takeoff' THEN CHANGE NEXT row 'takeoff' to 'delete'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "takeoff1"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "takeoff" 
    AND t.lag_pe_flightduration_type = "takeoff"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';

/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "takeoff"
THEN "takeoff1" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//IF pe_flightduration_type CURRENT row = 'landing' AND if the NEXT row is 'landing' THEN CHANGE NEXT row 'landing' to 'delete'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "landing" 
    AND t.lag_pe_flightduration_type = "landing"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "landing" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "landing"
THEN "delete" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//************************
//IF pe_flightduration_type CURRENT row = 'takeoff1' AND if the PREVIOUS row is 'takeoff' THEN CHANGE PREVIOUS row 'takeoff' to 'delete'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lead(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lead_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "takeoff" 
    AND t.lead_pe_flightduration_type = "takeoff1"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id - 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff1" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id - 1 = pe_flightduration_id) = "takeoff"
THEN "delete" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//UPDATE "takeoff1" to be "takeoff"
$sql = '
UPDATE pe_flightduration 
SET pe_flightduration_type  = "takeoff"
WHERE pe_flightduration_type = "takeoff1"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//

//DELETE any row that is not takeoff or landing
$sql = '
DELETE FROM pe_flightduration 
WHERE NOT (pe_flightduration_type = "takeoff" OR pe_flightduration_type = "landing")
';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//****************************************************


//IF pe_flightduration_type CURRENT row = 'landing' AND if the NEXT row is 'landing' THEN CHANGE NEXT row 'landing' to 'delete'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lag(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lag_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "landing" 
    AND t.lag_pe_flightduration_type = "landing"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id + 1 as col1, CASE 
WHEN pe_flightduration_type = "landing" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id + 1 = pe_flightduration_id) = "landing"
THEN "delete" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//IF pe_flightduration_type CURRENT row = 'takeoff' AND if the PREVIOUS row is 'takeoff' THEN CHANGE PREVIOUS row 'takeoff' to 'delete'... delete later
$sql = '
UPDATE pe_flightduration 
   SET pe_flightduration_type = "delete"
WHERE EXISTS (
  SELECT 1 FROM (
      SELECT pe_flightduration_id, pe_flightduration_type, lead(pe_flightduration_type) OVER (PARTITION BY pe_flightduration_pilotid ORDER BY pe_flightduration_id) AS lead_pe_flightduration_type 
      FROM pe_flightduration
  ) AS t 
  WHERE t.pe_flightduration_type = "takeoff" 
    AND t.lead_pe_flightduration_type = "takeoff"
  AND t.pe_flightduration_id = pe_flightduration.pe_flightduration_id
);';


/* $sql = '
UPDATE pe_flightduration 
INNER JOIN (SELECT  pe_flightduration_id - 1 as col1, CASE 
WHEN pe_flightduration_type = "takeoff1" 
AND (SELECT pe_flightduration_type FROM pe_flightduration WHERE t1.pe_flightduration_id - 1 = pe_flightduration_id) = "takeoff"
THEN "delete" ELSE NULL END as col2 from pe_flightduration t1 order by pe_flightduration_id) t2 ON pe_flightduration.pe_flightduration_id = t2.col1 AND t2.col2 IS NOT NULL
SET pe_flightduration_type = col2
'; */


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE any row that is not takeoff or landing (one more final iteration of this deletion is necessary)
$sql = '
DELETE FROM pe_flightduration 
WHERE NOT (pe_flightduration_type = "takeoff" OR pe_flightduration_type = "landing")
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


// counting each takeoff as an increment for use to find flight duration
$sql = '
UPDATE pe_flightduration
JOIN(
	SELECT pe_flightduration_id,
		row_number() over (partition by pe_flightduration_pilotid 
		order by pe_flightduration_id) rn from pe_flightduration) N on N.pe_flightduration_id = pe_flightduration.pe_flightduration_id
SET pe_flightduration_takeofflandingnum = rn
WHERE pe_flightduration_type = "takeoff"
';



if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// counting each landing as an increment for use to find flight duration
$sql = '
UPDATE pe_flightduration
JOIN(
	SELECT pe_flightduration_id,
		row_number() over (partition by pe_flightduration_pilotid
		order by pe_flightduration_id) rn from pe_flightduration) N on N.pe_flightduration_id =	pe_flightduration.pe_flightduration_id
SET pe_flightduration_takeofflandingnum = rn
WHERE pe_flightduration_type = "landing"
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$sql = '
UPDATE pe_flightduration SET pe_flightduration_takeofflandingnum = pe_flightduration_takeofflandingnum - 1
WHERE pe_flightduration_type = "landing"
';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////CREATE PE_FINALFLIGHTDURATION FOR FINAL FLIGHT DURATION TIME////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_finalflightduration";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_finalflightduration (
pe_finalflightduration_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_finalflightduration_takeoffdatetime DATETIME DEFAULT NULL,
pe_finalflightduration_landingdatetime DATETIME DEFAULT NULL,
pe_finalflightduration_takeofflandingnum BIGINT(20) DEFAULT NULL,
pe_finalflightduration_duration BIGINT(20) DEFAULT NULL,
pe_finalflightduration_pilotid VARCHAR(100) DEFAULT NULL,
pe_finalflightduration_pilotname VARCHAR(100) DEFAULT NULL,
pe_finalflightduration_nolanding VARCHAR(100) DEFAULT NULL,
pe_finalflightduration_militarybranch VARCHAR(100) DEFAULT NULL,
pe_finalflightduration_duration_af BIGINT(20) DEFAULT NULL,
pe_finalflightduration_duration_ar BIGINT(20) DEFAULT NULL,
pe_finalflightduration_duration_nv BIGINT(20) DEFAULT NULL,
pe_finalflightduration_duration_ma BIGINT(20) DEFAULT NULL
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

// INSERT values from pe_flightduration & only takeoff time
$sql = 'INSERT INTO pe_finalflightduration
(pe_finalflightduration_takeoffdatetime,
pe_finalflightduration_takeofflandingnum,
pe_finalflightduration_pilotid,
pe_finalflightduration_pilotname 
)
    SELECT DISTINCT
	pe_flightduration_datetime AS pe_finalflightduration_takeoffdatetime,
	pe_flightduration_takeofflandingnum AS pe_finalflightduration_takeofflandingnum,
	pe_flightduration_pilotid AS pe_finalflightduration_pilotid,
	pe_flightduration_pilotname AS pe_finalflightduration_pilotname
	   
    FROM pe_flightduration
	WHERE pe_flightduration_type = "takeoff"
	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// INSERT landing time from pe_flightduration
$sql = 'UPDATE pe_finalflightduration
JOIN(
	SELECT pe_flightduration_type, pe_flightduration_datetime, pe_flightduration_pilotid, pe_flightduration_takeofflandingnum
	FROM pe_flightduration) x ON pe_flightduration_takeofflandingnum = pe_finalflightduration_takeofflandingnum
	SET pe_finalflightduration_landingdatetime = pe_flightduration_datetime
	WHERE pe_flightduration_type = "landing" AND pe_flightduration_takeofflandingnum = pe_finalflightduration_takeofflandingnum AND pe_flightduration_pilotid = pe_finalflightduration_pilotid 
';

// UPDATE pe_finalflightduration SET pe_finalflightduration_landingdatetime = pe_flightduration_datetime
//WHERE pe_flightduration_type = "landing"


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}
//just create another table sortie that has 2 different columns for flight duration and column takeofflandingnum and pilot id
//change flight duration to flight calculation and make new rbale as flightduration
$sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration = 
TIMESTAMPDIFF(MINUTE,pe_finalflightduration_takeoffdatetime, pe_finalflightduration_landingdatetime)

';

/* $sql = 'INSERT INTO pe_finalflightduration
(pe_finalflightduration_duration)
SELECT DISTINCT TIMESTAMPDIFF(MINUTE,pe_finalflightduration_takeoffdatetime, pe_finalflightduration_landingdatetime)
  FROM pe_finalflightduration
GROUP BY pe_finalflightduration_pilotid, pe_finalflightduration_takeofflandingnum
';  */

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//inserting multiple columns from pe_flightduration
$sql = ' UPDATE pe_finalflightduration 
JOIN( SELECT pe_flightduration_type, pe_flightduration_nolanding, pe_flightduration_pilotid, pe_flightduration_datetime
	FROM pe_flightduration) x ON pe_flightduration_datetime = pe_finalflightduration_takeoffdatetime
	SET pe_finalflightduration_nolanding = "landed"
	WHERE pe_flightduration_datetime = pe_finalflightduration_takeoffdatetime 
	AND pe_flightduration_pilotid = pe_finalflightduration_pilotid
	AND pe_flightduration_type = "takeoff" 
	AND pe_flightduration_nolanding = "landed"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE deleting any flight that is less than 1 minutes in duration to eliminate all the hello cargo scooting
$sql = '
DELETE FROM pe_finalflightduration 
WHERE pe_finalflightduration_duration < 1
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


// INSERT branch into each flight
$sql = ' UPDATE pe_finalflightduration 
JOIN( SELECT pe_logevent_militarybranch, pe_logevent_datetime
	FROM pe_logevent) x ON pe_logevent_datetime = pe_finalflightduration_takeoffdatetime
	SET pe_finalflightduration_militarybranch = pe_logevent_militarybranch
	WHERE pe_logevent_datetime = pe_finalflightduration_takeoffdatetime AND pe_logevent_militarybranch IS NOT NULL

';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//filtering pe_flightduration by military branch - air force
$sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration_af = pe_finalflightduration_duration
WHERE pe_finalflightduration_militarybranch = "Air Force"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//filtering pe_flightduration by military branch - army
$sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration_ar = pe_finalflightduration_duration
WHERE pe_finalflightduration_militarybranch = "Army"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//filtering pe_flightduration by military branch - Navy
$sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration_nv = pe_finalflightduration_duration
WHERE pe_finalflightduration_militarybranch = "Navy"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//filtering pe_flightduration by military branch - Marines (USMC)
$sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration_ma = pe_finalflightduration_duration
WHERE pe_finalflightduration_militarybranch = "Marines"
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE 1 minute from every flight to sync with the hardcore stats which avoid explosion on spawn issues in first 45 seconds
/* $sql = '
UPDATE pe_finalflightduration SET pe_finalflightduration_duration = pe_finalflightduration_duration - 1
'; */

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// Create variable to save @a = 0 for the purpose of incrementing by one
/* $sql = '
SET @a = 0'; 


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */

//this code works, but does not iterate over all pilotids
/* $sql = '
UPDATE pe_flightduration 
JOIN ( SELECT DISTINCT pe_LogEvent_pilotid
       FROM pe_LogEvent 
       GROUP BY pe_LogEvent_pilotid) x ON pe_LogEvent_pilotid = pe_flightduration_pilotid
SET pe_flightduration_takeofflandingnum = @a:=@a+1
WHERE pe_flightduration_type = "takeoff" AND pe_flightduration_pilotid = 1
'; */


//try adding this code get this to work for each pilotid
//https://dba.stackexchange.com/questions/164781/how-do-i-loop-through-a-table-and-update-a-field-in-sql/164785
/* update r
  set OrderId = NewOrderId
  from (
    select *
      ,  NewOrderId = row_number() over (
            partition by AccountId
            order by [RowId]
      )
    from Renewals
      ) as r */


// Increment takeoff by one ... NEED TO ADD FOR EACH SOMEHOW SO THAT IT CONDUCTS THIS FOR EACH PILOTID.
/* $sql = '
UPDATE pe_flightduration SET pe_flightduration_takeofflandingnum = @a:=@a+1
WHERE pe_flightduration_pilotid = pe_LogEvent_pilotid AND pe_flightduration_type = "takeoff"

;'; */





// Create variable to save @a = 0 for the purpose of incrementing by one
$sql = '
SET @b = 0';  

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

// Increment landing by one ... NEED TO ADD FOR EACH SOMEHOW SO THAT IT CONDUCTS THIS FOR EACH PILOTID.
/* $sql = '
UPDATE pe_flightduration SET pe_flightduration_takeofflandingnum = @b:=@b+1
WHERE pe_flightduration_pilotid = 1 AND pe_flightduration_type = "landing"

;'; */


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE crash, death, eject between change_slot starttime to + 2min
/* $sql = "
DELETE FROM pe_LogEvent  
WHERE pe_LogEvent_id IN (SELECT 
        pe.pe_LogEvent_id AS id

    FROM pe_LogEvent AS pe
        INNER JOIN pe_change_slots_dates AS csd ON (pe.pe_LogEvent_datetime BETWEEN csd.pe_change_slots_dates_starttime AND csd.pe_change_slots_dates_endtime)
    WHERE (pe.pe_LogEvent_PilotName = csd.pe_change_slots_pilotname) AND (pe.pe_LogEvent_type = 'crash' OR pe.pe_LogEvent_type = 'pilot_death' OR pe.pe_LogEvent_type = 'eject'))
";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////CREATE PE_CAMPAIGN FOR ENABLING CLICKABLE CAMPAIGN STATS////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_campaign";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_campaign (
pe_campaign_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_campaign_name VARCHAR(100) DEFAULT NULL

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

//INSERT only campaign_name
$sql = 'INSERT INTO pe_campaign
    (
	pe_campaign_name
	)
    SELECT DISTINCT
	SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 30) AS pe_campaign_name
	   
    FROM pe_DataMissionHashes

	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////CREATE PE_MISSION FOR ENABLING CLICKABLE CAMPAIGN STATS////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_mission";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_Mission
$sql = 'CREATE TABLE IF NOT EXISTS pe_mission (
pe_mission_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_mission_name VARCHAR(100) DEFAULT NULL,
pe_mission_name_short VARCHAR(100) DEFAULT NULL

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

//INSERT mission_name and mission_name_short
$sql = 'INSERT INTO pe_mission
    (
	pe_mission_name,
	pe_mission_name_short
	)
    SELECT DISTINCT
	SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 26) AS pe_mission_name,
	SUBSTRING(pe_DataMissionHashes_hash, POSITION("_0" IN pe_DataMissionHashes_hash) + 1, 3) AS pe_mission_name_short
	   
    FROM pe_DataMissionHashes

	';

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////CREATE PE_CAMPAIGNDETAILS FOR ENABLING CLICKABLE CAMPAIGN STATS////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//DROP TABLE if exists
$sql = "DROP TABLE IF EXISTS pe_campaigndetails";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table 
$sql = 'CREATE TABLE IF NOT EXISTS pe_campaigndetails (
pe_campaigndetails_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_campaigndetails_missionhash_id BIGINT(20) DEFAULT NULL,
pe_campaigndetails_missionhash_hash VARCHAR(150) DEFAULT NULL,
pe_campaigndetails_name VARCHAR(100) DEFAULT NULL,
pe_campaigndetails_name_id INT(20) DEFAULT NULL,
pe_campaigndetails_mission_name VARCHAR(100) DEFAULT NULL,
pe_campaigndetails_mission_name_id INT(20) DEFAULT NULL,
pe_campaigndetails_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP

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

//filtering pe_flightduration by military branch - Marines (USMC)
/* $sql = 'UPDATE pe_finalflightduration SET pe_finalflightduration_duration_ma = pe_finalflightduration_duration
WHERE pe_finalflightduration_militarybranch = "Marines"
';
 */
if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//$sql = "UPDATE pe_campaigndetails SET pe_campaigndetails_name=SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 30) WHERE pe_LogEvent_content LIKE('BLUE%')AND (pe_LogEvent_type = 'change_slot' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'friendly_fire')";

// SET pe_campaign_name as DSMC campaign names
/* $sql = ' UPDATE pe_campaigndetails 
JOIN( SELECT pe_DataMissionHashes_hash, pe_DataMissionHashes_id
	FROM pe_DataMissionHashes) x ON pe_campaigndetails_missionhash_id = pe_DataMissionHashes_id

	SET pe_campaigndetails_name = SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 30)

'; */


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




// INSERT values from pe_flightduration & only takeoff time
$sql = 'INSERT INTO pe_campaigndetails
    (
	pe_campaigndetails_missionhash_id,
	pe_campaigndetails_missionhash_hash,
	pe_campaigndetails_name,
	pe_campaigndetails_mission_name,
  pe_campaigndetails_datetime
	)
    SELECT DISTINCT
	pe_DataMissionHashes_id AS pe_campaigndetails_missionhash_id,
	pe_DataMissionHashes_hash AS pe_campaigndetails_missionhash_hash,
	SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 30) AS pe_campaigndetails_name,
	SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 26) AS pe_campaigndetails_mission_name,
  pe_DataMissionHashes_datetime AS pe_campaigndetails_datetime	
	   
    FROM pe_DataMissionHashes

	';

//	WHERE (SUBSTRING(pe_DataMissionHashes_hash, 1, CHAR_LENGTH(pe_DataMissionHashes_hash) - 30) <> "")

if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//INSERT only campaign_name
/* $sql = 'INSERT INTO pe_campaigndetails
    (
	pe_campaigndetails_name_id
	)
    SELECT 
	pe_campaign_name,
	pe_campaign_id AS pe_campaigndetails_name_id
	   
    FROM pe_campaign
	WHERE pe_campaign_name = pe_campaigndetails_name

	'; */

//UPDATE only campaign_name_id
$sql = '
UPDATE pe_campaigndetails 
JOIN ( SELECT pe_campaign_name,
	   pe_campaign_id
       FROM pe_campaign
       ) x ON pe_campaign_name = pe_campaigndetails_name
SET pe_campaigndetails_name_id = pe_campaign_id
WHERE pe_campaign_name = pe_campaigndetails_name
';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//UPDATE only mission_name_id
$sql = '
UPDATE pe_campaigndetails 
JOIN ( SELECT pe_mission_name,
	   pe_mission_id
       FROM pe_mission
       ) x ON pe_mission_name = pe_campaigndetails_mission_name
SET pe_campaigndetails_mission_name_id = pe_mission_id
WHERE pe_mission_name = pe_campaigndetails_mission_name
';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT value for ranked campaigndetails number
/* $sql = ' UPDATE pe_campaigndetails
	JOIN(
	SELECT pe_campaigndetails_name_id,
		DENSE_RANK() OVER (partition by pe_campaigndetails_id ORDER BY pe_campaigndetails_name) rn from pe_campaigndetails)
	)
	SELECT
	DENSE_RANK() OVER (ORDER BY pe_campaigndetails_name) pe_campaigndetails_id AS pe_campaigndetails_name_id
	SET pe_campaigndetails_name_id = rn

	'; */
	
/* $sql = '
UPDATE pe_campaigndetails
JOIN(
	SELECT pe_campaigndetails_id,
		DENSE_RANK() over (partition by pe_campaigndetails_name
		order by pe_campaigndetails_id) rn from pe_campaigndetails) N on N.pe_campaigndetails_id = pe_campaigndetails.pe_campaigndetails_id
SET pe_campaigndetails_mission_name_id = rn

'; */	
	

/* $sql = "UPDATE pe_logevent SET pe_LogEvent_redkilledplayerunit_name = 'planes'
WHERE pe_logevent_arg2 = 'Planes' AND (pe_LogEvent_type = 'kill') AND (pe_LogEvent_coalition = 'RED') AND (pe_LogEvent_playervsai = 'Player') AND (pe_LogEvent_coalition_killed_player IS NOT NULL) 
 ";
 */
/* $sql = '
UPDATE pe_flightduration
JOIN(
	SELECT pe_flightduration_id,
		row_number() over (partition by pe_flightduration_pilotid 
		order by pe_flightduration_id) rn from pe_flightduration) N on N.pe_flightduration_id = pe_flightduration.pe_flightduration_id
SET pe_flightduration_takeofflandingnum = rn
WHERE pe_flightduration_type = "takeoff"
'; */


/* $sql = '
UPDATE pe_campaigndetails
JOIN(
	SELECT pe_flightduration_id,
		row_number() over (partition by pe_flightduration_pilotid 
		order by pe_flightduration_id) rn from pe_flightduration) N on N.pe_flightduration_id = pe_flightduration.pe_flightduration_id
SET pe_flightduration_takeofflandingnum = rn
WHERE pe_flightduration_type = "takeoff"
';
 */


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_LastPilotDeath";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_LastPilotDeath (
pe_LastPilotDeath_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_LastPilotDeath_pilotname VARCHAR(100) DEFAULT NULL,
pe_LastPilotDeath_datetime DATETIME DEFAULT CURRENT_TIMESTAMP
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


// INSERT last pilot death names and times into table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_LastPilotDeath 
(pe_LastPilotDeath_pilotname,
pe_LastPilotDeath_datetime) 
SELECT DISTINCT v1.pe_LogEvent_lastpilotdeathname,
 v1.pe_LogEvent_datetime
  FROM pe_logevent v1 
  LEFT JOIN pe_logevent v2 
    ON v1.pe_LogEvent_lastpilotdeathname = v2.pe_LogEvent_lastpilotdeathname
   AND v1.pe_LogEvent_datetime < v2.pe_LogEvent_datetime
 WHERE v2.pe_LogEvent_lastpilotdeathname IS NULL 
   AND v1.pe_LogEvent_lastpilotdeathname IS NOT NULL';


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE DUPLICATES from pe_LastPilotDeath table!!!
$sql = '
DELETE FROM pe_LastPilotDeath 
WHERE 
	pe_LastPilotDeath_pilotname IN (
	SELECT 
		pe_LastPilotDeath_pilotname 
	FROM (
		SELECT 
			pe_LastPilotDeath_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_LastPilotDeath_datetime
				ORDER BY pe_LastPilotDeath_datetime) AS row_num
		FROM 
			pe_LastPilotDeath
		
	) t
    WHERE row_num > 1
)';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


// INSERT last pilot death names and times into table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_LastPilotDeath 
(pe_LastPilotDeath_pilotname) 
SELECT pe_LastPilotDeath_pilotname
  FROM pe_LastPilotDeath 
 WHERE pe_LastPilotDeath_pilotname NOT IN(SELECT pe_LogEvent_PilotName FROM pe_LogEvent)';

//SELECT    table1.ID
//FROM      table1
//WHERE     table1.ID NOT IN(SELECT table2.ID FROM table2)

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





// Adding 45 seconds of time to pe_LastPilotdeath_datetime to prevent any events caused by death to be added to new life.
/* $sql = 'INSERT INTO pe_LastPilotDeath 
(pe_LastPilotDeath_datetime) 
SELECT DATEADD(second, 45, pe_LastPilotDeath_datetime) AS DateAdd
SELECT pe_LastPilotDeath_datetime
  FROM pe_LastPilotDeath 
 WHERE pe_LastPilotDeath_pilotname NOT IN(SELECT pe_LogEvent_PilotName FROM pe_LogEvent)';

//SELECT    table1.ID
//FROM      table1
//WHERE     table1.ID NOT IN(SELECT table2.ID FROM table2)

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */




//Populating pilot name for 'kill' AND 'takeoff'
/* $sql = "UPDATE pe_LastPilotDeath SET pe_LastPilotDeath_datetime = DATEADD(second, 45, pe_LastPilotDeath_datetime) ";


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */

//SELECT DATEADD(year, 1, '2017/08/25') AS DateAdd;

//SELECT    table1.ID
//FROM      table1
//WHERE     table1.ID NOT IN(SELECT table2.ID FROM table2)


/* if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LastPilotDeath_pilotname`, b.`pe_LogEvent_PilotName`
FROM `pe_LastPilotDeath` AS a 
LEFT JOIN `pe_LogEvent` AS b
ON a.`pe_LastPilotDeath_pilotname` = b.`pe_LogEvent_PilotName`
WHERE a.`pe_LastPilotDeath_pilotname` NOT IN(b.`pe_LogEvent_PilotName`)"))

{


//cast(your_float_column as decimal(10,2))

	echo "<table>";
	//echo "<table class='table_stats'>";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Time of Death</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_id'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_pilotname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LastPilotDeath_datetime'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_type'] . "</td>";			

		echo "</tr>";
	}
	echo "</table>";


$result->close();

} */



///////////////////////END OF LASTPILOTDEATH//////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Table pe_DeathAncestory -> creates who's current life is piloting for Hardcore mode / Stats Reset based on # of Deaths
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_DeathAncestory";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_DeathAncestory (
pe_DeathAncestory_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_DeathAncestory_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_DeathAncestory ADD IF NOT EXISTS `pe_DeathAncestory_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_DeathAncestory_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_DeathAncestory ADD IF NOT EXISTS `pe_DeathAncestory_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_DeathAncestory 
(pe_DeathAncestory_pilotname, pe_DeathAncestory_pilotdeathcount) 
SELECT pe_LogEvent_PilotName, COUNT(pe_LogEvent_deaths)
  FROM pe_LogEvent
WHERE pe_LogEvent_PilotName IS NOT NULL
GROUP BY pe_LogEvent_PilotName
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_DeathAncestory 
WHERE 
	pe_DeathAncestory_pilotname IN (
	SELECT 
		pe_DeathAncestory_pilotname 
	FROM (
		SELECT 
			pe_DeathAncestory_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_DeathAncestory_id
				ORDER BY pe_DeathAncestory_id) AS row_num
		FROM 
			pe_DeathAncestory
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_DeathAncestory ADD IF NOT EXISTS `pe_DeathAncestory_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestory set
   pe_DeathAncestory_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestory_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_DeathAncestory 
JOIN ( SELECT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name ) x ON pe_LogLogins_name = pe_DeathAncestory_pilotname
SET pe_DeathAncestory_pilotid = pe_LogLogins_playerid
WHERE pe_DeathAncestory_pilotname IS NOT NULL
';


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




/////////////////////////////////////////////////
//END SECTION -> pe_DeathAncestory END
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Table pe_DeathAncestoryFinal -> creates who's current life is piloting for Hardcore mode / Stats Reset based on # of Deaths
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_DeathAncestoryFinal";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_DeathAncestoryFinal (
pe_DeathAncestoryFinal_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_DeathAncestoryFinal_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_DeathAncestoryFinal ADD IF NOT EXISTS `pe_DeathAncestoryFinal_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_DeathAncestoryFinal
(pe_DeathAncestoryFinal_pilotname)
SELECT DISTINCT pe_dataplayers_lastname
  FROM pe_dataplayers
GROUP BY pe_dataplayers_lastname
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_DeathAncestoryFinal 
WHERE 
	pe_DeathAncestoryFinal_pilotname IN (
	SELECT 
		pe_DeathAncestoryFinal_pilotname 
	FROM (
		SELECT 
			pe_DeathAncestoryFinal_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_DeathAncestoryFinal_id
				ORDER BY pe_DeathAncestoryFinal_id) AS row_num
		FROM 
			pe_DeathAncestoryFinal
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_DeathAncestoryFinal ADD IF NOT EXISTS `pe_DeathAncestoryFinal_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestoryFinal set
   pe_DeathAncestoryFinal_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestoryFinal_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_DeathAncestoryFinal 
JOIN ( SELECT DISTINCT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name) x ON pe_LogLogins_name = pe_DeathAncestoryFinal_pilotname
SET pe_DeathAncestoryFinal_pilotid  = pe_LogLogins_playerid
WHERE pe_DeathAncestoryFinal_pilotname IS NOT NULL
';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_DeathAncestoryFinal_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_DeathAncestoryFinal ADD IF NOT EXISTS `pe_DeathAncestoryFinal_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////SUMMING deaths/////////////


$sql = 'UPDATE pe_DeathAncestoryFinal SET
   pe_DeathAncestoryFinal_pilotdeathcount  = (
    SELECT SUM(pe_DeathAncestory_pilotdeathcount) 
	FROM pe_DeathAncestory 
    WHERE  pe_DeathAncestory_pilotid = pe_DeathAncestoryFinal_pilotid
	GROUP BY pe_DeathAncestoryFinal_pilotid
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//Delete users that have no data ... pe_DeathAncestoryFinal_pilotdeathcount = NULL
$sql = 'DELETE FROM pe_DeathAncestoryFinal
WHERE pe_DeathAncestoryFinal_pilotdeathcount IS NULL
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//Create pe_DeathAncestoryFinal Column in DB as `pe_DeathAncestoryFinal_lastpilotdeathtime`
$sql = "ALTER TABLE pe_DeathAncestoryFinal ADD IF NOT EXISTS `pe_DeathAncestoryFinal_lastpilotdeathtime` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Add last pilot deaths from pe_LastPilotDeath_datetime
$sql = 'UPDATE pe_DeathAncestoryFinal SET
   pe_DeathAncestoryFinal_lastpilotdeathtime = (
    SELECT pe_LastPilotDeath_datetime 
	FROM pe_LastPilotDeath 
    WHERE  pe_LastPilotDeath_pilotname = pe_DeathAncestoryFinal_pilotname
	GROUP BY pe_LastPilotDeath_pilotname
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//If no deaths (pilot_death = 0) then record first reported time as last death.
$sql = 'UPDATE pe_DeathAncestoryFinal SET
   pe_DeathAncestoryFinal_lastpilotdeathtime = (
    SELECT pe_LogEvent_datetime
	FROM pe_LogEvent 
    WHERE pe_LogEvent_id = 1
	GROUP BY pe_DeathAncestoryFinal_pilotname)
	WHERE pe_DeathAncestoryFinal_pilotdeathcount = 0
	';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//For scenario case -> for same pilot id ->  if no death occured on current name but death occured on past name, use this death time
/* $sql = 'UPDATE pe_DeathAncestoryFinal SET
   pe_DeathAncestoryFinal_lastpilotdeathtime = (
    SELECT DISTINCT pe_LogEvent_datetime
	FROM pe_LogEvent 
    WHERE  pe_DeathAncestoryFinal_pilotid = pe_LogEvent_pilotid AND pe_LogEvent_type = "pilot_death"
	GROUP BY pe_DeathAncestoryFinal_pilotname
	ORDER BY pe_LogEvent_datetime DESC )
	WHERE pe_DeathAncestoryFinal_lastpilotdeathtime IS NULL
	'; */


$sql = 'UPDATE pe_deathancestoryfinal 
JOIN ( SELECT pe_LogEvent_pilotid,
              MAX(pe_LogEvent_datetime) pe_LogEvent_datetime
       FROM pe_logevent 
       WHERE pe_LogEvent_type = "pilot_death"
       GROUP BY pe_LogEvent_pilotid ) x ON pe_DeathAncestoryFinal_pilotid = pe_LogEvent_pilotid
SET pe_DeathAncestoryFinal_lastpilotdeathtime = pe_LogEvent_datetime
WHERE pe_DeathAncestoryFinal_lastpilotdeathtime IS NULL';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'UPDATE pe_DeathAncestoryFinal SET
   pe_DeathAncestoryFinal_pilotdeathcount = (
    SELECT COUNT(pe_LogEvent_deaths) 
	FROM pe_LogEvent
    WHERE pe_LogEvent_pilotname IS NOT NULL AND pe_DeathAncestoryFinal_pilotname = pe_LogEvent_Pilotid
	GROUP BY pe_LogEvent_pilotid
   )'; */


/* $sql = 'INSERT INTO pe_DeathAncestoryFinal 
(pe_DeathAncestoryFinal_pilotdeathcount) 
SELECT COUNT(pe_LogEvent_deaths)
  FROM pe_LogEvent
WHERE pe_LogEvent_PilotName IS NOT NULL
GROUP BY pe_LogEvent_pilotid'; */


if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Table pe_Rank -> creates rank for individual players
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_Rank";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_Rank (
pe_Rank_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_Rank_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_Rank
(pe_Rank_pilotname)
SELECT DISTINCT pe_dataplayers_lastname
  FROM pe_dataplayers
GROUP BY pe_dataplayers_lastname
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_Rank 
WHERE 
	pe_Rank_pilotname IN (
	SELECT 
		pe_Rank_pilotname 
	FROM (
		SELECT 
			pe_Rank_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_Rank_id
				ORDER BY pe_Rank_id) AS row_num
		FROM 
			pe_Rank
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestoryFinal set
   pe_DeathAncestoryFinal_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestoryFinal_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_Rank 
JOIN ( SELECT DISTINCT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name) x ON pe_LogLogins_name = pe_Rank_pilotname
SET pe_Rank_pilotid  = pe_LogLogins_playerid
WHERE pe_Rank_pilotname IS NOT NULL
';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_Rank_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////SUMMING deaths/////////////


$sql = 'UPDATE pe_Rank SET
   pe_Rank_pilotdeathcount  = (
    SELECT SUM(pe_DeathAncestory_pilotdeathcount) 
	FROM pe_DeathAncestory 
    WHERE  pe_DeathAncestory_pilotid = pe_Rank_pilotid
	GROUP BY pe_Rank_pilotid
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//Delete users that have no data ... pe_DeathAncestoryFinal_pilotdeathcount = NULL
$sql = 'DELETE FROM pe_Rank
WHERE pe_Rank_pilotdeathcount IS NULL
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

///////////////////////////////////////////////////////
//// ADD Military Branches to airframes `pe_datatypes`
///////////////////////////////////////////////////////

//***DROP TABLE `pe_Rank_AF_1Lt` Rank (United States Air Force First Lieutenant)***
/* 
$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O1_1Lt";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_AF_O-1_1Lt` (United States Air Force First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O1_1Lt` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */



///////////////// ADDING AIR FORCE RANK ///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_AF_O1` Rank (United States Air Force First Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_AF_O-1` (United States Air Force First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AF_O-2_2Lt` Rank (United States Air Force Second Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 2Lt Column in DB as `pe_Rank_AF_O-2_2Lt` (United States Air Force Second Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AF_O-3_Capt` Rank (United States Air Force Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Capt Column in DB as `pe_Rank_AF_O-3_Capt` (United States Air Force Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AF_O-4_Maj` Rank (United States Air Force Major)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Maj Column in DB as `pe_Rank_AF_O-4_Maj` (United States Air Force Major)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AF_O-5_LtCol` Rank (United States Air Force Lieutenant Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtCol Column in DB as `pe_Rank_AF_O-5_LtCol` (United States Air Force Lieutenant Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_AF_O-6_Col` Rank (United States Air Force Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O6";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Col Column in DB as `pe_Rank_AF_O-6_Col` (United States Air Force Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O6` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AF_O-7_BrigGen` Rank (United States Air Force Brigadier General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O7";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create BrigGen Column in DB as `pe_Rank_AF_O-7_BrigGen` (United States Air Force Brigadier General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O7` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_AF_O-8_MajGen` Rank (United States Air Force Major General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O8";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create MajGen Column in DB as `pe_Rank_AF_O-8_MajGen` (United States Air Force Major General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O8` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AF_O-9_LtGen` Rank (United States Air Force Lieutenant General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O9";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtGen Column in DB as `pe_Rank_AF_O-9_LtGen` (United States Air Force Lieutenant General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O9` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AF_O-10_Gen` Rank (United States Air Force General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O10";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Gen Column in DB as `pe_Rank_AF_O-10_Gen` (United States Air Force General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O10` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AF_Special_GAF` Rank (United States Air Force "General of the Air Force")***

$sql = "DROP TABLE IF EXISTS pe_Rank_AF_O11";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create GAF Column in DB as `pe_Rank_AF_Special_GAF` (United States Air Force "General of the Air Force")RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AF_O11` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////// ADDING US ARMY RANK ///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_AR_1Lt` Rank (United States Army First Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_AR_O-1_1Lt` (United States Army First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AR_O-2_2Lt` Rank (United States Army Second Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 2Lt Column in DB as `pe_Rank_AR_O-2_2Lt` (United States Army Second Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AR_O-3_Capt` Rank (United States Army Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Capt Column in DB as `pe_Rank_AR_O-3_Capt` (United States Army Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_O-4_Maj` Rank (United States Army Major)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Maj Column in DB as `pe_Rank_AR_O-4_Maj` (United States Army Major)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_O-5_LtCol` Rank (United States Army Lieutenant Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtCol Column in DB as `pe_Rank_AR_O-5_LtCol` (United States Army Lieutenant Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_AR_O-6_Col` Rank (United States Army Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O6";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Col Column in DB as `pe_Rank_AR_O-6_Col` (United States Army Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O6` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_O-7_BrigGen` Rank (United States Army Brigadier General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O7";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create BrigGen Column in DB as `pe_Rank_AR_O-7_BrigGen` (United States Army Brigadier General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O7` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_AR_O-8_MajGen` Rank (United States Army Major General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O8";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create MajGen Column in DB as `pe_Rank_AR_O-8_MajGen` (United States Army Major General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O8` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AR_O-9_LtGen` Rank (United States Army Lieutenant General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O9";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtGen Column in DB as `pe_Rank_AR_O-9_LtGen` (United States Army Lieutenant General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O9` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_O-10_Gen` Rank (United States Army General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O10";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Gen Column in DB as `pe_Rank_AR_O-10_Gen` (United States Army General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O10` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_Special_GA` Rank (United States Army "General of the Army")***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_O11";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create GA Column in DB as `pe_Rank_AR_Special_GA` (United States Army "General of the Army")RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_O11` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////// ADDING US MARINES RANK ///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_MA_1Lt` Rank (United States Marines First Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_MA_O-1_1Lt` (United States Marines First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_MA_O-2_2Lt` Rank (United States Marines Second Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 2Lt Column in DB as `pe_Rank_MA_O-2_2Lt` (United States Marines Second Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_MA_O-3_Capt` Rank (United States Marines Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Capt Column in DB as `pe_Rank_MA_O-3_Capt` (United States Marines Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_O-4_Maj` Rank (United States Marines Major)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Maj Column in DB as `pe_Rank_MA_O-4_Maj` (United States Marines Major)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_O-5_LtCol` Rank (United States Marines Lieutenant Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtCol Column in DB as `pe_Rank_MA_O-5_LtCol` (United States Marines Lieutenant Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_MA_O-6_Col` Rank (United States Marines Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O6";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Col Column in DB as `pe_Rank_MA_O-6_Col` (United States Marines Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O6` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_O-7_BrigGen` Rank (United States Marines Brigadier General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O7";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create BrigGen Column in DB as `pe_Rank_MA_O-7_BrigGen` (United States Marines Brigadier General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O7` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//***DROP TABLE `pe_Rank_MA_O-8_MajGen` Rank (United States Marines Major General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O8";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create MajGen Column in DB as `pe_Rank_MA_O-8_MajGen` (United States Marines Major General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O8` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_MA_O-9_LtGen` Rank (United States Marines Lieutenant General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O9";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtGen Column in DB as `pe_Rank_MA_O-9_LtGen` (United States Marines Lieutenant General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O9` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_O-10_Gen` Rank (United States Marines General)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_O10";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Gen Column in DB as `pe_Rank_MA_O-10_Gen` (United States Marines General)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_O10` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}





///////////////////////////////////////////
////////ADDING NAVY  "Officer" O RANKS
//////////////////////////////////////////

//***DROP TABLE `pe_Rank_NV_ENS` Rank (United States Navy Ensign)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create ENS Column in DB as `pe_Rank_NV_O-1_ENS` (United States Navy Ensign)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_NV_O-2_LTJG` Rank (United States Navy Lieutenant Junior Grade)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LTJG Column in DB as `pe_Rank_NV_O-2_LTJG` (United States Navy Lieutenant Junior Grade)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_NV_O-3_LT` Rank (United States Navy Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LT Column in DB as `pe_Rank_NV_O-3_LT` (United States Navy Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-4_LCDR` Rank (United States Navy Lieutenant Commander)***
$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LCDR Column in DB as `pe_Rank_NV_O-4_LCDR` (United States Navy Lieutenant Commander)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-5_CDR` Rank (United States Navy Commander)***
$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create CDR Column in DB as `pe_Rank_NV_O-5_CDR` (United States Navy Commander)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-6_CAPT` Rank (United States Navy Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O6";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create CAPT Column in DB as `pe_Rank_NV_O-6_CAPT` (United States Navy Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O6` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-7_RDML` Rank (United States Air Navy Rear Admiral Lower Half)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O7";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create RDML Column in DB as `pe_Rank_NV_O-7_RDML` (United States Navy Rear Admiral Lower Half)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O7` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-8_RADM` Rank (United States Navy Rear Admiral Upper Half)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O8";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create RADM Column in DB as `pe_Rank_NV_O-8_RADM` (United States Navy Rear Admiral Upper Half)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O8` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-9_VADM` Rank (United States Navy Vice Admiral)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O9";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create VADM Column in DB as `pe_Rank_NV_O-9_VADM` (United States Navy Vice Admiral)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O9` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_O-10_ADM` Rank (United States Navy Admiral)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O10";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create ADM Column in DB as `pe_Rank_NV_O-10_ADM` (United States Navy Admiral)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O10` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_NV_Special_FADM` Rank (United States Navy Fleet Admiral)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_O11";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create FADM Column in DB as `pe_Rank_NV_Special_FADM` (United States Navy Fleet Admiral)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_O11` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



///////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////




///////////////// ADDING US ARMY WARRANT OFFICER RANKs  ///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_AR_1Lt` Rank (United States Army First Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_WO1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_AR_WO-1_1Lt` (United States Army First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_WO1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AR_WO-2_2Lt` Rank (United States Army Second Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_WO2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 2Lt Column in DB as `pe_Rank_AR_WO-2_2Lt` (United States Army Second Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_WO2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_AR_WO-3_Capt` Rank (United States Army Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_WO3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Capt Column in DB as `pe_Rank_AR_WO-3_Capt` (United States Army Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_WO3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_WO-4_Maj` Rank (United States Army Major)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_WO4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Maj Column in DB as `pe_Rank_AR_WO-4_Maj` (United States Army Major)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_WO4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_AR_WO-5_LtCol` Rank (United States Army Lieutenant Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_AR_WO5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtCol Column in DB as `pe_Rank_AR_WO-5_LtCol` (United States Army Lieutenant Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_AR_WO5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




///////////////// ADDING US MARINES WARRANT OFFICER RANKs ///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_MA_1Lt` Rank (United States Marines First Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_WO1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 1Lt Column in DB as `pe_Rank_MA_WO-1_1Lt` (United States Marines First Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_WO1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_MA_WO-2_2Lt` Rank (United States Marines Second Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_WO2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create 2Lt Column in DB as `pe_Rank_MA_WO-2_2Lt` (United States Marines Second Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_WO2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_MA_WO-3_Capt` Rank (United States Marines Captain)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_WO3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Capt Column in DB as `pe_Rank_MA_WO-3_Capt` (United States Marines Captain)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_WO3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_WO-4_Maj` Rank (United States Marines Major)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_WO4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create Maj Column in DB as `pe_Rank_MA_WO-4_Maj` (United States Marines Major)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_WO4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_MA_WO-5_LtCol` Rank (United States Marines Lieutenant Colonel)***

$sql = "DROP TABLE IF EXISTS pe_Rank_MA_WO5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LtCol Column in DB as `pe_Rank_MA_WO-5_LtCol` (United States Marines Lieutenant Colonel)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_MA_WO5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////////////////////////////////////////////////
////////ADDING NAVY  "WARRANT Officer" WO RANKS
//////////////////////////////////////////////////

//***DROP TABLE `pe_Rank_NV_ENS` Rank (United States Navy Ensign)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_WO1";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create ENS Column in DB as `pe_Rank_NV_WO-1_ENS` (United States Navy Ensign)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_WO1` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_NV_WO-2_LTJG` Rank (United States Navy Lieutenant Junior Grade)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_WO2";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LTJG Column in DB as `pe_Rank_NV_WO-2_LTJG` (United States Navy Lieutenant Junior Grade)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_WO2` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_NV_WO-3_LT` Rank (United States Navy Lieutenant)***

$sql = "DROP TABLE IF EXISTS pe_Rank_NV_WO3";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LT Column in DB as `pe_Rank_NV_WO-3_LT` (United States Navy Lieutenant)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_WO3` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_WO-4_LCDR` Rank (United States Navy Lieutenant Commander)***
$sql = "DROP TABLE IF EXISTS pe_Rank_NV_WO4";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create LCDR Column in DB as `pe_Rank_NV_WO-4_LCDR` (United States Navy Lieutenant Commander)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_WO4` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_NV_WO-5_CDR` Rank (United States Navy Commander)***
$sql = "DROP TABLE IF EXISTS pe_Rank_NV_WO5";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create CDR Column in DB as `pe_Rank_NV_WO-5_CDR` (United States Navy Commander)RANK
$sql = "ALTER TABLE pe_Rank ADD IF NOT EXISTS `pe_Rank_NV_WO5` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SECTION PURPOSE: Create Table pe_Medals -> creates medals for individual players
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////CREATE RUS RUSSION MEDALS TABLE////////////////////
/////////////////////pe_Medals_RUS///////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_Medals_RUS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_Medals_RUS (
pe_Medals_RUS_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_Medals_RUS
(pe_Medals_RUS_pilotname)
SELECT DISTINCT pe_dataplayers_lastname
  FROM pe_dataplayers
GROUP BY pe_dataplayers_lastname
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_Medals_RUS 
WHERE 
	pe_Medals_RUS_pilotname IN (
	SELECT 
		pe_Medals_RUS_pilotname 
	FROM (
		SELECT 
			pe_Medals_RUS_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_Medals_RUS_id
				ORDER BY pe_Medals_RUS_id) AS row_num
		FROM 
			pe_Medals_RUS
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestoryFinal set
   pe_DeathAncestoryFinal_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestoryFinal_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_Medals_RUS 
JOIN ( SELECT DISTINCT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name) x ON pe_LogLogins_name = pe_Medals_RUS_pilotname
SET pe_Medals_RUS_pilotid  = pe_LogLogins_playerid
WHERE pe_Medals_RUS_pilotname IS NOT NULL
';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////SUMMING deaths/////////////


$sql = 'UPDATE pe_Medals_RUS SET
   pe_Medals_RUS_pilotdeathcount  = (
    SELECT SUM(pe_DeathAncestory_pilotdeathcount) 
	FROM pe_DeathAncestory 
    WHERE  pe_DeathAncestory_pilotid = pe_Medals_RUS_pilotid
	GROUP BY pe_Medals_RUS_pilotid
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//Delete users that have no data ... pe_DeathAncestoryFinal_pilotdeathcount = NULL
$sql = 'DELETE FROM pe_Medals_RUS
WHERE pe_Medals_RUS_pilotdeathcount IS NULL
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

///////////////// ADDING Russian Medals_RUS///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_RUS_CO` Courage Order Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_CO";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Create  Column in DB as `pe_Medals_RUS_CO` Courage Order Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_CO` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_RUS_MOC` Medal of Courage Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_MOC";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Medals_RUS_MOC` Medal of Courage Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_MOC` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_RUS_NM` Nesterov Medal Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_NM";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_NM` Nesterov Medal Award Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_NM` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_RUS_MSO` Military Serve Order Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_MSO";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_MSO` Military Serve OrderAward
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_MSO` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_RUS_GCIV` Georgy Cross-IV Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_GCIV";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_GCIV` Georgy Cross-IV Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_GCIV` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_RUS_MMFIIS` Medal For Merit To Fatherland-II with swords Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_MMFIIS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_MMFIIS` Medal For Merit To Fatherland-II with swords Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_MMFIIS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_RUS_GCI` Georgy Cross-I Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_GCI";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_GCI` Georgy Cross-I Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_GCI` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_RUS_HGS` Hero Gold Star Award

$sql = "DROP TABLE IF EXISTS pe_Medals_RUS_HGS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_RUS_HGS` Hero Gold Star Award
$sql = "ALTER TABLE pe_Medals_RUS ADD IF NOT EXISTS `pe_Medals_RUS_HGS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


///////////////////////////////////////////////




//////////////CREATE USA UNITED STATES MEDALS TABLE////////////////////
/////////////////////pe_Medals_USA///////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_Medals_USA";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_Medals_USA (
pe_Medals_USA_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_Medals_USA
(pe_Medals_USA_pilotname)
SELECT DISTINCT pe_dataplayers_lastname
  FROM pe_dataplayers
GROUP BY pe_dataplayers_lastname
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_Medals_USA 
WHERE 
	pe_Medals_USA_pilotname IN (
	SELECT 
		pe_Medals_USA_pilotname 
	FROM (
		SELECT 
			pe_Medals_USA_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_Medals_USA_id
				ORDER BY pe_Medals_USA_id) AS row_num
		FROM 
			pe_Medals_USA
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestoryFinal set
   pe_DeathAncestoryFinal_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestoryFinal_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_Medals_USA 
JOIN ( SELECT DISTINCT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name) x ON pe_LogLogins_name = pe_Medals_USA_pilotname
SET pe_Medals_USA_pilotid  = pe_LogLogins_playerid
WHERE pe_Medals_USA_pilotname IS NOT NULL
';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////SUMMING deaths/////////////


$sql = 'UPDATE pe_Medals_USA SET
   pe_Medals_USA_pilotdeathcount  = (
    SELECT SUM(pe_DeathAncestory_pilotdeathcount) 
	FROM pe_DeathAncestory 
    WHERE  pe_DeathAncestory_pilotid = pe_Medals_USA_pilotid
	GROUP BY pe_Medals_USA_pilotid
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//Delete users that have no data ... pe_DeathAncestoryFinal_pilotdeathcount = NULL
$sql = 'DELETE FROM pe_Medals_USA
WHERE pe_Medals_USA_pilotdeathcount IS NULL
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

///////////////// ADDING UNITED STATES MEDALS USA///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_USA_AM_AF` Air Medal: Air Force Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_AM_AF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_AM_AF` Air Medal: Air Force Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_AM_AF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_AM_AR` Air Medal: Army Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_AM_AR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_AM_AR` Air Medal: Army Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_AM_AR` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_AM_NV` Air Medal: Navy & Marines Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_AM_NV";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_AM_NV` Air Medal: Navy & Marines Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_AM_NV` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_BS` Bronze Star Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_BS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_BS` Bronze Star Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_BS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_SS` Silver Star Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_SS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_SS` Silver Star Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_SS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_DFC_AR` Distinguished Flying Cross Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_DFC_AR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_DFC_AR` Distinguished Flying Cross Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_DFC_AR` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}




//***DROP TABLE `pe_Rank_USA_AFC` Air Force Cross Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_AFC_AF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_AFC_AF` Air Force Cross Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_AFC_AF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_NMC_NV` Navy and Marines Cross Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_NMC_NV";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_NMC_NV` Navy and Marines Cross Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_NMC_NV` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_MH_AF` Medal of Honor: Air Force Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_MH_AF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_MH_AF` Medal of Honor: Air Force Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_MH_AF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_MH_AR` Medal of Honor: Army Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_MH_AR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_MH_AR` Medal of Honor: Army Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_MH_AR` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_MH_AR` Medal of Honor: Navy (and Marines) Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_MH_NV";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_MH_AR` Medal of Honor: Navy (and Marines)Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_MH_NV` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_PUC_AF` Presidential Unit Citation: Air Force Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_PUC_AF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_PUC_AF` Presidential Unit Citation: Air Force Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_PUC_AF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_PUC_AR` Presidential Unit Citation: Army Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_PUC_AR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_PUC_AR` Presidential Unit Citation: Army Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_PUC_AR` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_PUC_NVMA` Presidential Unit Citation: Navy and Marines Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_PUC_NVMA";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_PUC_NVMA` Presidential Unit Citation: Navy and Marines Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_PUC_NVMA` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_DSM` Distinguished Service Medal Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_DSM";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_DSM` Distinguished Service Medal Award ***
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_DSM` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_USA_AMM_AF` AirMans Medal - Air Force Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_AMM_AF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_AMM_AF` AirMans Medal - Air Force Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_AMM_AF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_SM_AR` Soldier's Medal - Army Force Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_SM_AR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_SM_AR` Soldier's Medal - Army Force Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_SM_AR` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_USA_NMM_NVMA` Navy and Marines Medal Award

$sql = "DROP TABLE IF EXISTS pe_Medals_USA_NMM_NVMA";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_USA_NMM_NVMA` Navy and Marines Medal Award
$sql = "ALTER TABLE pe_Medals_USA ADD IF NOT EXISTS `pe_Medals_USA_NMM_NVMA` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

///////////////////////////////////////////////



//////////////CREATE UKR UKARINE MEDALS TABLE////////////////////
/////////////////////pe_Medals_UKR///////////////

//DROP TABLE if pe_LastPilotDeath exists
$sql = "DROP TABLE IF EXISTS pe_Medals_UKR";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
$sql = 'CREATE TABLE IF NOT EXISTS pe_Medals_UKR (
pe_Medals_UKR_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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


//***ADDING pilotname***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_pilotname";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_pilotname` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
$sql = 'INSERT INTO pe_Medals_UKR
(pe_Medals_UKR_pilotname)
SELECT DISTINCT pe_dataplayers_lastname
  FROM pe_dataplayers
GROUP BY pe_dataplayers_lastname
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//DELETE DUPLICATES from pe_DeathAncestory table!!!
$sql = '
DELETE FROM pe_Medals_UKR 
WHERE 
	pe_Medals_UKR_pilotname IN (
	SELECT 
		pe_Medals_UKR_pilotname 
	FROM (
		SELECT 
			pe_Medals_UKR_pilotname,
			ROW_NUMBER() OVER (
				PARTITION BY pe_Medals_UKR_id
				ORDER BY pe_Medals_UKR_id) AS row_num
		FROM 
			pe_Medals_UKR
		
	) t
    WHERE row_num > 1
)';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 


//////ADDING PILOT ID NUMBER/////////////
//Creating pilotid column in DB as `pe_LogEvent_pilotid`
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_pilotid` BIGINT(20) NULL";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Adding pilotid to pe_DeathAncestory_pilotid
/* $sql = 'update pe_DeathAncestoryFinal set
   pe_DeathAncestoryFinal_pilotid = (
        select distinct pe_LogLogins_playerid from pe_loglogins
            where pe_LogLogins_Name = pe_DeathAncestoryFinal_pilotname
   )'; */

//Adding pilotid to pe_DeathAncestory_pilotid
$sql = '
UPDATE pe_Medals_UKR 
JOIN ( SELECT DISTINCT pe_LogLogins_playerid, pe_LogLogins_name
       FROM pe_loglogins 
       GROUP BY pe_LogLogins_name) x ON pe_LogLogins_name = pe_Medals_UKR_pilotname
SET pe_Medals_UKR_pilotid  = pe_LogLogins_playerid
WHERE pe_Medals_UKR_pilotname IS NOT NULL
';



if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***ADDING pilot death count***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_pilotdeathcount";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create pilotdeathcount Column in DB as `pe_DeathAncestory_pilotdeathcount`
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_pilotdeathcount` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//////SUMMING deaths/////////////


$sql = 'UPDATE pe_Medals_UKR SET
   pe_Medals_UKR_pilotdeathcount  = (
    SELECT SUM(pe_DeathAncestory_pilotdeathcount) 
	FROM pe_DeathAncestory 
    WHERE  pe_DeathAncestory_pilotid = pe_Medals_UKR_pilotid
	GROUP BY pe_Medals_UKR_pilotid
   )';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

//Delete users that have no data ... pe_DeathAncestoryFinal_pilotdeathcount = NULL
$sql = 'DELETE FROM pe_Medals_UKR
WHERE pe_Medals_UKR_pilotdeathcount IS NULL
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} 

///////////////// ADDING UKRAINE MEDALS UKR///////////// 
////////////////////////////////////////////////////////


//***DROP TABLE `pe_Rank_UKR_MDF` Medal For Defender Of Fatherland Award

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_MDF";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_MDF` Medal For Defender Of Fatherland Award
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_MDF` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_UKR_OMIII` Order For Merit-III Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_OMIII";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Create  Column in DB as pe_Rank_UKR_OMIII` Order For Merit-III Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_OMIII` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_UKR_OMII` Order For Merit-II Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_OMII";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_OMII` Order For Merit-II Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_OMII` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_UKR_OMI` Order For Merit-I Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_OMI";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as pe_Rank_UKR_OMI` Order For Merit-I Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_OMI` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_UKR_OMS` Military Serve Order Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_OMS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_OMS` Military Serve OrderAward
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_OMS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_UKR_MMS` Medal for Military Service Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_MMS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_MMS` Medal for Military Service Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_MMS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//***DROP TABLE `pe_Rank_UKR_OC` Order for Courage Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_OC";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_OC` Order for Courage Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_OC` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//***DROP TABLE `pe_Rank_UKR_GS` Gold Star Award ***

$sql = "DROP TABLE IF EXISTS pe_Medals_UKR_GS";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Create  Column in DB as `pe_Rank_UKR_GS` Gold Star Award ***
$sql = "ALTER TABLE pe_Medals_UKR ADD IF NOT EXISTS `pe_Medals_UKR_GS` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



///////////////////////////////////////////////


//pe_medals CALCULATIONS FOR MEDALS USA


// Create column for purple heart
$sql = "DROP TABLE IF EXISTS pe_LogEvent_purpleheart";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Create purple heart Column in DB as `pe_LogEvent_purpleheart`
$sql = "ALTER TABLE pe_logevent ADD IF NOT EXISTS `pe_LogEvent_purpleheart` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


//Populating purple heart medal for each pilot for pe_LogEvent_type = 'eject' & plane killed by enemy
$sql = "UPDATE pe_logevent SET pe_LogEvent_purpleheart=pe_LogEvent_PilotName WHERE pe_LogEvent_content LIKE('%Player%') AND pe_LogEvent_type = 'eject' AND pe_LogEvent_playervsai ='Player' ";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}


// Calculate Silver Star Medal
$sql = '


UPDATE pe_medals_usa

LEFT JOIN (SELECT DISTINCT pe_LogEvent_pilotid, pe_LogEvent_datetime, pe_LogEvent_type, pe_LogEvent_PilotName,
              FLOOR((COUNT(`pe_LogEvent_kills_planes`)- COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/5) AS total_a2akills
		FROM pe_logevent 
		GROUP BY pe_LogEvent_pilotid ) x ON pe_Medals_USA_pilotid = pe_LogEvent_pilotid


	   
INNER JOIN (SELECT DISTINCT pe_DataPlayers_updated,`pe_DataPlayers_lastname`,`pe_DataPlayers_id`
        FROM pe_DataPlayers
		) y ON pe_LogEvent_pilotid = pe_DataPlayers_id 
		

	   
LEFT JOIN (SELECT pe_DeathAncestoryFinal_lastpilotdeathtime, pe_deathancestoryfinal_pilotid
		FROM pe_deathancestoryfinal

		ORDER BY pe_DeathAncestoryFinal_pilotname DESC
		) z ON pe_deathancestoryfinal_pilotid = pe_Medals_USA_pilotid


	
		SET pe_medals_usa_ss = total_a2akills

 

';

// Can't get this to work but this is what it would take to filter out for HARDCORE MODE
/* 		WHERE CASE 
		WHEN ((`pe_LogEvent_datetime` = `pe_DeathAncestoryFinal_lastpilotdeathtime`) AND `pe_LogEvent_type` = "pilot_death") THEN (`pe_LogEvent_datetime`) 
		ELSE (`pe_LogEvent_datetime` > (DATE_ADD(`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END */

//WORKS
/* UPDATE pe_medals_usa
JOIN (SELECT DISTINCT pe_LogEvent_pilotid, pe_LogEvent_datetime, pe_LogEvent_type,
              FLOOR((COUNT(`pe_LogEvent_kills_planes`)- COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/1) AS total_a2akills
       FROM pe_logevent 
       GROUP BY pe_LogEvent_pilotid ) x ON pe_Medals_USA_pilotid = pe_LogEvent_pilotid
    JOIN pe_deathancestoryfinal ON pe_Medals_USA_pilotid = pe_deathancestoryfinal_pilotid
SET pe_medals_usa_ss = total_a2akills
WHERE CASE 
WHEN ((`pe_LogEvent_datetime` = `pe_DeathAncestoryFinal_lastpilotdeathtime`) AND `pe_LogEvent_type` = "pilot_death") THEN (`pe_LogEvent_datetime`) 
ELSE (`pe_LogEvent_datetime` > (DATE_ADD(`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END */
//WORKS

//OLD DOESNT WORK
/* UPDATE pe_medals_usa
JOIN (SELECT DISTINCT pe_LogEvent_pilotid, pe_LogEvent_datetime, pe_LogEvent_type, pe_LogEvent_PilotName,
              FLOOR((COUNT(`pe_LogEvent_kills_planes`)- COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/1) AS total_a2akills
       FROM pe_logevent 
       GROUP BY pe_LogEvent_pilotid ) x ON pe_Medals_USA_pilotid = pe_LogEvent_pilotid
    JOIN pe_LastPilotDeath ON pe_LogEvent_pilotname = pe_LastPilotDeath_pilotname
SET pe_medals_usa_ss = total_a2akills
WHERE CASE  
WHEN ((`pe_LogEvent_datetime` = `pe_LastPilotDeath_datetime`) AND `pe_LogEvent_type` = "pilot_death") THEN (`pe_LogEvent_datetime`) 
WHEN `pe_LastPilotDeath_pilotname` IS NOT NULL 
THEN (`pe_LogEvent_datetime` > (DATE_ADD(`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND))) 

WHEN `pe_LastPilotDeath_pilotname` IS NOT NULL AND `pe_LogEvent_datetime` IS NULL THEN `pe_LogEvent_datetime` 
ELSE `pe_LogEvent_datetime` END */
/////


/*    UPDATE pe_medals_usa a 
    JOIN (SELECT b.`pe_LogEvent_pilotid`,
              FLOOR((COUNT(b.`pe_LogEvent_kills_planes`)- COUNT(b.`pe_LogEvent_friendly_fire_killer`)+COUNT(b.`pe_LogEvent_kills_helicopters`))/1) AS total_a2akills FROM pe_logevent b GROUP BY b.pe_LogEvent_pilotid) x ON b.`pe_LogEvent_pilotid` = a.`pe_Medals_USA_pilotid`  
    JOIN pe_deathancestoryfinal c ON a.pe_Medals_USA_pilotid = c.pe_deathancestoryfinal_pilotid
SET a.pe_medals_usa_ss = b.pe_LogEvent_pilotid */

/* JOIN ( SELECT DISTINCT pe_deathancestoryfinal_pilotid,
		pe_DeathAncestoryFinal_lastpilotdeathtime
		from pe_DeathAncestoryFinal) x ON pe_Medals_USA_pilotid = pe_deathancestoryfinal_pilotid */

/*    UPDATE TABLEA a 
   JOIN TABLEB b ON a.join_colA = b.join_colB  
   SET a.columnToUpdate = [something]
   
   UPDATE TABLE_A a 
    JOIN TABLE_B b ON a.join_col = b.join_col AND a.column_a = b.column_b 
    JOIN TABLE_C c ON [condition]
	SET a.column_c = a.column_c + 1 */

/* WHERE CASE  
WHEN ((a.`pe_LogEvent_datetime` = c.`pe_LastPilotDeath_datetime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
WHEN c.`pe_LastPilotDeath_pilotname` IS NOT NULL 
THEN (a.`pe_LogEvent_datetime` > (DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND))) 

WHEN c.`pe_LastPilotDeath_pilotname` IS NOT NULL AND a.`pe_LogEvent_datetime` IS NULL THEN a.`pe_LogEvent_datetime` 
ELSE a.`pe_LogEvent_datetime` END */

/* UPDATE pe_medals_usa
JOIN (SELECT DISTINCT pe_LogEvent_pilotid,
              FLOOR((COUNT(`pe_LogEvent_kills_planes`)- COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/1) AS total_a2akills
       FROM pe_logevent 
       GROUP BY pe_LogEvent_pilotid ) x ON pe_Medals_USA_pilotid = pe_LogEvent_pilotid
SET pe_medals_usa_ss = total_a2akills */


	   //WHERE pe_logevent_datetime > pe_logevent_datetime (max(pe_logevent_type = "pilot_death"))

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}



//Updating coalition on -> change_slot -> RED
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_coalition='RED' WHERE pe_LogEvent_content LIKE('RED%') AND (pe_LogEvent_type = 'change_slot' OR pe_LogEvent_type = 'landing' OR pe_LogEvent_type = 'takeoff' OR pe_LogEvent_type = 'kill' OR pe_LogEvent_type = 'eject' OR pe_LogEvent_type = 'crash' OR pe_LogEvent_type = 'pilot_death' OR pe_LogEvent_type = 'friendly_fire')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */



////////////////////////////////////////////////
////////////////////////////////////////////////


 
/* $sql = 'INSERT INTO pe_LastPilotDeath
(pe_LastPilotDeath_pilotname)
SELECT DISTINCT a.pe_LogEvent_LastPilotDeathName
FROM pe_LogEvent
SELECT a.pe_LogEvent_PilotName FROM pe_LogEvent
NOT IN (a.pe_LogEvent_LastPilotDeathName)
AND a.pe_LogEvent_PilotName NOT NULL'; */

//WHERE NOT EXISTS (


/* $sql = 'INSERT INTO pe_LastPilotDeath 
(pe_LastPilotDeath_pilotname,
pe_LastPilotDeath_datetime) 
SELECT DISTINCT a.pe_LogEvent_pilotname
     , a.pe_LogEvent_datetime
  FROM pe_logevent AS a 
 WHERE v2.pe_LogEvent_pilotname IS NULL 
   AND v1.pe_LogEvent_pilotname IS NOT NULL'; */


//One way ... deletes all the data though ...
 
/* $sql = '

DELETE FROM pe_LastPilotDeath
    WHERE pe_LastPilotDeath_id NOT IN
    (
        SELECT MAX(pe_LastPilotDeath_id) AS MaxRecordID
        FROM pe_LastPilotDeath
        GROUP BY pe_LastPilotDeath_pilotname,
		pe_LastPilotDeath_datetime
    )'; */




// Second way ... more complicated though .... no idea :(
/* $sql = '
SELECT E.pe_LastPilotDeath_id, 
    E.pe_LastPilotDeath_pilotname, 
    E.pe_LastPilotDeath_datetime, 
    T.rank
FROM pe_LastPilotDeath E
  INNER JOIN
(
 SELECT *, 
        RANK() OVER(PARTITION BY pe_LastPilotDeath_pilotname, 
                                 pe_LastPilotDeath_datetime, 
        ORDER BY pe_LastPilotDeath_id) rank
 FROM pe_LastPilotDeath
) T ON E.pe_LastPilotDeath_id = t.pe_LastPilotDeath_id;

DELETE E
    FROM pe_LastPilotDeath E
         INNER JOIN
    (
        SELECT *, 
               RANK() OVER(PARTITION BY pe_LastPilotDeath_pilotname, 
                                        pe_LastPilotDeath_datetime, 
               ORDER BY pe_LastPilotDeath_id) rank
        FROM pe_LastPilotDeath
    ) T ON E.pe_LastPilotDeath_id = t.pe_LastPilotDeath_id
    WHERE rank > 1'; */



//Third way ... PLease work!
/* $sql = 'WITH CTE(pe_LastPilotDeath_pilotname, 
    pe_LastPilotDeath_datetime, 
    DuplicateCount)
AS (SELECT pe_LastPilotDeath_pilotname, 
           pe_LastPilotDeath_datetime,  
           ROW_NUMBER() OVER(PARTITION BY pe_LastPilotDeath_pilotname, 
                                          pe_LastPilotDeath_datetime                                         
           ORDER BY pe_LastPilotDeath_id) AS DuplicateCount
    FROM pe_LastPilotDeath)
DELETE FROM CTE
WHERE DuplicateCount > 1'; */

////////////////////////////////////MAKE NEW STATS TABLE ... AHHHHHHHHHHH//////////////

//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
/* $sql = 'CREATE TABLE IF NOT EXISTS pe_LogStats2 (
pe_LogStats2_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pe_LogStats2_pilotname VARCHAR(100) DEFAULT NULL,
pe_LogStats2_datetime DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
';

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */

//Creating PlayervsAI Column in DB as `pe_LogEvent_playervsai`
/* $sql = "ALTER TABLE pe_LogStats2 ADD IF NOT EXISTS `pe_LogStats2_crashes` VARCHAR(100)";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

//Updating or Populating player column
$sql = "UPDATE pe_LogStats2 SET pe_LogStats2_crashes='1' WHERE pe_LogEvent_type = ('crash')";

if ($mysqli->query($sql) === TRUE) {
//  echo "Record updated successfully";
//  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


// INSERT last pilot death names and times into table (will create duplicates bc it involves copying the table - TRICKY PART!!!
/* $sql = 'INSERT INTO pe_LastPilotDeath 
(pe_LastPilotDeath_pilotname,
pe_LastPilotDeath_datetime) 
SELECT DISTINCT v1.pe_LogEvent_lastpilotdeathname,
 v1.pe_LogEvent_datetime
  FROM pe_logevent v1 
  LEFT JOIN pe_logevent v2 
    ON v1.pe_LogEvent_lastpilotdeathname = v2.pe_LogEvent_lastpilotdeathname
   AND v1.pe_LogEvent_datetime < v2.pe_LogEvent_datetime
 WHERE v2.pe_LogEvent_lastpilotdeathname IS NULL 
   AND v1.pe_LogEvent_lastpilotdeathname IS NOT NULL'; */


if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}







//Clearing LastPilotDeathtime columns with not the most recent datetime by pilot 
// USE THIS TO FIND MOST RECENT TIME https://stackoverflow.com/questions/17038193/select-row-with-most-recent-date-per-user/17038667

//enter select statement into new column ... doesn't error out but doesn't work.
/* $sql = "INSERT INTO `pe_logevent`(`pe_LogEvent_id`,`pe_LogEvent_pilotname`,`pe_LogEvent_lastpilotdeathtime`) VALUES('SELECT v1.`pe_Log_Event_id`,v1.`pe_LogEvent_pilotname`, v1.`pe_LogEvent_datetime` 
FROM `pe_logevent` AS v1 
LEFT JOIN `pe_logevent` AS v2 
  ON v1.`pe_LogEvent_pilotname` = v2.`pe_LogEvent_pilotname` AND 
     v1.`pe_LogEvent_datetime` < v2.`pe_LogEvent_datetime` 
WHERE v2.`pe_LogEvent_pilotname` IS NULL AND v1.`pe_LogEvent_pilotname` IS NOT NULL GROUP BY v1.`pe_LogEvent_pilotname`')"; */

/* 
if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


/* if ($result = $mysqli->query("SELECT v1.`pe_LogEvent_lastpilotdeathname`, v1.`pe_LogEvent_datetime`
FROM `pe_logevent` AS v1 
LEFT JOIN `pe_logevent` AS v2 
  ON v1.`pe_LogEvent_lastpilotdeathname` = v2.`pe_LogEvent_lastpilotdeathname` AND 
     v1.`pe_LogEvent_datetime` < v2.`pe_LogEvent_datetime` 
WHERE v2.`pe_LogEvent_lastpilotdeathname` IS NULL AND v1.`pe_LogEvent_lastpilotdeathname` IS NOT NULL GROUP BY v1.`pe_LogEvent_datetime`"))

{

//cast(your_float_column as decimal(10,2))

	echo "<table>";
	//echo "<table class='table_stats'>";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Time of Death</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_id'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_lastpilotdeathname'] . "</td>";					
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_type'] . "</td>";			

		echo "</tr>";
	}
	echo "</table>";


$result->close();

} */

//Action to SET Column
/* $sql = "UPDATE pe_logevent SET `pe_LogEvent_lastpilotdeathtime` = (SELECT v1.`pe_LogEvent_pilotname` 
FROM `pe_logevent` AS v1 
LEFT JOIN `pe_logevent` AS v2 
  ON v1.`pe_LogEvent_pilotname` = v2.`pe_LogEvent_pilotname` AND 
     v1.`pe_LogEvent_datetime` < v2.`pe_LogEvent_datetime` 
WHERE v2.`pe_LogEvent_pilotname` IS NULL ) WHERE `pe_LogEvent_pilotname` IS NOT NULL "; */



//Tried doesn't work
/* $sql = "UPDATE pe_logevent SET pe_LogEvent_lastpilotdeathtime(SELECT v1.`pe_LogEvent_pilotname`, v1.`pe_LogEvent_datetime`, v2.`pe_LogEvent_datetime`, v2.`pe_LogEvent_pilotname`  
FROM `pe_logevent` AS v1 
LEFT JOIN `pe_logevent` AS v2 
  ON v1.`pe_LogEvent_pilotname` = v2.`pe_LogEvent_pilotname` AND 
     v1.`pe_LogEvent_datetime` < v2.`pe_LogEvent_datetime` 
WHERE v2.`pe_LogEvent_pilotname` IS NULL GROUP BY v1.`pe_LogEvent_pilotname`)"; */


//Reference to code that works 
/* SELECT `pe_LogEvent_pilotname` 
FROM `pe_logevent` AS v1 
LEFT JOIN `pe_logevent` AS v2 
  ON v1.nr = v2.nr AND 
     v1.`pe_LogEvent_datetime` < v2.`pe_LogEvent_datetime` 
WHERE v2.nr IS NULL  */




/* if ($mysqli->query($sql) === TRUE) {
//echo "Record updated successfully";
//  echo "<br><br>";
 // sleep(1);
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
} */


?>