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






<?php




/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo "<h3 style='margin:5px'>Rank (<i>based upon your Hardcore Stats</i>)</h3>";
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_selfbomb`,


COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,

CASE WHEN d.`pe_DeathAncestoryFinal_pilotdeathcount` > 0 THEN COUNT(a.`pe_LogEvent_deaths`) - 1 
WHEN d.`pe_DeathAncestoryFinal_pilotdeathcount` = 0 THEN '0' ELSE '0' END AS value_count_deaths,

d.`pe_DeathAncestoryFinal_pilotdeathcount`,
CASE WHEN (d.`pe_DeathAncestoryFinal_pilotdeathcount`) = 0 THEN ''
WHEN (d.`pe_DeathAncestoryFinal_pilotdeathcount`) = NULL THEN ''  
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
WHEN(d.`pe_DeathAncestoryFinal_pilotdeathcount`) > 30 THEN 'xFUBARx'   
ELSE '.' END AS DeathAncestory,

COUNT(a.`pe_LogEvent_pvp_killer`) AS value_count_pvp,

COUNT(a.`pe_LogEvent_friendly_fire_killer`) - COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) AS value_count_teamkills,
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
SUM(g.`pe_finalflightduration_duration_af`)/60 AS flightduration_af,
SUM(g.`pe_finalflightduration_duration_ar`)/60 AS flightduration_ar,
SUM(g.`pe_finalflightduration_duration_nv`)/60 AS flightduration_nv,
SUM(g.`pe_finalflightduration_duration_ma`)/60 AS flightduration_ma,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,


DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,



CASE
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[2ndLt] Second Lieutenant (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[1stLt] First Lieutenant (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[Capt] Captain (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Maj] Major (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[LtCol] Lieutenant Colonel (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[Col] Colonel (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[BrigGen] Brigadier General (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MajGen] Major General (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LtGen] Lieutenant General (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[Gen] General (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) > 1500) THEN '[GAF] General of the Air Force (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_nato,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[2ndLt] Second Lieutenant (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[1stLt] First Lieutenant (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[Capt] Captain (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Maj] Major (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[LtCol] Lieutenant Colonel (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[Col] Colonel (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[BrigGen] Brigadier General (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MajGen] Major General (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LtGen] Lieutenant General (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[Gen] General (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) > 1500) THEN '[GAF] General of the Air Force (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_af,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[2LT] Second Lieutenant (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[1LT] First Lieutenant (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[CPT] Captain (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[MAJ] Major (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[LTC] Lieutenant Colonel (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[COL] Colonel (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[BG] Brigadier General (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MG] Major General (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LTG] Lieutenant General (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[GEN] General (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) > 1500) THEN '[GA] General of the Army (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_ar,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[ENS] Ensign (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[LTJG] Lieutenant Junior Grade (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[Lt] Lieutenant (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[LCDR] Lieutenant Commander (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[CDR] Commander (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[Capt] Captain (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[RDML] Rear Admiral Lower Half (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[RADM] Rear Admiral Upper Half (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[VADM] Vice Admiral (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[ADM] Admiral (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) > 1500) THEN '[FADM] Fleet Admiral (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_nv,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[2ndLt] Second Lieutenant (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[1stLt] First Lieutenant (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[Capt] Captain (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Maj] Major (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[LtCol] Lieutenant Colonel (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[Col] Colonel (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[BGen] Brigadier General (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MajGen] Major General (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LtGen] Lieutenant General (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_ma`)+ ((COUNT(a.`pe_LogEvent_MA_kills_armor`)*5+COUNT(a.`pe_LogEvent_MA_kills_unarmed`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_MA_kills_ships`)*5+COUNT(a.`pe_LogEvent_MA_kills_artillery`)*2+COUNT(a.`pe_LogEvent_MA_kills_missiles`)*5+COUNT(a.`pe_LogEvent_MA_kills_fortifications`)+COUNT(a.`pe_LogEvent_MA_kills_warehouses`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_MA_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_MA_kills_helicopters`*5)) ) > 1259) THEN '[Gen] General (O-10)'                               
ELSE 'Cadet' END AS rank_officer_usa_ma,



CASE
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '1' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '2' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '3'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '4'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '5'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '6'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '7'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '8'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '9'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '10'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) > 1500) THEN '11'                                 
ELSE '0' END rank_total_campaign,



