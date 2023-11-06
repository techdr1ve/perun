<!-- This is integration example for https://github.com/szporwolik/perun - please keep the code as simple and straightforward as possible -->
<!DOCTYPE html>
<html>
  <head>

	<style>
	<?php
	require "style.inc.php"; // include style
	?>
	</style>

	<?php
	require "header.inc.php"; // include header 
	?>



	
  </head>
  
  <body>

	<div id="header">
	
	<?php
		
//		session_start(); // Dr. No code to flip pages
		
			require "config.inc.php"; // trying to make this an include
//			require "functions.drno.php";
			
			//Enable Error Checking
			$driver = new mysqli_driver();
			$driver->report_mode = MYSQLI_REPORT_ERROR;
			
			// Try to connect to the database
				$mysqli = new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database);

			// Check connection
			if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}

			// Make Updates to columns in the database first before querying ... started with Hardcore/Realistic and now encompasses everything
			require "updates.inc.php";

			// Current Time + Mission + Map
				
//				echo "<h3>PLEASE FOR THE LOVE OF GOD WORK</h3>";
				$result = $mysqli->query("SELECT a.`pe_OnlineStatus_updated`, a.`pe_OnlineStatus_mission_name`, a.`pe_OnlineStatus_mission_theatre`, a.`pe_OnlineStatus_server_players`, a.`pe_OnlineStatus_server_players`- 1 AS server_players, a.`pe_OnlineStatus_server_pause`, CASE WHEN(a.`pe_OnlineStatus_server_pause`= 0) THEN 'Yes' ELSE 'No' END AS server_pause FROM pe_onlinestatus AS a ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "] on Mission: [" . $row->pe_OnlineStatus_mission_name . "] in Map: [" . $row->pe_OnlineStatus_mission_theatre .  "] with Player Count: [" . $row->server_players . "] and is Server Paused? : [" . $row->server_pause .  "].";
				}

?>



<h4>	 

<li><a href="serverstatus.php">Overall Server Status</a> </li>
<li><a href="serverstatsbycoalition.php">By: Coalition</a></li>	
<div class="tooltip"><li><a href="serverstatshardcore.php">By: Hardcore/Realistic </a></li> <span class="tooltiptext">Upon pilot death, stats reset!</span></div>
<div class="tooltip"><li><a href="serverstatshardcorebycoalition.php">By: Hardcore/Realistic by Coalition</a></li><span class="tooltiptext">Upon pilot death, stats reset!</span></div>

</h4>


<?php

/////////////FINAL///////All Server Statistics by Coalition: BLUE 
echo '<h3> All Server Statistics by Coalition: BLUE <img src="blue.png" alt="Paris" width="40" height="13"></h3>';
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_killed`,


COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,

COUNT(a.`pe_LogEvent_deaths`) AS value_count_deaths,
d.`pe_DeathAncestory_pilotdeathcount`,
CASE WHEN (d.`pe_DeathAncestory_pilotdeathcount`) = 0 THEN '' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 1 THEN 'Jr.' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 2 THEN 'II'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 3 THEN 'III' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 4 THEN 'IV' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 5 THEN 'V'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 6 THEN 'VI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 7 THEN 'VII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 8 THEN 'VIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 9 THEN 'IX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 10 THEN 'X'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 11 THEN 'XI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 12 THEN 'XII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 13 THEN 'XIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 14 THEN 'XIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 15 THEN 'XV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 16 THEN 'XVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 17 THEN 'XVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 18 THEN 'XVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 19 THEN 'XVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 20 THEN 'XX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 21 THEN 'XXI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 22 THEN 'XXII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 23 THEN 'XXIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 24 THEN 'XXIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 25 THEN 'XXV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 26 THEN 'XXVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 27 THEN 'XXVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 28 THEN 'XXVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 29 THEN 'XXVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 30 THEN 'XXX'  
ELSE 'xFUBARx' END AS DeathAncestory,

COUNT(a.`pe_LogEvent_pvp_killer`) AS value_count_pvp,
COUNT(a.`pe_LogEvent_friendly_fire_killer`) AS value_count_teamkills,

(COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`)) AS value_count_kills_planes,

