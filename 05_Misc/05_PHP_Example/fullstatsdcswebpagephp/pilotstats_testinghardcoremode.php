<!-- This is integration example for https://github.com/szporwolik/perun - please keep the code as simple and straightforward as possible -->
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
		img:hover {
		-webkit-transform: scaleX(-1);
		transform: scaleX(-1);
		}		
	</style>
  </head>
  <body>
	<div id="header">
		<h1>Nomansland DCS Stats <a href="https://assets.change.org/photos/6/fc/nj/QKFcNjvVRqvmWNq-800x450-noPad.jpg?1552876930"><img src="gooseisloose.png" alt="Paris" width="33.3333333" height="25"></h1>
		<h2>		

		<a href="serverstats.php">Server</a> |
		<a href="pilotstats.php">Pilot</a> |
		<a href="airframestats.php">Airframe</a> |		
		<a href="missionstats.php">Mission</a> |		
		<a href="campaignstats.php">Campaign</a> |		
		<a href="livemap.php">Live Map</a> 		

		</h2>
		<h3>Get Perun support at <a href="https://discord.gg/MTahREx">Discord</a>
	</div>
	<div id="content">

		<?php



/* // Create connection - full method for reference
$mysqli = new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database);
// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$sql = "UPDATE pe_dataplayers SET pe_DataPlayers_lastname='Omin' WHERE pe_DataPlayers_id = '1'";

if ($mysqli->query($sql) === TRUE) {
  echo "Record updated successfully";
  echo "<br><br>";
} else {
  echo "Error updating record: " . $mysqli->error;
  echo "<br><br>";
}

$mysqli->close(); */



		
//			session_start(); // Dr. No code to flip pages
			//requiring configuration to connect to mysql database
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

			// Make Updates to columns in the database first before querying
			require "updates.inc.php"; 
			
			// Current Time + Mission + Map
				
//				echo "<h3>PLEASE FOR THE LOVE OF GOD WORK</h3>";
				$result = $mysqli->query("SELECT a.`pe_OnlineStatus_updated`, a.`pe_OnlineStatus_mission_name`, a.`pe_OnlineStatus_mission_theatre`, a.`pe_OnlineStatus_server_players`, a.`pe_OnlineStatus_server_players`- 1 AS server_players, a.`pe_OnlineStatus_server_pause`, CASE WHEN(a.`pe_OnlineStatus_server_pause`= 0) THEN 'Yes' ELSE 'No' END AS server_pause FROM pe_onlinestatus AS a ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "] on Mission: [" . $row->pe_OnlineStatus_mission_name . "] in Map: [" . $row->pe_OnlineStatus_mission_theatre .  "] with Player Count: [" . $row->server_players . "] and is Server Paused? : [" . $row->server_pause .  "].";
				}

//For Reference - Short Querying Code
//if ($result = $mysqli->query("SELECT b.`pe_DataPlayers_lastname`, REPLACE(('b.`pe_DataPlayers_lastname`' = 'WW2 Campaign Pilot'), 'WW2 Campaign Pilot', '[HVY]Omin')
//FROM `pe_DataPlayers` AS b WHERE b.`pe_DataPlayers_id` = 1"))

//$result->close();

//Everytime you die, reset your stats back to 0 ... so stats accumulate only from last death
//find last death
//find time of last death
//accumulate stats only after last time of death

// Query Last pilot death by time and then set all variables to only accumulate stats after last death time
echo "<h3> Last Death pilot table</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_mstatus`,a.`ps_deaths`,a.`pe_LogStats_datetime`,c.`pe_LogEvent_datetime`,c.`pe_LogEvent_content`, c.`pe_LogEvent_type`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_airdefense, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_airfield_landings`) AS value_sum_airfield_landings, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_ship_landings`) AS value_sum_ship_landings, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_farp_landings`) AS value_sum_farp_landings, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, SUM(a.`ps_other_landings`) AS value_sum_other_landings, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills,(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings, ((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test, b.`pe_DataPlayers_updated`, b.`pe_DataPlayers_id` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_LogEvent` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_LogEvent_missionhash_id` WHERE c.`pe_LogEvent_type` IN ('pilot_death') GROUP BY b.`pe_DataPlayers_lastname`,c.`pe_LogEvent_datetime`  ")) {

//cast(your_float_column as decimal(10,2))

	echo "<table>";
	//echo "<table class='table_stats'>";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>Deaths</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_playerid'] . "</td>";					
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_datetime'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_type'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_content'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['ps_deaths'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['total_takeoffs'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";	
			//echo "<td style='text-align: center'>" . $row['value_sum_deaths'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ejections'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_sum_crashes'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['value_sum_pvp'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_teamkills'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_planes'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_helicopters'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_armor'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_other'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_unarmed'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_airdefense'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_artillery'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_infantry'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_ships'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_kills_fortification'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";
			//echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td>" . $row['value_sum_crashes'] . "</td>";
			//echo "<td>" . $row['value_sum_ejections'] . "</td>";
			//echo "<td>" . $row['value_sum_deaths'] . "</td>";	
		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}

// Query Last pilot death by time and then set all variables to only accumulate stats after last death time
echo "<h3> All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_airdefense, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_airfield_landings`) AS value_sum_airfield_landings, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_ship_landings`) AS value_sum_ship_landings, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_farp_landings`) AS value_sum_farp_landings, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, SUM(a.`ps_other_landings`) AS value_sum_other_landings, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills,(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings, ((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test, b.`pe_DataPlayers_updated`, b.`pe_DataPlayers_id` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id GROUP BY b.`pe_DataPlayers_lastname` ORDER BY b.`pe_DataPlayers_updated` DESC")) {

//cast(your_float_column as decimal(10,2))

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>A2A Kills</th><th>A2G Kills</th><th>::Status::</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>Light Vehicles</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_takeoffs'] . "</td>";			
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";	
			echo "<td style='text-align: center'>" . $row['value_sum_deaths'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_crashes'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['value_sum_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_other'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_sum_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_sum_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_fortification'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";
			//echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td>" . $row['value_sum_crashes'] . "</td>";
			//echo "<td>" . $row['value_sum_ejections'] . "</td>";
			//echo "<td>" . $row['value_sum_deaths'] . "</td>";	
		echo "</tr>";
	}
	echo "</table>";
	
	$result->close();
}



// COMPLETE/FULL statistics for pilot  - 2 SQL Tables Joined
echo "<h3> All Pilot Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_airdefense, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_airfield_landings`) AS value_sum_airfield_landings, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_ship_landings`) AS value_sum_ship_landings, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_farp_landings`) AS value_sum_farp_landings, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, SUM(a.`ps_other_landings`) AS value_sum_other_landings, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills,(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings, ((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test, b.`pe_DataPlayers_updated`, b.`pe_DataPlayers_id` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id GROUP BY b.`pe_DataPlayers_lastname` ORDER BY b.`pe_DataPlayers_updated` DESC")) {

//cast(your_float_column as decimal(10,2))

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>A2A Kills</th><th>A2G Kills</th><th>::Status::</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>Light Vehicles</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_takeoffs'] . "</td>";			
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";	
			echo "<td style='text-align: center'>" . $row['value_sum_deaths'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_crashes'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['value_sum_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_sum_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_other'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_sum_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_sum_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_fortification'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";
			//echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td>" . $row['value_sum_crashes'] . "</td>";
			//echo "<td>" . $row['value_sum_ejections'] . "</td>";
			//echo "<td>" . $row['value_sum_deaths'] . "</td>";	
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