CASE WHEN((FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/20) >= 1) AND (FLOOR((COUNT(`pe_LogEvent_AR_kills_artillery`)+COUNT(`pe_LogEvent_AR_kills_armor`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)+COUNT(a.`pe_LogEvent_AR_kills_ships`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`))/40) >= '1' )) THEN '1'   
ELSE '0' END AS medals_usa_mh_ar,

CASE WHEN((FLOOR(((COUNT(`pe_LogEvent_NV_kills_planes`)+COUNT(`pe_LogEvent_MA_kills_planes`))-(COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_MA_friendly_fire_killer`))+(COUNT(`pe_LogEvent_NV_kills_helicopters`)+COUNT(`pe_LogEvent_MA_kills_helicopters`)))/20) >= 1) AND (FLOOR(((COUNT(`pe_LogEvent_NV_kills_armor`)+COUNT(`pe_LogEvent_MA_kills_armor`))+(COUNT(a.`pe_LogEvent_NV_kills_air_defense`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`))+(COUNT(a.`pe_LogEvent_NV_kills_ships`)+COUNT(a.`pe_LogEvent_MA_kills_ships`))+(COUNT(a.`pe_LogEvent_NV_kills_infantry`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`)))/40) >= '1' )) THEN '1'   
ELSE '0' END AS medals_usa_mh_nv,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_AF_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_af,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_AR_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_ar,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_NV_kills_missiles`)) >= 1) OR FLOOR((COUNT(`pe_LogEvent_MA_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_nvma,




FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_AF_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AF_takeoffs`))/25) +

FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/3)+
FLOOR((COUNT(a.`pe_LogEvent_AR_kills_armor`))/2) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_air_defense`))/2) + COUNT(a.`pe_LogEvent_AR_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_infantry`))/10) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_artillery`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_missiles`)+COUNT(a.`pe_LogEvent_AR_kills_fortifications`))/20) +

FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_NV_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_NV_takeoffs`))/25) +

FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_infantry`))/10) +

FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/5) +

FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/10) + FLOOR((COUNT(`pe_LogEvent_AF_kills_armor`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)+COUNT(a.`pe_LogEvent_AF_kills_ships`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`))/20) +

FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/10) + FLOOR((COUNT(`pe_LogEvent_AR_kills_artillery`)+COUNT(`pe_LogEvent_AR_kills_armor`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)+COUNT(a.`pe_LogEvent_AR_kills_ships`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`))/20) +

FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/10) + 
FLOOR((COUNT(`pe_LogEvent_MA_kills_planes`)-COUNT(`pe_LogEvent_MA_friendly_fire_killer`)+COUNT(`pe_LogEvent_MA_kills_helicopters`))/10) +
FLOOR((COUNT(`pe_LogEvent_NV_kills_armor`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)+COUNT(a.`pe_LogEvent_NV_kills_ships`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`))/20) +
FLOOR((COUNT(`pe_LogEvent_MA_kills_armor`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)+COUNT(a.`pe_LogEvent_MA_kills_ships`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`))/20) +

FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/15) + FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_infantry`))/30) 

AS medals_usa_total,



a.`pe_LogEvent_type`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime`,
d.`pe_DeathAncestoryFinal_pilotname`,
e.`pe_medals_usa_AM_AF`,
e.`pe_medals_usa_AM_AR`,
e.`pe_medals_usa_AM_NV`,
e.`pe_medals_usa_BS`,
e.`pe_medals_usa_SS`,
e.`pe_medals_usa_DFC_AR`,
e.`pe_medals_usa_AFC_AF`,
e.`pe_medals_usa_NMC_NV`,
e.`pe_medals_usa_MH_AF`,
e.`pe_medals_usa_MH_AR`,
e.`pe_medals_usa_MH_NV`,
e.`pe_medals_usa_PUC_AF`,
e.`pe_medals_usa_PUC_AR`,
e.`pe_medals_usa_PUC_NVMA`,
e.`pe_medals_usa_AMM_AF`,
e.`pe_medals_usa_SM_AR`,
e.`pe_medals_usa_NMM_NVMA`,
e.`pe_medals_usa_DSM`,
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
LEFT JOIN `pe_medals_usa` AS e
ON a.pe_LogEvent_pilotname=e.pe_medals_usa_pilotname
LEFT JOIN `pe_finalflightduration` AS g
ON a.pe_LogEvent_datetime = g.pe_finalflightduration_takeoffdatetime



