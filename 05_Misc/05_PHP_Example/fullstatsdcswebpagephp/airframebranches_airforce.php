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



/////////////FINAL///////All Pilot Statistics (Realistic/Hardcore) ... only populate stats after last pilot death for each pilot
echo "<h3 style='margin:5px'>Reference Data: Airframe Names by DCS Airframe Type by Military Branch</h3>";
if ($result = $mysqli->query("SELECT 
pe_militarybranch_airframename,
pe_militarybranch_datatype,
pe_militarybranch_branch



FROM pe_militarybranch

WHERE pe_militarybranch_branch = 'Air Force'
GROUP BY pe_militarybranch_branch, pe_militarybranch_datatype



")) {


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
	echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Filter by airframe...' title='Type in a name'>";	// searchable entry
	echo "<table class='table_stats' id='myTable' >";	
	echo "<tr class='table_header'><th><h1 style='color:#111;font-size:22px;'>Airframe Name</h1></th><th><h1 style='color:#111;font-size:22px;'>DCS Airframe Type</h1></th><th><h1 style='color:#111;font-size:22px;'><a href='https://en.wikipedia.org/wiki/United_States_Armed_Forces' target='_blank' rel='noopener noreferrer'>Military Branch</a></h1></th></tr>"; // First Code							
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr class='header'>";
			
			//echo "<td style='text-align: center'>" . $row['pe_DataPlayers_lastname'] . " " . $row['DeathAncestory'] . "</td>";
			
			echo "<td style='text-align: center'><h1 style='color:#111;font-size:17px;'>" . $row['pe_militarybranch_airframename'] . "</h1></td>";	
			echo "<td style='text-align: center'><h1 style='color:#111;font-size:17px;'>" . $row['pe_militarybranch_datatype'] . "</h1></td>";	
			echo "<td style='text-align: center'><h1 style='color:#111;font-size:17px;'>" . $row['pe_militarybranch_branch'] . "</h1></td>";
			//echo "<td style='text-align: center'><h1 style='color:#111;font-size:17px;'>" . $row['pe_medalsdb_reqs'] . "</h1></td>";		
			//echo "<td style='text-align: center'>" . $row['timeformatted_dataplayers_updated'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['pe_LogStats_missionhash_id'] . "</td>";							
			//echo "<td style='text-align: center'>" . $row['pe_DataTypes_name'] . "</td>";			
			//echo "<td style='text-align: center'>" . $row['medals_usa_bs'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_ss'] . "</td>";
			//echo "<td style='text-align: center'>" . $row['medals_usa_dfc'] . "</td>";				
			//echo "<td style='text-align: center'>" . $row['medals_usa_dsc_ar'] . "</td>";	
			//echo "<td style='text-align: center'>" . $row['medals_usa_afc_af'] . "</td>";
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
					

            //$pilotnames[]  = $row['pe_DataPlayers_lastname'];
			//$totala2g[] = $row['total_a2gkills'];
			//$totala2a[] = $row['total_a2akills'];
			//$totalkills[] = $row['total_kills'];			
			//$sorties[] = $row['value_count_takeoffs'];
			//$totalmedals[] = $row['medals_usa_total'];


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
                        labels:<?php //echo json_encode($pilotnames); ?>,


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
                            
                            data:<?php //echo json_encode($totalmedals); ?>,
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

-->


<?php


			
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