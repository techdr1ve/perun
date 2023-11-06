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

<div class="tooltip"><li><li><a href="combatflightcert.php">Certifications by Pilot</a> </li> <span class="tooltiptext">Only clean flights counted w/o crash, eject, or pilot death!</span></div>
<div class="tooltip"><li><a href="combatflightcert_airframe.php">Certifications by Pilot by Airframe</a></li> <span class="tooltiptext">Only clean flights counted w/o crash, eject, or pilot death!</span></div>
<div class="tooltip"><li><a href="combatflightcert_branch.php">Certifications by Pilot by Military Branch</a></li> <span class="tooltiptext">Only clean flights counted w/o crash, eject, or pilot death!</span></div>

</h4>



<?php




/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo "<h3 style='margin:5px'>Combat Flight Certification (<i>based upon your Total Stats based on a Kill during a Clean Flight where the target is either generic or specific based on muntion type :: More Info in Passing Requirements link below</i>)</h3>";
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
COUNT(a.`pe_LogEvent_takeoffs`) AS value_count_takeoffs,
COUNT(a.`pe_LogEvent_landings`) AS value_count_landings,

(COUNT(a.`pe_LogEvent_landings`)/(COUNT(a.`pe_LogEvent_takeoffs`))*100) AS total_takeoff_landing_percentage, 
CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

(COUNT(a.`pe_LogEvent_kills_planes`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,


DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,



CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AIM-7M', 'AIM-7MH', 'AIM-7E', 'AIM-7F', 'Matra_S530D', 'RS-2US', 'Super 530D', 'R-27ER (AA-10 Alamo C)' )) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2a_fox1,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AIM-9L', 'AIM-9M', 'AIM-9P5', 'AIM-9X', 'AIM-9B', 'AIM-9P', 'AIM-9P3', 'PL-5EII', 'Matra Magic II', 'R-27ET (AA-10 Alamo D)', 'R-27ET (AA-10D)', 'R-60 (AA-8 Aphid)', 'R-73 (AA-11 Archer)', 'R-77 (AA-12 Adder)', 'RB-24J', 'RB-74', 'R-3R', 'R-60', 'MBDA Mistral')) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2a_fox2,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AIM-54A_Mk47', 'AIM-54A_Mk60', 'AIM-54C_Mk47', 'AIM-54C', 'AIM-54C-Mk47', 'AIM-120B', 'AIM-120C', 'AIM-120-5', 'SD-10')) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2a_fox3,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('Cannon') AND `pe_LogEvent_arg2`IN('Planes', 'Helicopters') ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2a_guns,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('Cannon') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'  
ELSE '' END AS cert_a2g_guns_autocannon,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('ARAKM70BHE', 'ARAKM70BAP', 'HYDRA-70 M151' , 'HYDRA-70 M156 WP', 'HYDRA-70 MK5', 'HYDRA-70 WTU-1/B', 'S-8KOM', 'S-8OFP2', 'S-13OF', 'S-24A (21)', 'S-24B (21)' 'S-25L', 'S-25OFM', 'SNEB', 'Unguided 90mm', 'Zuni-127', 'ZUNI MK71', 'SNEB68_EAP', 'S-5M', 'HVAR', 'S-24B', 'S-5KO', 'S-5M - unguided rocket 57mm') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_rockets_unguided,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('HYDRA-70 MPP APKWS', 'HYDRA-70 HE APKWS','BRM-1_90MM') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_rockets_guided,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AGM-62 Walleye II', 'AGM-62', 'AGM-65A', 'AGM-65B', 'AGM-65D','AGM-65F', 'AGM-65G', 'AGM-65H', 'AGM-65K', 'AGM-154A', 'AGM-154C','C-701IR', 'C-701T', 'Kh-29T', 'Kh-66 Grom (21)', 'RB-05A','RB-75A', 'RB-75B', 'RB-75T', 'RB-75') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_missiles_ccdirMav,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AGM-65E', 'AGM-65L', 'Kh-29L', 'Kh-25ML') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_missiles_laserMav,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AGM-122','AGM-88C', 'ADM-141', 'Kh-25MP', 'Kh-25MPU', 'Kh-58U', 'LD-10', 'AGM-45A') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_missiles_SEADARM,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('HOT3', 'Vikhr M', 'AT-6','9M120F Ataka (AT-9 Spiral-2)') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_missiles_ATGM,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AGM-84A','AGM-84D','AGM-84E', 'AGM-84K', 'AGM-84E SLAM', 'C-802AK', 'CM-802AKG', 'Sea Eagle', 'Rb-04E', 'Rb-15F') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_missiles_AntiShip,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('AN-M30A1', 'AN-M57', 'AN-M64', 'AN-M65', 'BR-250', 'BR-500', 'FAB-50', 'FAB-100', 'FAB-250', 'FAB-250 M54 TU', 'FAB-500 M62', 'FAB-1500 M54', 'GB-GP-250lbs-Mk4', 'GB-GP-500lbs-Mk4', 'M117', 'M/71 HE-Bomb', 'M/71 HE-Bomb w chute', 'Mk-82', 'Mk-82 SnakeEye', 'Mk-82 Snakeye', 'Mk-82AIR', 'Mk-81SE', 'Mk-81',  'Mk-82Y - 500lb GP Chute Retarded HD', 'Mk-83', 'Mk-84', '250 lbs. Bomb Mk. IV') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_dumb,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('GBU-10', 'GBU-12', 'GBU-16', 'GBU-24 Paveway III', 'GBU-27', 'GBU-24','GBU-54','GBU-54B','GBU-54(V)1/B') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_laserGBU,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('GBU-31', 'GBU-31(V)1/B','GBU-31(V)2/B', 'GBU-31(V)3/B','GBU-31(V)4/B', 'GBU-32(V)2/B', 'GBU-38', 'GBU-54','GBU-54B','GBU-54(V)1/B') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_GPSJDAM,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('CBU-105', 'CBU-97', 'AB 250-2', 'AB 500-1', 'BL755', 'BL755', 'BLG-66', 'CBU-52B', 'CBU-87 CEM', 'CBU-97 SFW', 'CBU-99', 'CBU-99', 'CBU-100', 'CBU-103', 'CBU-105', 'Mk 118', 'ROCKEYE', 'BLU-3B', 'BLU-3A') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_clusterCBU,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('BIN-200', 'Mk-77 mod 1', 'Mk-77 mod 0') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_incendiary,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('BLU-108', 'BetAB-500', 'BetAB-500ShP', 'KAB-500kr', 'TYPE-200A', 'SC-50', 'SC 250 Type 1 L2', 'SC 250 Type 3J', 'SC 500J', 'SC 500L2', 'SD 2', 'SD 10A', 'SD 250 Stg', 'SD 500A') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_penetrator,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('BK90 MJ1', 'BK90 MJ2', 'GB-6', 'GB-6-HE', 'GB-6-SFW', 'LS-6-500') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_glide,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('GBU-43/B') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_MOAB,