WHERE CASE 
WHEN ((a.`pe_LogEvent_datetime` = d.`pe_DeathAncestoryFinal_lastpilotdeathtime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
ELSE (a.`pe_LogEvent_datetime` > (DATE_ADD(d.`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END

GROUP BY a.pe_LogEvent_pilotid
ORDER BY d.`pe_DeathAncestoryFinal_pilotname` DESC


")) {


/* 
WHERE CASE 
WHEN ((a.`pe_LogEvent_datetime` = d.`pe_DeathAncestoryFinal_lastpilotdeathtime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
ELSE (a.`pe_LogEvent_datetime` > (DATE_ADD(d.`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END

GROUP BY a.pe_LogEvent_pilotid
ORDER BY b.`pe_DataPlayers_updated` DESC
 */
 
 
//echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";


// more medals to add --> Airman's Medal, Soldier's Medal, Navy and Marines Medal, Distinguished Service Medal AF, AR, NVMA
/* <th><a href='https://en.wikipedia.org/wiki/Airman%27s_Medal' target='_blank' rel='noopener noreferrer'>Airman's Medal</th><th><a href='https://en.wikipedia.org/wiki/Soldier%27s_Medal' target='_blank' rel='noopener noreferrer'>Soldier's Medal</th><th><a href='https://en.wikipedia.org/wiki/Navy_and_Marine_Corps_Medal' target='_blank' rel='noopener noreferrer'>Navy and Marine Corps Medal</th><th><a href='https://en.wikipedia.org/wiki/Air_Force_Distinguished_Service_Medal' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|AF</th><th><a href='https://en.wikipedia.org/wiki/Distinguished_Service_Medal_(U.S._Army)' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|AR</th><th><a href='https://en.wikipedia.org/wiki/Navy_Distinguished_Service_Medal' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|NV(MA)</th> */


//TABLE STARTS BELOW
	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='1'><a href='hardcorestats_rankreq.php'>Rank Requirements</a></th><th style='text-align: center' colspan='5'><a href='https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjmiIm5yYLxAhVyHjQIHRezBuoQFjANegQIBBAF&url=https%3A%2F%2Fwww.studyguides.af.mil%2FPortals%2F15%2Fdocuments%2Frank_ribbons%2FOfficer%2520Rank%2520Insignia%2520of%2520the%2520United%2520States%2520Armed%2520Forces.pdf&usg=AOvVaw386NawbQlTTpvjkge-R6vW' target='_blank' rel='noopener noreferrer'>Officer Rank (Adhoc Campaign)</a></th><th style='text-align: center' colspan='5'><a href='https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjmiIm5yYLxAhVyHjQIHRezBuoQFjANegQIBBAF&url=https%3A%2F%2Fwww.studyguides.af.mil%2FPortals%2F15%2Fdocuments%2Frank_ribbons%2FOfficer%2520Rank%2520Insignia%2520of%2520the%2520United%2520States%2520Armed%2520Forces.pdf&usg=AOvVaw386NawbQlTTpvjkge-R6vW' target='_blank' rel='noopener noreferrer'>Officer/Warrant Officer Rank (Planned Campaign)</a></th></tr>"; // First Code		
	echo "<tr class='table_header'><th>Pilot</th><th>NATO</th><th>Air Force</th><th>Army</th><th>Navy</th><th>USMC</th><th>NATO(WO)</th><th>Air Force(O)</th><th>Army(WO)</th><th>Navy(WO)</th><th>USMC(WO)</th></tr>"; // First Code							
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['rank_officer_usa_nato'] . "</td>";
			echo "<td style='text-align: center'>" . $row['rank_officer_usa_af'] . "</td>";
			echo "<td style='text-align: center'>" . $row['rank_officer_usa_ar'] . "</td>";
			echo "<td style='text-align: center'>" . $row['rank_officer_usa_nv'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['rank_officer_usa_ma'] . "</td>";
		
			//echo "<td style='text-align: center'>" . $row['medals_usa_am_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_am_nv'] . "</td>";
			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			
			//echo "<td style='text-align: center'>" . $row['medals_usa_bs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_ss'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_dfc'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_afc_af'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsc_ar'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_nmc_nv'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_af'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_nv'] . "</td>";						
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_af'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_ar'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_nvma'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['medals_usa_amm_af'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_sm_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_nmm_nvma'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_af'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_nvma'] . "</td>";				
			

			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			
	
							

			//echo "<td style='text-align: center'>" . $row['pe_medals_usa_AFC'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['pe_medals_usa_MH'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_missiles'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_warehouses'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

            $pilotnames[]  = $row['pe_DataPlayers_lastname'];
			$totala2g[] = $row['total_a2gkills'];
			$totala2a[] = $row['total_a2akills'];
			$totalkills[] = $row['total_kills'];			
			$sorties[] = $row['value_count_takeoffs'];
			$totalrank[] = $row['rank_total_campaign'];


		echo "</tr>";
	}
	echo "</table>";

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
            <h2 class="page-header" >NATO Rank (All Military Branch Stats Combined) </h2>		
            <canvas  id="chartjs_pie"></canvas> 
           <!-- <h3 class="page-header" ><i>Excluded: Medal of Honor AND Presidential Unit Citation</i></h3>	-->

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
                        labels:<?php echo json_encode($pilotnames); ?>,


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
                            
                            data:<?php echo json_encode($totalrank); ?>,
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



//ps_kills_planes_hardcore
/* (CASE WHEN a.`pe_LogStats_datetime` < c.`pe_LastPilotDeath_datetime` THEN SUM(a.`ps_kills_planes` = 0) END) AS ps_kills_planes_dead,
(CASE WHEN c.`pe_LastPilotDeath_datetime` IS NOT NULL THEN (SUM(a.`ps_kills_planes`) - SUM('ps_kills_planes_dead')) WHEN c.`pe_LastPilotDeath_datetime` IS NULL THEN SUM(a.`ps_kills_planes`) END) AS value_sum_kills_planes_hardcore,  */


//(CASE WHEN a.`pe_LogStats_datetime` > c.`pe_LastPilotDeath_datetime` THEN (a.`ps_ejections` = '0') END) AS ps_ejections_dead,
//(CASE WHEN c.`pe_LastPilotDeath_datetime` IS NOT NULL THEN (SUM(a.`ps_ejections`) - SUM('ps_ejections_dead')) WHEN c.`pe_LastPilotDeath_datetime` IS NULL THEN 
//SUM(a.`ps_ejections`) END) AS value_sum_ejections_hardcore,

//(CASE WHEN a.`pe_LogStats_datetime` < c.`pe_LastPilotDeath_datetime` THEN (a.`ps_kills_other` = 0) END) AS ps_kills_other_dead,
//(CASE WHEN c.`pe_LastPilotDeath_datetime` IS NOT NULL THEN (SUM(a.`ps_kills_other`) - SUM('ps_kills_other_dead')) WHEN c.`pe_LastPilotDeath_datetime` IS NULL THEN //SUM(a.`ps_kills_other`) END) AS value_sum_kills_other_hardcore,

// Query Last pilot death by time and then set all variables to only accumulate stats after last death time

//COUNT(a.`pe_LogEvent_kill_planes`) AS value_count_kills_planes,

//$x ='COUNT(pe_LogEvent.`pe_LogEvent_deaths`) AS value_count_deaths' ;










/////////////TESTING///////
/* echo "<h3> All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_killed`,


a.`pe_LogEvent_datetime` > c.`pe_LastPilotDeath_datetime` AS flag,
COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,
COUNT(a.`pe_LogEvent_deaths`) AS value_count_deaths,
CASE WHEN COUNT(a.`pe_LogEvent_deaths`) = 0 THEN '' 
WHEN COUNT(a.`pe_LogEvent_deaths`) = 1 THEN 'Jr.' 
WHEN COUNT(a.`pe_LogEvent_deaths`) = 2 THEN 'II'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 3 THEN 'III' 
WHEN COUNT(a.`pe_LogEvent_deaths`) = 4 THEN 'IV' 
WHEN COUNT(a.`pe_LogEvent_deaths`) = 5 THEN 'V'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 6 THEN 'VI'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 7 THEN 'VII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 8 THEN 'VIII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 9 THEN 'IX'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 10 THEN 'X'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 11 THEN 'XI'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 12 THEN 'XII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 13 THEN 'XIII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 14 THEN 'XIV'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 15 THEN 'XV'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 16 THEN 'XVI'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 17 THEN 'XVII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 18 THEN 'XVIII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 19 THEN 'XVIX'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 20 THEN 'XX'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 21 THEN 'XXI'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 22 THEN 'XXII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 23 THEN 'XXIII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 24 THEN 'XXIV'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 25 THEN 'XXV'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 26 THEN 'XXVI'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 27 THEN 'XXVII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 28 THEN 'XXVIII'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 29 THEN 'XXVIX'
WHEN COUNT(a.`pe_LogEvent_deaths`) = 30 THEN 'XXX'  
ELSE 'xFUBARx' END AS value_count_deaths_ancestory,

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
COUNT(a.`pe_LogEvent_kills_artillery`) AS value_count_kills_artillery,
COUNT(a.`pe_LogEvent_kills_other`) AS value_count_kills_other,
COUNT(a.`pe_LogEvent_takeoffs`) AS value_count_takeoffs,
COUNT(a.`pe_LogEvent_landings`) AS value_count_landings,

(COUNT(a.`pe_LogEvent_landings`)/(COUNT(a.`pe_LogEvent_takeoffs`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_other`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,



b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`,
c.`pe_LastPilotDeath_pilotname`,
c.`pe_LastPilotDeath_datetime` 
FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotname = b.pe_DataPlayers_lastname 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON b.pe_DataPlayers_lastname=c.pe_LastPilotDeath_pilotname 

GROUP BY b.`pe_DataPlayers_lastname` 
ORDER BY b.`pe_DataPlayers_updated` DESC")) {


//TABLE BELOW


	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>Light Vehicles</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['value_count_deaths_ancestory'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
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
			echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_kills_planes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_helicopters'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_armor'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['value_count_kills_unarmed'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_airdefense'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_kills_artillery'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_infantry'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_ships'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_kills_fortifications'] . "</td>";
			
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
} */

/////////////////END TESTING////////////


			
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