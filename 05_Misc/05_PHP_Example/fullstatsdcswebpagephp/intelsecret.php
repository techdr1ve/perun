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

			require "update_intel.inc.php"; // include header
?>


<?php

/////////////FINAL///////Secret Intel log - status
echo "<h3 style='margin:5px'><br><b>Command Center: Personnel Intelligence Board</b></h3>";
if ($result = $mysqli->query("SELECT * FROM pe_intel")) {

//TABLE STARTS BELOW
	echo "<input type='text' id='myInput2' onkeyup='myFunction1()' placeholder='Filter by Unit...' title='Search Units'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='2'></th></tr>"; // First Layer		
	echo "<tr class='table_header'><th>Unit</th><th>Status</th><th>Location</th><th>Latest Timestamp</th><th>Secret Intelligence</th></tr>"; // Third Layer 	 								
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			echo "<td style='text-align: center'><b>" . $row['pe_intel_unit'] . "</b></td>";
			echo "<td style='text-align: center'><b>" . $row['pe_intel_status'] . "</b></td>";
			echo "<td style='text-align: center'>" . $row['pe_intel_location'] . "</td>";
			echo "<td style='text-align: center'>" . $row['pe_intel_latest_timestamp'] . "</td>";
			echo "<td style='text-align: center'><b>" . $row['pe_intel_secret_intel'] . "</b></td>";			
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_airframe'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_militarybranch'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['msg'] . "</td>";
						

		echo "</tr>";
	}
	echo "</table>";

echo "<script>
function myFunction1() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('myInput2');
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

/////////////FINAL///////Secret Intel log - log entries
echo "<h3 style='margin:5px'><br><b>Secret Intelligence Log</b></h3>";
if ($result = $mysqli->query("SELECT DISTINCT pe_LogChat_datetime AS time, pe_LogChat_msg AS msg
FROM `pe_LogChat`

WHERE pe_LogChat_msg LIKE('%POW%') OR pe_LogChat_msg LIKE('%VIP%') OR pe_LogChat_msg LIKE('%Target%') OR pe_LogChat_msg LIKE('%Secret Intel%')
ORDER BY `pe_LogChat_datetime` DESC


")) {

//TABLE STARTS BELOW
	echo "<input type='text' id='myInput3' onkeyup='myFunction3()' placeholder='Filter by log entries...' title='Search Entries'>";	// searchable entry
	echo "<table class='table_stats' id='myTable3' >";
	//echo "<tr class='table_header'><th style='text-align: center' colspan='2'></th></tr>"; // First Layer		
	echo "<tr class='table_header'><th>Time Stamp</th><th>Log Entry</th></tr>"; // Third Layer 	 								
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			echo "<td style='text-align: center'>" . $row['time'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_airframe'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogEvent_militarybranch'] . "</td>";				
			echo "<td style='text-align: center'>" . $row['msg'] . "</td>";
						

		echo "</tr>";
	}
	echo "</table>";

echo "<script>
function myFunction3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('myInput3');
  filter = input.value.toUpperCase();
  table = document.getElementById('myTable3');
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

?>

<!DOCTYPE html>
<html>

<body onload="CertFunction()">

<script>
   function CertFunction(){
    td_array = document.getElementsByTagName("td");
//    pass_value = "PASS";
//	missing_value = "";
	rescued_value = "RESCUED";
	captured_value = "CAPTURED";
	killedinaction_value = "KIA";
	missinginaction_value = "RELEASED & MIA";
	savedandrestored_value = "SAVED & RESTORED";
	executed_value = "EXECUTED";
	//intel_value = "Intel";

/*    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == pass_value){
        td_array[i].style.backgroundColor = "#90ee90";		
      };
	  };
*/
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == rescued_value){
        td_array[i].style.backgroundColor = "#90ee90";
        td_array[i+3].style.backgroundColor = "#90ee90";			
      };
	  };
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == captured_value){
        td_array[i].style.backgroundColor = "#90ee90";
        td_array[i+3].style.backgroundColor = "#90ee90";		
      };
	  };	  
/*    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == missing_value){
        td_array[i].style.backgroundColor = "#FF7F7F";
	  };
	  };
*/	  
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == missinginaction_value){
        td_array[i].style.backgroundColor = "#FF7F7F";		
      };
	  };	  
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == killedinaction_value){
        td_array[i].style.backgroundColor = "#989898";		
      };
	  };
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == savedandrestored_value){
        td_array[i].style.backgroundColor = "#989898";		
      };
	  };
    for (i = 0; i < td_array.length; i++){
      if (td_array[i].textContent == executed_value){
        td_array[i].style.backgroundColor = "#90ee90";		
      };
	  };
//    for (i = 0; i < td_array.length; i++){
//      if (td_array[i].textContent == intel_value){
//        td_array[i].style.backgroundColor = "#90ee90";		
//      };
//	  };	  
	  
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