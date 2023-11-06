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
				$result = $mysqli->query("SELECT a.`pe_OnlineStatus_updated`, a.`pe_OnlineStatus_mission_name`, a.`pe_OnlineStatus_mission_theatre`, a.`pe_OnlineStatus_server_players`, FORMAT((a.`pe_OnlineStatus_mission_modeltime`/3600),1) AS mission_time, FORMAT((720 - a.`pe_OnlineStatus_mission_modeltime`/60),0) AS reset_time, a.`pe_OnlineStatus_server_players`- 1 AS server_players, a.`pe_OnlineStatus_server_pause`, CASE WHEN(a.`pe_OnlineStatus_server_pause`= 1) THEN 'Yes' ELSE 'No' END AS server_pause, a.`pe_OnlineStatus_time_in_mission` FROM pe_onlinestatus AS a ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "], on Mission: [" . $row->pe_OnlineStatus_mission_name . "], in Map: [" . $row->pe_OnlineStatus_mission_theatre .  "], Running for: [" . $row->mission_time . "]hrs, Start Time in Mission: [" . $row->pe_OnlineStatus_time_in_mission . "], Mission Ends in: [" . $row->reset_time . "]min, with Player Count: [" . $row->server_players . "], and is Server Paused?: [" . $row->server_pause .  "].";
				}

?>
	
	<h1 style="color:#780000;">SQL Database Deletion</h1>
	
	

<?php
	


			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: Create Table pe_Reset -> Record PilotIDs >30 deaths 
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//DROP TABLE if pe_LastPilotDeath exists
/* 			$sql = "DROP TABLE IF EXISTS pe_DeleteDateTime";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
			$sql = 'CREATE TABLE IF NOT EXISTS pe_DeleteDateTime (
			pe_DeleteDateTime_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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

			$sql = "DROP TABLE IF EXISTS pe_DeleteDateTime_pilotid";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}


			//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
			$sql = "ALTER TABLE pe_DeleteDateTime ADD IF NOT EXISTS `pe_DeleteDateTime_pilotid` BIGINT(20)";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}



			// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
			$sql = 'INSERT INTO pe_DeleteDateTime
			(pe_DeleteDateTime_pilotid)
			SELECT DISTINCT pe_LogEvent_pilotid
			  FROM pe_LogEvent
			  WHERE pe_LogEvent_datetime < "2021-06-02 18:46:14"
			GROUP BY pe_LogEvent_pilotid
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} */

	

//Show a table with pilots > 30 deaths
/* echo "<h3 style='margin:5px'>Pilot Names > 30 Deaths</h3>";
echo "<h4style='margin:5px'><i>*Note: Deleted Pilot Names will NOT APPEAR until Stats are accumulated again!*</i></h4>";
if ($result = $mysqli->query("SELECT a.`pe_reset_pilotid`, 
b.`pe_DeathAncestoryFinal_pilotdeathcount` AS pilotdeaths, 
b.`pe_DeathAncestoryFinal_pilotname` AS pilotname,
b.`pe_DeathAncestoryFinal_pilotid` 
FROM pe_reset AS a 
INNER JOIN pe_DeathAncestoryFinal AS b ON a.`pe_reset_pilotid` = b.`pe_DeathAncestoryFinal_pilotid` 
GROUP BY b.`pe_DeathAncestoryFinal_pilotname`

"))  { 


//TABLE STARTS BELOW

	echo "<table>";
	echo "<table class='table_stats'>";
	echo "<tr class='table_header'><th>Pilot Name</th><th>Deaths</th></tr>"; // First Code					
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";		
			echo "<td style='text-align: center'>" . $row['pilotname'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pilotdeaths'] . "</td>";	

		echo "</tr>";
	}
	echo "</table><br>";
	
	$result->close();
}
*/

?>

<!--------------------------------UNCOMMENT THIS CODE TO USE DATA DELETION BUTTON!!!!!!!!!!!!!!!!!!--------------------------------
	<form method="post">		

		<br><br>					
		<input type="submit" name="button4"
				value="DELETE Data before Syrian Offensive Campaign"/>				
			
	</form>

--------------------------------UNCOMMENT THIS CODE TO USE DATA DELETION BUTTON!!!!!!!!!!!!!!!!!!---------------------------------->

	<form method="post">	
		<br><br>					
		<input type="submit" name="button5"
				value="DELETE 'POW' Intel Entries"/>					
	</form>

	<form method="post">	
		<br><br>					
		<input type="submit" name="button6"
				value="DELETE 'VIP' Intel Entries"/>				
	</form>

	<form method="post">	
		<br><br>					
		<input type="submit" name="button7"
				value="DELETE 'Target' Intel Entries"/>				
	</form>
	<form method="post">	
		<br><br>					
		<input type="submit" name="button8"
				value="DELETE 'Secret Intel:' Entries"/>				
	</form>	
	

