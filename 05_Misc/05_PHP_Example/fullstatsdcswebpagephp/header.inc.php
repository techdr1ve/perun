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

$info = pathinfo( __FILE__ );
$page = $info['filename'];  //output : index

echo "<link href='https://fonts.googleapis.com/css?family=Geostar' rel='stylesheet'>";
//echo "<link href='https://fonts.googleapis.com/css?family=Kumar One Outline' rel='stylesheet'>";

//	  <li><a href="serverstatus.php" >Server Status</a></li>
//	  <li><a href="livemap.php">Live Radar Map</a></li>	


?>

	<?php
	include "resetservertimer.php"; // trying to make this an include
	?>
	   


<?php
//Below is code for top nav bar links
echo
'
<ul>		
	<link rel="shortcut icon" href="wtf_logo3.png" type="image/png.">



	  <li><a href="pilots.php"><img src="helmet.png" alt="Paris" width="20" height="14"><b>PILOTS</b></a></li>
	  <li><a href="totalstats.php"><img src="equal.png" alt="Paris" width="20" height="14"><b>TOTAL STATS</b></a></li>	  
	  <li><a href="standings.php"><img src="skullcrossbones.png" alt="Paris" width="20" height="14"><b>STANDINGS</b><img src="equal.png" alt="Paris" width="20" height="14"></a></li>
	  <li><a href="hardcorestats.php"><img src="blood.png" alt="Paris" width="20" height="14"><b>HARDCORE STATS</b></a></li>
	  
	  <li class ="dropdown"><a href="hardcorestats_rank.php" class="dropbtn"><img src="rank.png" alt="Paris" width="20" height="14"><b>RANK</b><img src="blood.png" alt="Paris" width="20" height="14"></a>
			<div class="dropdown-content">
			  <a href="hardcorestats_rank.php"><b>Pilot Ranks</b></a>			
			  <a href="hardcorestats_rankreq_usa.php"><b>BLUE Requirements</b></a>
			  <a href="hardcorestats_rankreq_rus.php"><b>RED Requirements</b></a>
			</div>	   
	  </li>
	  
	  <li class ="dropdown"><a href="hardcorestats_medals.php" class="dropbtn"><img src="star.png" alt="Paris" width="20" height="14"><b>MEDALS</b><img src="blood.png" alt="Paris" width="20" height="14"></a>
			<div class="dropdown-content">
			  <a href="hardcorestats_medals.php"><b>Pilot Medals</b></a>			
			  <a href="hardcorestats_medalsreq_usa.php"><b>BLUE Requirements</b></a>
			  <a href="hardcorestats_medalsreq_rus.php"><b>RED Requirements</b></a>
			</div>	 	  
	  </li>

	  <li><a href="intelsecret.php"><img src="key.png" alt="Paris" width="18" height="14"><b>SECRET INTEL</b></a></li>
	  
	  <li class ="dropdown"><a href="airframebranches.php" class="dropbtn"><img src="jet1.png" alt="Paris" width="20" height="14"><b>MILITARY BRANCH</b></a>
			<div class="dropdown-content">
			  <a href="airframebranches.php"><b>All Branches</b></a>			
			  <a href="airframebranches_airforce.php"><b>Air Force</b></a>
			  <a href="airframebranches_army.php"><b>Army</b></a>
			  <a href="airframebranches_navy.php"><b>Navy</b></a>
			  <a href="airframebranches_marines.php"><b>Marines</b></a>
				  
			</div>		  
	  </li>
	  
	  <!-- <li><a href="missionstats.php">Mission Stats</a></li> -->
	  <!-- <li><a href="campaignstats.php">Campaign Stats</a></li> -->

	  <li class ="dropdown"><a href="combatflightcert.php" class="dropbtn"><img src="greencheck.png" alt="Paris" width="20" height="14"><b>COMBAT FLIGHT CERT</b></a>
			<div class="dropdown-content">
			  <a href="combatflightcert.php"><b>Pilot Certifications</b></a>
			  <a href="combatflightcert_passingreqs.php"><b>Passing Requirements</b></a>
			</div>		  
	  </li>


	  
	  <li style="float:right"><form method="post"><input type="submit" name="button8" value="UPDATE DATA"/></form></li>	
	  <li style="float:right"><a href="resetcommands.inc.php"><img src="crossout.png" alt="Paris" width="20" height="14"><b>RESET STATS</b></a></li>
	</ul>

';

?>

<?php //pilotdropdown selection box
	echo'<ul>';
	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="SELECT DISTINCT
	a.pe_dataplayers_lastname,
	a.pe_dataplayers_id
	FROM pe_dataplayers AS a";
	$res = mysqli_query($con, $sql);
?>

		<script>
		function showUser(str) {
		  if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHint").innerHTML = this.responseText;
			  }
			};
			xmlhttp.open("GET","pilotdropdown.php?q="+str,true);
			xmlhttp.send();
		  }
		}
		</script>
<?php
echo'<li>';
?>

		<select onchange="showUser(this.value)">
		<option value="">Select a Pilot:</option>
		<?php while( $rows = mysqli_fetch_array($res)){
			?>

		  <option value="<?php echo $rows['pe_dataplayers_id'];  ?> " > <?php  echo $rows['pe_dataplayers_lastname'] ;  ?> </option>
		  
		     
		  <?php
		  
		  }
		  ?>	
		  		 
		  </select>
		  		  		  

		
		<?php
		echo'</li>';
		
		?>


