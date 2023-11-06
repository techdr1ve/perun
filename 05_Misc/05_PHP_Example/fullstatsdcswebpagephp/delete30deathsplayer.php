<?php


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

?>