<?php



		

		if(isset($_POST['button4'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all pilot's stats in LogEvent and LogStats
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//**********************DELETING PilotID from LogEvent******************************//

/* 			$sql = 'INSERT INTO pe_DeleteDateTime
			(pe_DeleteDateTime_pilotid)
			SELECT DISTINCT pe_LogEvent_pilotid
			  FROM pe_LogEvent
			  WHERE pe_LogEvent_datetime < "2021-06-02 18:46:14"
			GROUP BY pe_LogEvent_pilotid
			'; */

			// Delete pilots which became populated for reset due to > 30 deaths
			//AND pe_LogEvent_pilotid IS NOT NULL      <-- add this line to WHERE if you want to delete only pilotids

			//require "updates.inc.php";
			
			$sql = 'DELETE FROM pe_LogEvent
			WHERE pe_LogEvent_datetime < "2021-06-02 18:46:14" 
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 

			// Delete pilots which became populated for reset due to > 30 deaths
			$sql = 'DELETE FROM pe_LogEvent
			WHERE pe_LogEvent_datetime > "2021-06-03 07:45:43"
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 

			//If no deaths (pilot_death = 0) then record first reported time as last death.
/* 			$sql = 'UPDATE pe_DeathAncestoryFinal SET
			   pe_DeathAncestoryFinal_lastpilotdeathtime = (
				SELECT pe_LogEvent_datetime
				FROM pe_LogEvent 
				WHERE MIN(pe_LogEvent_id) pe_LogEvent_id	
				GROUP BY pe_DeathAncestoryFinal_pilotname
				ORDER BY pe_LogEvent_id LIMIT 1)
				WHERE pe_DeathAncestoryFinal_pilotdeathcount = 0
				'; */

			//Quick and Dirty way ... just change log_event_id = # last number available
/* 			$sql = 'UPDATE pe_DeathAncestoryFinal SET
			   pe_DeathAncestoryFinal_lastpilotdeathtime = (
				SELECT pe_LogEvent_datetime
				FROM pe_LogEvent 
				WHERE pe_LogEvent_id = 2058
				GROUP BY pe_DeathAncestoryFinal_pilotname)
				WHERE pe_DeathAncestoryFinal_pilotdeathcount = 0
				'; */

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 			

			///////////////////END PILOT ID DELETION/////////////////////

			echo "<h3 style='color:black;font-size:25px;'>Pilot Stats Before Mission 1 have been <u><i>DELETED.</u></i></h3>";

		}
		
	
		if(isset($_POST['button5'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all log chat messages in pe_LogChat_msg (Secret Intel)
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//**********************DELETING LogChat_msg from pe_LogChat******************************//
			//require "updates.inc.php";
			$sql = 'DELETE FROM pe_LogChat
			WHERE pe_LogChat_msg LIKE("%POW%") 
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 
			///////////////////pe_LogChat_msg DELETION/////////////////////
			echo "<h3 style='color:black;font-size:25px;'>Log Chat 'POW' messages have been <u><i>DELETED.</u></i></h3>";
		}

		if(isset($_POST['button6'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all log chat messages in pe_LogChat_msg (Secret Intel)
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//**********************DELETING LogChat_msg from pe_LogChat******************************//
			//require "updates.inc.php";
			$sql = 'DELETE FROM pe_LogChat
			WHERE pe_LogChat_msg LIKE("%VIP%") 
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 
			///////////////////pe_LogChat_msg DELETION/////////////////////
			echo "<h3 style='color:black;font-size:25px;'>Log Chat 'VIP' messages have been <u><i>DELETED.</u></i></h3>";
		}

		if(isset($_POST['button8'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all log chat messages in pe_LogChat_msg (Secret Intel)
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//**********************DELETING LogChat_msg from pe_LogChat******************************//
			//require "updates.inc.php";
			$sql = 'DELETE FROM pe_LogChat
			WHERE pe_LogChat_msg LIKE("%Intel%") 
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 
			///////////////////pe_LogChat_msg DELETION/////////////////////
			echo "<h3 style='color:black;font-size:25px;'>Log Chat 'Secret Intel:' messages have been <u><i>DELETED.</u></i></h3>";
		}

		if(isset($_POST['button7'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all log chat messages in pe_LogChat_msg (Secret Intel)
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			//**********************DELETING LogChat_msg from pe_LogChat******************************//
			//require "updates.inc.php";
			$sql = 'DELETE FROM pe_LogChat
			WHERE pe_LogChat_msg LIKE("%Target%") 
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 
			///////////////////pe_LogChat_msg DELETION/////////////////////
			echo "<h3 style='color:black;font-size:25px;'>Log Chat 'Target' messages have been <u><i>DELETED.</u></i></h3>";
		}

	
	?>
	





			
		
	</div>
	<div id="footer">
		<?php
		require "footer.inc.php"; // include menu items at top

		// Close database connection
		$mysqli->close();

		?>
	</div>
  </body>
</html>