<?php   //teamdropdown selection box
	
	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="SELECT DISTINCT
	a.pe_teams_name AS value_teamname, 
	a.pe_teams_id
	FROM pe_teams AS a";
	$res = mysqli_query($con, $sql);
?>

		<script>
		function showTeam(str) {
		  if (str == "") {
			document.getElementById("txtHinty").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHinty").innerHTML = this.responseText;
			  }
			};
			xmlhttp.open("GET","teamdropdown.php?y="+str,true);
			xmlhttp.send();
		  }
		}
		</script>
<?php
echo'<li>';
?>

		<select onchange="showTeam(this.value)">
		<option value="">Select a Team:</option>
		<?php while( $rows = mysqli_fetch_array($res)){
			?>

		  <option value="<?php echo $rows['value_teamname'];  ?> " > <?php  echo $rows['value_teamname'] ;  ?> </option>
		  
		     
		  <?php
		  
		  }
		  ?>	
		  		 
		  </select>
		  		  		  

		
		<?php
		echo'</li>';
		
		?>



<?php   //squadrondropdown selection box
	
	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="SELECT DISTINCT
	a.pe_squadrons_name AS value_squadronname, 
	a.pe_squadrons_id
	FROM pe_squadrons AS a";
	$res = mysqli_query($con, $sql);
?>

		<script>
		function showSquadron(str) {
		  if (str == "") {
			document.getElementById("txtHints").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHints").innerHTML = this.responseText;
			  }
			};
			xmlhttp.open("GET","squadrondropdown.php?s="+str,true);
			xmlhttp.send();
		  }
		}
		</script>
<?php
echo'<li>';
?>

		<select onchange="showSquadron(this.value)">
		<option value="">Select a Squadron:</option>
		<?php while( $rows = mysqli_fetch_array($res)){
			?>

		  <option value="<?php echo $rows['value_squadronname'];  ?> " > <?php  echo $rows['value_squadronname'] ;  ?> </option>
		  
		     
		  <?php
		  
		  }
		  ?>	
		  		 
		  </select>
		  		  		  

		
		<?php
		echo'</li>';
		
		?>



		
		
		<?php 
		echo'<li>';
		?>
		<b style="color: white">...Server Restart:</b>
		<b style="color: white" id="demo">Winding up...</b>

		<?php
		echo'</li>';
		?>		
		
		
		<?php
		echo'</ul>';
		?>
		
		
		 
<?php
echo
'

	<h1 style="font-family:Geostar;color:#111;font-size:40px;margin:5px 1px 1px 1px;"><a href="https://assets.change.org/photos/6/fc/nj/QKFcNjvVRqvmWNq-800x450-noPad.jpg?1552876930"><img src="moonlight.png" alt="Paris" width=44.4444" height="33.33333"></a>  Moonlight Regiment : Stats  <a href="https://assets.change.org/photos/6/fc/nj/QKFcNjvVRqvmWNq-800x450-noPad.jpg?1552876930"><img src="moonlight.png" alt="Paris" width=44.4444" height="33.33333"></a> Cold War Server <a href="https://assets.change.org/photos/6/fc/nj/QKFcNjvVRqvmWNq-800x450-noPad.jpg?1552876930"><img src="moonlight.png" alt="Paris" width=44.4444" height="33.33333"></a></h1>
	
	<title>DCS Stats</title>
    <meta charset="utf-8">
    <meta name="description" content="WTF DCS Statistics">
    <meta name="keywords" content="wtf stats dcs world perun">
    <meta name="author" content="Dr.No (The Dude)">
	
	';	
?> 
	


	
	
	<!-- <h1 style="color:#780000;">SQL Database Manipulation</h1> -->

<!--
	<form method="post">		

						
		<input type="submit" name="button1"
				value="UPDATE DATA"/>				
			
	</form>	
-->

<?php

			
		if(isset($_POST['button8'])) {


			////////////////////////////////////////////////////////////////////////////////////
			/////////////////UPDATE DATA BUTTON///////
			////////////////////////////////////////////////////////////////////////////////////

			// Make Updates to columns in the database first before querying ... started with Hardcore/Realistic and now encompasses everything
			require "updates.inc.php";

			///////////////////END PILOT ID DELETION/////////////////////

			echo "<h1 style='color:black;font-size:14px;'>DATA HAS BEEN <u><i>UPDATED.</u></i></h1>";

		}


				
	?>

		<h4>
		<div id="txtHint"></div>
		<div id="txtHinty"></div>
		<div id="txtHints"></div>
		</h4>

		
<?php
/* 	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="SELECT DISTINCT
	a.pe_dataplayers_lastname
	FROM pe_dataplayers AS a";
	$res = mysqli_query($con, $sql); */
?>		
		
		<script>
		function showCustomer(str) {
		var xhttp;
		if (str == "") {
			document.getElementById("txtHint1").innerHTML = "";
		return;
		}
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("txtHint1").innerHTML = this.responseText;
		}
		};
		xhttp.open("GET", "getpilotdata.php?z="+str, true);
		xhttp.send();
		}
		</script>



