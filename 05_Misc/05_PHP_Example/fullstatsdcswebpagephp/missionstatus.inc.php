<?php
//				echo "<h3>PLEASE FOR THE LOVE OF GOD WORK</h3>";
				$result = $mysqli->query("SELECT a.`pe_OnlineStatus_updated`, a.`pe_OnlineStatus_mission_name`, a.`pe_OnlineStatus_mission_theatre` AS currentmapname, a.`pe_OnlineStatus_server_players`, FORMAT((a.`pe_OnlineStatus_mission_modeltime`/3600),1) AS mission_time, FORMAT((720 - a.`pe_OnlineStatus_mission_modeltime`/60),0) AS reset_time, a.`pe_OnlineStatus_server_players`- 1 AS server_players, a.`pe_OnlineStatus_server_pause`, CASE WHEN(a.`pe_OnlineStatus_server_pause`= 1) THEN 'Yes' ELSE 'No' END AS server_pause, a.`pe_OnlineStatus_time_in_mission` FROM pe_onlinestatus AS a ORDER BY pe_OnlineStatus_instance DESC LIMIT 1");
				if ($row = $result->fetch_object()) {
					
					echo "Last Update is [" . $row->pe_OnlineStatus_updated . "], on Mission: [" . $row->pe_OnlineStatus_mission_name . "], in Map: [" . $row->currentmapname .  "], Running for: [" . $row->mission_time . "]hrs, Start Time in Mission: [" . $row->pe_OnlineStatus_time_in_mission . "], Mission Ends in: [" . $row->reset_time . "]min, with Player Count: [" . $row->server_players . "], and is Server Paused?: [" . $row->server_pause .  "].";

					$currentmap[]  = strval($row->currentmapname);
					//echo $row->currentmapname;
					//echo "MarianaIslands";
					//$currentmap = "MarianaIslands";
				}

				#servercolor ===COLOR KEY MAP===
				#bc910c - light brown - (DUSTY DESERT) - SYRIA, PERSIANGULF
				#96c193 - light green - (FORREST AREAS) - CAUCASUS, FALKLANDISLANDS
				#a2c4c9 - light blue  - (MAINLY OCEAN) -  MARIANAISLANDS
				#b6b3b3 - light grey  - (OLD WWII WARS) - CHANNEL, NORMANDY
				#d19595 - light red   - (REDFLAG EXERCISES) - NEVADA 
				
				if ($currentmap == ["MarianaIslands"])
				{
					$servercolor = "#a2c4c9"; //blue
				}
				elseif($currentmap == ["Caucasus"])
				{
					$servercolor = "#96c193"; //green
				}
				elseif($currentmap == ["FalklandIslands"])
				{
					$servercolor = "#96c193"; //green
				}
				elseif($currentmap == ["Syria"])
				{
					$servercolor = "#bc910c"; //brown
				}
				elseif($currentmap == ["PersianGulf"])
				{
					$servercolor = "#bc910c"; //brown
				}
				elseif($currentmap == ["Nevada"])
				{
					$servercolor = "#d19595"; //red
				}
				elseif($currentmap == ["Normandy"])
				{
					$servercolor = "#b6b3b3"; //grey
				}
				elseif($currentmap == ["Channel"])
				{
					$servercolor = "#b6b3b3"; //grey
				}					
				else
				{
					$servercolor = "#f2c846"; //yellow caution! map not loaded correctly
				}


?>
            

	<style>
		body {
				background-color: <?php echo $servercolor; ?>;
		}	
	</style>