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

//	$simStats = new SimStats(new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS, $MYSQL_DB));
$Stats = new Stats(new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database));

//////////////test
class Stats {

	protected $mysqli;
	
	public function Stats(mysqli $mysqli) {
		$this->mysqli = $mysqli;
	}
	

	public function echoClickStats() 
	{
		if (isset($_GET['pis'])) 
		{
			$this->echoPilotStat2($_GET['pis']);
		}			
		else
		{
//			echo "<h2>Pilots</h2><br><br>";
//			$this->echoPilotsTable();
		}
	}
	


	public function echoPilotStat2($pilotid) {

		require "config.inc.php"; // trying to make this an include
		// Try to connect to the database
		$mysqli = new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database);	
		
		if ($pilot = $this->getPilotsStat2($pilotid)) {
			
			$pilotid = $pilot->pe_dataplayers_id;



			//echo "<button id='show'>Toggle Detailed Pilot Stats</button>";
			//echo "Pilot: " . $pilot->pe_dataplayers_lastname . "";
			//echo "Kills: Armor " . $pilot->value_count_kills_armor . "<br><br>";
//			echo "<table class='table_stats'><tr class='table_row_0'><td>Total Flight Time: </td><td>" . $this->timeToString($pilot->flighttime) . "</td></tr>";
			//echo "<tr class='table_row_1'><td>Flights: </td><td>" . $pilot->flights . "</td></tr>";
			//echo "<tr class='table_row_0'><td>Last Activity: </td><td>" . $pilot->pe_dataplayers_updated . "</td></tr>";

					



			//echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
			//echo "<table class='table_stats' id='myTable' >";
			//echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Aviator Record Summary</th><th style='text-align: center' colspan='6'>Life Events</th></tr>"; // First Code	
			//echo "<tr class='table_header'><th>Pilot</th><th>Last Flight</th><th>Total Flight Hours</th><th>Sorties</th><th>A2A Kills</th></tr>"; // First Code

			//while($pilot->mysqli_fetch_array($result))
			
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_pilotid . "</td>";	
					//echo "<tr onclick=\"window.document.location='?pis=" . $pilot->pe_LogEvent_pilotid . "'\" class='table_row_" . $pilot->pe_LogEvent_pilotid %2 . "'>";
					//echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_lastname . "</td>";		
					//echo "<td style='text-align: center'>" . $pilot->value_count_kills_armor . "</td>";
						//echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_updated . "</td>";
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_airframe . "</td>";			
					//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
					//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
					//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
						//echo "<td style='text-align: center'>" . $pilot->pe_DataMissionHashes_hash . "</td>";
						//echo "<td style='text-align: center'>" . $pilot->value_mission_short . "</td>";			


					//echo "<h2>Pilot " . $pilot->pe_dataplayers_lastname . "</h2>";
					//echo "<h3>Kills: Armor " . $pilot->value_count_kills_armor . "</h3><br><br>";
					//echo "<tr class='table_row_0'><td>Last Activity: </td><td>" . $pilot->pe_dataplayers_updated . "</td></tr>";
					
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_airframe . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_pilotid . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_DataMissionHashes_hash . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_mission . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_campaign . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_missionhash_id . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_mission_short . "</h2>";	


				//echo "</tr>";
			
			//echo "</table>";







					//TABLE STARTS BELOW
					//echo "<br><input type='text' id='myInput3' onkeyup='myFunction3()' placeholder='Filter by pilot names ...' title='Type in a name'>";	// searchable entry
					echo "<br><br><table class='table_stats' id='myTable3'>";
					echo "<tr class='table_header'><th style='text-align: center' colspan='1' >Kill Details</th><th style='text-align: center' colspan='2' >Victory Marks</th><th style='text-align: center' colspan='2'>A2A Kills (+4)</th><th style='text-align: center' colspan='10'>A2G Kills (Pts Below) <button onclick='history.go(-1);' style='float:right'>Back </button></th></tr>"; // First Code	
					echo "<tr class='table_header'><th>Pilot</th><th>A2A Kills</th><th>A2G Kills</th><th>Planes</th><th>Helos</th><th>Tanks|APCs|LUVs (+3)</th><th>UnArmored (+1)</th><th>Air Defense (+4)</th><th>Artillery (+2)</th><th>TEL Missile (+3)</th><th>Infantry (+2)</th><th>Ships (+3)</th><th>Warehouses (+3)</th><th>Structures (+3)</th><th>Hits|Statics (+0)</th></tr>"; // First Code							
					//while($row = mysqli_fetch_array($result))
					//{
						echo "<tr class='header'>";
							//echo "<td style='text-align: center'>" . $row['pe_LogEvent_pilotname'] . "</td>";
							//echo "<tr onclick=\"window.document.location='?pid=" . $row['pe_LogEvent_pilotid'] . "'\" class='table_row_" . $row['pe_LogEvent_pilotid']%2 . "'>";		
							//echo "<tr onclick=\"window.document.location='?pid=" . $row['value_campaign'] . "'\" class='table_row_" . $row['value_campaign'] . "'>";			
							//echo "<td style='text-align: center'>" . $row['value_campaign'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_mission_short'] . "</td>";						
							//echo "<td style='text-align: center'>" . $row['pe_LogEvent_airframe'] . "</td>";			
							//echo "<td style='text-align: center'>" . $row['pe_LogEvent_militarybranch'] . "</td>";
							//echo "<tr onclick=\"window.document.location='?pis=" . $pilot->pe_LogEvent_pilotid . "'\" class='table_row_" . $pilot->pe_LogEvent_pilotid %2 . "'>";
							echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_pilotname. "</td>";							
							//echo "<td style='text-align: center'>" . $pilot->lastname . "</td>";
							//echo "<td style='text-align: center'>" . $pilot->pe_DataPlayers_lastname . "</td>";		
							//echo "<td style='text-align: center'>" . number_format($row['flightduration'],1) . " hours</td>";					
							//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
							//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
							echo "<td style='text-align: center'>" . $pilot->total_a2akills . "</td>";
							echo "<td style='text-align: center'>" . $pilot->total_a2gkills . "</td>";			
							//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
							//echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
							//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";
							//echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";			
							//echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
							//echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_count_selfkills'] . "</td>";			
							//echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";							
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_planes . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_helicopters . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_armor . "</td>";		
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_unarmed . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_airdefense . "</td>";			
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_artillery . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_missiles . "</td>";			
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_infantry . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_ships . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_fortifications . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_warehouses . "</td>";
							echo "<td style='text-align: center'>" . $pilot->value_count_kills_other . "</td>";				
							//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
							//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";			

							//$airframes[] = $row['pe_LogEvent_airframe'];
							//$totala2g[] = $row['total_a2gkills'];
							//$totala2a[] = $row['total_a2akills'];
							//$totalkills[] = $row['total_kills'];			
							//$sorties[] = $row['value_count_takeoffs'];









						echo "</tr>";
					//}
					echo "</table>";
					


/* 				echo "<script>
				function myFunction3() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById('myInput3');
				  filter = input.value.toUpperCase();
				  table = document.getElementById('myTable3');
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
				</script>"; */
					
					//$result->close();







			//echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
			//echo "<table class='table_stats' id='myTable' >";
			//echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Aviator Record Summary</th><th style='text-align: center' colspan='6'>Life Events</th></tr>"; // First Code	
			//echo "<tr class='table_header'><th>Pilot</th><th>Last Flight</th><th>Total Flight Hours</th><th>Sorties</th><th>A2A Kills</th><th>A2G Kills</th></tr>"; // First Code

			//while($pilot->mysqli_fetch_array($result))
			
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_pilotid . "</td>";	
					//echo "<tr onclick=\"window.document.location='?pis=" . $pilot->pe_LogEvent_pilotid . "'\" class='table_row_" . $pilot->pe_LogEvent_pilotid %2 . "'>";
					//echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_lastname . "</td>";		
					//echo "<td style='text-align: center'>" . $pilot->value_count_kills_armor . "</td>";
						//echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_updated . "</td>";
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_airframe . "</td>";			
					//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
					//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
					//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
						//echo "<td style='text-align: center'>" . $pilot->pe_DataMissionHashes_hash . "</td>";
						//echo "<td style='text-align: center'>" . $pilot->value_mission_short . "</td>";			


					//echo "<h2>Pilot " . $pilot->pe_dataplayers_lastname . "</h2>";
					//echo "<h3>Kills: Armor " . $pilot->value_count_kills_armor . "</h3><br><br>";
					//echo "<tr class='table_row_0'><td>Last Activity: </td><td>" . $pilot->pe_dataplayers_updated . "</td></tr>";
					
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_airframe . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_pilotid . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_DataMissionHashes_hash . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_mission . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_campaign . "</h2>";
					//echo "<h2>Pilot " . $pilot->pe_LogEvent_missionhash_id . "</h2>";
					//echo "<h2>Pilot " . $pilot->value_mission_short . "</h2>";	


				//echo "</tr>";
			
			//echo "</table>";


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

/* 	echo "<script>
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
	</script>";	 */
	
	//$result->close();
						
			
//			echo "<tr class='table_row_1'><td>Status: </td><td>" . $onlinestatus . "</td></tr></table>";
			//echo "<br><br>";
			
			
			
			
			//try to print active flight
//			if ($online == 1) {
//				$this->echoActiveFlight($pilotid);
//			}
			
//			echo "<b>Last Flights:</b>";
//			$this->echoPilotsFlightsTable($pilotid);
			
//			echo "<b>Flown Airplanes</b>";
//			$this->echoPilotsAircraftsTable($pilotid);
					
		} else {
			echo "Pilot not found!";
		}
	}

	public function getPilotsStat2($pilotid) {
		//get pilot information
		//$prep = $this->mysqli->prepare("SELECT id, name, disp_name, flighttime, flights, lastactive, online FROM pilots WHERE id=?");
/* 		$prep = $this->mysqli->prepare("
		
		SELECT 
		a.pe_dataplayers_id,
		b.`pe_LogEvent_missionhash_id`,		
		a.pe_dataplayers_lastname,
		a.pe_dataplayers_updated, 
		COUNT(b.`pe_LogEvent_kills_armor`) AS value_count_kills_armor,  
		b.pe_LogEvent_pilotid, 
		f.`pe_DataMissionHashes_hash`,
		SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) AS value_mission,
		SUBSTRING(f.`pe_DataMissionHashes_hash`, POSITION('_0' IN f.`pe_DataMissionHashes_hash`) + 1, 3) AS value_mission_short,  
		SUBSTRING(f.`pe_DataMissionHashes_hash`, 6, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 35) AS value_campaign

		FROM pe_dataplayers AS a
		INNER JOIN pe_LogEvent AS b
		ON a.pe_DataPlayers_id = b.pe_LogEvent_pilotid 	
		INNER JOIN `pe_DataMissionHashes` AS f 
		ON b.`pe_LogEvent_missionhash_id` = f.`pe_DataMissionHashes_id` 


		
		WHERE a.pe_dataplayers_id=?		
		
		"); */






//Kill Stats Query (button is in 2nd query below)
				$prep = $this->mysqli->prepare("
				
				SELECT DISTINCT
				a.`pe_LogEvent_missionhash_id`,				
				a.`pe_LogEvent_pilotid`,
				a.`pe_LogEvent_pilotname`, 
				a.`pe_LogEvent_friendly_fire_killer`, 
				a.`pe_LogEvent_friendly_fire_selfbomb`,

				COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
				COUNT(a.`pe_LogEvent_crashes`)*(-1) AS value_count_crashesneg,

				COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,
				COUNT(a.`pe_LogEvent_ejections`)*(-1) AS value_count_ejectneg,

				COUNT(a.`pe_LogEvent_deaths`) AS value_count_deaths,
				COUNT(a.`pe_LogEvent_deaths`)*(-1) AS value_count_deathsneg,

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

				(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) AS total_a2gkills,

				(COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

				(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,

				DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,



				a.`pe_LogEvent_militarybranch`,
				a.`pe_LogEvent_airframe`,
				a.`pe_LogEvent_type`,
				b.`pe_DataPlayers_lastname` AS lastname,
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
				k.pe_campaigndetails_mission_name,



				 f.`pe_DataMissionHashes_id`, 
				 f.`pe_DataMissionHashes_hash`,
				 f.`pe_DataMissionHashes_datetime`,  
				 SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) AS value_mission,
				SUBSTRING(f.`pe_DataMissionHashes_hash`, POSITION('_0' IN f.`pe_DataMissionHashes_hash`) + 1, 3) AS value_mission_short,  
				SUBSTRING(f.`pe_DataMissionHashes_hash`, 6, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 35) AS value_campaign 


				FROM `pe_LogEvent` AS a 
				INNER JOIN `pe_DataPlayers` AS b 
				ON a.pe_LogEvent_pilotid = b.pe_DataPlayers_id 
				LEFT JOIN `pe_LastPilotDeath` AS c 
				ON a.pe_LogEvent_pilotname=c.pe_LastPilotDeath_pilotname
				LEFT JOIN `pe_DeathAncestoryFinal` AS d 
				ON a.pe_LogEvent_pilotname=d.pe_DeathAncestoryFinal_pilotname
				LEFT JOIN `pe_finalflightduration` AS g
				ON a.pe_LogEvent_datetime = g.pe_finalflightduration_takeoffdatetime
				INNER JOIN `pe_DataMissionHashes` AS f 
				ON a.`pe_LogEvent_missionhash_id` = f.`pe_DataMissionHashes_id` 
				INNER JOIN `pe_CampaignDetails` AS k
				ON a.`pe_LogEvent_missionhash_id` = k.`pe_CampaignDetails_missionhash_id`  


				WHERE b.pe_dataplayers_id=?	

				GROUP BY a.pe_LogEvent_pilotid
				ORDER BY 
				COUNT(a.`pe_LogEvent_kills_unarmed`)+
				((COUNT(a.`pe_LogEvent_kills_infantry`)+COUNT(a.`pe_LogEvent_kills_artillery`))*2)+
				((COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`))*3) +
				(COUNT(a.`pe_LogEvent_kills_air_defense`)*4)+
				((COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`))*4) +
				(COUNT(a.`pe_LogEvent_pvp_killer`)*5) -
				COUNT(a.`pe_LogEvent_crashes`) +
				COUNT(a.`pe_LogEvent_ejections`) -
				(CASE WHEN(COUNT(a.`pe_LogEvent_deaths`) = '0') THEN '0' ELSE ((COUNT(a.`pe_LogEvent_deaths`))*3) END) -
				COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) -
				((COUNT(a.`pe_LogEvent_friendly_fire_killer`) - COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`))*10) +
				(FLOOR((SUM(g.`pe_finalflightduration_duration`)/10)*(COUNT(g.`pe_finalflightduration_nolanding`)/(COUNT(g.`pe_finalflightduration_id`))))) DESC						

				");






		$prep->bind_param('i', $pilotid);
		$prep->execute();
		
		$row = new stdClass();
		//$prep->bind_result($row->id, $row->name, $row->disp_name, $row->flighttime, $row->flights, $row->lastactive, $row->online);
		$prep->bind_result(
		$row->pe_LogEvent_missionhash_id,

		$row->pe_LogEvent_pilotid,


				$row->pe_LogEvent_pilotname, 
				$row->pe_LogEvent_friendly_fire_killer, 
				$row->pe_LogEvent_friendly_fire_selfbomb,

				$row->value_count_crashes,
				$row->value_count_crashesneg,

				$row->value_count_ejections,
				$row->value_count_ejectneg,

				$row->value_count_deaths,
				$row->value_count_deathsneg,

				$row->pe_DeathAncestoryFinal_pilotdeathcount,
				$row->DeathAncestory,

				$row->value_count_pvp,

				$row->value_count_teamkills,
				$row->value_count_selfkills,

				$row->value_count_kills_planes,

				$row->value_count_kills_helicopters,
				$row->value_count_kills_armor,
				$row->value_count_kills_airdefense,
				$row->value_count_kills_unarmed,
				$row->value_count_kills_infantry,
				$row->value_count_kills_ships,
				$row->value_count_kills_fortifications,
				$row->value_count_kills_warehouses,
				$row->value_count_kills_artillery,
				$row->value_count_kills_missiles,
				$row->value_count_kills_other,
				$row->value_count_takeoffs,
				$row->value_count_landings,

				$row->total_takeoff_landing_percentage, 
				$row->test1,

				$row->flightduration,

				$row->total_a2gkills,

				$row->total_a2akills,

				$row->total_kills,

				$row->minus45seconds,


				$row->pe_LogEvent_militarybranch,
				$row->pe_LogEvent_airframe,
				$row->pe_LogEvent_type,

				$row->pe_dataplayers_id, 
				$row->lastname, 
				$row->pe_dataplayers_updated, 
	

				$row->pe_LastPilotDeath_pilotname,
				$row->pe_LastPilotDeath_datetime,
				$row->pe_DeathAncestoryFinal_pilotname,
				$row->pe_finalflightduration_duration,
				$row->pe_finalflightduration_pilotid,
				$row->pe_finalflightduration_takeofflandingnum,
				$row->pe_finalflightduration_nolanding,
				$row->pe_finalflightduration_id,
				$row->pe_campaigndetails_mission_name,


		$row->pe_DataMissionHashes_id,
		$row->pe_DataMissionHashes_hash,
		$row->pe_DataMissionHashes_datetime,
		
		$row->value_mission,
		$row->value_campaign,
		$row->value_mission_short
		
		);

		if ($prep->fetch()) { 
			return $row;
		}
		$prep->close();
		return false;
	}	
	
}

$Stats->echoClickStats();

//////////////end test


?>






<h4>	 


  <li><a href="standings.php"><b>Overall</b></a></li>
  <li class ="dropdown"><a class="dropbtn"><b>By Coalition</b><img src="equal.png" alt="Paris" width="20" height="14"></a>
		<div class="dropdown-content">
		  <a href="standings_coalition_bluefor.php"><b>BLUEFOR</b></a>			
		  <a href="standings_coalition_redfor.php"><b>REDFOR</b></a>
		  
		</div>	   
  </li>  
  <li class ="dropdown"><a class="dropbtn"><b>By Military Branch</b><img src="equal.png" alt="Paris" width="20" height="14"></a>
		<div class="dropdown-content">
		  <a href="standings_branch_airforce.php"><b>Air Force</b></a>			
		  <a href="standings_branch_army.php"><b>Army</b></a>
		  <a href="standings_branch_navy.php"><b>Navy</b></a>
		  <a href="standings_branch_marines.php"><b>Marines</b></a>			  
		</div>	   
  </li>
  <li class ="dropdown"><a href="standings_campaign.php" class="dropbtn"><b>By Campaign</b><img src="equal.png" alt="Paris" width="20" height="14"></a>
		<div class="dropdown-content">		
		  <a href="standings_campaignbymission.php"><b>By Mission</b></a>
		  
		</div>	   
  </li>



</h4>


<?php




/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo '<h3 style="margin:5px"><br><br><br>Standings Overall (<i>based upon your Total Stats</i>)</h3>';

if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_selfbomb`, a.`pe_LogEvent_deaths`,


COUNT(a.`pe_LogEvent_crashes`) AS value_count_crashes,
COUNT(a.`pe_LogEvent_ejections`) AS value_count_ejections,

COUNT(a.`pe_LogEvent_deaths`)  AS value_count_deaths,


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

(COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,


DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,

COUNT(a.`pe_LogEvent_kills_unarmed`)+
((COUNT(a.`pe_LogEvent_kills_infantry`)+COUNT(a.`pe_LogEvent_kills_artillery`))*2)+
((COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`))*3) +
(COUNT(a.`pe_LogEvent_kills_air_defense`)*4)+
((COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`))*4) +
(COUNT(a.`pe_LogEvent_pvp_killer`)*5) -
COUNT(a.`pe_LogEvent_crashes`) +
COUNT(a.`pe_LogEvent_ejections`) -
(CASE WHEN(COUNT(a.`pe_LogEvent_deaths`) = '0') THEN '0' ELSE ((COUNT(a.`pe_LogEvent_deaths`))*3) END) -
COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) -
((COUNT(a.`pe_LogEvent_friendly_fire_killer`) - COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`))*10) +
(FLOOR((SUM(g.`pe_finalflightduration_duration`)/10)*(COUNT(g.`pe_finalflightduration_nolanding`)/(COUNT(g.`pe_finalflightduration_id`)))))
AS score,


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



FLOOR(COUNT(`pe_LogEvent_ejections`)/4) AS medals_usa_ph,


FLOOR((COUNT(a.`pe_LogEvent_AF_kills_planes`)-COUNT(a.`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_AF_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_AF_kills_ships`) + FLOOR(COUNT(g.`pe_finalflightduration_duration_af`)/25) AS medals_usa_am_af,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'BLUE') 
THEN FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_AF_kills_ships`) + FLOOR((COUNT(g.`pe_finalflightduration_duration_af`))/25) 
END AS medals_usa_am_af_blue, 

CASE
WHEN(a.`pe_LogEvent_coalition` = 'RED') 
THEN FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_AF_kills_ships`) + FLOOR((COUNT(g.`pe_finalflightduration_duration_af`))/25) 
END AS medals_rus_am_af_red,


FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/3)+
FLOOR((COUNT(a.`pe_LogEvent_AR_kills_armor`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_air_defense`))/3) + COUNT(a.`pe_LogEvent_AR_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_infantry`))/20) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_artillery`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_unarmed`))/20) AS medals_usa_am_ar,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'BLUE') 
THEN FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/3)+
FLOOR((COUNT(a.`pe_LogEvent_AR_kills_armor`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_air_defense`))/3) + COUNT(a.`pe_LogEvent_AR_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_infantry`))/20) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_artillery`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_unarmed`))/20) END AS medals_usa_am_ar_blue,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'RED') 
THEN FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/3)+
FLOOR((COUNT(a.`pe_LogEvent_AR_kills_armor`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_air_defense`))/3) + COUNT(a.`pe_LogEvent_AR_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_infantry`))/20) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_artillery`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_unarmed`))/20) END AS medals_rus_am_ar_red,

FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_NV_kills_ships`) + FLOOR(COUNT(g.`pe_finalflightduration_duration_nv`)/25) AS medals_usa_am_nv,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'BLUE') 
THEN FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_NV_kills_ships`) + FLOOR((COUNT(g.`pe_finalflightduration_duration_nv`))/25) END AS medals_usa_am_nv_blue,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'RED') 
THEN FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_NV_kills_ships`) + FLOOR((COUNT(g.`pe_finalflightduration_duration_nv`))/25) END AS medals_rus_am_nv_red,

FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+(COUNT(a.`pe_LogEvent_kills_infantry`)/2))/10) AS medals_usa_bs,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'BLUE') 
THEN FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+(COUNT(a.`pe_LogEvent_kills_infantry`)/2))/10) END AS medals_usa_bs_blue,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'RED') 
THEN FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+(COUNT(a.`pe_LogEvent_kills_infantry`)/2))/10) END AS medals_rus_bs_red,





FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/5) AS medals_usa_ss,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'BLUE') 
THEN FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/5) END AS medals_usa_ss_blue,

CASE
WHEN(a.`pe_LogEvent_coalition` = 'RED') 
THEN FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/5) END AS medals_rus_ss_red,







FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/10) + FLOOR((COUNT(`pe_LogEvent_AF_kills_armor`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)+COUNT(a.`pe_LogEvent_AF_kills_ships`)+(COUNT(a.`pe_LogEvent_AF_kills_infantry`)/2))/30) AS medals_usa_afc_af,

FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/10) + FLOOR((COUNT(`pe_LogEvent_AR_kills_artillery`)+COUNT(`pe_LogEvent_AR_kills_armor`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)+COUNT(a.`pe_LogEvent_AR_kills_ships`)+(COUNT(a.`pe_LogEvent_AR_kills_infantry`)/2))/30) AS medals_usa_dsc_ar,

FLOOR((COUNT(`pe_LogEvent_NV_kills_planes`)-COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_NV_kills_helicopters`))/10) + 
FLOOR((COUNT(`pe_LogEvent_MA_kills_planes`)-COUNT(`pe_LogEvent_MA_friendly_fire_killer`)+COUNT(`pe_LogEvent_MA_kills_helicopters`))/10) +
FLOOR((COUNT(`pe_LogEvent_NV_kills_armor`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)+COUNT(a.`pe_LogEvent_NV_kills_ships`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`))/30) +
FLOOR((COUNT(`pe_LogEvent_MA_kills_armor`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`)+COUNT(a.`pe_LogEvent_MA_kills_ships`)+COUNT(a.`pe_LogEvent_MA_kills_infantry`))/30) AS medals_usa_nmc_nv,