COUNT(a.`pe_LogEvent_kills_helicopters`) AS value_count_kills_helicopters,
COUNT(a.`pe_LogEvent_kills_armor`) AS value_count_kills_armor,
COUNT(a.`pe_LogEvent_kills_air_defense`) AS value_count_kills_airdefense,
COUNT(a.`pe_LogEvent_kills_unarmed`) AS value_count_kills_unarmed,
COUNT(a.`pe_LogEvent_kills_infantry`) AS value_count_kills_infantry,
COUNT(a.`pe_LogEvent_kills_ships`) AS value_count_kills_ships,
COUNT(a.`pe_LogEvent_kills_fortifications`) AS value_count_kills_fortifications,
COUNT(a.`pe_LogEvent_kills_warehouses`) AS value_count_kills_warehouses,
COUNT(a.`pe_LogEvent_kills_artillery`) AS value_count_kills_artillery,
COUNT(a.`pe_LogEvent_kills_missiles`) AS value_count_kills_missiles,
COUNT(a.`pe_LogEvent_kills_other`) AS value_count_kills_other,
COUNT(a.`pe_LogEvent_takeoffs`) AS value_count_takeoffs,
COUNT(a.`pe_LogEvent_landings`) AS value_count_landings,

(COUNT(a.`pe_LogEvent_landings`)/(COUNT(a.`pe_LogEvent_takeoffs`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_other`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)- COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,

SUBSTRING(e.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(e.`pe_DataMissionHashes_hash`) - 26) AS value_mission,


a.`pe_LogEvent_missionhash_id`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime`,
d.`pe_DeathAncestory_pilotname`,
e.`pe_DataMissionHashes_id`, 
e.`pe_DataMissionHashes_hash` 


FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotname = b.pe_DataPlayers_lastname 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON b.pe_DataPlayers_lastname=c.pe_LastPilotDeath_pilotname 
LEFT JOIN `pe_DeathAncestory` AS d 
ON b.pe_DataPlayers_lastname=d.pe_DeathAncestory_pilotname 
INNER JOIN `pe_DataMissionHashes` AS e ON a.`pe_LogEvent_missionhash_id` = e.`pe_DataMissionHashes_id`

WHERE a.`pe_LogEvent_coalition` = 'BLUE' AND NOT a.`pe_LogEvent_type` = 'change_slot'
ORDER BY b.`pe_DataPlayers_updated` DESC


")) {


//TABLE STARTS BELOW

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='2'>Summary</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='10'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>LUV|Other</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Scud Missile</th><th>Infantry</th><th>Ships</th><th>Warehouses</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_missiles'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_warehouses'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}

/////////////////END FINAL ////////////

?>









<?php


/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo '<h3> All Server Statistics by Coalition: RED <img src="red.png" alt="Paris" width="40" height="13"></h3>';
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_killed`,


COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,

CASE WHEN c.`pe_LastPilotDeath_pilotname` IS NOT NULL THEN COUNT(a.`pe_LogEvent_deaths`) - 1 
WHEN c.`pe_LastPilotDeath_pilotname` IS NOT NULL AND a.`pe_LogEvent_datetime` IS NULL THEN '0' ELSE '0' END AS value_count_deaths,
d.`pe_DeathAncestory_pilotdeathcount`,
CASE WHEN (d.`pe_DeathAncestory_pilotdeathcount`) = 0 THEN '' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 1 THEN 'Jr.' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 2 THEN 'II'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 3 THEN 'III' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 4 THEN 'IV' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 5 THEN 'V'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 6 THEN 'VI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 7 THEN 'VII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 8 THEN 'VIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 9 THEN 'IX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 10 THEN 'X'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 11 THEN 'XI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 12 THEN 'XII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 13 THEN 'XIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 14 THEN 'XIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 15 THEN 'XV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 16 THEN 'XVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 17 THEN 'XVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 18 THEN 'XVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 19 THEN 'XVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 20 THEN 'XX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 21 THEN 'XXI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 22 THEN 'XXII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 23 THEN 'XXIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 24 THEN 'XXIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 25 THEN 'XXV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 26 THEN 'XXVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 27 THEN 'XXVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 28 THEN 'XXVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 29 THEN 'XXVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 30 THEN 'XXX'  
ELSE 'xFUBARx' END AS DeathAncestory,

COUNT(a.`pe_LogEvent_pvp_killer`) AS value_count_pvp,
COUNT(a.`pe_LogEvent_friendly_fire_killer`) AS value_count_teamkills,

(COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`)) AS value_count_kills_planes,

