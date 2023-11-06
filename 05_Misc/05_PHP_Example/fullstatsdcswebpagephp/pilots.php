<!-- This is integration example for https://github.com/szporwolik/perun - please keep the code as simple and straightforward as possible -->
<!DOCTYPE html>
<html>
  <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

	
	
//	$simStats = new SimStats(new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS, $MYSQL_DB));
	$Stats = new Stats(new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database));


//////////////test
class Stats {

	protected $mysqli;
	
	public function Stats(mysqli $mysqli) {
		$this->mysqli = $mysqli;
	}
	

	public function echoOrderOfContent() 
	{
		if (isset($_GET['pid'])) 
		{
			$this->echoPilotStat($_GET['pid']);
		}
		elseif (isset($_GET['pis'])) 
		{
			$this->echoPilotStat2($_GET['pis']);
		}		
		else
		{
//			echo "<h2>Pilots</h2><br><br>";
//			$this->echoPilotsTable();
		}
	}
	
	public function echoPilotStat($pilotid) {
		
		if ($pilot = $this->getPilotsStat($pilotid)) {
			
			$pilotid = $pilot->pe_dataplayers_id;
//			$online = $pilot->online;
//			$onlinestatus = "<p class='pilot_offline'>On the Ground</p>";
//			if ($pilot->online == 1)
//				$onlinestatus = "<p class='pilot_online'>Flying</p>";
			
			//echo "<h2>Pilot " . $pilot->pe_dataplayers_lastname . "</h2>";
			//echo "<h3>Kills: Armor " . $pilot->value_count_kills_armor . "</h3><br><br>";
//			echo "<table class='table_stats'><tr class='table_row_0'><td>Total Flight Time: </td><td>" . $this->timeToString($pilot->flighttime) . "</td></tr>";
			//echo "<tr class='table_row_1'><td>Flights: </td><td>" . $pilot->flights . "</td></tr>";
			//echo "<tr class='table_row_0'><td>Last Activity: </td><td>" . $pilot->pe_dataplayers_updated . "</td></tr>";
			
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_airframe . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_pilotid . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_DataMissionHashes_hash . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_mission . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_campaign . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_missionhash_id . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_mission_short . "</h2>";			




			echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
			echo "<table class='table_stats' id='myTable' >";
			//echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Aviator Record Summary</th><th style='text-align: center' colspan='6'>Life Events</th></tr>"; // First Code	
			echo "<tr class='table_header'><th>Pilot</th><th>Last Flight</th><th>Total Flight Hours</th><th>Sorties</th><th>A2A Kills</th></tr>"; // First Code

			//while($pilot->mysqli_fetch_array($result))
			
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_pilotid . "</td>";	
					echo "<tr onclick=\"window.document.location='?pis=" . $pilot->pe_LogEvent_pilotid . "'\" class='table_row_" . $pilot->pe_LogEvent_pilotid %2 . "'>";
					echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_lastname . "</td>";		
					echo "<td style='text-align: center'>" . $pilot->value_count_kills_armor . "</td>";
						echo "<td style='text-align: center'>" . $pilot->pe_dataplayers_updated . "</td>";
					//echo "<td style='text-align: center'>" . $pilot->pe_LogEvent_airframe . "</td>";			
					//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
					//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
					//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
						echo "<td style='text-align: center'>" . $pilot->pe_DataMissionHashes_hash . "</td>";
						echo "<td style='text-align: center'>" . $pilot->value_mission_short . "</td>";			


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


				echo "</tr>";
			
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
			
	//		$result->close();




						
			
//			echo "<tr class='table_row_1'><td>Status: </td><td>" . $onlinestatus . "</td></tr></table>";
			echo "<br><br>";
			
			
			
			
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


	public function echoPilotStat2($pilotid) {
		
		if ($pilot = $this->getPilotsStat($pilotid)) {
			
			$pilotid = $pilot->pe_dataplayers_id;
//			$online = $pilot->online;
//			$onlinestatus = "<p class='pilot_offline'>On the Ground</p>";
//			if ($pilot->online == 1)
//				$onlinestatus = "<p class='pilot_online'>Flying</p>";
			
			echo "<h2>Pilot " . $pilot->pe_dataplayers_lastname . "</h2>";
			echo "<h3>Kills: Armor " . $pilot->value_count_kills_armor . "</h3><br><br>";
//			echo "<table class='table_stats'><tr class='table_row_0'><td>Total Flight Time: </td><td>" . $this->timeToString($pilot->flighttime) . "</td></tr>";
			//echo "<tr class='table_row_1'><td>Flights: </td><td>" . $pilot->flights . "</td></tr>";
			echo "<tr class='table_row_0'><td>Last Activity: </td><td>" . $pilot->pe_dataplayers_updated . "</td></tr>";
			
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_airframe . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_pilotid . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_DataMissionHashes_hash . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_mission . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_campaign . "</h2>";
			//echo "<h2>Pilot " . $pilot->pe_LogEvent_missionhash_id . "</h2>";
			//echo "<h2>Pilot " . $pilot->value_mission_short . "</h2>";			




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
			echo "<br><br>";
			
			
			
			
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

	public function getPilotsStat($pilotid) {
		//get pilot information
		//$prep = $this->mysqli->prepare("SELECT id, name, disp_name, flighttime, flights, lastactive, online FROM pilots WHERE id=?");
		$prep = $this->mysqli->prepare("
		
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
		
		");		
		$prep->bind_param('i', $pilotid);
		$prep->execute();
		
		$row = new stdClass();
		//$prep->bind_result($row->id, $row->name, $row->disp_name, $row->flighttime, $row->flights, $row->lastactive, $row->online);
		$prep->bind_result(
		$row->pe_LogEvent_missionhash_id,
		$row->pe_dataplayers_id, 
		$row->pe_dataplayers_lastname, 
		$row->pe_dataplayers_updated, 
		$row->value_count_kills_armor,
		$row->pe_LogEvent_pilotid, 
		$row->pe_DataMissionHashes_hash,
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



$Stats->echoOrderOfContent();

//////////////end test

?>



<?php


			// Make Updates to columns in the database first before querying ... started with Hardcore/Realistic and now encompasses everything
			//require "updates.inc.php";

			// Current Time + Mission + Map

			require "missionstatus.inc.php"; // include header

?>





		<?php while( $rows = mysqli_fetch_array($res)) {
			?>

		  <option value="<?php echo $rows['pe_dataplayers_lastname'];  ?> " > <?php  echo $rows['pe_dataplayers_lastname'] ;  ?> </option>
		     
		  <?php
		  $result->close();
		  }
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

/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo "<br><br><br><h3 style='margin:5px'>All Pilot Statistics</h3>";
echo "<h4 style='margin:5px'><i>Click on Individual Pilot Names for Details</i></h4>";
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


GROUP BY a.`pe_LogEvent_pilotid`
ORDER BY b.`pe_DataPlayers_updated` DESC


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

	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Aviator Record Summary</th><th style='text-align: center' colspan='6'>Life Events</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight</th><th>Total Flight Hours</th><th>Sorties</th><th>A2A Kills</th><th>A2G Kills</th></tr>"; // First Code

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr onclick=\"window.document.location='?pid=" . $row['pe_LogEvent_pilotid'] . "'\" class='table_row_" . $row['pe_LogEvent_pilotid']%2 . "'>";
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			echo "<td style='text-align: center'>" . number_format($row['flightduration'],1) . " hours</td>";
			echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
			//echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_ejections'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['value_count_crashes'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_selfkills'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['value_count_pvp'] . "</td>";
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
            $crashes[] = $row['value_count_crashesneg'];
            $eject[] = $row['value_count_ejectneg'];
            $deaths[] = $row['value_count_deathsneg'];
            $teamkills[] = $row['value_count_teamkillsneg'];			
			$pvpkills[] = $row['value_count_pvp'];			
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




<?php

/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
/* echo "<br><br><br><h3 style='margin:5px'> All Pilot Statistics</h3>";
if ($result = $mysqli->query("SELECT DISTINCT a.`pe_LogEvent_pilotname`, a.`pe_LogEvent_friendly_fire_killer`, a.`pe_LogEvent_friendly_fire_selfbomb`, a.`pe_LogEvent_datetime` AS mission_start_time,


DATE_ADD(a.`pe_LogEvent_datetime`, INTERVAL 45 SECOND) AS minus45secondsdatetime,



a.`pe_LogEvent_pilotid`,
b.`pe_DataPlayers_lastname`, 
b.`pe_DataPlayers_updated`,
b.`pe_DataPlayers_id`



FROM `pe_LogEvent` AS a 
INNER JOIN `pe_DataPlayers` AS b 
ON a.pe_LogEvent_pilotid = b.pe_DataPlayers_id 

WHERE a.`pe_LogEvent_type` = 'SimStart'

GROUP BY a.`pe_LogEvent_datetime`
ORDER BY a.`pe_LogEvent_datetime` DESC LIMIT 1


")) { */


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

/* 	echo "<table class='table_stats' >";
	echo "<tr class='table_header'><th>time</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>"; */
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['total_a2akills'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['total_a2gkills'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_coalition'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_onlineplayers_side'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_mstatus'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['value_count_takeoffs'] . "</td>";			
			//echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage'],1) . "%</td>";	
/* 			echo "<td style='text-align: center'>" . $row['value_count_deaths'] . "</td>";
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
			echo "<td style='text-align: center'>" . $row['value_count_kills_other'] . "</td>";		 */		
			//echo "<td style='text-align: center'>" . $row['minus45seconds'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_count_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_takeoffs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_airfield_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_ship_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_farp_landings'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['value_sum_other_landings'] . "</td>";		
			//echo "<td style='text-align: center'>" . $row['mission_start_time'] . "</td>";				

            //$pilotnames[]  = $row['pe_DataPlayers_lastname'];
            //$crashes[] = $row['value_count_crashesneg'];
            //$eject[] = $row['value_count_ejectneg'];
            //$deaths[] = $row['value_count_deathsneg'];
            //$teamkills[] = $row['value_count_teamkillsneg'];			
			//$pvpkills[] = $row['value_count_pvp'];			
			//$totala2g[] = $row['total_a2gkills'];
			//$totala2a[] = $row['total_a2akills'];
			//$totalkills[] = $row['total_kills'];			
			//$sorties[] = $row['value_count_takeoffs'];
			//$timemissionstart[] = $row['mission_start_time'];				

/* 		echo "</tr>";
	}
	echo "</table>"; */


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

/* 	$result->close();
} */

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
        <div style="width:60%;hieght:20%;text-align:center">

            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($pilotnames); ?>,
                        datasets: [
						{
							label: 'PVP Kills',

                            backgroundColor: "#FFFFFF", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($pvpkills); ?>,
                        },	
						{
							label: 'A2A Kills',

                            backgroundColor: "#00FFFF", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($totala2a); ?>,
                        },	
						{
							label: 'A2G Kills',

                            backgroundColor: "#008000", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($totala2g); ?>,
                        },
						{
							label: 'Sorties',

                            backgroundColor: "#FFA500", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($sorties); ?>,
                        },							
						{
							label: 'Crash',

                            backgroundColor: "#FF0000", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($crashes); ?>,
                        },
						{
							label: 'Eject',

                            backgroundColor: "#FFFF00", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($eject); ?>,
                        },
						{
							label: 'Deaths',

                            backgroundColor: "#000000", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($deaths); ?>,
                        },	
						{
							label: 'Team Kill',

                            backgroundColor: "#964B00", 
							borderColor: "#000000",
                            
                            data:<?php echo json_encode($teamkills); ?>,
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
							text: 'Chart.js Bar Chart'
						  }

						}

					  },
                });
    </script>
</html>





<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:30%;height:10%;text-align:center">
            <h2 class="page-header" >Total Kills vs. Pilot </h2>		
            <canvas  id="chartjs_pie"></canvas> 
            <h3 class="page-header" >OUTER: Total Kills<br>MIDDLE: A2A Kills<br>INNER: A2G Kills</h3>	

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
                            
                            data:<?php echo json_encode($totalkills); ?>,
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


////////////////////////////////


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



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////SAVE!!!!//////////////////
// COMPLETE/FULL statistics for pilot  - 2 SQL Tables Joined
/* echo "<h3> All Pilot Statistics</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_mstatus`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_airdefense, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_airfield_landings`) AS value_sum_airfield_landings, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_ship_landings`) AS value_sum_ship_landings, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_farp_landings`) AS value_sum_farp_landings, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, SUM(a.`ps_other_landings`) AS value_sum_other_landings, b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_other`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills,(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings, ((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test, b.`pe_DataPlayers_updated`, b.`pe_DataPlayers_id` FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id GROUP BY b.`pe_DataPlayers_lastname` ORDER BY b.`pe_DataPlayers_updated` DESC")) {

//cast(your_float_column as decimal(10,2))

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th style='text-align: center' colspan='5'>Last Known</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Last Flight Log</th><th>A2A Kills</th><th>A2G Kills</th><th>::Status::</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Armor</th><th>LUV|Other</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th></tr>"; // First Code					
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
} */
			
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