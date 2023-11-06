<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = strval($_GET['q']);

require "config.inc.php"; // trying to make this an include

$con = mysqli_connect($config_db_host, $config_db_username, $config_db_password, $config_db_database);
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,$config_db_database);
$sql="
		SELECT 
		a.pe_dataplayers_id,
		a.pe_dataplayers_ucid,
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
		
		WHERE a.pe_dataplayers_id = '".$q."'

";

$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>PlayerID</th>
<th>Pilot</th>
<th>Last Connected</th>
<th>Armor Kills</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['pe_dataplayers_id'] . "</td>";
  echo "<td>" . $row['pe_dataplayers_lastname'] . "</td>";
  echo "<td>" . $row['pe_dataplayers_updated'] . "</td>";
  echo "<td>" . $row['value_count_kills_armor'] . "</td>";
  //echo "<td>" . $row['Job'] . "</td>";
  echo "</tr>";


}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>