CASE WHEN(SUM(`pe_LogEvent_arg1`IN('RN-24', 'RN-28') AND `pe_LogEvent_arg2`IN('Air Defence', 'Armor', 'Artillery', 'Fortification', 'Infantry', 'Ships', 'UnArmed', 'Warehouse' ) ) >= 1) THEN '<b>PASS</b>'   
ELSE '' END AS cert_a2g_bomb_nuke,



a.`pe_LogEvent_arg1`,
a.`pe_LogEvent_arg2`,
a.`pe_LogEvent_airframe`,
a.`pe_LogEvent_militarybranch`,
a.`pe_LogEvent_killedunit_name`,
a.`pe_LogEvent_type`,
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
g.`pe_finalflightduration_id`,
g.pe_finalflightduration_takeoffdatetime,
g.pe_finalflightduration_landingdatetime


FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotid = b.pe_DataPlayers_id 
LEFT JOIN `pe_LastPilotDeath` AS c 
ON a.pe_LogEvent_pilotname=c.pe_LastPilotDeath_pilotname
INNER JOIN `pe_DeathAncestoryFinal` AS d 
ON a.pe_LogEvent_pilotname=d.pe_DeathAncestoryFinal_pilotname
LEFT JOIN `pe_medals_usa` AS e
ON a.pe_LogEvent_pilotname=e.pe_medals_usa_pilotname
LEFT JOIN `pe_finalflightduration` AS g
ON a.pe_LogEvent_datetime = g.pe_finalflightduration_takeoffdatetime

