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
			//require "updates.inc.php";

			// Current Time + Mission + Map

			require "missionstatus.inc.php"; // include header

?>


<h4>	 

<li><a href="totalstats.php">Total Stats</a> </li>
<li><a href="totalstatsbypilot.php">By: Pilot</a> </li>
<li><a href="totalstatsbycoalition.php">By: Coalition</a></li>
<li><a href="totalstatsbypilotbycoalition.php">By: Coalition by Pilot</a></li>
<li><a href="totalstatsbyairframe.php">By: Airframe</a> </li>
<li><a href="totalstatsbypilotbyairframe.php">By: Airframe by Pilot</a> </li>
<li><a href="totalstatsbycampaign.php">By: Campaign</a> </li>
<li><a href="totalstatsbycampaignbymission.php">By: Campaign By Mission</a> </li>
<li><a href="totalstatsbycampaignbymissionbyairframe.php">By: Campaign By Mission By Airframe</a> </li>
<li><a href="totalstatsbycampaignbymissionbypilotbyairframe.php">By: Campaign By Mission By Airframe by Pilot</a> </li>

</h4>

<?php
		


// testing 2 joins
// Pilot Statistics BY AIRFRAME 
/* echo "<br><br><h3>All Airframe Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_typeid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, 
SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_air_defense, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, 

(SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`))+SUM(a.`ps_kills_air_defense`) AS total_a2gkills, 
(SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills,
(SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)+SUM(a.`ps_kills_air_defense`))+(SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_kills,


(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings, ((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

 b.`pe_DataPlayers_lastname`,
 c.`pe_DataTypes_name`
 
 FROM `pe_LogStats` AS a
 INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id 
 INNER JOIN `pe_DataTypes` AS c ON a.pe_LogStats_typeid = c.pe_DataTypes_id 
 WHERE c.`pe_DataTypes_name` NOT IN('?_-1','instructor', 'observer', 'forward_observer') 
 GROUP BY c.`pe_DataTypes_id` ORDER BY c.`pe_DataTypes_name`")) {


	
	

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='3'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Airframe Type</th><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Tanks|APCs|LUVs</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Hits|Aesthetic Statics</th></tr>"; // First Code					

	
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_datetime'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_typeid'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";
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
			echo "<td style='text-align: center'>" . $row['value_sum_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_air_defense'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_fortification'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_sum_kills_other'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td>" . $row['pe_DataPlayers_lastname'] . "</td>";
			//echo "<td>" . $row['value_sum_crashes'] . "</td>";
			//echo "<td>" . $row['value_sum_ejections'] . "</td>";
			//echo "<td>" . $row['value_sum_deaths'] . "</td>";	
			
			
			$airframes[]  = $row['pe_DataTypes_name'];
			$totala2g[] = $row['total_a2gkills'];
			$totala2a[] = $row['total_a2akills'];
			$totalkills[] = $row['total_kills'];			
			$sorties[] = $row['total_takeoffs'];
			
			
		echo "</tr>";
	}
	echo "</table>"; */


/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo "<br><br><br><h3 style='margin:5px'> All Airframe Statistics</h3>";
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_selfbomb`,

COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_crashes`)*(-1) AS value_count_crashesneg,

COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,
COUNT(a.`pe_LogEvent_ejections`)*(-1) AS value_count_ejectneg,


COUNT(a.`pe_LogEvent_deaths`) AS value_count_deaths,
COUNT(a.`pe_LogEvent_deaths`)*(-1) AS value_count_deathsneg,

d.`pe_DeathAncestoryFinal_pilotdeathcount`,
CASE WHEN (d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 0 THEN '' 
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 1 THEN 'Jr.' 
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 2 THEN 'II'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 3 THEN 'III' 
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 4 THEN 'IV' 
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 5 THEN 'V'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 6 THEN 'VI'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 7 THEN 'VII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 8 THEN 'VIII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 9 THEN 'IX'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 10 THEN 'X'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 11 THEN 'XI'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 12 THEN 'XII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 13 THEN 'XIII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 14 THEN 'XIV'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 15 THEN 'XV'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 16 THEN 'XVI'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 17 THEN 'XVII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 18 THEN 'XVIII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 19 THEN 'XVIX'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 20 THEN 'XX'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 21 THEN 'XXI'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 22 THEN 'XXII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 23 THEN 'XXIII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 24 THEN 'XXIV'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 25 THEN 'XXV'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 26 THEN 'XXVI'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 27 THEN 'XXVII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 28 THEN 'XXVIII'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 29 THEN 'XXVIX'
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 30 THEN 'XXX'  
ELSE 'xFUBARx' END AS DeathAncestory,

COUNT(a.`pe_LogEvent_pvp_killer`) AS value_count_pvp,
COUNT(a.`pe_LogEvent_friendly_fire_killer`) - COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) AS value_count_teamkills,

