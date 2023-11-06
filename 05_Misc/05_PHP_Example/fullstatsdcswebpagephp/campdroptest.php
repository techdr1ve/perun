<?php

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
?>


<?php //campaigndropdown selection box

	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="

SELECT DISTINCT
	f.pe_DataMissionHashes_hash,
	b.`pe_LogEvent_airframe`,
	d.`pe_finalflightduration_id`,
	f.pe_DataMissionHashes_datetime,
	SUBSTRING(f.`pe_DataMissionHashes_hash`, 6, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 35) AS value_campaign,
	SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) AS value_mission
	
	FROM pe_LogEvent AS b
	INNER JOIN `pe_DataMissionHashes` AS f 
	ON b.`pe_LogEvent_missionhash_id` = f.`pe_DataMissionHashes_id`
	LEFT JOIN `pe_finalflightduration` AS d
	ON b.pe_LogEvent_datetime = d.pe_finalflightduration_takeoffdatetime
	INNER JOIN `pe_CampaignDetails` AS k
	ON b.`pe_LogEvent_missionhash_id` = k.`pe_CampaignDetails_missionhash_id`  		
	
	WHERE b.`pe_LogEvent_airframe` NOT IN('?_-1','instructor', 'observer', 'forward_observer') AND
	(SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) LIKE '%DSMC%') 

	GROUP BY value_campaign
	ORDER BY pe_DataMissionHashes_datetime DESC

	
	";
	
	$res = mysqli_query($con, $sql);
?>

		<script>
		function showCampaign(str) {
		  if (str == "") {
			document.getElementById("txtHintc").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHintc").innerHTML = this.responseText;
			  }
			};
			xmlhttp.open("GET","campaigndropdown.php?c="+str,true);
			xmlhttp.send();
		  }
		}
		</script>


		<select onchange="showCampaign(this.value)">
		<option value="">Select a Campaign:</option>
		<?php while( $rows = mysqli_fetch_array($res)){
			?>

		  <option value="<?php echo $rows['value_campaign'];  ?> " > <?php  echo $rows['value_campaign'] ;  ?> </option>
		  
		     
		  <?php
		  
		  }
		  ?>	
		  		 
		  </select>
		  		  		  

		


<?php   //missiondropdown selection box
	
	$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
	$sql ="SELECT DISTINCT
	f.pe_DataMissionHashes_hash,
	b.`pe_LogEvent_airframe`,
	d.`pe_finalflightduration_id`,
	SUBSTRING(f.`pe_DataMissionHashes_hash`, 6, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 35) AS value_campaign,
	SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) AS value_mission
	
	FROM pe_LogEvent AS b
	INNER JOIN `pe_DataMissionHashes` AS f 
	ON b.`pe_LogEvent_missionhash_id` = f.`pe_DataMissionHashes_id`
	LEFT JOIN `pe_finalflightduration` AS d
	ON b.pe_LogEvent_datetime = d.pe_finalflightduration_takeoffdatetime
	INNER JOIN `pe_CampaignDetails` AS k
	ON b.`pe_LogEvent_missionhash_id` = k.`pe_CampaignDetails_missionhash_id`  		
	
	WHERE b.`pe_LogEvent_airframe` NOT IN('?_-1','instructor', 'observer', 'forward_observer') AND
	(SUBSTRING(f.`pe_DataMissionHashes_hash`, 1, CHAR_LENGTH(f.`pe_DataMissionHashes_hash`) - 26) LIKE '%DSMC%') AND
	(d.`pe_finalflightduration_id`) IS NOT NULL

	GROUP BY value_campaign, pe_CampaignDetails_datetime
	ORDER BY pe_CampaignDetails_datetime DESC

	";
	
	$res = mysqli_query($con, $sql);
?>

		<script>
		function showMission(str) {
		  if (str == "") {
			document.getElementById("txtHintm").innerHTML = "";
			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHintm").innerHTML = this.responseText;
			  }
			};
			xmlhttp.open("GET","missiondropdown.php?m="+str,true);
			xmlhttp.send();
		  }
		}
		</script>


		<select onchange="showMission(this.value)">
		<option value="">Select a Mission:</option>
		<?php while( $rows = mysqli_fetch_array($res)){
			?>

		  <option value="<?php echo $rows['value_mission'];  ?> " > <?php  echo $rows['value_mission'] ;  ?> </option>
		  
		     
		  <?php
		  
		  }
		  ?>	
		  		 
		  </select>
		  		  		  

<h4>
<div id="txtHintc"></div>
<div id="txtHintm"></div>
</h4>