FLOOR((COUNT(`pe_LogEvent_kills_planes`)-COUNT(`pe_LogEvent_friendly_fire_killer`)+COUNT(`pe_LogEvent_kills_helicopters`))/15) + FLOOR((COUNT(`pe_LogEvent_kills_artillery`)+COUNT(`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+(COUNT(a.`pe_LogEvent_kills_infantry`)/2))/45) AS medals_usa_dfc,



CASE WHEN((FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/20) >= 1) AND (FLOOR((COUNT(`pe_LogEvent_AF_kills_armor`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)+COUNT(a.`pe_LogEvent_AF_kills_ships`)+FLOOR(COUNT(a.`pe_LogEvent_AF_kills_infantry`)/2))/40) >= '1' )) THEN '1'   
ELSE '0' END AS medals_usa_mh_af,

CASE WHEN((FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/20) >= 1) AND (FLOOR((COUNT(`pe_LogEvent_AR_kills_artillery`)+COUNT(`pe_LogEvent_AR_kills_armor`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)+COUNT(a.`pe_LogEvent_AR_kills_ships`)+FLOOR(COUNT(a.`pe_LogEvent_AR_kills_infantry`)/2))/40) >= '1' )) THEN '1'   
ELSE '0' END AS medals_usa_mh_ar,

CASE WHEN((FLOOR(((COUNT(`pe_LogEvent_NV_kills_planes`)+COUNT(`pe_LogEvent_MA_kills_planes`))-(COUNT(`pe_LogEvent_NV_friendly_fire_killer`)+COUNT(`pe_LogEvent_MA_friendly_fire_killer`))+(COUNT(`pe_LogEvent_NV_kills_helicopters`)+COUNT(`pe_LogEvent_MA_kills_helicopters`)))/20) >= 1) AND (FLOOR(((COUNT(`pe_LogEvent_NV_kills_armor`)+COUNT(`pe_LogEvent_MA_kills_armor`))+(COUNT(a.`pe_LogEvent_NV_kills_air_defense`)+COUNT(a.`pe_LogEvent_MA_kills_air_defense`))+(COUNT(a.`pe_LogEvent_NV_kills_ships`)+COUNT(a.`pe_LogEvent_MA_kills_ships`))+(COUNT(a.`pe_LogEvent_NV_kills_infantry`)+FLOOR(COUNT(a.`pe_LogEvent_MA_kills_infantry`)/2)))/40) >= '1' )) THEN '1'   
ELSE '0' END AS medals_usa_mh_nv,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_AF_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_af,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_AR_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_ar,

CASE WHEN(FLOOR((COUNT(`pe_LogEvent_NV_kills_missiles`)) >= 1) OR FLOOR((COUNT(`pe_LogEvent_MA_kills_missiles`)) >= 1)) THEN '1'   
ELSE '0' END AS medals_usa_puc_nvma,




FLOOR((COUNT(`pe_LogEvent_AF_kills_planes`)-COUNT(`pe_LogEvent_AF_friendly_fire_killer`)+COUNT(`pe_LogEvent_AF_kills_helicopters`))/3) + COUNT(a.`pe_LogEvent_AF_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AF_takeoffs`))/25) +

FLOOR((COUNT(`pe_LogEvent_AR_kills_planes`)-COUNT(`pe_LogEvent_AR_friendly_fire_killer`)+COUNT(`pe_LogEvent_AR_kills_helicopters`))/3)+
FLOOR((COUNT(a.`pe_LogEvent_AR_kills_armor`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_air_defense`))/3) + COUNT(a.`pe_LogEvent_AR_kills_ships`) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_infantry`))/10) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_artillery`))/4) + FLOOR((COUNT(a.`pe_LogEvent_AR_kills_unarmed`))/20) +

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

		h.`pe_DataMissionHashes_id`,
		h.`pe_DataMissionHashes_hash`,
		SUBSTRING(h.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(h.`pe_DataMissionHashes_hash`) - 26) AS value_mission,
		SUBSTRING(h.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(h.`pe_DataMissionHashes_hash`) - 30) AS value_campaign,