COUNT(a.`pe_LogEvent_kills_helicopters`) AS value_count_kills_helicopters,
COUNT(a.`pe_LogEvent_kills_armor`) AS value_count_kills_armor,
COUNT(a.`pe_LogEvent_kills_air_defense`) AS value_count_kills_airdefense,
COUNT(a.`pe_LogEvent_kills_unarmed`) AS value_count_kills_unarmed,
COUNT(a.`pe_LogEvent_kills_infantry`) AS value_count_kills_infantry,
COUNT(a.`pe_LogEvent_kills_ships`) AS value_count_kills_ships,
COUNT(a.`pe_LogEvent_kills_fortifications`) AS value_count_kills_fortifications,
COUNT(a.`pe_LogEvent_kills_warehouses`) AS value_count_kills_warehouses,
COUNT(a.`pe_LogEvent_kills_artillery`) AS value_count_kills_artillery,
COUNT(a.`pe_LogEvent_kills_missiles`) AS value_count_kills_missiles,
COUNT(a.`pe_LogEvent_kills_other`) AS value_count_kills_other,
COUNT(a.`pe_LogEvent_takeoffs`) AS value_count_takeoffs,
COUNT(a.`pe_LogEvent_landings`) AS value_count_landings,

(COUNT(a.`pe_LogEvent_landings`)/(COUNT(a.`pe_LogEvent_takeoffs`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_other`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)- COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,

SUBSTRING(e.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(e.`pe_DataMissionHashes_hash`) - 26) AS value_mission,


a.`pe_LogEvent_missionhash_id`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime`,
d.`pe_DeathAncestory_pilotname`,
e.`pe_DataMissionHashes_id`, 
e.`pe_DataMissionHashes_hash` 


FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotname = b.pe_DataPlayers_lastname 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON b.pe_DataPlayers_lastname=c.pe_LastPilotDeath_pilotname 
LEFT JOIN `pe_DeathAncestory` AS d 
ON b.pe_DataPlayers_lastname=d.pe_DeathAncestory_pilotname 
INNER JOIN `pe_DataMissionHashes` AS e ON a.`pe_LogEvent_missionhash_id` = e.`pe_DataMissionHashes_id`

WHERE a.`pe_LogEvent_coalition` = 'RED' AND NOT a.`pe_LogEvent_type` = 'change_slot'

ORDER BY b.`pe_DataPlayers_updated` DESC


")) {


//TABLE STARTS BELOW

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='2'>Summary</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='10'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>LUV|Other</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Scud Missile</th><th>Infantry</th><th>Ships</th><th>Warehouses</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_missiles'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_warehouses'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}

/////////////////END FINAL ////////////



// testing 2 joins
// Mission statistics for pilot
/*  echo "<h3>All Server Statistics by Mission</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` GROUP BY value_mission ")) {


	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='3'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>Air Defense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_deaths'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_crashes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_other'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_sum_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_fortification'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_airfield_takeoffs'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td>" . $row['value_sum_crashes'] . "</td>";
			//echo "<td>" . $row['value_sum_ejections'] . "</td>";
			//echo "<td>" . $row['value_sum_deaths'] . "</td>";	
		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
} 
 */

			

		?>
		
		

<?php

/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
//echo "<h3> All Server Statistics</h3>";
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_coalition`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_killed`,


COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_crashes`)*(-1) AS value_count_crashesneg,

COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,


COUNT(a.`pe_LogEvent_deaths`) AS value_count_deaths,
COUNT(a.`pe_LogEvent_deaths`)*(-1) AS value_count_deathsneg,


d.`pe_DeathAncestory_pilotdeathcount`,
CASE WHEN (d.`pe_DeathAncestory_pilotdeathcount`) = 0 THEN '' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 1 THEN 'Jr.' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 2 THEN 'II'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 3 THEN 'III' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 4 THEN 'IV' 
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 5 THEN 'V'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 6 THEN 'VI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 7 THEN 'VII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 8 THEN 'VIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 9 THEN 'IX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 10 THEN 'X'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 11 THEN 'XI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 12 THEN 'XII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 13 THEN 'XIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 14 THEN 'XIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 15 THEN 'XV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 16 THEN 'XVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 17 THEN 'XVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 18 THEN 'XVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 19 THEN 'XVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 20 THEN 'XX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 21 THEN 'XXI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 22 THEN 'XXII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 23 THEN 'XXIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 24 THEN 'XXIV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 25 THEN 'XXV'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 26 THEN 'XXVI'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 27 THEN 'XXVII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 28 THEN 'XXVIII'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 29 THEN 'XXVIX'
WHEN(d.`pe_DeathAncestory_pilotdeathcount`) = 30 THEN 'XXX'  
ELSE 'xFUBARx' END AS DeathAncestory,

COUNT(a.`pe_LogEvent_pvp_killer`) AS value_count_pvp,
COUNT(a.`pe_LogEvent_friendly_fire_killer`) AS value_count_teamkills,

(COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`)) AS value_count_kills_planes,