WHERE a.pe_LogEvent_militarybranch NOT IN('N/A')

GROUP BY a.`pe_LogEvent_pilotid`, a.pe_LogEvent_militarybranch
ORDER BY a.pe_LogEvent_militarybranch ASC



")) {

/* WHERE a.`pe_LogEvent_datetime`BETWEEN g.pe_finalflightduration_takeoffdatetime AND g.pe_finalflightduration_landingdatetime
AND g.pe_finalflightduration_nolanding` = 'landed' */

/* 
WHERE CASE 
WHEN ((a.`pe_LogEvent_datetime` = d.`pe_DeathAncestoryFinal_lastpilotdeathtime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
ELSE (a.`pe_LogEvent_datetime` > (DATE_ADD(d.`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END

GROUP BY a.pe_LogEvent_pilotid
ORDER BY b.`pe_DataPlayers_updated` DESC
 */
 

//TABLE STARTS BELOW
	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='2'></th><th style='text-align: center' colspan='4'><a href='https://en.wikipedia.org/wiki/Air-to-air_missile' target='_blank' rel='noopener noreferrer'>Air-to-Air(A2A)</a></th><th style='text-align: center' colspan='17'><a href='https://www.airgoons.com/w/DCS_Reference/Stores_List' target='_blank' rel='noopener noreferrer'>Air-to-Ground(A2G)</a></th></tr>"; // First Layer
	echo "<tr class='table_header'><th style='text-align: center' colspan='2'><a href='combatflightcert_passingreqs.php'>Passing Requirements</a></th><th style='text-align: center' colspan='4'><a href='https://en.wikipedia.org/wiki/Fox_(code_word)' target='_blank' rel='noopener noreferrer'>Fox Codes</a></th><th style='text-align: center' colspan='1'><a href='https://www.gd-ots.com/armaments/aircraft-guns-gun-systems/' target='_blank' rel='noopener noreferrer'>Guns</a></th><th style='text-align: center' colspan='2'><a href='https://en.wikipedia.org/wiki/Hydra_70' target='_blank' rel='noopener noreferrer'>Rockets</a></th><th style='text-align: center' colspan='5'><a href='https://en.wikipedia.org/wiki/Air-to-surface_missile' target='_blank' rel='noopener noreferrer'>Missiles</a></th><th style='text-align: center' colspan='9'><a href='https://en.wikipedia.org/wiki/Aerial_bomb' target='_blank' rel='noopener noreferrer'>Bombs</a></th></tr>"; // Second Layer			
	echo "<tr class='table_header'><th>Pilot</th><th>Military Branch</th><th><a href='https://www.gd-ots.com/armaments/aircraft-guns-gun-systems/' target='_blank' rel='noopener noreferrer'>Guns</a></th><th><a href='https://en.wikipedia.org/wiki/Semi-active_radar_homing' target='_blank' rel='noopener noreferrer'>Fox1(SARH)</a></th><th><a href='https://en.wikipedia.org/wiki/Infrared_homing' target='_blank' rel='noopener noreferrer'>Fox2(IR)</a></th><th><a href='https://en.wikipedia.org/wiki/Active_radar_homing' target='_blank' rel='noopener noreferrer'>Fox3(AR)</a></th><th><a href='https://en.wikipedia.org/wiki/GAU-8_Avenger' target='_blank' rel='noopener noreferrer'>Auto-Cannon</a></th><th><a href='https://en.wikipedia.org/wiki/Hydra_70' target='_blank' rel='noopener noreferrer'>UnGuided</a></th><th><a href='https://en.wikipedia.org/wiki/Advanced_Precision_Kill_Weapon_System' target='_blank' rel='noopener noreferrer'>Laser-Guided</a></th><th><a href='https://en.wikipedia.org/wiki/AGM-65_Maverick' target='_blank' rel='noopener noreferrer'>CCD/IR-Mav</a></th><th><a href='https://en.wikipedia.org/wiki/AGM-65_Maverick' target='_blank' rel='noopener noreferrer'>Laser-Mav</a></th><th><a href='https://en.wikipedia.org/wiki/Anti-radiation_missile' target='_blank' rel='noopener noreferrer'>SEAD-ARM</a></th><th><a href='https://en.wikipedia.org/wiki/Anti-tank_guided_missile' target='_blank' rel='noopener noreferrer'>ATGM</a></th><th><a href='https://en.wikipedia.org/wiki/Anti-ship_missile' target='_blank' rel='noopener noreferrer'>Anti-Ship</a></th>
	<th><a href='https://en.wikipedia.org/wiki/Unguided_bomb' target='_blank' rel='noopener noreferrer'>Dumb</a></th><th><a href='https://en.wikipedia.org/wiki/Laser-guided_bomb' target='_blank' rel='noopener noreferrer'>Laser-GBU</a></th><th><a href='https://en.wikipedia.org/wiki/Joint_Direct_Attack_Munition#:~:text=The%20Joint%20Direct%20Attack%20Munition,%2Dweather%20precision%2Dguided%20munitions.&text=The%20JDAM's%20guidance%20system%20was,the%20%22joint%22%20in%20JDAM.' target='_blank' rel='noopener noreferrer'>GPS-JDAM</th><th><a href='https://en.wikipedia.org/wiki/Cluster_munition' target='_blank' rel='noopener noreferrer'>Cluster-CBU</th><th><a href='https://en.wikipedia.org/wiki/Bunker_buster' target='_blank' rel='noopener noreferrer'>Penetrator</a></th>
	<th><a href='https://en.wikipedia.org/wiki/Glide_bomb#:~:text=A%20glide%20bomb%20or%20stand,conventional%20bomb%20without%20such%20surfaces.&text=The%20term%20glide%20bombing%20does,of%20shallow%2Dangle%20dive%20bombing.' target='_blank' rel='noopener noreferrer'>Glide</a></th><th><a href='https://en.wikipedia.org/wiki/Incendiary_device' target='_blank' rel='noopener noreferrer'>Incendiary</th><th><a href='https://en.wikipedia.org/wiki/GBU-43/B_MOAB' target='_blank' rel='noopener noreferrer'>MOAB</a></th><th><a href='https://en.wikipedia.org/wiki/Nuclear_weapon' target='_blank' rel='noopener noreferrer'>Nuke</a></th>
	</tr>"; // Third Layer 	 								
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_airframe'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_LogEvent_militarybranch'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['cert_a2a_guns'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2a_fox1'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2a_fox2'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2a_fox3'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			

			echo "<td style='text-align: center'>" . $row['cert_a2g_guns_autocannon'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['cert_a2g_rockets_unguided'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['cert_a2g_rockets_guided'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['cert_a2g_missiles_ccdirMav'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['cert_a2g_missiles_laserMav'] . "</td>";	
			echo "<td style='text-align: center'>" . $row['cert_a2g_missiles_SEADARM'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['cert_a2g_missiles_ATGM'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_missiles_AntiShip'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_dumb'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_laserGBU'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_GPSJDAM'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_clusterCBU'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_penetrator'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_glide'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_incendiary'] . "</td>";					
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_MOAB'] . "</td>";
			echo "<td style='text-align: center'>" . $row['cert_a2g_bomb_nuke'] . "</td>";						
			
		

            $pilotnames[]  = $row['pe_DataPlayers_lastname'];
			$totala2g[] = $row['total_a2gkills'];
			$totala2a[] = $row['total_a2akills'];
			$totalkills[] = $row['total_kills'];			
			$sorties[] = $row['value_count_takeoffs'];



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
<html>

<body onload="CertFunction()">

<script>
   function CertFunction(){
    td_array = document.getElementsByTagName("td");
    pass_value = "PASS";
	missing_value = "";

    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == pass_value){
        td_array[i].style.backgroundColor = "#90ee90";		
      };
	  };
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == missing_value){
        td_array[i].style.backgroundColor = "#FF7F7F";
	  };
	};
    
  };
</script>

</body>
</html>

<script>

</script>

<!--
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:30%;height:10%;text-align:center">
            <h2 class="page-header" >Total Medals Achieved </h2>		
            <canvas  id="chartjs_pie"></canvas> 
            <h3 class="page-header" ><i>Excluded: Medal of Honor AND Presidential Unit Citation</i></h3>	

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
                            
                            data:<?php echo json_encode($totalmedals); ?>,
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
</html> -->



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