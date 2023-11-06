<!-- This is an advanced integration example from Dr.No for https://github.com/szporwolik/perun - please keep the code as simple and straightforward as possible -->
<!DOCTYPE html>
<html>
  <head>
    <title>Nomansland DCS Stats</title>
    <meta charset="utf-8">
    <meta name="description" content="Nomansland DCS Stats">
    <meta name="keywords" content="dcs world perun">
    <meta name="author" content="Dr.No (The Dude)">
	
	<style>
		body {
			background-color: #b3ffb3;
			padding: 0 20px 0 20px;
		}

		h1,h2,h3 {
			color: black; 
			
		}
		
		#header{
			border-top: 1px solid navy;
			border-bottom: 1px solid navy;
			padding: 10px 0 10px 0px;
		}
		
		#content{
			border-top: 1px solid navy;
			border-bottom: 1px solid navy;
			padding: 10px 0 10px 0px;
		}
		
		#footer{
			padding: 10px 0 10px 0px;
			text-align: right;
		}
		
		table, td{
			border: 1px solid navy;
			background-color:#ffffe6
			
		}
		
		table, th{
			border: 1px solid black;
			background-color:#d9d9d9;
		}
	</style>
  </head>
  <body>
	<div id="header">
		<h1>Nomansland DCS Stats</h1>
		<h2>		

		<a href="serverstats.php">Server Stats</a> |
		<a href="pilotstats.php">Pilot Stats</a> |
		<a href="missionstats.php">Mission Stats</a> |		
		<a href="campaignstats.php">Campaign Stats</a> |		
		<a href="livemap.php">Live Map</a> |
		<a href="template.php">Template</a>	

		</h2>
		<h3>Get Perun support at <a href="https://discord.gg/MTahREx">Discord</a>
	</div>
	<div id="content">

		<?php

		require "config.inc.php"; // trying to make this an include		
//		session_start(); // Dr. No code to flip pages
		
			
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

			// Current Time + Mission + Map
				
//				echo "<h3>PLEASE FOR THE LOVE OF GOD WORK</h3>";
				$result = $mysqli->query("SELECT * FROM pe_onlinestatus ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "] on Mission: [" . $row->pe_OnlineStatus_mission_name . "] in Map: [" . $row->pe_OnlineStatus_mission_theatre .  "] with Player Count: [" . $row->pe_OnlineStatus_server_players . "] and is Server Paused? : [" . $row->pe_OnlineStatus_server_pause .  "].";
				}






// testing 2 joins
// COMPLETE/FULL statistics for pilot  - 2 SQL Tables Joined
echo "<h3> FULL Pilot Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_updated`, c.pe_onlineplayers_side, CASE WHEN(c.`pe_onlineplayers_side`= 0) THEN 'BLUE' ELSE 'RED' END AS value_coalition FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_onlineplayers` AS c ON a.pe_LogStats_playerid = c.pe_OnlinePlayers_id")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='6'>Last Known</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>A2A Kills</th><th>A2G Kills</th><th>Coalition</th><th>::Status::</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>Air Defense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
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


// testing 2 joins
// Pilot Statistics BY AIRFRAME 
echo "<h3>FULL Pilot Statistics BY AIRFRAME - 3 SQL Tables Joined</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataTypes_name` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id WHERE c.`pe_DataTypes_name` NOT IN ('?_-1') GROUP BY c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname` ORDER BY c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname`")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Airframe Type</th><th>A2A Kills</th><th>A2G Kills</th><th>::Status::</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>Air Defense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_typeid'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";							
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

// testing 2 joins
// Mission statistics for pilot
echo "<h3>ALL MISSION Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` GROUP BY value_mission ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
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

// testing 2 joins
// Mission statistics for pilot
echo "<h3>ALL MISSION Pilot Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`,  SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` GROUP BY value_mission, b.`pe_DataPlayers_lastname` ORDER BY value_mission, b.`pe_DataPlayers_lastname` ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Current Status</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	

	echo "<tr class='table_header'><th>Pilot</th><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>Air Defense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins


// testing 2 joins
// Full statistics for pilot
echo "<h3>ALL MISSION Pilot Statistics by AIRFRAME</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataTypes_name`, d.`pe_DataMissionHashes_id`, d.`pe_DataMissionHashes_hash`, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id INNER JOIN `pe_DataMissionHashes` AS d ON a.`pe_LogStats_missionhash_id` = d.`pe_DataMissionHashes_id` WHERE c.`pe_DataTypes_name` NOT IN ('?_-1') GROUP BY value_mission, c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname` ORDER BY c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname` ")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Mission</th><th>Airframe Type</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>Air Defense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins




// testing 2 joins
// Mission statistics for pilot
echo "<h3>MISSION Statistics WITH KEY --> $  as Last character in .miz file; ex: 'Bombastic$.miz' ... The mission will show as 'Bombastic.miz' </h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, b.`pe_DataPlayers_lastname`, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` WHERE SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) LIKE '%$%' GROUP BY value_mission ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='3'>Current Status</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins

// testing 2 joins
// Mission statistics for pilot
echo "<h3>MISSION Statistics by Pilot WITH KEY --> $  as Last character in .miz file; ex: 'Bombastic$.miz' ... The mission will show as 'Bombastic.miz' </h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` WHERE SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) LIKE '%$%' GROUP BY b.`pe_DataPlayers_lastname`, value_mission ORDER BY b.`pe_DataPlayers_lastname`, value_mission ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";
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
// testing 2 joins

// testing 2 joins
// Full statistics for pilot
echo "<h3>MISSION Pilot Statistics by AIRFRAME With KEY --> $</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataTypes_name`, d.`pe_DataMissionHashes_id`, d.`pe_DataMissionHashes_hash`, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id INNER JOIN `pe_DataMissionHashes` AS d ON a.`pe_LogStats_missionhash_id` = d.`pe_DataMissionHashes_id` WHERE((SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) LIKE '%$%') AND c.`pe_DataTypes_name` NOT IN ('?_-1')) GROUP BY value_mission, c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname` ORDER BY c.`pe_DataTypes_id`, b.`pe_DataPlayers_lastname` ")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Current Status</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Mission</th><th>Airframe Type</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['value_mission'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins






// testing 2 joins
// Full statistics for pilot
echo "<h3>CAMPAIGN Overall Statistics WITH KEY --> !_###  as last characters in .miz file; ex: 'OperationRoadRunner!_001.miz' </h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 31) AS value_campaign FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` WHERE SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) LIKE '%!_0%' GROUP BY value_campaign ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='3'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Campaign</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_campaign'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins



// testing 2 joins
// Full statistics for pilot
echo "<h3>CAMPAIGN Pilot Statistics WITH KEY --> !_###  as last characters in .miz file; ex: 'OperationRoadRunner!_001.miz' </h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 31) AS value_campaign FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` WHERE SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) LIKE '%!_0%' GROUP BY b.`pe_DataPlayers_lastname`, value_campaign ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Campaign</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['pe_DataMissionHashes_hash'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_campaign'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins


// testing 3 joins
// Full statistics for pilot
echo "<h3>CAMPAIGN Pilot Statistics by AIRFRAME WITH KEY --> !_### </h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataTypes_name`, d.`pe_DataMissionHashes_id`, d.`pe_DataMissionHashes_hash`, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) AS value_mission, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 31) AS value_campaign FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id INNER JOIN `pe_DataMissionHashes` AS d ON a.`pe_LogStats_missionhash_id` = d.`pe_DataMissionHashes_id` WHERE((SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) LIKE '%!_0%') AND c.`pe_DataTypes_name` NOT IN ('?_-1')) GROUP BY value_campaign, c.`pe_DataTypes_id` ")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Campaign</th><th>Airframe Type</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['value_campaign'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins


// testing 3 joins
// CAMPAIGN Pilot Statistics by MISSION with KEY !_###
echo "<h3>CAMPAIGN Pilot Statistics by MISSION with KEY --> !_###</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataTypes_name`, d.`pe_DataMissionHashes_id`, d.`pe_DataMissionHashes_hash`, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) AS value_mission, SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 31) AS value_campaign, SUBSTRING(d.`pe_DataMissionHashes_hash`, POSITION('!_' IN d.`pe_DataMissionHashes_hash`) + 2, 3) AS value_mission_short  FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id INNER JOIN `pe_DataMissionHashes` AS d ON a.`pe_LogStats_missionhash_id` = d.`pe_DataMissionHashes_id` WHERE( (SUBSTRING(d.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(d.`pe_DataMissionHashes_hash`) - 26) LIKE '%!_0%') AND c.`pe_DataTypes_name` NOT IN ('?_-1')) GROUP BY value_campaign, value_mission ")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Main Events</th><th style='text-align: center' colspan='3'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='7'>A2G Kills</th><th style='text-align: center' colspan='4'>Takeoffs</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Campaign</th><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>UnArmored</th><th>AirDefense|Other</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Airfield</th><th>Ship</th><th>FARP</th><th>Other</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['value_campaign'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_mission_short'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
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
// testing 2 joins


			// Last 5 missions on the server
				echo "<h3>List last 5 missions at the server</h3>";
				if ($result = $mysqli->query("SELECT * FROM `pe_DataMissionHashes` ORDER BY `pe_DataMissionHashes`.`pe_DataMissionHashes_datetime` DESC LIMIT 5")) {
					echo "<table>";
					echo "<table class='table_stats'>"; //First Code from Dr. No
					echo "<tr class='table_header'><th>Mission Version Datetime</th><th>Timestamp</th></tr>"; // First Code					
					while($row = mysqli_fetch_array($result))
					{

						echo "<tr>";
							//echo "<td>" . $row['pe_DataMissionHashes_id'] . "</td>";
							echo "<td>" . $row['pe_DataMissionHashes_hash'] . "</td>";
							echo "<td>" . $row['pe_DataMissionHashes_datetime'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					
					$result->close();
				}			

			
			// Some Examples
				// List last 5 missions at the server
/* 				echo "<h3>List last 5 missions at the server</h3>";
				if ($result = $mysqli->query("SELECT * FROM `pe_DataMissionHashes` ORDER BY `pe_DataMissionHashes`.`pe_DataMissionHashes_datetime` DESC LIMIT 5")) {
					echo "<table>";
					while($row = mysqli_fetch_array($result))
					{
						echo "<table class='table_stats'>"; //First Code from Dr. No
						echo "<tr class='table_header'><th >Mission Number</th><th>Mission Number Version Datetime</th><th>Timestamp</th></tr>"; // First Code
						echo "<tr>";
							echo "<td>" . $row['pe_DataMissionHashes_id'] . "</td>";
							echo "<td>" . $row['pe_DataMissionHashes_hash'] . "</td>";
							echo "<td>" . $row['pe_DataMissionHashes_datetime'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					
					$result->close();
				} */
				
				// List last 5
/* 				echo "<h3>List last 5 players known server </h3>";
				if ($result = $mysqli->query("SELECT * FROM `pe_DataPlayers` ORDER BY `pe_DataPlayers`.`pe_DataPlayers_updated` DESC LIMIT 5")) {
					echo "<table>";
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>" . $row['pe_DataPlayers_id'] . "</td>";
							echo "<td>" . $row['pe_DataPlayers_ucid'] . "</td>";
							echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
							echo "<td>" . $row['pe_DataPlayers_updated'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					
					$result->close();
				} */
				
				// List last 5 chat messages 
/* 				echo "<h3>List last 5 chat messages (note: INNER JOIN is used to pull the player's name from other table)</h3>";
				if ($result = $mysqli->query("SELECT * FROM `pe_LogChat` INNER JOIN `pe_DataPlayers` on `pe_LogChat`.pe_LogChat_playerid = `pe_DataPlayers`.pe_DataPlayers_id ORDER BY `pe_LogChat`.`pe_LogChat_datetime` DESC LIMIT 5")) {
					echo "<table>";
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>" . $row['pe_LogChat_datetime'] . "</td>";
							echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
							echo "<td>" . $row['pe_LogChat_msg'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					
					$result->close();
				} */
				
				
				// List last 5 events
/* 				echo "<h3> WISH </h3>";
		$result = $this->mysqli->query("SELECT * FROM pilots WHERE name<>'AI' AND disp_name<>'AI' ORDER BY flighttime DESC");
		
				$this->mysqli->query("UPDATE pilots SET pilots.crashes = pilots.crashes + (SELECT COUNT(events.id) FROM " . $this->event_table . " AS events WHERE events.event='S_EVENT_CRASH' AND events.InitiatorPlayer=pilots.name)");
		
				if ($result = $mysqli->query("SELECT COUNT('ps_crashes') FROM 'pe_LogStats'")) {
					
					echo "<table>";
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>" . $row['pe_crashes'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					
					$result->close();
				}
 */

// Basic statistics for pilot
echo "<h3>List basic statistics for pilot </h3>";
if ($result = $mysqli->query("SELECT `pe_LogStats_playerid`, SUM(`ps_crashes`) AS value_sum_crashes, SUM(`ps_ejections`) AS value_sum_ejections, SUM(`ps_deaths`) AS value_sum_deaths FROM `pe_LogStats` ORDER BY `pe_LogStats_playerid` desc LIMIT 20")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th>Player ID</th><th>Total Crashes</th><th>Total Ejections</th><th>Total Deaths</th></tr>";
//	$crashh = $mysqli->query("SELECT SUM(`ps_kills_planes`) AS value_sum_planekills FROM `pe_LogStats` WHERE `pe_LogStats_playerid` IS NOT NULL");
			
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td>" . $row['pe_LogStats_playerid'] . "</td>";
			echo "<td>" . $row['value_sum_crashes'] . "</td>";
			echo "<td>" . $row['value_sum_ejections'] . "</td>";
			echo "<td>" . $row['value_sum_deaths'] . "</td>";	
//			echo "<td>" . $row($crashh] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}

// testing 2 joins
// Basic statistics for pilot
echo "<h3>List basic statistics for pilot - 2 joins</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, b.`pe_DataPlayers_lastname` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id ")) {
	
	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th>Player ID</th><th>Pilot</th><th>Total Crashes</th><th>Total Ejections</th><th>Total Deaths</th></tr>";
//	$crashh = $mysqli->query("SELECT SUM(`ps_kills_planes`) AS value_sum_planekills FROM `pe_LogStats` WHERE `pe_LogStats_playerid` IS NOT NULL");
			
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td>" . $row['pe_LogStats_playerid'] . "</td>";
			echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			echo "<td>" . $row['value_sum_crashes'] . "</td>";
			echo "<td>" . $row['value_sum_ejections'] . "</td>";
			echo "<td>" . $row['value_sum_deaths'] . "</td>";	
//			echo "<td>" . $row($crashh] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}


			
			// Close database connection
				$mysqli->close();
		?>
	</div>
	<div id="footer">
		<a href="https://github.com/szporwolik/perun">
			<img src="https://camo.githubusercontent.com/50a1df184e069b36f3ddf9223bf16582f49aa16c/68747470733a2f2f692e696d6775722e636f6d2f5072496b714e412e706e67" alt="Perun_Logo">
		</a>
	</div>
  </body>
</html>