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
	
	<h1 style="color:#780000;">SQL Database Deletion</h1>
	
	

<?php
	


			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: Create Table pe_Reset -> Record PilotIDs >30 deaths 
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//DROP TABLE if pe_LastPilotDeath exists
			$sql = "DROP TABLE IF EXISTS pe_Reset";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table pe_LastPilotDeath -> sets stage for Hardcore mode / Stats Reset on Last Death
			$sql = 'CREATE TABLE IF NOT EXISTS pe_Reset (
			pe_Reset_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
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

			$sql = "DROP TABLE IF EXISTS pe_Reset_pilotid";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}


			//Create PilotNames Column in DB as `pe_LogEvent_pilotname`
			$sql = "ALTER TABLE pe_Reset ADD IF NOT EXISTS `pe_Reset_pilotid` BIGINT(20)";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}



			// INSERT pilot names into ancestory table (will create duplicates bc it involves copying the table - TRICKY PART!!!
			$sql = 'INSERT INTO pe_Reset
			(pe_Reset_pilotid)
			SELECT DISTINCT pe_DeathAncestoryFinal_pilotid
			  FROM pe_DeathAncestoryFinal
			  WHERE pe_DeathAncestoryFinal_pilotdeathcount > 30
			GROUP BY pe_DeathAncestoryFinal_pilotid
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

	

//Show a table with pilots > 30 deaths
echo "<h3 style='margin:5px'>Pilot Names > 30 Deaths</h3>";
echo "<h4style='margin:5px'><i>*Note: Deleted Pilot Names will NOT APPEAR until Stats are accumulated again!*</i></h4>";
if ($result = $mysqli->query("SELECT a.`pe_reset_pilotid`, 
b.`pe_DeathAncestoryFinal_pilotdeathcount` AS pilotdeaths, 
b.`pe_DeathAncestoryFinal_pilotname` AS pilotname,
b.`pe_DeathAncestoryFinal_pilotid` 
FROM pe_reset AS a 
INNER JOIN pe_DeathAncestoryFinal AS b ON a.`pe_reset_pilotid` = b.`pe_DeathAncestoryFinal_pilotid` 
GROUP BY b.`pe_DeathAncestoryFinal_pilotname`

")) {


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

?>


	<form method="post">		

		<input type="submit" name="button2"
				value="Click to -> Revisit the Moments of your Final Death..."/>	
		<br><br>	
		<input type="submit" name="button3"
				value="Click to -> Mourn your Pilot's Deletion..."/>
		<br><br>					
		<input type="submit" name="button1"
				value="DELETE PILOT DATA > 30 Deaths"/>
			
	
			
	</form>



<?php


		if(isset($_POST['button1'])) {

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//SECTION PURPOSE: DELETE all pilot's stats in LogEvent and LogStats
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//**********************DELETING PilotID from LogEvent******************************//



			// Make Updates to columns in the database first before querying ... started with Hardcore/Realistic and now encompasses everything
			require "updates.inc.php";

			//Create Reset Column as `pe_LogEvent_Reset`
			$sql = "ALTER TABLE pe_LogEvent ADD IF NOT EXISTS `pe_LogEvent_Reset` VARCHAR(100)";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}



			//***DROP table if it exists `pe_LogEvent_Reset` ***
			$sql = "DROP TABLE IF EXISTS pe_LogEvent_Reset";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}





			//Adding pilotids >30 deaths to pe_LogEvent_Reset
			$sql = '
			UPDATE pe_LogEvent
			JOIN (SELECT DISTINCT pe_Reset_pilotid
				   FROM pe_Reset
				   GROUP BY pe_Reset_pilotid) x ON pe_LogEvent_PilotID = pe_Reset_pilotid
			SET pe_LogEvent_Reset = pe_Reset_pilotid
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			// Delete pilots which became populated for reset due to > 30 deaths
			$sql = 'DELETE FROM pe_LogEvent
			WHERE pe_LogEvent_reset IS NOT NULL
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 



			//**********************DELETING PilotID from LogStats******************************//


			//Create Reset Column in DB as `pe_LogStats_Reset`
			$sql = "ALTER TABLE pe_LogStats ADD IF NOT EXISTS `pe_LogStats_Reset` VARCHAR(100)";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}


			//***Drop Table if Exists ***
			$sql = "DROP TABLE IF EXISTS pe_LogStats_Reset";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}



			//Adding pe_Reset_pilotid to pe_LogStats_Reset
			$sql = '
			UPDATE pe_LogStats
			JOIN (SELECT DISTINCT pe_Reset_pilotid
				   FROM pe_Reset
				   GROUP BY pe_Reset_pilotid) x ON pe_LogStats_playerid = pe_Reset_pilotid
			SET pe_LogStats_Reset = pe_Reset_pilotid
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Deleting ALL pe_Reset_pilotids data from pe_LogStats_Reset
			$sql = 'DELETE FROM pe_LogStats
			WHERE pe_LogStats_reset IS NOT NULL
			';

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			} 

			///////////////////END PILOT ID DELETION/////////////////////

			echo "<h3 style='color:purple;font-size:25px;'>Pilots with > 30 Deaths have now been <u><i>DELETED.</u></i><br>Get Up & Get Flying Soon!<br></h3>";

			echo "<h3 style='color: blue;'><i>Note: Deleted Pilot Names will NOT APPEAR until Stats are accumulated again!</i></h3>";
		}
	
		if(isset($_POST['button2'])) {
			echo "<h3 style='color:#780000;font-size:25px;'>Eject! Eject! ... Watch the canopy!</h3>";
			
/*			$ytarray=explode("/", $videolink);
			$ytendstring=end($ytarray);
			$ytendarray=explode("?v=", $ytendstring);
			$ytendstring=end($ytendarray);
			$ytendarray=explode("&", $ytendstring);
			$ytcode=$ytendarray[0];
			$ytendarray[0] = "https://www.youtube.com/watch?v=lThUWB81i4g" ;

			echo "<iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
*/

			echo "<iframe width=\"840\" height=\"630\" src=\"https://www.youtube.com/embed/lThUWB81i4g?autoplay=1\" frameborder=\"1\" allowfullscreen></iframe>";

			
		}
		
				if(isset($_POST['button3'])) {
			echo "<h3 style='color:blue;font-size:25px;'>Let the mourning begin...</h3>";
			
/*			$ytarray=explode("/", $videolink);
			$ytendstring=end($ytarray);
			$ytendarray=explode("?v=", $ytendstring);
			$ytendstring=end($ytendarray);
			$ytendarray=explode("&", $ytendstring);
			$ytcode=$ytendarray[0];
			$ytendarray[0] = "https://www.youtube.com/watch?v=lThUWB81i4g" ;

			echo "<iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
*/

			echo "<iframe width=\"840\" height=\"630\" src=\"https://www.youtube.com/embed/qmAmb36jafA?autoplay=1\" frameborder=\"1\" allowfullscreen></iframe>";

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