a.`pe_LogEvent_coalition`,
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
g.`pe_finalflightduration_id`,
k.`pe_CampaignDetails_missionhash_id`,
k.`pe_campaigndetails_name` 


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
INNER JOIN `pe_DataMissionHashes` AS h
ON a.`pe_LogEvent_missionhash_id` = h.`pe_DataMissionHashes_id` 	
INNER JOIN `pe_CampaignDetails` AS k
ON a.`pe_LogEvent_missionhash_id` = k.`pe_CampaignDetails_missionhash_id`  	


GROUP BY a.pe_LogEvent_pilotid
ORDER BY 
COUNT(a.`pe_LogEvent_kills_unarmed`)+
((COUNT(a.`pe_LogEvent_kills_infantry`)+COUNT(a.`pe_LogEvent_kills_artillery`))*2)+
((COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`))*3) +
(COUNT(a.`pe_LogEvent_kills_air_defense`)*4)+
((COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`))*4) +
(COUNT(a.`pe_LogEvent_pvp_killer`)*5) -
COUNT(a.`pe_LogEvent_crashes`) +
COUNT(a.`pe_LogEvent_ejections`) -
(CASE WHEN(COUNT(a.`pe_LogEvent_deaths`) = '0') THEN '0' ELSE ((COUNT(a.`pe_LogEvent_deaths`))*3) END) -
COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`) -
((COUNT(a.`pe_LogEvent_friendly_fire_killer`) - COUNT(a.`pe_LogEvent_friendly_fire_selfbomb`))*10) +
(FLOOR((SUM(g.`pe_finalflightduration_duration`)/10)*(COUNT(g.`pe_finalflightduration_nolanding`)/(COUNT(g.`pe_finalflightduration_id`))))) DESC




")) {


/* 
WHERE CASE 
WHEN ((a.`pe_LogEvent_datetime` = d.`pe_DeathAncestoryFinal_lastpilotdeathtime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
ELSE (a.`pe_LogEvent_datetime` > (DATE_ADD(d.`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END

GROUP BY a.pe_LogEvent_pilotid
ORDER BY b.`pe_DataPlayers_updated` DESC
 */
 
 
//echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";

$rankshort = '';
// more medals to add --> Airman's Medal, Soldier's Medal, Navy and Marines Medal, Distinguished Service Medal AF, AR, NVMA
/* <th><a href='https://en.wikipedia.org/wiki/Airman%27s_Medal' target='_blank' rel='noopener noreferrer'>Airman's Medal</th><th><a href='https://en.wikipedia.org/wiki/Soldier%27s_Medal' target='_blank' rel='noopener noreferrer'>Soldier's Medal</th><th><a href='https://en.wikipedia.org/wiki/Navy_and_Marine_Corps_Medal' target='_blank' rel='noopener noreferrer'>Navy and Marine Corps Medal</th><th><a href='https://en.wikipedia.org/wiki/Air_Force_Distinguished_Service_Medal' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|AF</th><th><a href='https://en.wikipedia.org/wiki/Distinguished_Service_Medal_(U.S._Army)' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|AR</th><th><a href='https://en.wikipedia.org/wiki/Navy_Distinguished_Service_Medal' target='_blank' rel='noopener noreferrer'>Distinguished Service Medal|NV(MA)</th> */

$TWOLT = '[2LT]';
$ONELT = '[1LT]';
$CAPT = '[Capt]';
$MAJ = '[Maj]';
$LTCOL = '[LtCol]';
$COL = '[Col]';
$BRIGGEN = '[BrigGen]';
$MAJGEN = '[MajGen]';
$LTGEN = '[LtGen]';
$GEN = '[Gen]';
$GAF = '[GAF]';
$NA = '';

//TABLE STARTS BELOW
	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Aviator Record Summary (A2G Kills: +4 Anti-Air, +3 Armored/Missiles/Ships/Statics, +2 Infantry/Artillery, +1 Unarmed)</th><th style='text-align: center' colspan='6'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='1'>Score</th><th style='text-align: center;  ' colspan='1'><a href='https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjmiIm5yYLxAhVyHjQIHRezBuoQFjANegQIBBAF&url=https%3A%2F%2Fwww.studyguides.af.mil%2FPortals%2F15%2Fdocuments%2Frank_ribbons%2FOfficer%2520Rank%2520Insignia%2520of%2520the%2520United%2520States%2520Armed%2520Forces.pdf&usg=AOvVaw386NawbQlTTpvjkge-R6vW' target='_blank' rel='noopener noreferrer'>Officer Rank</a></th><th style='text-align: center;  ' colspan='1'>Medals Awarded</th></tr>"; // First Code			
	echo "<tr class='table_header'><th>Place</th><th>Pilot</th><th>Flight Hours [(+1/10min)*%]</th><th>A2A Kills (+4)</th><th>A2G Kills (Up)</th><th>Sorties</th><th>Landing%</th><th>Ejections (+1)</th><th>Crashes (-1)</th><th>Deaths (-3)</th><th>Bomb Self (-1)</th><th>PVP Kills (+5)</th><th>Team Kills (-10)</th><th>Total</th><th><a href='hardcorestats_rankreq_usa.php'>Rank [NATO]</a></th><th><a href='hardcorestats_medalsreq_usa.php'>Medal Requirements</a></th></tr>"; // First Code							
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";

			echo "<tr onclick=\"window.document.location='?pis=" . $row['pe_DataPlayers_id'] . "'\" class='table_row_" . $row['pe_DataPlayers_id'] . "'>";	
	        echo "<td style='text-align: center' class='counterCell'>" . "</td>";			


			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nato'] . "</td>";
			if($row['rank_officer_usa_nato']=="[2ndLt] Second Lieutenant (O-1)")
			{
			//echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='60px' width='31px'/>" . "<br>[2ndLt] Second Lieutenant (O-1)" . "</td>";
			$rankshort = $TWOLT;			
			}
			elseif($row['rank_officer_usa_nato']=="[1stLt] First Lieutenant (O-2)")
			{
			//echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='60px' width='31px'/>" . "<br>[1stLt] First Lieutenant (O-2)" . "</td>";
			$rankshort = $ONELT;
			}
			elseif($row['rank_officer_usa_nato']=="[Capt] Captain (O-3)")
			{
			//echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='60px' width='60px'/>" . "<br>[Capt] Captain (O-3)" . "</td>";	
			$rankshort = $CAPT;
			}
			elseif($row['rank_officer_usa_nato']=="[Maj] Major (O-4)")
			{
			//echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='60px' width='60px'/>" . "<br>[Maj] Major (O-4)" . "</td>";	
			$rankshort = $MAJ;
			}
			elseif($row['rank_officer_usa_nato']=="[LtCol] Lieutenant Colonel (O-5)")
			{
			$rankshort = $LTCOL;
			//echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='60px' width='60px'/>" . "<br>[LtCol] Lieutenant Colonel (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Col] Colonel (O-6)")
			{
			$rankshort = $COL;
			//echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='600px' width='90px'/>" . "<br>[Col] Colonel (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[BrigGen] Brigadier General (O-7)")
			{
			$rankshort = $BRIGGEN;
			//echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='60px' width='60px'/>" . "<br>[BrigGen] Brigadier General (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[MajGen] Major General (O-8)")
			{
			$rankshort = $MAJGEN;				
			//echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='60px' width='90px'/>" . "<br>[MajGen] Major General (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[LtGen] Lieutenant General (O-9)")
			{
			$rankshort = $LTGEN;
			//echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='60px' width='105px'/>" . "<br>[LtGen] Lieutenant General (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Gen] General (O-10)")
			{
			$rankshort = $GEN;
			//echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='60px' width='120px'/>" . "<br>[Gen] General (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[GAF] General of the Air Force (O-11)")
			{
			$rankshort = $GAF;
			//echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='60px' width='60px'/>" . "<br>[GAF] General of the Air Force (O-11)" . "</td>";	
			}			
			else
			{
			//echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			$rankshort = $NA;
			}



			//echo "<td style='text-align: center'>" . $row[''] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $rankshort['rank_officer_usa_nato'] . "</td>";		
			//echo "<td style='text-align: center'>" . $rankshort . " " . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";
			echo "<td style='text-align: center'>" . $rankshort . " " . $row['pe_DataPlayers_lastname'] . "</td>";			
			echo "<td style='text-align: center'>" . number_format($row['flightduration'],1) . " hours</td>";
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";				
			echo "<td style='text-align: center' >" . $row['value_count_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landing'] . "</td>";				
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
			echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";					
			echo "<td style='text-align: center'>" . $row['value_count_selfkills'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
			echo "<td style='text-align: center'>" . $row['value_count_teamkills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['score'] . "</td>";				
			
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

/* 			switch($row['rank_officer_usa_nato'])
			{
			case("[2ndLt] Second Lieutenant (O-1)"):
			{
			echo "<td style='text-align: center'>" . "<img src='./herogoldstar.png' class='thumbnail' height='40px' width='21px'/>" . "</td>";	
			}
			case("[1stLt] First Lieutenant (O-2)");
			{
			echo "<td style='text-align: center'>" . "<img src='./airmedal.png' class='thumbnail' height='40px' width='21px'/>" . "</td>";	
			}
			} */
			
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nato'] . "</td>";
			if($row['rank_officer_usa_nato']=="[2ndLt] Second Lieutenant (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='60px' width='31px'/>" . "<br>Second<br>Lieutenant<br>(O-1)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[1stLt] First Lieutenant (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='60px' width='31px'/>" . "<br>First<br>Lieutenant<br>(O-2)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Capt] Captain (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='60px' width='60px'/>" . "<br>Captain<br>(O-3)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Maj] Major (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='60px' width='60px'/>" . "<br>Major<br>(O-4)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[LtCol] Lieutenant Colonel (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='60px' width='60px'/>" . "<br>Lieutenant<br>Colonel<br>(O-5)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Col] Colonel (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='60px' width='90px'/>" . "<br>Colonel<br>(O-6)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[BrigGen] Brigadier General (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='60px' width='60px'/>" . "<br>Brigadier<br>General<br>(O-7)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[MajGen] Major General (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='60px' width='120px'/>" . "<br>Major General<br>(O-8)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[LtGen] Lieutenant General (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='60px' width='180px'/>" . "<br>Lieutenant<br>General<br>(O-9)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Gen] General (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='60px' width='240px'/>" . "<br>General<br>(O-10)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[GAF] General of the Air Force (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='60px' width='60px'/>" . "<br>General of the<br>Air Force<br>(O-11)" . "<br><br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Purple_Heart' target='_blank' rel='noopener noreferrer'><img src='./purpleheart.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ph'])) . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			}

			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_af'] . "</td>";			
/* 			if($row['rank_officer_usa_af']=="[2ndLt] Second Lieutenant (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [2ndLt] Second Lieutenant (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[1stLt] First Lieutenant (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [1stLt] First Lieutenant (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Capt] Captain (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [Capt] Captain (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Maj] Major (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [Maj] Major (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[LtCol] Lieutenant Colonel (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [LtCol] Lieutenant Colonel (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Col] Colonel (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [Col] Colonel (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[BrigGen] Brigadier General (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [BrigGen] Brigadier General (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[MajGen] Major General (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='40px' width='60px'/>" . "  [MajGen] Major General (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[LtGen] Lieutenant General (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "  [LtGen] Lieutenant General (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Gen] General (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "  [Gen] General (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[GAF] General of the Air Force (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [GAF] General of the Air Force (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			} */
			
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_ar'] . "</td>";
/* 			if($row['rank_officer_usa_ar']=="[2LT] Second Lieutenant (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [2LT] Second Lieutenant (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[1LT] First Lieutenant (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [1LT] First Lieutenant (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[CPT] Captain (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [CPT] Captain (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[MAJ] Major (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [MAJ] Major (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[LTC] Lieutenant Colonel (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [LTC] Lieutenant Colonel (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[COL] Colonel (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [COL] Colonel (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[BG] Brigadier General (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [BG] Brigadier General (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[MG] Major General (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='40px' width='60px'/>" . "  [MG] Major General (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[LTG] Lieutenant General (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "  [LTG] Lieutenant General (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[GEN] General (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "  [GEN] General (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[GA] General of the Army (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [GA] General of the Army (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			} */

			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nv'] . "</td>";				
/* 			if($row['rank_officer_usa_nv']=="[ENS] Ensign (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./ENS_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [ENS] Ensign (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[LTJG] Lieutenant Junior Grade (O-2))")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTJG_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [LTJG] Lieutenant Junior Grade (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[Lt] Lieutenant (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LT_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [Lt] Lieutenant (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[LCDR] Lieutenant Commander (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LCDR_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [LCDR] Lieutenant Commander (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[CDR] Commander (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CDR_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [CDR] Commander (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[Capt] Captain (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CAPT_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [Capt] Captain (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[RDML] Rear Admiral Lower Half (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./RDML_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [RDML] Rear Admiral Lower Half (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[RADM] Rear Admiral Upper Half (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./RADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./MG_t.png' height='40px' width='80px'/>" . "  [RADM] Rear Admiral Upper Half (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[VADM] Vice Admiral (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./VADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./LTG_t.png' height='40px' width='120px'/>" . "  [VADM] Vice Admiral (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[ADM] Admiral (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./ADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./GEN_t.png' height='40px' width='160px'/>" . "  [ADM] Admiral (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[FADM] Fleet Admiral (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./FADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [FADM] Fleet Admiral (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			} */


			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_ma'] . "</td>";
/* 			if($row['rank_officer_usa_ma']=="[2ndLt] Second Lieutenant (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "[2ndLt] Second Lieutenant (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[1stLt] First Lieutenant (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "[1stLt] First Lieutenant (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[Capt] Captain (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png'  height='40px' width='40px'/>" . "[Capt] Captain (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[Maj] Major (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png'  height='40px' width='40px'/>" . "[Maj] Major (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[LtCol] Lieutenant Colonel (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png'  height='40px' width='40px'/>" . "[LtCol] Lieutenant Colonel (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[Col] Colonel (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png'  height='40px' width='60px'/>" . "[Col] Colonel (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[BGen] Brigadier General (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png'  height='40px' width='40px'/>" . "[BGen] Brigadier General (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[MajGen] Major General (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png'  height='40px' width='60px'/>" . "[MajGen] Major General (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[LtGen] Lieutenant General (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "[LtGen] Lieutenant General (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ma']=="[Gen] General (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "[Gen] General (O-10)" . "</td>";	
			}		
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			} */
		
			//echo "<td style='text-align: center'>" . $row['medals_usa_am_af'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./airmedal.png' height='40px' width='21px' class='thumbnail2' />", floor($row['medals_usa_am_af'])) . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_am_ar'] . "</td>";
			
			
			
			echo "<td style='text-align: center' >" . str_repeat("<a href='https://en.wikipedia.org/wiki/Air_Medal' target='_blank' rel='noopener noreferrer'><img src='./airmedal.png' height='40px' width='21px' class='thumbnail3' /></a>", floor($row['medals_usa_am_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Air_Medal' target='_blank' rel='noopener noreferrer'><img src='./airmedal.png' class='thumbnail3' height='40px' width='21px' /></a>", floor($row['medals_usa_am_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Air_Medal' target='_blank' rel='noopener noreferrer'><img src='./airmedal.png' height='40px' width='21px' class='thumbnail3' /></a>", floor($row['medals_usa_am_nv'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Bronze_Star_Medal' target='_blank' rel='noopener noreferrer'><img src='./bronzestar.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_bs'])) . "<br>" . str_repeat("<a href='https://www.military-ranks.org/decorations/silver-star' target='_blank' rel='noopener noreferrer'><img src='./silverstar2.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ss'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Distinguished_Flying_Cross_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./distinguishedflyingcross.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_dfc'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Air_Force_Cross_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./airforcecross.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_afc_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Distinguished_Service_Cross_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./distinguishedservicecross.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_dsc_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Navy_Cross' target='_blank' rel='noopener noreferrer'><img src='./navycross.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_nmc_nv'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_Honor' target='_blank' rel='noopener noreferrer'><img src='./medalofhonorairforce.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_Honor' target='_blank' rel='noopener noreferrer'><img src='./medalofhonorarmy.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_Honor' target='_blank' rel='noopener noreferrer'><img src='./medalofhonornavy.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_nv'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Presidential_Unit_Citation_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./pucairforce.png' class='thumbnail3' height='20px' width='60px'/></a>", floor($row['medals_usa_puc_af'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Presidential_Unit_Citation_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./pucarmy.png' class='thumbnail3' height='20px' width='60px'/></a>", floor($row['medals_usa_puc_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Presidential_Unit_Citation_(United_States)' target='_blank' rel='noopener noreferrer'><img src='./pucnavy.png' class='thumbnail3' height='20px' width='60px'/></a>", floor($row['medals_usa_puc_nvma'])) . "</td>";



/* 			echo "<td style='text-align: center' >" . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossiv.png' height='24px' width='21px' class='thumbnail3' /></a>", floor($row['medals_usa_am_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossiv.png' class='thumbnail3' height='24px' width='21px' /></a>", floor($row['medals_usa_am_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossiv.png' height='24px' width='21px' class='thumbnail3' /></a>", floor($row['medals_usa_am_nv'])) . "<br>" . str_repeat("<a href='http://acepilots.com/medals/soviet/mil.html' target='_blank' rel='noopener noreferrer'><img src='./orderforservice.png' class='thumbnail3' height='21px' width='21px'/></a>", floor($row['medals_usa_bs'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_%22For_Courage%22_(Russia)' target='_blank' rel='noopener noreferrer'><img src='./medalforcourage.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_ss'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_Nesterov' target='_blank' rel='noopener noreferrer'><img src='./medalofnesterov.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_dfc'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossi.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_afc_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossi.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_dsc_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Cross_of_St._George' target='_blank' rel='noopener noreferrer'><img src='./georgycrossi.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_nmc_nv'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Hero_of_the_Soviet_Union' target='_blank' rel='noopener noreferrer'><img src='./herogoldstar.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_af'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Hero_of_the_Soviet_Union' target='_blank' rel='noopener noreferrer'><img src='./herogoldstar.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Hero_of_the_Soviet_Union' target='_blank' rel='noopener noreferrer'><img src='./herogoldstar.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_mh_nv'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_the_Order_%22For_Merit_to_the_Fatherland%22' target='_blank' rel='noopener noreferrer'><img src='./merittofatherland.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_puc_af'])) . "<br>" . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_the_Order_%22For_Merit_to_the_Fatherland%22' target='_blank' rel='noopener noreferrer'><img src='./pucarmy.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_puc_ar'])) . str_repeat("<a href='https://en.wikipedia.org/wiki/Medal_of_the_Order_%22For_Merit_to_the_Fatherland%22' target='_blank' rel='noopener noreferrer'><img src='./merittofatherland.png' class='thumbnail3' height='40px' width='21px'/></a>", floor($row['medals_usa_puc_nvma'])) . "</td>";		 */	

			//echo "<td style='text-align: center'>" . $row['medals_usa_am_nv'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./airmedal.png' height='40px' width='21px' class='thumbnail2' />", floor($row['medals_usa_am_nv'])) . "</td>";			
			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";
			
			//echo "<td style='text-align: center'>" . $row['medals_usa_bs'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./bronzestar.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_bs'])) . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_ss'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./silverstar2.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_ss'])) . "</td>";				
			//echo "<td style='text-align: center'>" . $row['medals_usa_dfc'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./distinguishedflyingcross.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_dfc'])) . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_afc_af'] . "</td>";			
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./airforcecross.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_afc_af'])) . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsc_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./distinguishedservicecross.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_dsc_ar'])) . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_nmc_nv'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./navycross.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_nmc_nv'])) . "</td>";				
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_af'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./medalofhonorairforce.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_mh_af'])) . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./medalofhonorarmy.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_mh_ar'])) . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_mh_nv'] . "</td>";
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./medalofhonornavy.png' class='thumbnail2' height='40px' width='21px'/>", floor($row['medals_usa_mh_nv'])) . "</td>";		
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_af'] . "</td>";	
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./pucairforce.png' class='thumbnail2' height='20px' width='60px'/>", floor($row['medals_usa_puc_af'])) . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_ar'] . "</td>";	
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./pucarmy.png' class='thumbnail2' height='20px' width='60px'/>", floor($row['medals_usa_puc_ar'])) . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_puc_nvma'] . "</td>";		
			//echo "<td style='text-align: center'>" . str_repeat("<img src='./pucnavy.png' class='thumbnail2' height='20px' width='60px'/>", floor($row['medals_usa_puc_nvma'])) . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_amm_af'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_sm_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_nmm_nvma'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_af'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsm_nvma'] . "</td>";				
			

	

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
    td = tr[i].getElementsByTagName('td')[1];
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




/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
/* echo '<br><h3 style="margin:5px"> Rank (<i>based upon your Hardcore Stats</i>) by Coalition: RED <img src="red.png" alt="Paris" width="40" height="13"></h3>';

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

(COUNT(a.`pe_LogEvent_kills_planes`)-COUNT(a.`pe_LogEvent_friendly_fire_killer`)+COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_a2akills,

(COUNT(a.`pe_LogEvent_kills_armor`)+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)+COUNT(a.`pe_LogEvent_kills_ships`)+COUNT(a.`pe_LogEvent_kills_artillery`)+COUNT(a.`pe_LogEvent_kills_missiles`)+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)) + (COUNT(a.`pe_LogEvent_kills_planes`) - COUNT(a.`pe_LogEvent_friendly_fire_killer`) + COUNT(a.`pe_LogEvent_kills_helicopters`)) AS total_kills,


DATE_ADD(c.`pe_LastPilotDeath_datetime`, INTERVAL 45 SECOND) AS minus45seconds,



CASE
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[JrLt] Mládshiy leytenánt (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[Lt] leytenánt (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[SrLt] Stárshiy leytenánt (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Capt] Kapitán (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[Maj] Mayór (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[LtCol] Podpolkóvnik (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[Col] Polkóvnik (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MajGen] Generál-mayór (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LtGen] Generál-leytenánt (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[ColGen] Generál-polkóvnik (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration`)+ ((COUNT(a.`pe_LogEvent_kills_armor`)*5+COUNT(a.`pe_LogEvent_kills_unarmed`)+COUNT(a.`pe_LogEvent_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_kills_ships`)*5+COUNT(a.`pe_LogEvent_kills_artillery`)*2+COUNT(a.`pe_LogEvent_kills_missiles`)*5+COUNT(a.`pe_LogEvent_kills_fortifications`)+COUNT(a.`pe_LogEvent_kills_warehouses`)+COUNT(a.`pe_LogEvent_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_kills_helicopters`*5)) ) > 1500) THEN '[GAF] Generál ármii (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_nato,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[JrLt] Mládshiy leytenánt (O-1)' 

WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[Lt] Leytenánt (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[SrLt] Stárshiy leytenánt (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Capt] Kapitán (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[Maj] Mayór (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[LtCol] Podpolkóvnik (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[Col] Polkóvnik (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[MajGen] Generál-mayór (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[LtGen] Generál-leytenánt (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[ColGen] Generál-polkóvnik (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_af`)+ ((COUNT(a.`pe_LogEvent_AF_kills_armor`)*5+COUNT(a.`pe_LogEvent_AF_kills_unarmed`)+COUNT(a.`pe_LogEvent_AF_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AF_kills_ships`)*5+COUNT(a.`pe_LogEvent_AF_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AF_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AF_kills_fortifications`)+COUNT(a.`pe_LogEvent_AF_kills_warehouses`)+COUNT(a.`pe_LogEvent_AF_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AF_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AF_kills_helicopters`*5)) ) > 1500) THEN '[GAF] Generál ármii (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_af,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[Lt] Leytenánt (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[SrLt] Stárshiy leytenántt (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[Capt] Kapitán (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[Maj] Mayór (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[LtCol] Podpolkóvnik (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[Col] Polkóvnik (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[MajGen] Generál-mayór (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[LtGen] Generál-leytenánt (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[ColGen] Generál-polkóvnik (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[GA] Generál ármii (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_ar`)+ ((COUNT(a.`pe_LogEvent_AR_kills_armor`)*5+COUNT(a.`pe_LogEvent_AR_kills_unarmed`)+COUNT(a.`pe_LogEvent_AR_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_AR_kills_ships`)*5+COUNT(a.`pe_LogEvent_AR_kills_artillery`)*2+COUNT(a.`pe_LogEvent_AR_kills_missiles`)*5+COUNT(a.`pe_LogEvent_AR_kills_fortifications`)+COUNT(a.`pe_LogEvent_AR_kills_warehouses`)+COUNT(a.`pe_LogEvent_AR_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_AR_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_AR_kills_helicopters`*5)) ) > 1500) THEN '[MRF] Márshal Rossíyskoy Federátsii (O-11)'                                 
ELSE 'Cadet' END AS rank_officer_usa_ar,

CASE
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '0' AND '29') THEN '[JrLt] Mládshiy leytenánt (O-1)' 
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '30' AND '59') THEN '[Lt] Leytenánt (O-2)' 
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '60' AND '119') THEN '[SrLt] Stárshiy leytenánt (O-3)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '120' AND '239') THEN '[CaptLt] Kapitán leytenánt (O-4)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '240' AND '419') THEN '[3rdCapt] Kapitán 3rd pahra (O-5)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '420' AND '599') THEN '[2ndCapt] Kapitán 2nd pahra  (O-6)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '600' AND '779') THEN '[1stCapt] Kapitán 1st pahra (O-7)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '780' AND '1019') THEN '[CADM] Admiral Kontr (O-8)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '1020' AND '1259') THEN '[VADM] Admiral Vice (O-9)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) BETWEEN '1260' AND '1499') THEN '[ADM] Admiral (O-10)'
WHEN(SUM(g.`pe_finalflightduration_duration_nv`)+ ((COUNT(a.`pe_LogEvent_NV_kills_armor`)*5+COUNT(a.`pe_LogEvent_NV_kills_unarmed`)+COUNT(a.`pe_LogEvent_NV_kills_air_defense`)*3+COUNT(a.`pe_LogEvent_NV_kills_ships`)*5+COUNT(a.`pe_LogEvent_NV_kills_artillery`)*2+COUNT(a.`pe_LogEvent_NV_kills_missiles`)*5+COUNT(a.`pe_LogEvent_NV_kills_fortifications`)+COUNT(a.`pe_LogEvent_NV_kills_warehouses`)+COUNT(a.`pe_LogEvent_NV_kills_infantry`)*2) + (COUNT(a.`pe_LogEvent_NV_kills_planes`)*5 - COUNT(a.`pe_LogEvent_friendly_fire_killer`)*5 + COUNT(a.`pe_LogEvent_NV_kills_helicopters`*5)) ) > 1500) THEN '[FADM] Admiral Flota (O-11)'                                 
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
ELSE 'N/A DNE' END AS rank_officer_usa_ma,



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


a.`pe_LogEvent_coalition`,
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



WHERE a.`pe_LogEvent_coalition` = 'RED' AND 
CASE 
WHEN ((a.`pe_LogEvent_datetime` = d.`pe_DeathAncestoryFinal_lastpilotdeathtime`) AND a.`pe_LogEvent_type` = 'pilot_death') THEN (a.`pe_LogEvent_datetime`) 
ELSE (a.`pe_LogEvent_datetime` > (DATE_ADD(d.`pe_DeathAncestoryFinal_lastpilotdeathtime`, INTERVAL 45 SECOND))) END

GROUP BY a.pe_LogEvent_pilotid
ORDER BY d.`pe_DeathAncestoryFinal_pilotname` DESC


")) {
 */

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
/* 	echo "<input type='text' id='myznput1' onkeyup='myFunction1()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myzable1' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='1'><a href='hardcorestats_rankreq_rus.php'>Rank Requirements</a></th><th style='text-align: center' colspan='5'><a href='https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjmiIm5yYLxAhVyHjQIHRezBuoQFjANegQIBBAF&url=https%3A%2F%2Fwww.studyguides.af.mil%2FPortals%2F15%2Fdocuments%2Frank_ribbons%2FOfficer%2520Rank%2520Insignia%2520of%2520the%2520United%2520States%2520Armed%2520Forces.pdf&usg=AOvVaw386NawbQlTTpvjkge-R6vW' target='_blank' rel='noopener noreferrer'>Officer Rank (Adhoc Campaign)</a></th></tr>"; // First Code		
	echo "<tr class='table_header'><th>Pilot</th><th>NATO [All Branches Combined]</th><th>Air Force</th><th>Army</th><th>Navy</th></tr>"; // First Code							
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nato'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_af'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_ar'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nv'] . "</td>";				

			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nato'] . "</td>";
			if($row['rank_officer_usa_nato']=="[JrLt] Mládshiy leytenánt (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [JrLt] Mládshiy leytenánt (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Lt] leytenánt (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [Lt] leytenánt (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[SrLt] Stárshiy leytenánt (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [SrLt] Stárshiy leytenánt (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Capt] Kapitán (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [Capt] Kapitán (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Maj] Mayór (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [Maj] Mayór (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[LtCol] Podpolkóvnik (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [LtCol] Podpolkóvnik (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[Col] Polkóvnik (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [Col] Polkóvnik (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[MajGen] Generál-mayór (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='40px' width='60px'/>" . "  [MajGen] Generál-mayór (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[LtGen] Generál-leytenánt (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "  [LtGen] Generál-leytenánt (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[ColGen] Generál-polkóvnik (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "  [ColGen] Generál-polkóvnik (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nato']=="[GAF] Generál ármii (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [GAF] Generál ármii (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			}

			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_af'] . "</td>";			
			if($row['rank_officer_usa_af']=="[JrLt] Mládshiy leytenánt (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [JrLt] Mládshiy leytenánt (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Lt] leytenánt (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [Lt] leytenánt (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[SrLt] Stárshiy leytenánt (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [SrLt] Stárshiy leytenánt (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Capt] Kapitán (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [Capt] Kapitán (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Maj] Mayór (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [Maj] Mayór (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[LtCol] Podpolkóvnik (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [LtCol] Podpolkóvnik (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[Col] Polkóvnik (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [Col] Polkóvnik (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[MajGen] Generál-mayór (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='40px' width='60px'/>" . "  [MajGen] Generál-mayór (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[LtGen] Generál-leytenánt (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "  [LtGen] Generál-leytenánt (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[ColGen] Generál-polkóvnik (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "  [ColGen] Generál-polkóvnik (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_af']=="[GAF] Generál ármii (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [GAF] Generál ármii (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			}

			
			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_ar'] . "</td>";
			if($row['rank_officer_usa_ar']=="[Lt] Leytenánt (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [Lt] Leytenánt (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[SrLt] Stárshiy leytenántt (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [SrLt] Stárshiy leytenántt (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[Capt] Kapitán (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [Capt] Kapitán (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[Maj] Mayór (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [Maj] Mayór (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[LtCol] Podpolkóvnik (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [LtCol] Podpolkóvnik (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[Col] Polkóvnik (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [Col] Polkóvnik (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[MajGen] Generál-mayór (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [MajGen] Generál-mayór (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[LtGen] Generál-leytenánt (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./MG_t.png' height='40px' width='60px'/>" . "  [LtGen] Generál-leytenánt (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[ColGen] Generál-polkóvnik (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTG_t.png' height='40px' width='70px'/>" . "  [ColGen] Generál-polkóvnik (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[GA] Generál ármii (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GEN_t.png' height='40px' width='80px'/>" . "  [GA] Generál ármii (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_ar']=="[MRF] Márshal Rossíyskoy Federátsii (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [MRF] Márshal Rossíyskoy Federátsii (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			}

			//echo "<td style='text-align: center'>" . $row['rank_officer_usa_nv'] . "</td>";				
			if($row['rank_officer_usa_nv']=="[JrLt] Mládshiy leytenánt (O-1)")
			{
			echo "<td style='text-align: center'>" . "<img src='./ENS_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./2LT.png' height='40px' width='21px'/>" . "  [JrLt] Mládshiy leytenánt (O-1)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[Lt] Leytenánt (O-2)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LTJG_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./1LT.png' height='40px' width='21px'/>" . "  [Lt] Leytenánt (O-2)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[SrLt] Stárshiy leytenánt (O-3)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LT_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./CPT_t.png' height='40px' width='40px'/>" . "  [SrLt] Stárshiy leytenánt (O-3)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[CaptLt] Kapitán leytenánt (O-4)")
			{
			echo "<td style='text-align: center'>" . "<img src='./LCDR_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./MAJ_t.png' height='40px' width='40px'/>" . "  [CaptLt] Kapitán leytenánt (O-4)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[3rdCapt] Kapitán 3rd pahra (O-5)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CDR_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./LTC_t.png' height='40px' width='40px'/>" . "  [3rdCapt] Kapitán 3rd pahra (O-5)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[2ndCapt] Kapitán 2nd pahra  (O-6)")
			{
			echo "<td style='text-align: center'>" . "<img src='./CAPT_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./COL_t.png' height='40px' width='60px'/>" . "  [2ndCapt] Kapitán 2nd pahra  (O-6)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[1stCapt] Kapitán 1st pahra (O-7)")
			{
			echo "<td style='text-align: center'>" . "<img src='./RDML_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./BG_t.png' height='40px' width='40px'/>" . "  [1stCapt] Kapitán 1st pahra (O-7)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[CADM] Admiral Kontr (O-8)")
			{
			echo "<td style='text-align: center'>" . "<img src='./RADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./MG_t.png' height='40px' width='80px'/>" . "  [CADM] Admiral Kontr (O-8)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[VADM] Admiral Vice (O-9)")
			{
			echo "<td style='text-align: center'>" . "<img src='./VADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./LTG_t.png' height='40px' width='120px'/>" . "  [VADM] Vice Admiral (O-9)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[ADM] Admiral (O-10)")
			{
			echo "<td style='text-align: center'>" . "<img src='./ADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./GEN_t.png' height='40px' width='160px'/>" . "  [ADM] Admiral (O-10)" . "</td>";	
			}
			elseif($row['rank_officer_usa_nv']=="[FADM] Admiral Flota (O-11)")
			{
			echo "<td style='text-align: center'>" . "<img src='./FADM_t.png' class='thumbnail' height='40px' width='50px'/>" . "<img src='./GA_t.png' height='40px' width='40px'/>" . "  [FADM] Admiral Flota (O-11)" . "</td>";	
			}			
			else
			{
			echo "<td style='text-align: center'>" . "<img src='./nothing.png' height='1px' width='1px'/>" . "</td>";	
			}



		
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
	function myFunction1() {
	  var input, filter, table, tr, td, i, txtValue;
	  input = document.getElementById('myznput1');
	  filter = input.value.toUpperCase();
	  table = document.getElementById('myzable1');
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


*/



?> 


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