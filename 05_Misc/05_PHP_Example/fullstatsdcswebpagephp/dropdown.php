<?php

require "config.inc.php"; // trying to make this an include

$conn = new mysqli($config_db_host, $config_db_username, $config_db_password, $config_db_database) 
or die ('Cannot connect to db');

    $result = $conn->query("
	SELECT 
	a.pe_dataplayers_id AS id,
	a.pe_dataplayers_lastname AS name
	FROM pe_dataplayers AS a
	");

    echo "<html>";
    echo "<body>";
    echo "<select name='id'>";

	echo "<table><tr><th>PlayerID</th><th>Pilot</th></tr>";
    while ($row = $result->fetch_assoc()) {

                  unset($id, $name);
                  $id = $row['id'];
                  $name = $row['name']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';
					echo "<tr>";
					echo "<td>" . $row['pe_dataplayers_id'] . "</td>";
					echo "<td>" . $row['pe_dataplayers_lastname'] . "</td>";
					echo "</tr>";
}

    echo "</table>";
	echo "</select>";
    echo "</body>";
    echo "</html>";

	
?> 