(COUNT(a.`pe_LogEvent_friendly_fire_killer`)- COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`))*(-1) AS value_count_teamkillsneg,

COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) AS value_count_selfkills,

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
COUNT(g.`pe_finalflightduration_id`) AS value_count_takeoffs,
COUNT(g.`pe_finalflightduration_nolanding` IS NOT NULL) AS value_count_landings,

(COUNT(g.`pe_finalflightduration_nolanding`)/(COUNT(g.`pe_finalflightduration_id`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test1,

SUM(g.`pe_finalflightduration_duration`)/60 AS flightduration,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)- COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,


DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,



a.`pe_LogEvent_pilotid`,
a.`pe_LogEvent_airframe`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime`,
d.`pe_DeathAncestoryFinal_pilotname`,
g.`pe_finalflightduration_duration`,
g.`pe_finalflightduration_pilotid`,
g.`pe_finalflightduration_takeofflandingnum`,
g.`pe_finalflightduration_nolanding`,
g.`pe_finalflightduration_id` 


FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotid = b.pe_DataPlayers_id 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON a.pe_LogEvent_pilotname=c.pe_LastPilotDeath_pilotname 
LEFT JOIN `pe_DeathAncestoryFinal` AS d 
ON a.pe_LogEvent_pilotname=d.pe_DeathAncestoryFinal_pilotname
LEFT JOIN `pe_finalflightduration` AS g
ON a.pe_LogEvent_datetime = g.pe_finalflightduration_takeoffdatetime 



 WHERE a.`pe_LogEvent_airframe` NOT IN('?_-1','instructor', 'observer', 'forward_observer') 
 GROUP BY a.`pe_LogEvent_airframe` 
 ORDER BY a.`pe_LogEvent_airframe`



")) {


//TABLE STARTS BELOW

/* <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
    <a href="#about">About</a>
    <a href="#base">Base</a>
    <a href="#blog">Blog</a>
    <a href="#contact">Contact</a>
    <a href="#custom">Custom</a>
    <a href="#support">Support</a>
    <a href="#tools">Tools</a>
  </div>
</div> */

	//echo "<select id=name name=name class='form-control' style='width:100px;'>";
	//echo "<option value=$row[id]>$row[name]</option>";
	//echo "</select>";

	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by airframe types...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Aviator Record Summary</th><th style='text-align: center' colspan='6'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='10'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Airframe</th><th>Flight Hours</th><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>Bomb Self</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Tanks|APCs|LUVs</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>TEL Missile</th><th>Infantry</th><th>Ships</th><th>Warehouses</th><th>Structures</th><th>Hits|Statics</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_airframe'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			echo "<td style='text-align: center'>" . number_format($row['flightduration'],1) . " hours</td>";			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
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
			echo "<td style='text-align: center'>" . $row['value_count_selfkills'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";
			
			echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_missiles'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_warehouses'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

			
			$airframes[] = $row['pe_LogEvent_airframe'];
			$totala2g[] = $row['total_a2gkills'];
			$totala2a[] = $row['total_a2akills'];
			$totalkills[] = $row['total_kills'];			
			$sorties[] = $row['value_count_takeoffs'];			

		echo "</tr>";
	}
	echo "</table>";


/* 	echo "<script>

	function myFunction() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}

	function filterFunction() {
	  var input, filter, ul, li, a, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  div = document.getElementById("myDropdown");
	  a = div.getElementsByTagName("a");
	  for (i = 0; i < a.length; i++) {
		txtValue = a[i].textContent || a[i].innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  a[i].style.display = "";
		} else {
		  a[i].style.display = "none";
		}
	  }
	}
	</script>";
 */

	echo "<script>
	function myFunction() {
	  var input, filter, table, tr, td, i, txtValue;
	  input = document.getElementById('myInput');
	  filter = input.value.toUpperCase();
	  table = document.getElementById('myTable');
	  tr = table.getElementsByTagName('tr');
	  for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName('td')[0];
		if (td) {
		  txtValue = td.textContent || td.innerText;
		  if (txtValue.toUpperCase().indexOf(filter) > -1) {
			tr[i].style.display = '';
		  } else {
			tr[i].style.display = 'none';
		  }
		}       
	  }
	}
	</script>";	
	
	$result->close();
}

/////////////////END FINAL ////////////

?>




<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:30%;height:10%;text-align:center">
            <h2 class="page-header" >Airframe Sorties|A2A|A2G vs. Pilot </h2>		
            <canvas  id="chartjs_pie"></canvas> 
            <h3 class="page-header" >OUTER: Sorties Flown<br>MIDDLE: A2A Kills<br>INNER: A2G Kills</h3>	

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
                        labels:<?php echo json_encode($airframes); ?>,


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
                                "#ff004e",
								"YELLOW",
								"ORANGE",
								"#6F00FF",
								"#318CE7",
								"PINK",
								"GREY",
								"#bada55",
								"#dcedc1",
								"#d3ffce",
								"#cccccc",
								"#468499",
								"#c0d6e4",
								"#00ff00",
								"#e6e6fa",
								"#420420",
								"#cbcba9",
								"#ccff00"


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
                                "#ff004e",
								"YELLOW",
								"ORANGE",
								"#6F00FF",
								"#318CE7",
								"PINK",
								"GREY",
								"#bada55",
								"#dcedc1",
								"#d3ffce",
								"#cccccc",
								"#468499",
								"#c0d6e4",
								"#00ff00",
								"#e6e6fa",
								"#420420",
								"#cbcba9",
								"#ccff00"

                            ],
                            
                            data:<?php echo json_encode($totala2a); ?>,
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
                                "#ff004e",
								"YELLOW",
								"ORANGE",
								"#6F00FF",
								"#318CE7",
								"PINK",
								"GREY",
								"#bada55",
								"#dcedc1",
								"#d3ffce",
								"#cccccc",
								"#468499",
								"#c0d6e4",
								"#00ff00",
								"#e6e6fa",
								"#420420",
								"#cbcba9",
								"#ccff00"
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




<?php
			
			// Close database connection
				$mysqli->close();
		?>
	</div>
	<div id="footer">
		<?php
		require "footer.inc.php"; // include menu items at top
		?>
	</div>
  </body>
</html>