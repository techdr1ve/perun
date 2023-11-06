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
				
//				echo "<h3>PLEASE FOR THE LOVE OF GOD WORK</h3>";
				$result = $mysqli->query("SELECT a.`pe_OnlineStatus_updated`, a.`pe_OnlineStatus_mission_name`, a.`pe_OnlineStatus_mission_theatre`, a.`pe_OnlineStatus_server_players`, a.`pe_OnlineStatus_server_players`- 1 AS server_players, a.`pe_OnlineStatus_server_pause`, CASE WHEN(a.`pe_OnlineStatus_server_pause`= 1) THEN 'Yes' ELSE 'No' END AS server_pause FROM pe_onlinestatus AS a ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "] on Mission: [" . $row->pe_OnlineStatus_mission_name . "] in Map: [" . $row->pe_OnlineStatus_mission_theatre .  "] with Player Count: [" . $row->server_players . "] and is Server Paused? : [" . $row->server_pause .  "].";
				}

?>




<h4>	
 
<li><a href="missionstats.php">Mission Stats</a> </li>
<li><a href="missionstatsbyairframe.php">By: Airframe</a></li>	
<li><a href="missionstatsbypilot.php">By: Pilot </a></li>
<div class="tooltip"><li><a href="missionstatsbypilotbyairframe.php">By: Pilot by Airframe</a></li><span class="tooltiptext">Long List? Filter!</span></div>

</h4>

<?php


// testing 2 joins
// Mission statistics for pilot
echo "<h3 style='margin:5px'>MISSION Statistics by Pilot WITH KEY --> _</h3>";
if ($result = $mysqli->query("SELECT a.`pe_LogStats_playerid`, a.`pe_LogStats_missionhash_id`, SUM(a.`ps_crashes`) AS value_sum_crashes, SUM(a.`ps_ejections`) AS value_sum_ejections, SUM(a.`ps_deaths`) AS value_sum_deaths, SUM(a.`ps_kills_X`) AS value_sum_kills, SUM(a.`ps_pvp`) AS value_sum_pvp, SUM(a.`ps_teamkills`) AS value_sum_teamkills, SUM(a.`ps_kills_planes`) AS value_sum_kills_planes, SUM(a.`ps_kills_helicopters`) AS value_sum_kills_helicopters, SUM(a.`ps_kills_armor`) AS value_sum_kills_armor, SUM(a.`ps_kills_unarmed`) AS value_sum_kills_unarmed, SUM(a.`ps_kills_infantry`) AS value_sum_kills_infantry, SUM(a.`ps_kills_ships`) AS value_sum_kills_ships, SUM(a.`ps_kills_fortification`) AS value_sum_kills_fortification, SUM(a.`ps_kills_artillery`) AS value_sum_kills_artillery, SUM(a.`ps_kills_air_defense`) AS value_sum_kills_air_defense, SUM(a.`ps_kills_other`) AS value_sum_kills_other, SUM(a.`ps_airfield_takeoffs`) AS value_sum_airfield_takeoffs, SUM(a.`ps_ship_takeoffs`) AS value_sum_ship_takeoffs, SUM(a.`ps_farp_takeoffs`) AS value_sum_farp_takeoffs, SUM(a.`ps_other_takeoffs`) AS value_sum_other_takeoffs, 

(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`)) AS total_takeoffs, (SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`)) AS total_landings,
((SUM(a.`ps_farp_landings`)+SUM(a.`ps_airfield_landings`)+SUM(a.`ps_ship_landings`)+SUM(a.`ps_other_landings`))/(SUM(a.`ps_farp_takeoffs`)+SUM(a.`ps_airfield_takeoffs`)+SUM(a.`ps_ship_takeoffs`)+SUM(a.`ps_other_takeoffs`))*100) AS total_takeoff_landing_percentage, CAST('total_takeoff_landing_percentage' AS decimal(3,2)) AS test,

b.`pe_DataPlayers_lastname`, (SUM(a.`ps_kills_armor`)+SUM(a.`ps_kills_unarmed`)+SUM(a.`ps_kills_ships`)+SUM(a.`ps_kills_artillery`)+SUM(a.`ps_kills_air_defense`)+SUM(a.`ps_kills_fortification`)+SUM(a.`ps_kills_infantry`)) AS total_a2gkills, (SUM(a.`ps_kills_planes`)+SUM(a.`ps_kills_helicopters`)) AS total_a2akills, c.`pe_DataMissionHashes_id`, c.`pe_DataMissionHashes_hash`, SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) AS value_mission FROM `pe_LogStats` AS a INNER JOIN `pe_DataPlayers` AS b ON a.pe_LogStats_playerid = b.pe_DataPlayers_id INNER JOIN `pe_DataMissionHashes` AS c ON a.`pe_LogStats_missionhash_id` = c.`pe_DataMissionHashes_id` WHERE SUBSTRING(c.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(c.`pe_DataMissionHashes_hash`) - 26) LIKE '%_%' GROUP BY b.`pe_DataPlayers_lastname`, value_mission ORDER BY b.`pe_DataPlayers_lastname`, value_mission ")) {

//SELECT col
//     , /* ANSI Syntax  */ SUBSTRING(col FROM 1 FOR CHAR_LENGTH(col) - 2) AS col_trimmed
//     , /* MySQL Syntax */ SUBSTRING(col,     1,    CHAR_LENGTH(col) - 2) AS col_trimmed
//FROM tbl
	
	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by pilot names...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	echo "<tr class='table_header'><th style='text-align: center' colspan='4'>Main Events</th><th style='text-align: center' colspan='5'>Life Events</th><th style='text-align: center' colspan='2'>PVP Events</th><th style='text-align: center' colspan='2'>A2A Kills</th><th style='text-align: center' colspan='8'>A2G Kills</th></tr>"; // First Code	
	echo "<tr class='table_header'><th>Pilot</th><th>Mission</th><th>A2A Kills</th><th>A2G Kills</th><th>Sorties</th><th>Landing%</th><th>Deaths</th><th>Ejections</th><th>Crashes</th><th>PVP Kills</th><th>Team Kills</th><th>Planes</th><th>Helos</th><th>Tanks|APCs|LUVs</th><th>UnArmored</th><th>Air Defense</th><th>Artillery</th><th>Infantry</th><th>Ships</th><th>Structures</th><th>Hits|Aesthetic Statics</th></tr>"; // First Code					
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
			echo "<td style='text-align: center'>" . $row['total_takeoffs'] . "</td>";				
			echo "<td style='text-align: center'>" . number_format($row['total_takeoff_landing_percentage' ],1) . "%</td>";				
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
// testing 2 joins
			
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