COUNT(a.`pe_LogEvent_kills_helicopters`) AS value_count_kills_helicopters,
COUNT(a.`pe_LogEvent_kills_armor`) AS value_count_kills_armor,
COUNT(a.`pe_LogEvent_kills_air_defense`) AS value_count_kills_airdefense,
COUNT(a.`pe_LogEvent_kills_unarmed`) AS value_count_kills_unarmed,
COUNT(a.`pe_LogEvent_kills_infantry`) AS value_count_kills_infantry,
COUNT(a.`pe_LogEvent_kills_ships`) AS value_count_kills_ships,
COUNT(a.`pe_LogEvent_kills_fortifications`) AS value_count_kills_fortifications,
COUNT(a.`pe_LogEvent_kills_warehouses`) AS value_count_kills_warehouses,
COUNT(a.`pe_LogEvent_kills_artillery`) AS value_count_kills_artillery,
COUNT(a.`pe_LogEvent_kills_missiles`) AS value_count_kills_missiles,
COUNT(a.`pe_LogEvent_kills_other`) AS value_count_kills_other,
COUNT(a.`pe_LogEvent_takeoffs`) AS value_count_takeoffs,
COUNT(a.`pe_LogEvent_landings`) AS value_count_landings,

(COUNT(a.`pe_LogEvent_landings`)/(COUNT(a.`pe_LogEvent_takeoffs`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_other`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,


(COUNT(a.`pe_LogEvent_kills_planes`)- COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) +(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_other`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_kills,



(COUNT(a.`pe_LogEvent_kills_planes`)- COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,

SUBSTRING(e.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(e.`pe_DataMissionHashes_hash`) - 26) AS value_mission,

a.`pe_LogEvent_missionhash_id`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime`,
d.`pe_DeathAncestory_pilotname`,
e.`pe_DataMissionHashes_id`, 
e.`pe_DataMissionHashes_hash` 


FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotname = b.pe_DataPlayers_lastname 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON b.pe_DataPlayers_lastname=c.pe_LastPilotDeath_pilotname 
LEFT JOIN `pe_DeathAncestory` AS d 
ON b.pe_DataPlayers_lastname=d.pe_DeathAncestory_pilotname 
INNER JOIN `pe_DataMissionHashes` AS e ON a.`pe_LogEvent_missionhash_id` = e.`pe_DataMissionHashes_id`


ORDER BY b.`pe_DataPlayers_updated` DESC


")) {


//TABLE STARTS BELOW

	echo "<table>";
	//echo "<table class='table_stats'>";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='2'>Summary</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='10'>A2G Kills</th></tr>"; // First Code	
	//echo "<tr class='table_header'><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>LUV|Other</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Scud Missile</th><th>Infantry</th><th>Ships</th><th>Warehouses</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		//echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			//echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_missiles'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_warehouses'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

            $coalition[]  = $row['pe_LogEvent_coalition'];
            $sorties[] = $row['value_count_takeoffs'];
			$totalkills[] = $row['total_kills'];
			$totala2g[] = $row['total_a2gkills'];
			$totala2a[] = $row['total_a2akills'];
			$crashes[] = $row['value_count_crashes'];			

		//echo "</tr>";
	}
	//echo "</table>";
	
	$result->close();
}

/////////////////END FINAL ////////////

			// Close database connection
				$mysqli->close();


?>




<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:25%;height:10%;text-align:center">
            <h2 class="page-header" >Versus Coalition Pie Stats </h2>

            <canvas  id="chartjs_pie"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($coalition); ?>,


                        datasets: [
						{
							label: 'Total Kills',

                            backgroundColor: [
                                "#3875e3",
							    "#C70039",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ], 
                            
                            data:<?php echo json_encode($totalkills); ?>,
                        },
						{
							label: 'Total A2A',

                            backgroundColor: [
                                "#3875e3",
							    "#C70039",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ],
                            
                            data:<?php echo json_encode($totala2a); ?>,
                        },																						
						{
							label: 'Total A2G',

                            backgroundColor: [
                                "#3875e3",
							    "#C70039",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ],
                            
                            data:<?php echo json_encode($totala2g); ?>,
                        },	
						{
							label: 'Total Sorties',

                            backgroundColor: [
                                "#3875e3",
							    "#C70039",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ],
                            
                            data:<?php echo json_encode($sorties); ?>,
                        },	
						{
							label: 'Total Crashes',

                            backgroundColor: [
                               "#0000FF",
							    "#900C3F",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ],
                            
                            data:<?php echo json_encode($crashes); ?>,
                        },
						]
					
                    },
						  options: {
							responsive: true,
							plugins: {
							  legend: {
								position: 'top',
							  },
							  title: {
								display: true,
								text: 'Chart.js Pie Chart'
							  }
							}
						  },
                });
    </script>
</html>


<!--
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:15%;height:10%;text-align:center">
            <h2 class="page-header" >A2G Kills</h2>

            <canvas  id="chartjs_pie"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_pie").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($coalition); ?>,


                        datasets: [
						{
							label: 'RED',

                            backgroundColor: [
                               "#0000FF",
							    "#000000",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ], 
                            
                            data:<?php echo json_encode($sorties); ?>,
                        },
						{
							label: 'BLUE',

                            backgroundColor: [
                               "#0000FF",
							    "#000000",
                                "#25d5f2",
								"#964B00",
								"#FF00FF",
								"#FFFFFF",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"

                            ],
                            
                            data:<?php echo json_encode($totala2g); ?>,
                        },																						
						]
					
                    },
						  options: {
							responsive: true,
							plugins: {
							  legend: {
								position: 'top',
							  },
							  title: {
								display: true,
								text: 'Chart.js Pie Chart'
							  }
							}
						  },
                });
    </script>
</html>
-->


  <!--  <script src="//code.jquery.com/jquery-1.9.1.js"></script> 
         <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>  -->

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div class="newspaper" style="width:30%;hieght:10%;text-align:center">
			<h2 class="page-header" >Sorties</h2>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($coalition); ?>,
                        datasets: [
						{
							label: 'Sorties',
							data:<?php echo json_encode($sorties); ?>,
                            backgroundColor: ["#0000FF","#ff004e"], 
							borderColor: "#000000",
							stack: 'Stack 0',                            

                        },
						{
							label: 'A2G Kills',
                            data:<?php echo json_encode($totala2g); ?>,
                            backgroundColor: ["#0000FF","#ff004e"],
							borderColor: "#000000",							
							stack: 'Stack 0',
                        },																						
						]
                    },
					  options: {
						plugins: {
						  title: {
							display: true,
							text: 'Chart.js Bar Chart - Stacked'
						  },
						},
						responsive: true,
						interaction: {
						  intersect: false,
						},
						scales: {
						  x: {
							stacked: true,
						  },
						  y: {
							stacked: true
						  }
						}
						
						
						
						
						
					  }
                });
    </script>
</html>




		
		


		
	</div>
	<div id="footer">
		<?php
		require "footer.inc.php"; // include menu items at top
		?>
	</div>
  </body>
</html>