<!-- This is integration example for https://github.com/szporwolik/perun - please keep the code as simple and straightforward as possible -->
<!DOCTYPE html>
<html>
  <head>

	<style>
	<?php
	require "style.inc.php"; // include style
	?>
	</style>



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


?>
	
	<h1 style="color:#780000;">Installation of FE Webpage & SQL Database Manipulation</h1>

		<br> Click the two buttons below in succession to Install Full Stats DB and FE Webpage elements, then Update<br>
		(Note: WAIT for confirmation of each before clicking the next button)<br>


	
<?php
	

?>

	<form method="post">		

		<br><br>					
		<input type="submit" name="button1"
				value="1. INSTALL: ADD RANKS & MEDALS REFERENCE DATA"/>				
			
	</form>

	<form method="post">		

		<br><br>					
		<input type="submit" name="button8"
				value="2. UPDATE: SQL DATA"/>				
			
	</form>

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

<?php

		if(isset($_POST['button1'])) {


			////////////////////////////////////////////////////////////////////////////////////
			/////////////////CREATE MILITARY BRANCHES FOR EACH AIRFRAME - REFERENCE TABLE///////
			////////////////////////////////////////////////////////////////////////////////////

			//DROP TABLE if exists
			$sql = "DROP TABLE IF EXISTS pe_militarybranch";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table 
			$sql = 'CREATE TABLE IF NOT EXISTS pe_militarybranch (
			pe_militarybranch_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pe_militarybranch_airframename VARCHAR(100) DEFAULT NULL,			
			pe_militarybranch_datatype VARCHAR(100) DEFAULT NULL,
			pe_militarybranch_branch VARCHAR(100) DEFAULT NULL
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

			// INSERT change_slots start time and +2min from pe_LogEvent
			$sql = 'INSERT INTO pe_militarybranch
			(pe_militarybranch_airframename,
			pe_militarybranch_datatype,
			pe_militarybranch_branch)
			VALUES ("Grumman F-14B Tomcat","F-14B", "Navy"),
			("Grumman F-14B Tomcat_2","F-14B_2", "Navy"),
			("Lockheed F-104G Starfighter","VSN_F104G", "Air Force"),
			("Lockheed F-104S Starfighter","VSN_F104S", "Air Force"),
			("Lockheed F-104S AG Starfighter","VSN_F104S_AG", "Air Force"),
			("Lockheed YF-12A SR-71 Blackbird","VSN_YF12A", "Air Force"),
			("Republic F-105D Thunderchief","VSN_F105D", "Air Force"),
			("Republic F-105G Thunderchief","VSN_F105G", "Air Force"),
			("McDonnell Douglas F-4B Phantom II","VSN_F4B", "Navy"),
			("McDonnell Douglas F-4C Phantom II","VSN_F4C", "Air Force"),			
			("Northrop F-5E-3 Tiger II","F-5E-3", "Air Force"),			
			("McDonnell Douglas F/A-18C Hornet","FA-18C_hornet", "Navy"),
			("Mikoyan MiG-29S Fulcrum","MiG-29S", "Air Force"),
			("Focke-Wulf Fw 190 Wurger","FW-190D9", "Air Force"),
			("North American F-86F Sabre","F-86F Sabre", "Air Force"),			
			("de Havilland DH.98 Mosquito FBVI","MosquitoFBMkVI",	"Air Force"),
			("McDonnell Douglas F-15C Eagle", "F-15C", "Air Force"),
			("McDonnell Douglas AV-8B Harrier II Night Attack V/STOL", "AV8BNA", "Marines"),
			("Saab AJS37 Viggen","AJS37", "Air Force"),
			("General Dynamics F-16C Block 50 Fighting Falcon aka Viper","F-16C_50", "Air Force"),
			("Lockheed C-130 Hercules","Hercules", "Air Force"),
			("Lockheed C-130 Hercules_2", "Hercules_2", "Air Force"),
			("Fairchild Republic A-10C Thunderbolt aka Warthog","A-10C", "Air Force"),
			("Fairchild Republic A-10A Thunderbolt aka Warthog","A-10A", "Air Force"),
			("Fairchild Republic A-10C II Thunderbolt aka Warthog","A-10C_2",	"Air Force"),
			("CAC/PAC JF-17 Thunder","JF-17", "Air Force"),
			("Kamov Ka-50 Blackshark 2", "Ka-50", "Army"),
			("Douglas A-4E-C Skyhawk","A-4E-C", "Navy"),
			("Dassault M-2000C Mirage","M-2000C", "Air Force"),
			("Observer View","observer", "N/A"),
			("Instructor View","instructor", "N/A"),
			("Tactical Commander View","artillery_commander", "N/A"),
			("Forward Observer View","forward_observer", "N/A"),
			("Shenyang J-11A Flanker-L","J-11A", "Air Force"),
			("Mil Mi-8MT Hip","Mi-8MT", "Army"),
			("Sukhoi Su-27 Flanker","Su-27", "Air Force"),
			("Grumman F-14A Tomcat","F-14A-135-GR", "Navy"),
			("Grumman F-14A Tomcat_2","F-14A-135-GR_2", "Navy"),
			("Submarine Spitfire LF Mk IX","SpitfireLFMkIX", "Air Force"),
			("Sukhoi Su-33 Flanker-D", "Su-33", "Navy"),
			("Sukhoi Su-25 Frogfoot","Su-25", "Air Force"),
			("Sukhoi Su-25T Frogfoot", "Su-25T", "Air Force"),
			("Mikoyan-Gurevich MiG-15 Bis Fagot", "MiG-15bis", "Air Force"),			
			("Mikoyan-Gurevich MiG-19P Farmer", "MiG-19P", "Air Force"),			
			("Mikoyan-Gurevich MiG-21 Bis Fishbed","MiG-21Bis", "Air Force"),
			("Mikoyan MiG-29A Fulcrum","MiG-29A", "Air Force"),
			("Mikoyan MiG-29G Fulcrum","MiG-29G", "Air Force"),
			("Bell UH-1 Iroquois aka Huey_1","UH-1H", "Army"),
			("Bell UH-1 Iroquois aka Huey_2","UH-1H_2",	"Army"),
			("Bell UH-1 Iroquois aka Huey_3","UH-1H_3",	"Army"),
			("Bell UH-1 Iroquois aka Huey_4","UH-1H_4",	"Army"),
			("North American Rockwell OV-10 Bronco", "Bronco-OV-10A", "Army"),
			("North American F-100 Super Sabre","VSN_F100", "Air Force"),			
			("BF-109 K-4 Kurfurst","Bf-109K-4", "Air Force"),
			("Focke-Wulf FW-190A8 Shrike ", "FW-190A8","Air Force"),			
			("Aerospatiale Gazelle SA342M","SA342M", "Army"),
			("Aerospatiale Gazelle SA342Mistral","SA342Mistral", "Army"),
			("Aerospatiale Gazelle SA342L","SA342L", "Army"),
			("Aerospatiale Gazelle SA342Minigun","SA342Minigun", "Army"),
			("Boeing AH-6 Littlebird","AH-6", "Army"),
			("Boeing CH-47 Chinook","Ch47_Chinook", "Army"),
			("Boeing AH-64 Apache","AH-64D_BLK_II", "Army"),			
			("Republic P-47D-30 Thunderbolt", "P-47D-30", "Air Force"),
			("Republic P-47D-30bl1 Thunderbolt","P-47D-30bl1", "Air Force"),			
			("Republic P-47D-40 Thunderbolt","P-47D-40", "Air Force"),
			("North American P-51D-30-NA Mustang", "P-51D-30-NA","Air Force"),
			("North American P-51D", "P-51D","Air Force"),			
			("Aero L-39C Albatros", "L-39C", "Air Force"),
			("Aero L-39C_2 Albatros", "L-39C_2", "Air Force"),
			("Aero L-39ZA Albatros", "L-39ZA", "Air Force"),			
			("CASA C-101EB Aviojet","C-101EB",	"Air Force"),
			("CASA C-101CC Aviojet","C-101CC",	"Air Force"),
			("CASA C-101CC Aviojet_2","C-101CC_2", "Air Force"),
			("North American TF-51D Mustang", "TF-51D","Air Force"),
			("Embraer EMB 314 Super Tucano aka A-29B","A-29B", "Air Force"),
			("Mil Mi-24P Hind","Mi-24P", "Army"),			
			("McDonnell Douglas T-45 Goshawk","T-45", "Navy"),
			("Wright Flyer aka Flyer 1 or 1903 Flyer", "Flyer1", "Air Force"),
			("N/A","?_-1", "N/A")
			';

			if ($mysqli->query($sql) === TRUE) {
			//echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}



			///////////////////////////////////////////////////////////////////////
			/////////////////CREATE MEDALS for EACH NATION - REFERENCE TABLE///////
			///////////////////////////////////////////////////////////////////////

			//DROP TABLE if exists
			$sql = "DROP TABLE IF EXISTS pe_medalsdb";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table 
			$sql = 'CREATE TABLE IF NOT EXISTS pe_medalsdb (
			pe_medalsdb_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pe_medalsdb_award VARCHAR(100) DEFAULT NULL,
			pe_medalsdb_nation VARCHAR(100) DEFAULT NULL,
			pe_medalsdb_branch VARCHAR(100) DEFAULT NULL,			
			pe_medalsdb_reqs VARCHAR(100) DEFAULT NULL,
			pe_medalsdb_imagename VARCHAR(100) DEFAULT NULL,
			pe_medalsdb_awardinenglish VARCHAR(100) DEFAULT NULL,
			pe_medalsdb_awardinnativelanguage VARCHAR(100) DEFAULT NULL
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

			// INSERT change_slots start time and +2min from pe_LogEvent
			$sql = 'INSERT INTO pe_medalsdb
			(pe_medalsdb_award,
			pe_medalsdb_nation,
			pe_medalsdb_branch,			
			pe_medalsdb_reqs,
			pe_medalsdb_imagename,
			pe_medalsdb_awardinenglish,
			pe_medalsdb_awardinnativelanguage)


			VALUES("Georgy Cross-IV", "Russia","Air Force", "25 Flights OR 1 A2G Ship OR 3 A2A", "RUS-05-GeorgyCross-4.png", "Georgy Cross-IV", "Znak otlichiya - Georgievskiy Krest
			IV stepeni"),
			("Georgy Cross-IV", "Russia","Army", "3 A2A OR A2G(4 Tank|APC|LUV OR 3 Air Defense OR 4 Artillery OR 20 Infantry OR 20 Unarmed)", "RUS-05-GeorgyCross-4.png", "Georgy Cross-IV", "Znak otlichiya - Georgievskiy Krest
			IV stepeni"),
			("Georgy Cross-IV", "Russia","Navy", "25 Flights OR 1 A2G Ship OR 3 A2A", "RUS-05-GeorgyCross-4.png", "Georgy Cross-IV", "Znak otlichiya - Georgievskiy Krest
			IV stepeni"),
			("Military Serve Order", "Russia","Air Force | Army | Navy", "A2G 10*(Tank|APC|LUV  + Air Defense + Ship + Infantry + Artillery)" , "RUS-04-MilitaryServe.png", "Military Serve Order", "Orden «Za sluzhbu Rodine v Vooruzhonnykh Silakh SSSR"),
			("Medal of Courage", "Russia","Air Force | Army | Navy", "5 A2A" , "RUS-02-MeritMedal.png", "Medal of Courage", " Medal Za otvagu"),
			("Nesterov Medal", "Russia","Air Force | Army | Navy","15 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + Infantry + Artillery)", "RUS-03-NesterovMedal.png", "Nesterov Medal", "Medal Nesterova"),			
			("Georgy Cross-I", "Russia", "Air Force","10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "RUS-07-GeorgyCross-1.png", "Georgy Cross-I", "Znak otlichiya - Georgievskiy Krest
			I stepeni"),
			("Georgy Cross-I", "Russia", "Army","10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2) + Artillery)", "RUS-07-GeorgyCross-1.png", "Georgy Cross-I", "Znak otlichiya - Georgievskiy Krest
			I stepeni"),
			("Georgy Cross-I", "Russia", "Navy","10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "RUS-07-GeorgyCross-1.png", "Georgy Cross-I", "Znak otlichiya - Georgievskiy Krest
			I stepeni"),			
			("Hero Gold Star", "Russia", "Air Force","20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "RUS-08-HeroStar.png", "Hero Gold Star", "Geroy Rossiyskoy Federatsii"),
			("Hero Gold Star", "Russia", "Army","20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2) + Artillery)", "RUS-08-HeroStar.png", "Hero Gold Star", "Geroy Rossiyskoy Federatsii"),
			("Hero Gold Star", "Russia", "Navy","20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "RUS-08-HeroStar.png", "Hero Gold Star", "Geroy Rossiyskoy Federatsii"),
			("Medal For Merit To Fatherland-II with swords", "Russia","Air Force", "1 A2G TELMissile", "RUS-06-ForMeritToFatherland-2.png", "Medal For Merit To Fatherland-II with swords", "Medal ordena «Za zaslugi pered Otechestvom» II stepeni s mechami"),
			("Medal For Merit To Fatherland-II with swords", "Russia","Army", "1 A2G TELMissile", "RUS-06-ForMeritToFatherland-2.png", "Medal For Merit To Fatherland-II with swords", "Medal ordena «Za zaslugi pered Otechestvom» II stepeni s mechami"),	
			("Medal For Merit To Fatherland-II with swords", "Russia","Navy", "1 A2G TELMissile", "RUS-06-ForMeritToFatherland-2.png", "Medal For Merit To Fatherland-II with swords", "Medal ordena «Za zaslugi pered Otechestvom» II stepeni s mechami"),	

			("Medal Zakhystnyku Vitchyzny", "Ukraine","ALL", "200", "UKR-01-ForDefenderOfFatherland.png", "Medal For Defender Of Fatherland", "Medal Zakhystnyku Vitchyzny"),
			("Orden Za Zaslugy III", "Ukraine", "ALL","600", "UKR-02-ForMerit-III.png", "Order For Merit-III", "Orden Za Zaslugy III"),
			("Orden Za Zaslugy II", "Ukraine","ALL", "1000", "UKR-03-ForMerit-II.png", "Order For Merit-II", "Orden Za Zaslugy II"),
			("Orden Za Zaslugy I", "Ukraine","ALL", "1400", "UKR-04-ForMerit-I.png", "Order For Merit-I", "Orden Za Zaslugy I"),
			("Orden Za Zaslugy", "Ukraine","ALL", "1800", "UKR-05-ForMerit-Star.png", "Order For Merit-Star", "Orden Za Zaslugy"),
			("Orden Za Viyskovu Sluzhbu", "Ukraine", "ALL","2200", "UKR-06-ForMilitaryService.png", "Medal for Military Service", "Medal Za Viyskovu Sluzhbu"),
			("Orden Za Muzhnist", "Ukraine","ALL", "2600", "UKR-07-OrderForCourage.png", "Order For Courage", "Orden Za Muzhnist"),
			("Zolota Zirka", "Ukraine","ALL", "3000", "UKR-08-GoldStar.png", "Gold Star", "Zolota Zirka"),

			("Air Medal",  "USA", "Air Force","25 Flights OR 1 A2G Ship OR 3 A2A", "US-01-AirMedal.png", "Air Medal", "Air Medal"),
			("Air Medal", "USA", "Army", "3 A2A OR A2G(4 Tank|APC|LUV OR 3 Air Defense OR 4 Artillery OR 20 Infantry OR 20 Unarmed)", "US-14-AirMedalArmy.png", "Air Medal", "Air Medal"),			
			("Air Medal", "USA", "Navy(+USMC)","25 Flights OR 1 A2G Ship OR 3 A2A", "US-15-AirMedalNavyMarines.png", "Air Medal", "Air Medal"),			
			("Bronze Star", "USA", "Air Force | Army | Navy(+USMC)", "A2G 10*(Tank|APC|LUV  + Air Defense + Ship + (Infantry/2) + Artillery)", "US-03-BronzeStar.png", "Bronze Star", "Bronze Star"),	
			("Silver Star", "USA","Air Force | Army | Navy(+USMC)", "5 A2A ", "US-06-SilverStar.png", "Silver Star", "Silver Star"),
			("Distinguished Flying Cross",  "USA","Air Force | Army | Navy(+USMC)", "15 A2A OR A2G 45*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2) + Artillery)", "US-05-DistinguishedFlyingCross.png", "Distinguished Flying Cross", "Distinguished Flying Cross"),				
			("Air Force Cross", "USA","Air Force", "10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "US-07-AirForceCross.png", "Air Force Cross", "Air Force Cross"),
			("Distinguished Service Cross", "USA", "Army","10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2) + Artillery)", "US-02-DistinguishedServiceCross.png", "Distinguished Service Cross", "Distinguished Service Cross"),
			("Navy Cross", "USA", "Navy(+USMC)", "10 A2A OR A2G 30*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "US-09-NavyandMarinesCross.png", "Navy(+USMC) Cross", "Navy(+USMC) Cross"),					
			("Medal of Honor",  "USA","Air Force", "20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "US-08-AirForceMedalOfHonour.png", "Medal of Honor", "Medal of Honor"),
			("Medal of Honor",  "USA", "Army","20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2) + Artillery)", "US-16-ArmyMedalOfHonour.png", "Medal of Honor", "Medal of Honor"),
			("Medal of Honor", "USA", "Navy(+USMC)","20 A2A AND A2G 40*(Tank|APC|LUV + Air Defense + Ship + (Infantry/2))", "US-17-NavyMedalOfHonour.png", "Medal of Honor", "Medal of Honor"),			
			("Presidential Unit Citation",  "USA","Air Force", "1 A2G TELMissile", "US-010-PresidentialUnitCitationAirForce.png", "Presidential Unit Citation", "Presidential Unit Citation"),
			("Presidential Unit Citation",  "USA","Army", "1 A2G TELMissile", "US-010-PresidentialUnitCitationArmy.png", "Presidential Unit Citation", "Presidential Unit Citation"),			
			("Presidential Unit Citation",  "USA","Navy(+USMC)", "1 A2G TELMissile", "US-011-PresidentialUnitCitationNavyandMarines.png", "Presidential Unit Citation", "Presidential Unit Citation")		
			

			';

// ADDITIONAL MEDALS TO BE ADDED
/* 			("Airmans Medal", "USA","ALL","1400", "US-04-AirmansMedal.png", "Airmans Medal", "Airmans Medal"),			
			("Soldiers Medal", "USA", "1400", "US-12-SoldiersMedal.png", "Soldiers Medal", "Soldiers Medal"),
			("Navy and Marine Corps Medal", "USA", "1400", "US-13-NavyandMarineCorpsMedal.png", "Navy and Marine Corps Medal", "Navy and Marine Corps Medal")	 */
//////////////END///////////////


			if ($mysqli->query($sql) === TRUE) {
			//echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}





			///////////////////////////////////////////////////////////////////////
			/////////////////CREATE Officer "O" RANKS for EACH NATION - REFERENCE TABLE///////
			///////////////////////////////////////////////////////////////////////

			//DROP TABLE if exists
			$sql = "DROP TABLE IF EXISTS pe_Oranksdb";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table 
			$sql = 'CREATE TABLE IF NOT EXISTS pe_Oranksdb(
			pe_Oranksdb_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pe_Oranksdb_nation VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_branch VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_rank VARCHAR(100) DEFAULT NULL,			
			pe_Oranksdb_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_value VARCHAR(100) DEFAULT NULL



			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			';

/*						pe_Oranksdb_O2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O2_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O3_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O4_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O5_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O6_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O6_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O6_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O6_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O7_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O7_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O7_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O7_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O8_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O8_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O8_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O8_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O9_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O9_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O9_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O9_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O10_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O10_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O10_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O10_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O11_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O11_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O11_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_O11_value VARCHAR(100) DEFAULT NULL

 			pe_Oranksdb_AR_O1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O1_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O2_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O3_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O4_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O5_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O6_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O6_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O6_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O6_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O7_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O7_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O7_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O7_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O8_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O8_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O8_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O8_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O9_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O9_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O9_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O9_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O10_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O10_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O10_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O10_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O11_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O11_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O11_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_AR_O11_value VARCHAR(100) DEFAULT NULL,

			pe_Oranksdb_MA_O1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O1_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O2_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O3_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O4_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O5_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O6_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O6_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O6_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O6_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O7_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O7_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O7_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O7_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O8_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O8_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O8_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O8_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O9_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O9_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O9_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O9_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O10_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O10_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O10_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O10_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O11_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O11_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O11_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_MA_O11_value VARCHAR(100) DEFAULT NULL,

			pe_Oranksdb_NV_O1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O1_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O2_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O3_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O4_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O5_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O6_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O6_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O6_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O6_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O7_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O7_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O7_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O7_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O8_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O8_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O8_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O8_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O9_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O9_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O9_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O9_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O10_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O10_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O10_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O10_value VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O11_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O11_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O11_titleshort VARCHAR(100) DEFAULT NULL,
			pe_Oranksdb_NV_O11_value VARCHAR(100) DEFAULT NULL */

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

/* 			pe_Oranksdb_O2_titlelongenglish,
			pe_Oranksdb_O2_titlelongnative,
			pe_Oranksdb_O2_titleshort,
			pe_Oranksdb_O2_value,
			pe_Oranksdb_O3_titlelongenglish,
			pe_Oranksdb_O3_titlelongnative,
			pe_Oranksdb_O3_titleshort,
			pe_Oranksdb_O3_value,
			pe_Oranksdb_O4_titlelongenglish,
			pe_Oranksdb_O4_titlelongnative,
			pe_Oranksdb_O4_titleshort,
			pe_Oranksdb_O4_value,
			pe_Oranksdb_O5_titlelongenglish,
			pe_Oranksdb_O5_titlelongnative,
			pe_Oranksdb_O5_titleshort,
			pe_Oranksdb_O5_value,
			pe_Oranksdb_O6_titlelongenglish,
			pe_Oranksdb_O6_titlelongnative,
			pe_Oranksdb_O6_titleshort,
			pe_Oranksdb_O6_value,
			pe_Oranksdb_O7_titlelongenglish,
			pe_Oranksdb_O7_titlelongnative,
			pe_Oranksdb_O7_titleshort,
			pe_Oranksdb_O7_value,
			pe_Oranksdb_O8_titlelongenglish,
			pe_Oranksdb_O8_titlelongnative,
			pe_Oranksdb_O8_titleshort,
			pe_Oranksdb_O8_value,
			pe_Oranksdb_O9_titlelongenglish,
			pe_Oranksdb_O9_titlelongnative,
			pe_Oranksdb_O9_titleshort,
			pe_Oranksdb_O9_value,
			pe_Oranksdb_O10_titlelongenglish,
			pe_Oranksdb_O10_titlelongnative,
			pe_Oranksdb_O10_titleshort,
			pe_Oranksdb_O10_value,
			pe_Oranksdb_O11_titlelongenglish,
			pe_Oranksdb_O11_titlelongnative,
			pe_Oranksdb_O11_titleshort,
			pe_Oranksdb_O11_value */

			// INSERT ranks into pe_Oranksdb
			$sql = 'INSERT INTO pe_Oranksdb
			(pe_Oranksdb_nation,
			pe_Oranksdb_branch,
			pe_Oranksdb_rank,
			pe_Oranksdb_titlelongenglish,
			pe_Oranksdb_titlelongnative,
			pe_Oranksdb_titleshort,
			pe_Oranksdb_value

			)


			VALUES("Russia",
			"Air Force",
			"O-1",
			"Junior Lieutenant", 
			"Mládshiy leytenánt", 
			"JrLt", 
			"0 to 0.5 Hours"
			),
			("Russia",
			"Air Force",
			"O-2",
			"Lieutenant", 
			"leytenánt", 
			"Lt", 
			"0.5 to 1 Hours"
			),
			("Russia",
			"Air Force",
			"O-3",
			"Senior Lieutenant", 
			"Stárshiy leytenánt", 
			"SrLt", 
			"1 to 2 Hours"
			),
			("Russia",
			"Air Force",
			"O-4",
			"Captain", 
			"Kapitán", 
			"Capt", 
			"2 to 4 Hours"
			),
			("Russia",
			"Air Force",			
			"O-5",
			"Major", 
			"Mayór", 
			"Maj", 
			"4 to 7 Hours"
			),
			("Russia",
			"Air Force",
			"O-6",
			"Lieutenant Colonel", 
			"Podpolkóvnik", 
			"LtCol", 
			"7 to 10 Hours"
			),
			("Russia",
			"Air Force",
			"O-7",
			"Colonel", 
			"Polkóvnik", 
			"Col", 
			"10 to 13 Hours"
			),
			("Russia",
			"Air Force",
			"O-8",
			"Major General", 
			"Generál-mayór", 
			"MajGen", 
			"13 to 17 Hours"
			),
			("Russia",
			"Air Force",			
			"O-9",
			"Lieutenant General", 
			"Generál-leytenánt", 
			"LtGen", 
			"17 to 21 Hours"
			),
			("Russia",
			"Air Force",			
			"O-10",
			"Colonel General", 
			"Generál-polkóvnik", 
			"ColGen", 
			"21 to 25 Hours"
			),
			("Russia",
			"Air Force",			
			"O-11",
			"General of the Air Force", 
			"Generál ármii", 
			"GAF", 
			"25 or More Hours" 
			),	
			 
			("Russia",
			"Army",
			"O-1",			
			"First Lieutenant",
			"Leytenánt",
			"Lt",
			"0 to 0.5 Hours"
			),
			("Russia",
			"Army",
			"O-2",				
			"Senior Lieutenant", 
			"Stárshiy leytenánt", 
			"SrLt", 
			"0.5 to 1 Hours"
			),
			("Russia",
			"Army",
			"O-3",
			"Captain", 
			"Kapitán", 
			"Capt", 
			"1 to 2 Hours"
			),
			("Russia",
			"Army",
			"O-4",
			"Major", 
			"Mayór", 
			"Maj", 
			"2 to 4 Hours"
			),
			("Russia",
			"Army",
			"O-5",
			"Lieutenant Colonel", 
			"Podpolkóvnik", 
			"LtCol", 
			"4 to 7 Hours"
			),
			("Russia",
			"Army",
			"O-6",
			"Colonel", 
			"Polkóvnik", 
			"Col", 
			"7 to 10 Hours"
			),
			("Russia",
			"Army",
			"O-7",			
			"Major General", 
			"Generál-mayór", 
			"MajGen", 
			"10 to 13 Hours"
			),
			("Russia",
			"Army",
			"O-8",
			"Lieutenant General", 
			"Generál-leytenánt", 
			"LtGen", 
			"13 to 17 Hours"
			),
			("Russia",
			"Army",
			"O-9",
			"Colonel General", 
			"Generál-polkóvnik", 
			"ColGen", 
			"17 to 21 Hours"
			),
			("Russia",
			"Army",
			"O-10",
			"General of the Army", 
			"Generál ármii", 
			"GA", 
			"21 to 25 Hours"
			),
			("Russia",
			"Army",
			"O-11",
			"Marshall of the Russian Federation", 
			"Márshal Rossíyskoy Federátsii", 
			"MRF", 
			"25 or More Hours" 
			),
			
			("Russia",
			"Marines",
			"O-1", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-2", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-3", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-4", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-5", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-6", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-7", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-8", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-9", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-10", 
			"", 
			"", 
			"", 
			""),
			("Russia",
			"Marines",
			"O-11", 
			"", 
			"", 
			"", 
			""),
			
			("Russia",
			"Navy",
			"O-1",
			"Junior Lieutenant", 
			"Mládshiy leytenánt", 
			"JrLt", 
			"0 to 0.5 Hours"
			),
			("Russia",
			"Navy",
			"O-2",
			"Lieutenant", 
			"leytenánt", 
			"Lt", 
			"0.5 to 1 Hours"
			),
			("Russia",
			"Navy",
			"O-3",
			"Senior Lieutenant", 
			"Stárshiy leytenánt", 
			"SrLt", 
			"1 to 2 Hours"
			),
			("Russia",
			"Navy",
			"O-4",
			"Captain Lieutenant",
			"Kapitán leytenánt",
			"CaptLt", 
			"2 to 4 Hours"
			),
			("Russia",
			"Navy",
			"O-5",
			"Captain 3rd Rank", 
			"Kapitán 3rd pahra", 
			"3rdCapt", 
			"4 to 7 Hours"
			),
			("Russia",
			"Navy",
			"O-6",
			"Captain 2nd Rank", 
			"Kapitán 2nd pahra", 
			"2ndCapt", 
			"7 to 10 Hours"
			),
			("Russia",
			"Navy",
			"O-7",
			"Captain 1st Rank", 
			"Kapitán 1st pahra", 
			"3rdCapt", 
			"10 to 13 Hours"
			),
			("Russia",
			"Navy",
			"O-8",
			"Counter Admiral", 
			"Admiral Kontr", 
			"CADM", 
			"13 to 17 Hours"
			),
			("Russia",
			"Navy",
			"O-9",
			"Vice Admiral", 
			"Admiral Vice", 
			"VADM", 
			"17 to 21 Hours"
			),
			("Russia",
			"Navy",
			"O-10",
			"Admiral", 
			"Admiral", 
			"ADM", 
			"21 to 25 Hours"
			),
			("Russia",
			"Navy",
			"O-11",
			"Admiral of the Fleet", 
			"Admiral Flota", 
			"FADM", 
			"25 or More Hours" 
			),

			("USA",
			"Air Force",
			"O-1",
			"Second Lieutenant", 
			"Second Lieutenant", 
			"2ndLt", 
			"0 to 0.5 Hours"
			),
			("USA",
			"Air Force",
			"O-2",
			"First Lieutenant", 
			"First Lieutenant", 
			"1stLt", 
			"0.5 to 1 Hours"
			),
			("USA",
			"Air Force",
			"O-3",			
			"Captain", 
			"Captain", 
			"Capt", 
			"1 to 2 Hours"
			),
			("USA",
			"Air Force",
			"O-4",
			"Major", 
			"Major", 
			"Maj", 
			"2 to 4 Hours"
			),
			("USA",
			"Air Force",
			"O-5",
			"Lieutenant Colonel", 
			"Lieutenant Colonel", 
			"LtCol", 
			"4 to 7 Hours"
			),
			("USA",
			"Air Force",
			"O-6",
			"Colonel", 
			"Colonel", 
			"Col", 
			"7 to 10 Hours"
			),
			("USA",
			"Air Force",
			"O-7",
			"Brigadier General",
			"Brigadier General",
			"BrigGen",
			"10 to 13 Hours"
			),
			("USA",
			"Air Force",
			"O-8",
			"Major General",
			"Major General",
			"MajGen",
			"13 to 17 Hours"
			),
			("USA",
			"Air Force",
			"O-9",
			"Lieutenant General",
			"Lieutenant General",
			"LtGen",
			"17 to 21 Hours"
			),
			("USA",
			"Air Force",
			"O-10",
			"General", 
			"General", 
			"Gen", 
			"21 to 25 Hours"
			),
			("USA",
			"Air Force",
			"O-11",
			"General of the Air Force", 
			"General of the Air Force", 
			"GAF", 
			"25 or More Hours"
			),
			
			("USA",
			"Army",
			"O-1",
			"Second Lieutenant", 
			"Second Lieutenant", 
			"2LT", 
			"0 to 0.5 Hours"
			),
			("USA",
			"Army",
			"O-2",
			"First Lieutenant", 
			"First Lieutenant", 
			"1LT", 
			"0.5 to 1 Hours"
			),
			("USA",
			"Army",
			"O-3",
			"Captain", 
			"Captain", 
			"CPT", 
			"1 to 2 Hours"
			),
			("USA",
			"Army",
			"O-4",
			"Major", 
			"Major", 
			"MAJ", 
			"2 to 4 Hours"
			),
			("USA",
			"Army",
			"O-5",
			"Lieutenant Colonel", 
			"Lieutenant Colonel", 
			"LTC", 
			"4 to 7 Hours"
			),
			("USA",
			"Army",
			"O-6",
			"Colonel", 
			"Colonel", 
			"COL", 
			"7 to 10 Hours"
			),
			("USA",
			"Army",
			"O-7",
			"Brigadier General", 
			"Brigadier General", 
			"BG", 
			"10 to 13 Hours"
			),
			("USA",
			"Army",
			"O-8",
			"Major General", 
			"Major General", 
			"MG", 
			"13 to 17 Hours"
			),
			("USA",
			"Army",
			"O-9",
			"Lieutenant General", 
			"Lieutenant General", 
			"LTG", 
			"17 to 21 Hours"
			),
			("USA",
			"Army",
			"O-10",
			"General", 
			"General", 
			"GEN", 
			"21 to 25 Hours"
			),
			("USA",
			"Army",
			"O-11",
			"General of the Army", 
			"General of the Army", 
			"GA", 
			"25 or More Hours"
			),
			("USA",
			"Marines",
			"O-1",
			"Second Lieutenant", 
			"Second Lieutenant", 
			"2ndLt", 
			"0 to 0.5 Hours"
			),
			("USA",
			"Marines",
			"O-2",
			"First Lieutenant", 
			"First Lieutenant", 
			"1stLt", 
			"0.5 to 1 Hours"
			),
			("USA",
			"Marines",
			"O-3",
			"Captain", 
			"Captain", 
			"Capt", 
			"1 to 2 Hours"
			),
			("USA",
			"Marines",
			"O-4",
			"Major", 
			"Major", 
			"Maj", 
			"2 to 4 Hours"
			),
			("USA",
			"Marines",
			"O-5",
			"Lieutenant Colonel", 
			"Lieutenant Colonel", 
			"LtCol", 
			"4 to 7 Hours"
			),
			("USA",
			"Marines",
			"O-6",
			"Colonel", 
			"Colonel", 
			"Col", 
			"7 to 10 Hours"
			),
			("USA",
			"Marines",
			"O-7",
			"Brigadier General", 
			"Brigadier General", 
			"BGen", 
			"10 to 13 Hours"
			),
			("USA",
			"Marines",
			"O-8",
			"Major General", 
			"Major General", 
			"MajGen", 
			"13 to 17 Hours"
			),
			("USA",
			"Marines",
			"O-9",
			"Lieutenant General", 
			"Lieutenant General", 
			"LtGen", 
			"17 to 21 Hours"
			),
			("USA",
			"Marines",
			"O-10",
			"General", 
			"General", 
			"Gen", 
			"21 or More Hours"
			),
			("USA",
			"Marines",
			"O-11",
			"", 
			"", 
			"", 
			"" 
			),
			("USA",
			"Navy",
			"O-1",
			"Ensign", 
			"Ensign", 
			"ENS", 
			"0 to 0.5 Hours"
			),
			("USA",
			"Navy",
			"O-2",
			"Lieutenant Junior Grade", 
			"Lieutenant Junior Grade", 
			"LTJG", 
			"0.5 to 1 Hours"
			),
			("USA",
			"Navy",
			"O-3",
			"Lieutenant", 
			"Lieutenant", 
			"Lt", 
			"1 to 2 Hours"
			),
			("USA",
			"Navy",
			"O-4",
			"Lieutenant Commander", 
			"Lieutenant Commander", 
			"LCDR", 
			"2 to 4 Hours"
			),
			("USA",
			"Navy",
			"O-5",
			"Commander", 
			"Commander", 
			"CDR", 
			"4 to 7 Hours"
			),
			("USA",
			"Navy",
			"O-6",
			"Captain", 
			"Captain", 
			"Capt", 
			"7 to 10 Hours"
			),
			("USA",
			"Navy",
			"O-7",
			"Rear Admiral Lower Half", 
			"Rear Admiral Lower Half", 
			"RDML", 
			"10 to 13 Hours"
			),
			("USA",
			"Navy",
			"O-8",
			"Rear Admiral Upper Half", 
			"Rear Admiral Upper Half", 
			"RADM", 
			"13 to 17 Hours"
			),
			("USA",
			"Navy",
			"O-9",
			"Vice Admiral", 
			"Vice Admiral", 
			"VADM", 
			"17 to 21 Hours"
			),
			("USA",
			"Navy",
			"O-10",
			"Admiral", 
			"Admiral", 
			"ADM", 
			"21 to 25 Hours"
			),
			("USA",
			"Navy",
			"O-11",
			"Fleet Admiral", 
			"Fleet Admiral", 
			"FADM", 
			"25 or More Hours"
			)

			';



			if ($mysqli->query($sql) === TRUE) {
			//echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

/* 			pe_Oranksdb_AR_O1_titlelongenglish,
			pe_Oranksdb_AR_O1_titlelongnative,
			pe_Oranksdb_AR_O1_titleshort,
			pe_Oranksdb_AR_O1_value,
			pe_Oranksdb_AR_O2_titlelongenglish,
			pe_Oranksdb_AR_O2_titlelongnative,
			pe_Oranksdb_AR_O2_titleshort,
			pe_Oranksdb_AR_O2_value,
			pe_Oranksdb_AR_O3_titlelongenglish,
			pe_Oranksdb_AR_O3_titlelongnative,
			pe_Oranksdb_AR_O3_titleshort,
			pe_Oranksdb_AR_O3_value,
			pe_Oranksdb_AR_O4_titlelongenglish,
			pe_Oranksdb_AR_O4_titlelongnative,
			pe_Oranksdb_AR_O4_titleshort,
			pe_Oranksdb_AR_O4_value,
			pe_Oranksdb_AR_O5_titlelongenglish,
			pe_Oranksdb_AR_O5_titlelongnative,
			pe_Oranksdb_AR_O5_titleshort,
			pe_Oranksdb_AR_O5_value,
			pe_Oranksdb_AR_O6_titlelongenglish,
			pe_Oranksdb_AR_O6_titlelongnative,
			pe_Oranksdb_AR_O6_titleshort,
			pe_Oranksdb_AR_O6_value,
			pe_Oranksdb_AR_O7_titlelongenglish,
			pe_Oranksdb_AR_O7_titlelongnative,
			pe_Oranksdb_AR_O7_titleshort,
			pe_Oranksdb_AR_O7_value,
			pe_Oranksdb_AR_O8_titlelongenglish,
			pe_Oranksdb_AR_O8_titlelongnative,
			pe_Oranksdb_AR_O8_titleshort,
			pe_Oranksdb_AR_O8_value,
			pe_Oranksdb_AR_O9_titlelongenglish,
			pe_Oranksdb_AR_O9_titlelongnative,
			pe_Oranksdb_AR_O9_titleshort,
			pe_Oranksdb_AR_O9_value,
			pe_Oranksdb_AR_O10_titlelongenglish,
			pe_Oranksdb_AR_O10_titlelongnative,
			pe_Oranksdb_AR_O10_titleshort,
			pe_Oranksdb_AR_O10_value,
			pe_Oranksdb_AR_O11_titlelongenglish,
			pe_Oranksdb_AR_O11_titlelongnative,
			pe_Oranksdb_AR_O11_titleshort,
			pe_Oranksdb_AR_O11_value,

			pe_Oranksdb_MA_O1_titlelongenglish,
			pe_Oranksdb_MA_O1_titlelongnative,
			pe_Oranksdb_MA_O1_titleshort,
			pe_Oranksdb_MA_O1_value,
			pe_Oranksdb_MA_O2_titlelongenglish,
			pe_Oranksdb_MA_O2_titlelongnative,
			pe_Oranksdb_MA_O2_titleshort,
			pe_Oranksdb_MA_O2_value,
			pe_Oranksdb_MA_O3_titlelongenglish,
			pe_Oranksdb_MA_O3_titlelongnative,
			pe_Oranksdb_MA_O3_titleshort,
			pe_Oranksdb_MA_O3_value,
			pe_Oranksdb_MA_O4_titlelongenglish,
			pe_Oranksdb_MA_O4_titlelongnative,
			pe_Oranksdb_MA_O4_titleshort,
			pe_Oranksdb_MA_O4_value,
			pe_Oranksdb_MA_O5_titlelongenglish,
			pe_Oranksdb_MA_O5_titlelongnative,
			pe_Oranksdb_MA_O5_titleshort,
			pe_Oranksdb_MA_O5_value,
			pe_Oranksdb_MA_O6_titlelongenglish,
			pe_Oranksdb_MA_O6_titlelongnative,
			pe_Oranksdb_MA_O6_titleshort,
			pe_Oranksdb_MA_O6_value,
			pe_Oranksdb_MA_O7_titlelongenglish,
			pe_Oranksdb_MA_O7_titlelongnative,
			pe_Oranksdb_MA_O7_titleshort,
			pe_Oranksdb_MA_O7_value,
			pe_Oranksdb_MA_O8_titlelongenglish,
			pe_Oranksdb_MA_O8_titlelongnative,
			pe_Oranksdb_MA_O8_titleshort,
			pe_Oranksdb_MA_O8_value,
			pe_Oranksdb_MA_O9_titlelongenglish,
			pe_Oranksdb_MA_O9_titlelongnative,
			pe_Oranksdb_MA_O9_titleshort,
			pe_Oranksdb_MA_O9_value,
			pe_Oranksdb_MA_O10_titlelongenglish,
			pe_Oranksdb_MA_O10_titlelongnative,
			pe_Oranksdb_MA_O10_titleshort,
			pe_Oranksdb_MA_O10_value,
			pe_Oranksdb_MA_O11_titlelongenglish,
			pe_Oranksdb_MA_O11_titlelongnative,
			pe_Oranksdb_MA_O11_titleshort,
			pe_Oranksdb_MA_O11_value,

			pe_Oranksdb_NV_O1_titlelongenglish,
			pe_Oranksdb_NV_O1_titlelongnative,
			pe_Oranksdb_NV_O1_titleshort,
			pe_Oranksdb_NV_O1_value,
			pe_Oranksdb_NV_O2_titlelongenglish,
			pe_Oranksdb_NV_O2_titlelongnative,
			pe_Oranksdb_NV_O2_titleshort,
			pe_Oranksdb_NV_O2_value,
			pe_Oranksdb_NV_O3_titlelongenglish,
			pe_Oranksdb_NV_O3_titlelongnative,
			pe_Oranksdb_NV_O3_titleshort,
			pe_Oranksdb_NV_O3_value,
			pe_Oranksdb_NV_O4_titlelongenglish,
			pe_Oranksdb_NV_O4_titlelongnative,
			pe_Oranksdb_NV_O4_titleshort,
			pe_Oranksdb_NV_O4_value,
			pe_Oranksdb_NV_O5_titlelongenglish,
			pe_Oranksdb_NV_O5_titlelongnative,
			pe_Oranksdb_NV_O5_titleshort,
			pe_Oranksdb_NV_O5_value,
			pe_Oranksdb_NV_O6_titlelongenglish,
			pe_Oranksdb_NV_O6_titlelongnative,
			pe_Oranksdb_NV_O6_titleshort,
			pe_Oranksdb_NV_O6_value,
			pe_Oranksdb_NV_O7_titlelongenglish,
			pe_Oranksdb_NV_O7_titlelongnative,
			pe_Oranksdb_NV_O7_titleshort,
			pe_Oranksdb_NV_O7_value,
			pe_Oranksdb_NV_O8_titlelongenglish,
			pe_Oranksdb_NV_O8_titlelongnative,
			pe_Oranksdb_NV_O8_titleshort,
			pe_Oranksdb_NV_O8_value,
			pe_Oranksdb_NV_O9_titlelongenglish,
			pe_Oranksdb_NV_O9_titlelongnative,
			pe_Oranksdb_NV_O9_titleshort,
			pe_Oranksdb_NV_O9_value,
			pe_Oranksdb_NV_O10_titlelongenglish,
			pe_Oranksdb_NV_O10_titlelongnative,
			pe_Oranksdb_NV_O10_titleshort,
			pe_Oranksdb_NV_O10_value,
			pe_Oranksdb_NV_O11_titlelongenglish,
			pe_Oranksdb_NV_O11_titlelongnative,
			pe_Oranksdb_NV_O11_titleshort,
			pe_Oranksdb_NV_O11_value */

			///////////////////////////////////////////////////////////////////////
			/////////////////CREATE Officer "O" RANKS for EACH NATION - REFERENCE TABLE///////
			///////////////////////////////////////////////////////////////////////

			//DROP TABLE if exists
			$sql = "DROP TABLE IF EXISTS pe_WOranksdb";

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			//Create Table 
			$sql = 'CREATE TABLE IF NOT EXISTS pe_WOranksdb(
			pe_WOranksdb_id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pe_WOranksdb_nation VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_branch VARCHAR(100) DEFAULT NULL,					

			pe_WOranksdb_WO1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO1_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO2_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO3_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO4_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_WO5_value VARCHAR(100) DEFAULT NULL




			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			';

/* 			pe_WOranksdb_MA_WO1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO1_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO2_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO3_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO4_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_MA_WO5_value VARCHAR(100) DEFAULT NULL,

			pe_WOranksdb_NV_WO1_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO1_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO1_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO1_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO2_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO2_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO2_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO2_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO3_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO3_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO3_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO3_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO4_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO4_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO4_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO4_value VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO5_titlelongenglish VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO5_titlelongnative VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO5_titleshort VARCHAR(100) DEFAULT NULL,
			pe_WOranksdb_NV_WO5_value VARCHAR(100) DEFAULT NULL */

			if ($mysqli->query($sql) === TRUE) {
			//  echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}

			// INSERT change_slots start time and +2min from pe_LogEvent
			$sql = 'INSERT INTO pe_WOranksdb
			(pe_WOranksdb_nation,
			pe_WOranksdb_branch,			
			pe_WOranksdb_WO1_titlelongenglish,
			pe_WOranksdb_WO1_titlelongnative,
			pe_WOranksdb_WO1_titleshort,
			pe_WOranksdb_WO1_value,
			pe_WOranksdb_WO2_titlelongenglish,
			pe_WOranksdb_WO2_titlelongnative,
			pe_WOranksdb_WO2_titleshort,
			pe_WOranksdb_WO2_value,
			pe_WOranksdb_WO3_titlelongenglish,
			pe_WOranksdb_WO3_titlelongnative,
			pe_WOranksdb_WO3_titleshort,
			pe_WOranksdb_WO3_value,
			pe_WOranksdb_WO4_titlelongenglish,
			pe_WOranksdb_WO4_titlelongnative,
			pe_WOranksdb_WO4_titleshort,
			pe_WOranksdb_WO4_value,
			pe_WOranksdb_WO5_titlelongenglish,
			pe_WOranksdb_WO5_titlelongnative,
			pe_WOranksdb_WO5_titleshort,
			pe_WOranksdb_WO5_value
			)

			VALUES(
			"Russia",
			"Army",
			"Sergeant", 
			"Serzhánt", 
			"WO1", 
			"1000",
			"Staff Sergeant", 
			"Stárshy serzhánt", 
			"CW2", 
			"1000", 
			"Sergeant first class", 
			"Starshina", 
			"CW3", 
			"1000",
			"Warrant officer", 
			"Praporshchik", 
			"CW4", 
			"1000",
			"Chief Warrant officer", 
			"Starshy praporshchik", 
			"CW5", 
			"1000"
			),
			(
			"Russia",
			"Marines", 
			"", 
			"", 
			"",
			"", 
			"", 
			"", 
			"", 
			"", 
			"", 
			"", 
			"",
			"", 
			"", 
			"", 
			"",
			"", 
			"", 
			"", 
			"",
			""
			 ),
			 (
			 "Russia",
			 "Navy",
			"Senior Seaman", 
			"Senior Seaman", 
			"WO1", 
			"1000",
			"Petty Officer Second Class", 
			"Petty Officer Second Class", 
			"CWO-2", 
			"1000", 
			"Petty Officer First Class", 
			"Petty Officer First Class", 
			"CWO-3", 
			"1000",
			"Chief Petty Officer", 
			"Chief Petty Officer", 
			"CWO-4", 
			"1000",
			"Chief Ship Petty Officer", 
			"Chief Ship Petty Officer", 
			"CWO-5", 
			"1000"
			),

			(
			"USA",
			"Army",
			"Warrant Officer", 
			"Warrant Officer", 
			"WO1", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CW2", 
			"1000", 
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CW3", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CW4", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CW5", 
			"1000"
			),
			("USA",
			"Marines",
			"Warrant Officer", 
			"Warrant Officer", 
			"WO1", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO2", 
			"1000", 
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO3", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO4", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO5", 
			"1000"
			 ),
			 (
			 "USA",
			 "Navy",
			"Warrant Officer", 
			"Warrant Officer", 
			"WO1", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO-2", 
			"1000", 
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO-3", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO-4", 
			"1000",
			"Chief Warrant Officer", 
			"Chief Warrant Officer", 
			"CWO-5", 
			"1000"
			)';

/* 			pe_WOranksdb_MA_WO1_titlelongenglish,
			pe_WOranksdb_MA_WO1_titlelongnative,
			pe_WOranksdb_MA_WO1_titleshort,
			pe_WOranksdb_MA_WO1_value,
			pe_WOranksdb_MA_WO2_titlelongenglish,
			pe_WOranksdb_MA_WO2_titlelongnative,
			pe_WOranksdb_MA_WO2_titleshort,
			pe_WOranksdb_MA_WO2_value,
			pe_WOranksdb_MA_WO3_titlelongenglish,
			pe_WOranksdb_MA_WO3_titlelongnative,
			pe_WOranksdb_MA_WO3_titleshort,
			pe_WOranksdb_MA_WO3_value,
			pe_WOranksdb_MA_WO4_titlelongenglish,
			pe_WOranksdb_MA_WO4_titlelongnative,
			pe_WOranksdb_MA_WO4_titleshort,
			pe_WOranksdb_MA_WO4_value,
			pe_WOranksdb_MA_WO5_titlelongenglish,
			pe_WOranksdb_MA_WO5_titlelongnative,
			pe_WOranksdb_MA_WO5_titleshort,
			pe_WOranksdb_MA_WO5_value,

			pe_WOranksdb_NV_WO1_titlelongenglish,
			pe_WOranksdb_NV_WO1_titlelongnative,
			pe_WOranksdb_NV_WO1_titleshort,
			pe_WOranksdb_NV_WO1_value,
			pe_WOranksdb_NV_WO2_titlelongenglish,
			pe_WOranksdb_NV_WO2_titlelongnative,
			pe_WOranksdb_NV_WO2_titleshort,
			pe_WOranksdb_NV_WO2_value,
			pe_WOranksdb_NV_WO3_titlelongenglish,
			pe_WOranksdb_NV_WO3_titlelongnative,
			pe_WOranksdb_NV_WO3_titleshort,
			pe_WOranksdb_NV_WO3_value,
			pe_WOranksdb_NV_WO4_titlelongenglish,
			pe_WOranksdb_NV_WO4_titlelongnative,
			pe_WOranksdb_NV_WO4_titleshort,
			pe_WOranksdb_NV_WO4_value,
			pe_WOranksdb_NV_WO5_titlelongenglish,
			pe_WOranksdb_NV_WO5_titlelongnative,
			pe_WOranksdb_NV_WO5_titleshort,
			pe_WOranksdb_NV_WO5_value */


			if ($mysqli->query($sql) === TRUE) {
			//echo "Record updated successfully";
			//  echo "<br><br>";
			 // sleep(1);
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  echo "<br><br>";
			}
	

			///////////////////END PILOT ID DELETION/////////////////////

			echo "<h3 style='color:black;font-size:25px;'>Ranks, Medals, & Reference Tables have been  <u><i>ADDED.</u></i></h3>";

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


<!--
country:add('RUSSIA' ,_("Russia"), "Russia", "RUS",
  use_default_ranks,
  {
    award('Courage Order', _('Courage Order'), 200, 'RUS-01-CourageOrder.png'),
    award('Medal of Courage',_('Medal of Courage'), 600, 'RUS-02-MeritMedal.png'),
    award('Nesterov Medal',_('Nesterov Medal'), 1000, 'RUS-03-NesterovMedal.png'),
    award('Military Serve Order',_('Military Serve Order'), 1400, 'RUS-04-MilitaryServe.png'),
    award('Georgy Cross-IV',_('Georgy Cross-IV'), 1800, 'RUS-05-GeorgyCross-4.png'),
    award('Medal For Merit To Fatherland-II with swords',_('Medal For Merit To Fatherland-II with swords'), 2200, 'RUS-06-ForMeritToFatherland-2.png'),
    award('Georgy Cross-I',_('Georgy Cross-I'), 2600, 'RUS-07-GeorgyCross-1.png'),
    award('Hero Gold Star',_('Hero Gold Star'), 3000, 'RUS-08-HeroStar.png'),
  },
  'Russia.lua'
);

country:add('UKRAINE',_("Ukraine"), "Ukraine", "UKR",
  use_default_ranks,
  {
    award('Medal "Zakhystnyku Vitchyzny"', _('Medal "Zakhystnyku Vitchyzny"'), 200,  'UKR-01-ForDefenderOfFatherland.png'),
    award('Orden "Za Zaslugy III"', _('Orden "Za Zaslugy III"'), 600,  'UKR-02-ForMerit-III.png'),
    award('Orden "Za Zaslugy II"', _('Orden "Za Zaslugy II"'), 1000, 'UKR-03-ForMerit-II.png'),
    award('Orden "Za Zaslugy I"', _('Orden "Za Zaslugy I"'), 1400, 'UKR-04-ForMerit-I.png'),
    award('Zirka "Za Zaslugy"', _('Zirka "Za Zaslugy"'), 1800, 'UKR-05-ForMerit-Star.png'),
    award('Medal "Za Viyskovu Sluzhbu"', _('Medal "Za Viyskovu Sluzhbu"'), 2200, 'UKR-06-ForMilitaryService.png'),
    award('Orden "Za Muzhnist"', _('Orden "Za Muzhnist"'), 2600, 'UKR-07-OrderForCourage.png'),
    award('Zolota Zirka', _('Zolota Zirka'), 3000, 'UKR-08-GoldStar.png'),
  },
  'Ukraine.lua'
);


country:add('USA'	 ,_("USA"), "USA", "USA",
  use_default_ranks,
  {
    award('Air Medal', _('Air Medal'), 200, 'US-01-AirMedal.png'),
    award('Purple Heart', _('Purple Heart'), 600, 'US-02-PurpleHeart.png'),
    award('Bronze Star', _('Bronze Star'), 1000, 'US-03-BronzeStar.png'),
    award('Airmans Medal', _('Airmans Medal'), 1400, 'US-04-AirmansMedal.png'),
    award('Distinguished Flying Cross', _('Distinguished Flying Cross'), 1800, 'US-05-DistinguishedFlyingCross.png'),
    award('Silver Star', _('Silver Star'), 2200, 'US-06-SilverStar.png'),
    award('Air Force Cross', _('Air Force Cross'), 2600, 'US-07-AirForceCross.png'),
    award('Medal of Honor', _('Medal of Honor'), 3000, 'US-08-AirForceMedalOfHonour.png'),
  },
  'USA.lua'
);

country:add('TURKEY' ,_("Turkey"), "Turkey", "TUR",
  use_default_ranks,
  {
    award('Liakat Medal', _('Liakat Medal'), 200,  'TUR-01-Liakat_Medal.png'),
    award('Success Medal', _('Success Medal'), 600,  'TUR-02-Succes_Medal.png'),
    award('Superior Service Medal', _('Superior Service Medal'), 1200, 'TUR-03-Superior_Service.png'),
    award('Superior Braveness Medal', _('Superior Braveness Medal'), 1800, 'TUR-04-Superior_Braveness_Medal.png'),
    award('Service and Praise Medal', _('Service and Praise Medal'), 2400, 'TUR-05-Service_and_Praise_Medal.png'),
    award('Medal of Honour', _('Medal of Honour'), 3000, 'TUR-06-Honour_Medal.png'),
  },
  'Turkey.lua'
);

country:add('UK'	 ,_("UK"), "UK", "UK",
  use_default_ranks,
  {
    award('British Empire Medal', _('British Empire Medal'), 200,  'UK-01-British_Empire_Medal.png'),
    award('Air Force Medal', _('Air Force Medal'), 600,  'UK-02-Air_Force_Medal.png'),
    award('Distinguished Flying Medal', _('Distinguished Flying Medal'), 1000, 'UK-03-Distinguished_Flying_Medal.png'),
    award('Military Medal', _('Military Medal'), 1400, 'UK-04-Military_Medal.png'),
    award('Distinguished Conduct Medal', _('Distinguished Conduct Medal'), 1800, 'UK-05-Distiguished_Conduct_Medal.png'),
    award('Air Force Cross', _('Air Force Cross'), 2200, 'UK-06-Air_Force_Cross.png'),
    award('Distinguished Flying Cross', _('Distinguished Flying Cross'), 2600, 'UK-07-Distinguished_Flying_Cross.png'),
    award('Military Cross', _('Military Cross'), 3000, 'UK-08-Military_Cross.png'),
  },
  'UK.lua'
);

country:add('FRANCE' ,_("France"), "France", "FRA",
  use_default_ranks,
  {
    award('Croix de la bravoure', _('Croix de la bravoure'), 200,  'FR-01-Cross_of_Valour.png'),
    award('Medaille militaire', _('Medaille militaire'), 600,  'FR-02-Medal_Militaire.png'),
    award('Medaille du merite', _('Medaille du merite'), 1000, 'FR-03-Merit_Medal.png'),
    award('Croix du combattant', _('Croix du combattant'), 1400, 'FR-04-Combatant_Cross.png'),
    award([[Medaille de la defense de l'armee nationale]], _([[Medaille de la defense de l'armee nationale]]), 1800, 'FR-05-Army_National_Defence_Medal.png'),
    award('Ordre du merite', _('Ordre du merite'), 2200, 'FR-06-Merit_Order.png'),
    award('Croix de la liberte', _('Croix de la liberte'), 2600, 'FR-07-Liberty_Cross.png'),
    award([[Legion d'honneur]], _([[Legion d'honneur]]), 3000, 'FR-08-Legion_of_Honor.png'),
  },
  'France.lua'
);

country:add('GERMANY',_("Germany"), "Germany", "GER",
  use_default_ranks,
  {
    award('Ehrenmedaille', _('Ehrenmedaille'), 200,  'DE-01-Ehrenmedaille-Honor.png'),
    award('Ehrenkreuz', _('Ehrenkreuz'), 700,  'DE-02-Ehrenkreuze.png'),
    award('Ehrenkreuz in Silber', _('Ehrenkreuz in Silber'), 1200, 'DE-03-Silbernekreuze.png'),
    award('Ehrenkreuz in Gold', _('Ehrenkreuz in Gold'), 1800, 'DE-04-Goldenekreuze.png'),
    award('Bundesverdienstmedaille', _('Bundesverdienstmedaille'), 2400, 'DE-05-Bundesverdienstmedaille.png'),
    award('Bundesverdienstkreuz', _('Bundesverdienstkreuz'), 3000, 'DE-06-Bundesverdienstkreuz.png'),
  },
  'Germany.lua'
);

country:add('AGGRESSORS' ,_("USAF Aggressors"), "USAF Aggressors", "AUSAF",
  use_default_ranks,
  {
    award('Air Medal', _('Air Medal'), 200, 'US-01-AirMedal.png'),
    award('Purple Heart', _('Purple Heart'), 600, 'US-02-PurpleHeart.png'),
    award('Bronze Star', _('Bronze Star'), 1000, 'US-03-BronzeStar.png'),
    award('Airmans Medal', _('Airmans Medal'), 1400, 'US-04-AirmansMedal.png'),
    award('Distinguished Flying Cross', _('Distinguished Flying Cross'), 1800, 'US-05-DistinguishedFlyingCross.png'),
    award('Silver Star', _('Silver Star'), 2200, 'US-06-SilverStar.png'),
    award('Air Force Cross', _('Air Force Cross'), 2600, 'US-07-AirForceCross.png'),
    award('Medal of Honor', _('Medal of Honor'), 3000, 'US-08-AirForceMedalOfHonour.png'),
  },
  'USA.lua'
);

country:add('CANADA' ,_("Canada"), "Canada", "CAN",
  use_default_ranks,
  {
    award('Medal of Bravery', _('Medal of Bravery'), 200,  'CA_01_Medal_of_Bravery.png'),
    award('Medal of Military Valour', _('Medal of Military Valour'), 600,  'CA_02_Medal_of_Military_Valour.png'),
    award('Meritorious Service Cross', _('Meritorious Service Cross'), 1000, 'CA_03_Meritorious_Service_Cross.png'),
    award('Star of Courage', _('Star of Courage'), 1400, 'CA_04_Star_of_Courage.png'),
    award('Star of Military Valour', _('Star of Military Valour'), 1800, 'CA_05_Star_of_Military_Valour.png'),
    award('The Order of Military Merit', _('The Order of Military Merit'), 2200, 'CA_06_The_Order_of_Military_Merit.png'),
    award('The Order of Canada', _('The Order of Canada'), 2600, 'CA_07_The_Order_of_Canada.png'),
    award('Cross of Valour', _('Cross of Valour'), 3000, 'CA_08_Cross_of_Valour.png'),
  },
  'Canada.lua'
);

country:add('SPAIN'  ,_("Spain"), "Spain", "SPN",
  use_default_ranks,
  {
    award('Cruz del Merito Aeronautico con distintivo azul', _('Cruz del Merito Aeronautico con distintivo azul'), 200,  'SP-01-Aeronautical_Merit_Cross_with_Blue_Ribbon.png'),
    award('Cruz del Merito Aeronautico con distintivo rojo', _('Cruz del Merito Aeronautico con distintivo rojo'), 800,  'SP-02-Aeronautical_Merit_Cross_with_Red_Ribbon.png'),
    award('Cruz de Guerra', _('Cruz de Guerra'), 1500, 'SP-03-War_Cross.png'),
    award('Medalla Militar Individual', _('Medalla Militar Individual'), 2200, 'SP-04-Individual_Military_Medal.png'),
    award('Cruz Laureada de San Fernando', _('Cruz Laureada de San Fernando'), 3000, 'SP-05-Laureate_Cross_of_Saint_Ferdinand.png'),
  },
  'Spain.lua'
);

country:add('THE_NETHERLANDS',_("The Netherlands"), "The Netherlands", "NETH",
  use_default_ranks,
  {
    award('Aviators Cross', _('Aviators Cross'), 200,  'NED-01-Aviators_Cross.png'),
    award('Hasselt Cross', _('Hasselt Cross'), 600,  'NED-02-Hasselt_Cross.png'),
    award('Lion III Class', _('Lion III Class'), 1000, 'NED-03-Lion_III_Class.png'),
    award('Long Service Decoration Bronze', _('Long Service Decoration Bronze'), 1400, 'NED-04-Long_Service_Decoration_Bronze.png'),
    award('Long Service Decoration Silver', _('Long Service Decoration Silver'), 1800, 'NED-05-Long_Service_Decoration_Silver.png'),
    award('Military Order of William Knight', _('Military Order of William Knight'), 2200, 'NED-06-Military_Order_of_William_Knight.png'),
    award('Order of the House of Nassau', _('Order of the House of Nassau'), 2600, 'NED-07-Order_of_the_House_of_Nassau.png'),
    award('Order of the House of Nassau-2', _('Order of the House of Nassau-2'), 3000, 'NED-08-Order_of_the_House_of_Nassau-2.png'),
  },
  'The Netherlands.lua'
);

country:add('BELGIUM',_("Belgium"), "Belgium", "BEL",
  use_default_ranks,
  {
    award('Medaille van militaire verdienste ', _('Medaille van militaire verdienste '), 200,  'BEL-01-Officer_of_the_Order_of_Leopold-1.png'),
    award('Erekruis voor militaire dienst in het buitenland ', _('Erekruis voor militaire dienst in het buitenland '), 600,  'BEL-02-Officer_of_the_Order_of_the_Crown.png'),
    award('Militair Kruis 2de Klas', _('Militair Kruis 2de Klas'), 1000, 'BEL-03-Officer_of_the_Order_of_Leopold-2.png'),
    award('Militair Kruis 1ste Klas', _('Militair Kruis 1ste Klas'), 1400, 'BEL-04-Knight_of_the_Order_of_Leopold.png'),
    award('Ridder in de Leopoldsorde', _('Ridder in de Leopoldsorde'), 1800, 'BEL-05-Military_Cross_1st_Class.png'),
    award('Officier in de Orde van Leopold II', _('Officier in de Orde van Leopold II'), 2200, 'BEL-06-Military_Cross_2nd_Class.png'),
    award('Officier in de Kroonorde', _('Officier in de Kroonorde'), 2600, 'BEL-07-Military_Cross_for_Foreign_Service.png'),
    award('Officier in de Leopoldsorde', _('Officier in de Leopoldsorde'), 3000, 'BEL-08-Medal_for_Military_Merit.png'),
  },
  'Belgium.lua'
);

country:add('NORWAY',_("Norway"), "Norway", "NOR",
  use_default_ranks,
  {
    award('Vernedyktighetsmedaljen', _('Vernedyktighetsmedaljen'), 200,  'NOR-01-AirForceServiceMedal.png'),
    award('Forsvarets Medalje for Internasjonale Operasjoner', _('Forsvarets Medalje for Internasjonale Operasjoner'), 600,  'NOR-02-Armed_Forces_medal_for_international_operations.png'),
    award('Forsvarsmedaljen', _('Forsvarsmedaljen'), 1000, 'NOR-03-Armed_Forces_medal.png'),
    award('Forsvarsmedaljen m Laurbargren', _('Forsvarsmedaljen m Laurbargren'), 1400, 'NOR-04-Armed_Forces_medal_with_Laureat.png'),
    award('Krigskorset', _('Krigskorset'), 1800, 'NOR-05-War_Cross.png'),
    award('St Olavsmedaljen', _('St Olavsmedaljen'), 2200, 'NOR-06-StOlaf_Medal.png'),
    award('Krigsmedaljen', _('Krigsmedaljen'), 2600, 'NOR-07-War_Medal.png'),
    award('Den kongelige Norske St Olavs orden', _('Den kongelige Norske St Olavs orden'), 3000, 'NOR-08-StOlaf_Knight.png'),
  },
  'Norway.lua'
);

country:add('DENMARK',_("Denmark"), "Denmark", "DEN",
  use_default_ranks,
  {
    award('Medaljen for udmarket lufttjeneste', _('Medaljen for udmarket lufttjeneste'), 200,  'DEN-01-Distinguished_Flying_Medal.png'),
    award('Dannebrogordenen Storkors', _('Dannebrogordenen Storkors'), 600,  'DEN-02-Silver_Cross_of_the_Order_of_Dannebrog.png'),
    award('Dannebrogordenen Ridderkors', _('Dannebrogordenen Ridderkors'), 1000, 'DEN-03-Order_of_Denneborg_Knight.png'),
    award('Dannebrogordenen Ridderkors af 1. grad', _('Dannebrogordenen Ridderkors af 1. grad'), 1400, 'DEN-04-Order_of_Danneburg_Knight_1st_Degree.png'),
    award('Hadertegnet for god tjeneste ved flyvevabnet', _('Hadertegnet for god tjeneste ved flyvevabnet'), 1800, 'DEN-05-Air_Force_Long_Service_Medal-25_years.png'),
    award('Forsvarets Medalje', _('Forsvarets Medalje'), 2200, 'DEN-06-Medal_of_the_Defence.png'),
    award('Dannebrogordenen Kommandorkors af 1. grad', _('Dannebrogordenen Kommandorkors af 1. grad'), 2600, 'DEN-07-Order_of_Danneburg_Commander_1st_Degree_Cross.png'),
    award('Forsvarets Medalje for Tapperhed', _('Forsvarets Medalje for Tapperhed'), 3000, 'DEN-08-Medal_for_Heroic_Deeds.png'),
  },
  'Denmark.lua'
);

country:next() --index 14 is free

country:add('ISRAEL',_("Israel"), "Israel", "ISR",
  use_default_ranks,
  {
    award('ITUR HA-GVURA', _('ITUR HA-GVURA'), 1000,  'Distinguished_Service_Medal.png'),
    award('ITUR HA-OZ', _('ITUR HA-OZ'), 2000,  'Gallantry_Medal.png'),
    award('ITUR HA-MOFET', _('ITUR HA-MOFET'), 3000,  'Valor_Medal.png'),
  },
  'Israel.lua'
);

country:add('GEORGIA',_("Georgia"), "Georgia", "GRG",
  use_default_ranks,
  {
    award('Medali "Sabrdzolo Damsakhurebisatvis"', _('Medali "Sabrdzolo Damsakhurebisatvis"'), 200,  'GR-01-Medal_for_the_Service_in_Battle.png'),
    award('Medali "Mkhedruli Mamatsobisatvis"', _('Medali "Mkhedruli Mamatsobisatvis"'), 600,  'GR-02-Medal_for_Military_Courage.png'),
    award('Vakhtang Gorgasalis Ordeni III', _('Vakhtang Gorgasalis Ordeni III'), 1000, 'GR-03-Order_of_Vakhtang_Gorgasali_III.png'),
    award('Vakhtang Gorgasalis Ordeni II', _('Vakhtang Gorgasalis Ordeni II'), 1400, 'GR-04-Order_of_Vakhtang_Gorgasali_II.png'),
    award('Vakhtang Gorgasalis Ordeni I', _('Vakhtang Gorgasalis Ordeni I'), 1800, 'GR-05-Order_of_Vakhtang_Gorgasali_I.png'),
    award('Girsebis Ordeni', _('Girsebis Ordeni'), 2200, 'GR-06-Order_of_Honour.png'),
    award('Girsebis Medali', _('Girsebis Medali'), 2600, 'GR-07-Medal_of_Valour.png'),
    award('Okros Satsmisis Ordeni', _('Okros Satsmisis Ordeni'), 3000, 'GR-08-Order_of_the_Gold_Fleece.png'),
  },
  'Georgia.lua'
);

country:add('INSURGENTS',_("Insurgents"), "Insurgents", "INS",
  use_default_ranks,
  {
  },
  'Insurgents.lua'
);

country:add('ABKHAZIA',_("Abkhazia"), "Abkhazia", "ABH",
  use_default_ranks,
  {
    award('Medal for Bravery', _('Medal for Bravery'), 400,  'ABH-01-Bravery.png'),
    award('Orden Leon', _('Orden "Leon"'), 1800,  'ABH-02-Leon.png'),
    award('Orden Glory III', _('Orden "Akhdz Apsha"'), 2600, 'ABH-03-Glory-III.png'),
    award('Hero of Abkhazia', _('Hero of Abkhazia'), 3000, 'ABH-04-Hero.png'),
  },
  'Abkhazia.lua'
);

country:add('SOUTH_OSETIA',_("South Ossetia"), "South Ossetia", "RSO",
  use_default_ranks,
  {
    award('Defender of the Fatherland', _('Defender of the Fatherland'), 1800,  'SOS-01-Defenders_of_the_Fatherland.png'),
    award('Uatsamonga', _('Hero of Osetia'), 3000, 'SOS-02-Uatsamonga.png'),
  },
  'South Ossetia.lua'
);

country:add('ITALY',_("Italy"), "Italy", "ITA",
  use_default_ranks,
  {
    award('Commemorative Medal of Peace Operations', _('Commemorative Medal of Peace Operations'), 200,  'IT-01-Commemorative_Medal_of_Peace_Operations.png'),
    award('Honor Decoration Interforce', _('Honor Decoration Interforce'), 600,  'IT-02-Honor_Decoration_Interforce.png'),
    award('NATO Medal for Merits', _('NATO Medal for Merits'), 1000, 'IT-03-NATO_Medal_for_Merits.png'),
    award('Medal of Long Air Navigation', _('Medal of Long Air Navigation'), 1800, 'IT-04-Medal_of_Long_Air_Navigation.png'),
    award('War Cross', _('War Cross'), 2200, 'IT-05-War_Cross.png'),
    award('Bronze Medal of Military Valour', _('Bronze Medal of Military Valour'), 2600, 'IT-06-Bronze_Medal_of_Military_Valour.png'),
    award('Silver Medal of Military Valour', _('Silver Medal of Military Valour'), 3000, 'IT-07-Silver_Medal_of_Military_Valour.png'),
    award('Gold Medal of Military Valour', _('Gold Medal of Military Valour'), 4000, 'IT-08-Gold_Medal_of_Military_Valour.png'),
  },
  'Italy.lua'
);

country:add('AUSTRALIA',_("Australia"), "Australia", "AUS",
  {
	rank('Second lieutenant', _('Pilot Officer'), 0, {0, 0, 64, 32}),
	rank('First lieutenant', _('Flying Officer'), 15, {0, 32, 64, 32}),
	rank('Captain', _('Flight Lieutenant'), 30, {0, 64, 64, 32}),
	rank('Major', _('Squadron Leader'), 60, {0, 96, 64, 32}),
	rank('Lieutenant colonel', _('Wing Commander'), 120, {0, 128, 64, 32}),
	rank('Colonel', _('Group Captain'), 240, {0, 160, 64, 32}),
  },
  {
	award('Distinguished Service Cross', _('Distinguished Service Cross'), 800, 'AUS05_Distinguished_Service_Cross.png'),
	award('Star of Courage', _('Star of Courage'), 1600, 'AUS04_Star_of_Courage.png'),
	award('Star of Gallantry', _('Star of Gallantry'), 2200, 'AUS03_The_Star_of_Gallantry.png'),
	award('Cross of Valour', _('Cross of Valour'),2600, 'AUS02_Cross_of_Valour.png'),
	award('Victoria Cross', _('Victoria Cross'), 3000, 'AUS01_Victoria_Cross.png'),
  },
  'Australia.lua'
);

country:add('SWITZERLAND',_("Switzerland"), "Switzerland", "SUI",
  use_default_ranks,
  {
    award('90 Diensttage', _('90 Diensttage'), 200,  'CH-01-90Diensttage.png'),
    award('170 Diensttage', _('170 Diensttage'), 400, 'CH-02-170Diensttage.png'),
    award('250 Diensttage', _('250 Diensttage'), 700, 'CH-03-250Diensttage.png'),
    award('350 Diensttage', _('350 Diensttage'), 1000, 'CH-04-350Diensttage.png'),
    award('450 Diensttage', _('450 Diensttage'), 1300, 'CH-05-450Diensttage.png'),
    award('550 Diensttage', _('550 Diensttage'), 1600, 'CH-06-550Diensttage.png'),
    award('650 Diensttage', _('650 Diensttage'), 1900, 'CH-07-650Diensttage.png'),
    award('750 Diensttage', _('750 Diensttage'), 2200, 'CH-08-750Diensttage.png'),
    award('850 Diensttage', _('850 Diensttage'), 2500, 'CH-09-850Diensttage.png'),
    award('950 Diensttage', _('950 Diensttage'), 2700, 'CH-10-950Diensttage.png'),
    award('Lange Ausland-Abkommandierung', _('Lange Ausland-Abkommandierung'), 3000, 'CH-11-LangeAuslandAbkommandierung.png'),
  },
  'Switzerland.lua'
);

country:add('AUSTRIA' ,_("Austria") , "Austria", "AUT", use_default_ranks,	no_awards,
{
	squadron('Austrian Federal Army', _('Austrian Federal Army'),'Bundesheer.png'),
})

country:add('BELARUS' ,_("Belarus") , 		"Belarus"			, "BLR", use_default_ranks,	no_awards,
{
	squadron('206th Assault Air Base', _('206th Assault Air Base'),'206.png'),
	squadron('181th Helicopter Air Base', _('181th Helicopter Air Base'),'181.png'),
	squadron('927th Fighter Air Base', _('927th Fighter Air Base'),'927.png'),
})

country:add('BULGARIA',_("Bulgaria"), 		"Bulgaria"			, "BGR", use_default_ranks,	no_awards,
{
	squadron('Bulgarian Air Force', _('Bulgarian Air Force'),'VVS.png'),
})

country:add('CHEZH_REPUBLIC',_("Czech Republic"),"Czech Republic"	, "CZE", use_default_ranks,	no_awards,
{
	squadron('Czech Air Force', _('Czech Air Force'),'CzechAirForce.png'),
	squadron('22nd Helicopter Base', _('22nd Helicopter Base'),'znak22zl.png'),
	squadron('213th Training Squadron', _('213th Training Squadron'),'213n.png'),
})

-- China
country:add('CHINA', 		_("China"), 		"China"				, "CHN", use_default_ranks,	
  {
	award('3rd-Class Merit',_('3rd-Class Merit'), 200, '3rd-Class-Merit.png'),
	award('2nd-Class Merit',_('2nd-Class Merit'), 1400, '2nd-Class-Merit.png'),
	award('1st-Class Merit', _('1st-Class Merit'), 3000, '1st-Class-Merit.png'),
  },
  'China.lua'
);

country:add('CROATIA', 		_("Croatia"), 		"Croatia"			, "HRV", use_default_ranks,	no_awards, no_squadrons);
country:add('EGYPT', 		_("Egypt"), 		"Egypt"				, "EGY", use_default_ranks,	no_awards, no_squadrons);
country:add('FINLAND', 		_("Finland"), 		"Finland"			, "FIN", use_default_ranks,	no_awards, no_squadrons);
country:add('GREECE', 		_("Greece"), 		"Greece"			, "GRC", use_default_ranks,
-- as we cannot push greek symbols to _( ) function  ,  source commented
--[[
  {
    rank('Second lieutenant' , _('Бнихрпумзнбгьт'), 0,   {0, 0, 64, 32}),
    rank('First lieutenant'	 , _('Хрпумзнбгьт')   , 15,  {0, 32, 64, 32}),
    rank('Captain'			 , _('Умзнбгьт')	  , 30,  {0, 64, 64, 32}),
    rank('Major'			 , _('Ерйумзнбгьт')   , 60,  {0, 96, 64, 32}),
    rank('Lieutenant colonel', _('БнфйумЮнбсчпт') , 120, {0, 128, 64, 32}),
    rank('Colonel'			 , _('УмЮнбсчпт')     , 240, {0, 160, 64, 32}),
  },
--]] 
  {
    award('Medal for Outstanding Acts', _('Medal for Outstanding Acts'), 800,  'GR-01-Medal_for_Outstanding_Acts.png'), -- _('МефЬллйп ЕобйсЭфщн РсЬоещн')
    award('War Cross 3rd Class'       , _('War Cross 3rd Class'       ), 1200, 'GR-02-War_Cross_C_Class.png'),          -- _('Рплемйкьт Уфбхсьт Г ФЬоещт')
    award('War Cross 2nd Class'       , _('War Cross 2nd Class'       ), 1600, 'GR-03-War_Cross_B_Class.png'),          -- _('Рплемйкьт Уфбхсьт В ФЬоещт')
    award('Silver Medal for Valour'   , _('Silver Medal for Valour'   ), 2200, 'GR-04-Silver_Medal_for_Valour.png'),    -- _('Бсгхсь БсйуфеЯп БндсеЯбт')
    award('Golden Medal for Valour'   , _('Golden Medal for Valour'   ), 2600, 'GR-05-Golden_Medal_for_Valour.png'),    -- _('Чсхуь БсйуфеЯп БндсеЯбт')
    award('Medal for Gallandry'       , _('Medal for Gallandry'       ), 3000, 'GR-06-Medal_for_Gallandry.png'),        -- _('БсйуфеЯп БндсбгбиЯбт')
  },
  {
    squadron('330 SQN HAF', 				_('330 SQN HAF'), '330sqn.png'),		-- _('330 МПЙСБ'	),
  	squadron('331 SQN HAF', 				_('331 SQN HAF'), '331mpk.png'),       -- _('331 МРК'		),
  	squadron('332 SQN HAF', 				_('332 SQN HAF'), '332mpk.png'),       -- _('332 МРК'		),
  	squadron('335 SQN HAF', 				_('335 SQN HAF'), '335mb.png'),        -- _('335 MB'		),
  	squadron('336 SQN HAF', 				_('336 SQN HAF'), '336mb.png'),        -- _('336 MB'		),
  	squadron('337 SQN HAF', 				_('337 SQN HAF'), '337sqn.png'),       -- _('337 МПЙСБ'	),
  	squadron('338 SQN HAF', 				_('338 SQN HAF'), '338mdb.png'),       -- _('338 МДВ'		),
  	squadron('339 SQN HAF', 				_('339 SQN HAF'), '339mpk.png'),       -- _('339 МРК'		),
  	squadron('340 SQN HAF', 				_('340 SQN HAF'), '340sqn.png'),       -- _('340 МПЙСБ'	),
  	squadron('341 SQN HAF', 				_('341 SQN HAF'), '341mpk.png'),       -- _('341 МРК'		),
  	squadron('343 SQN HAF', 				_('343 SQN HAF'), '343m.png'),         -- _('343 МПЙСБ'	),
  	squadron('343 STAR HAF',				_('343 STAR HAF'), 'star.png'),         -- _('343 STAR'	),
  	squadron('347 SQN HAF', 				_('347 SQN HAF'), '347sqn.png'),       -- _('347 МПЙСБ'	),
  	squadron('348 SQN HAF', 				_('348 SQN HAF'), '348mta.png'),       -- _('348 МФБ'		),
  	squadron('356 SQN HAF', 				_('356 SQN HAF'), '356mtm.png'),       -- _('356 МФМ'		),
  	squadron('358 SQN HAF', 				_('358 SQN HAF'), '358sar.png'),       -- _('358 МЕД'		),
  	squadron('361 SQN HAF', 				_('361 SQN HAF'), '361mea.png'),       -- _('361 МЕБ'		),
  	squadron('362 SQN HAF', 				_('362 SQN HAF'), '362mea.png'),       -- _('362 MEA'		),
  	squadron('363 SQN HAF', 				_('363 SQN HAF'), '363mea.png'),       -- _('363 MEA'		),
  	squadron('364 SQN HAF', 				_('364 SQN HAF'), '364mea.png'),       -- _('364 MEA'		),
  	squadron('380 SQN HAF', 				_('380 SQN HAF'), '380sqn.png'),       -- _('380 БУЕРЕ'	),
  	squadron('384 SQN HAF', 				_('384 SQN HAF'), '384sar.png'),       -- _('384 МЕД'		),
  	squadron('1ST ATTACK HELICOPTER SQN', 	_('1ST ATTACK HELICOPTER SQN'), '1teep.png'),        -- _('1o ФЕЕР'		),
  	squadron('2ND ATTACK HELICOPTER SQN', 	_('2ND ATTACK HELICOPTER SQN'), '2teep.png'),        -- _('2o ФЕЕР'		),
  	squadron('2ND HELICOPTER SQN', 			_('2ND HELICOPTER SQN'), '2teas.png'),        -- _('2o ФЕБУ'		),
  	squadron('4TH HELICOPTER SQN', 			_('4TH HELICOPTER SQN'), '4teas.png'),        -- _('4o ФЕБУ'		),
  	squadron('ARMOUR TRAINING CENTER', 		_('ARMOUR TRAINING CENTER'), 'ket8.png'),         -- _('КЕФИ'		),
  	squadron('21ST ARMORED BRIGADE', 		_('21ST ARMORED BRIGADE'), '21tt.png'),         -- _('21 ФИФ'		),
  	squadron('24TH ARMORED BRIGADE', 		_('24TH ARMORED BRIGADE'), '24tt.png'),         -- _('24 ФИФ'		),
})

local units  = country:get("GREECE").Units
	cnt_unit( units.Planes.Plane, "C-130");
	cnt_unit( units.Planes.Plane, "F-4E");
	cnt_unit( units.Planes.Plane, "F-16C bl.50");
	cnt_unit( units.Planes.Plane, "F-16C bl.52d");
	cnt_unit( units.Planes.Plane, "Mirage 2000-5");
	cnt_unit( units.Planes.Plane, "Yak-40");
	cnt_unit( units.Planes.Plane, "P-51D");
--Historical mode Aircraft GREECE
	cnt_unit( units.Planes.Plane, "C-17A");
	cnt_unit( units.Planes.Plane, "F-16C_50");
	cnt_unit( units.Planes.Plane, "M-2000C");
	cnt_unit( units.Planes.Plane, "F-4E_new");
--Historical mode Aircraft GREECE--end

	cnt_unit( units.Cars.Car, "M-109");
	cnt_unit( units.Cars.Car, "BMP-1");
	cnt_unit( units.Cars.Car, "M-113");
	cnt_unit( units.Cars.Car, "M1043 HMMWV Armament");
	cnt_unit( units.Cars.Car, "M1045 HMMWV TOW");
	cnt_unit( units.Cars.Car, "Soldier M4");
	cnt_unit( units.Cars.Car, "Soldier M249");
	cnt_unit( units.Cars.Car, "MLRS");
	cnt_unit( units.Cars.Car, "MLRS FDDM");
	cnt_unit( units.Cars.Car, "Leopard1A3");
	cnt_unit( units.Cars.Car, "Leopard-2");
	cnt_unit( units.Cars.Car, "Hummer");
	cnt_unit( units.Cars.Car, "M 818");

	cnt_unit( units.Cars.Car, "Osa 9A33 ln");
	cnt_unit( units.Cars.Car, "Tor 9A331");
	cnt_unit( units.Cars.Car, "Soldier stinger");
	cnt_unit( units.Cars.Car, "Stinger comm");
	cnt_unit( units.Cars.Car, "ZU-23 Emplacement Closed");
	cnt_unit( units.Cars.Car, "ZU-23 Emplacement");
	cnt_unit( units.Cars.Car, "Patriot AMG");
	cnt_unit( units.Cars.Car, "Patriot ECS");
	cnt_unit( units.Cars.Car, "Patriot ln");
	cnt_unit( units.Cars.Car, "Patriot EPP");
	cnt_unit( units.Cars.Car, "Patriot cp");
	cnt_unit( units.Cars.Car, "Patriot str");
	cnt_unit( units.Cars.Car, "Hawk tr");
	cnt_unit( units.Cars.Car, "Hawk sr");
	cnt_unit( units.Cars.Car, "Hawk ln");
	cnt_unit( units.Cars.Car, "Hawk cwar");
	cnt_unit( units.Cars.Car, "Hawk pcp");
	cnt_unit( units.Cars.Car, "S-300PS 40B6M tr");
	cnt_unit( units.Cars.Car, "S-300PS 40B6MD sr");
	cnt_unit( units.Cars.Car, "S-300PS 64H6E sr");
	cnt_unit( units.Cars.Car, "S-300PS 5P85C ln");
	cnt_unit( units.Cars.Car, "S-300PS 5P85D ln");
	cnt_unit( units.Cars.Car, "S-300PS 54K6 cp");
--Historical mode GRveh GREECE
	cnt_unit( units.Cars.Car, "M2A1_halftrack");
	cnt_unit( units.Cars.Car, "Cromwell_IV");
	cnt_unit( units.Cars.Car, "Centaur_IV");
	cnt_unit( units.Cars.Car, "M-60");
	cnt_unit( units.Cars.Car, "Grad-URAL");
	cnt_unit( units.Cars.Car, "bofors40");
	cnt_unit( units.Cars.Car, "flak18");
	cnt_unit( units.Cars.Car, "ZSU-23-4 Shilka");
	cnt_unit( units.Cars.Car, "HEMTT TFFT");
	cnt_unit( units.Cars.Car, "M978 HEMTT Tanker");
	cnt_unit( units.Cars.Car, "Trolley bus");
	cnt_unit( units.Cars.Car, "M8_Greyhound");
	cnt_unit( units.Cars.Car, "M4_Tractor");
	cnt_unit( units.Cars.Car, "generator_5i57");
	cnt_unit( units.Cars.Car, "leopard-2A4");
--Historical mode GRveh GREECE--end

--Historical mode Ships GREECE
cnt_unit( units.Ships.Ship, "La_Combattante_II");
--Historical mode Ships GREECE--End

	cnt_unit( units.Helicopters.Helicopter, "AH-64A");
	cnt_unit( units.Helicopters.Helicopter, "AH-64D");
	cnt_unit( units.Helicopters.Helicopter, "CH-47D");
	cnt_unit( units.Helicopters.Helicopter, "UH-1H");
	cnt_unit( units.Helicopters.Helicopter, "SH-60B");
	cnt_unit( units.Helicopters.Helicopter, "Mi-8MT");--fictional




country:add('HUNGARY',		_("Hungary"),		"Hungary"			, "HUN", use_default_ranks,	no_awards, no_squadrons);
country:add('INDIA',		_("India"),			"India"				, "IND", use_default_ranks,	no_awards, no_squadrons);
country:add('IRAN',			_("Iran"),			"Iran"				, "IRN", use_default_ranks,	no_awards, no_squadrons);
country:add('IRAQ',			_("Iraq"),			"Iraq"				, "IRQ", use_default_ranks,	no_awards, no_squadrons);

country:add('JAPAN', _("Japan"), "Japan" , "JPN",
	use_default_ranks,
	{
		award('5th Class Prize', _('5th Class Prize'), 200, 'JPN-01-5th.png'),
		award('4th Class Prize', _('4th Class Prize'), 600, 'JPN-02-4th.png'),
		award('3rd Class Prize', _('3rd Class Prize'), 1200, 'JPN-03-3rd.png'),
		award('2nd Class Prize', _('2nd Class Prize'), 1800, 'JPN-04-2nd.png'),
		award('1st Class Prize', _('1st Class Prize'), 2400, 'JPN-05-1st.png'),
		award('Special Prize', _('Special Prize'), 3000, 'JPN-06-Sp.png'),
	},
  'Japan.lua'
);

country:add('KAZAKHSTAN',	_("Kazakhstan"),	"Kazakhstan"		, "KAZ", use_default_ranks,	no_awards, no_squadrons);
country:add('NORTH_KOREA',	_("North Korea"),	"North Korea"		, "PRK", use_default_ranks,	no_awards, no_squadrons);
country:add('PAKISTAN',		_("Pakistan"),		"Pakistan"			, "PAK", use_default_ranks,	no_awards, no_squadrons);
country:add('POLAND', _("Poland"), "Poland", "POL",
{
	rank('Second lieutenant'	, _('Podporucznik')	,  0,  {0, 0,   64, 32}),
	rank('First lieutenant'		, _('Porucznik') 	, 15,  {0, 32,  64, 32}),
	rank('Captain'				, _('Kaptain')		, 30,  {0, 64,  64, 32}),
	rank('Major'				, _('Major')		, 60,  {0, 96,  64, 32}),
	rank('Lieutenant colonel'	, _('Podpulkownik')	, 120, {0, 128, 64, 32}),
	rank('Colonel'				, _('Pulkownik')	, 240, {0, 160, 64, 32}),
  },
  {
	award('Lotniczy Krzyz Zaslugi z mieczami', 		_('Lotniczy Krzyz Zaslugi z mieczami'), 	1000,  'lkzm.png'),
	award('Lotniczy Krzyz Zaslugi', 				_('Lotniczy Krzyz Zaslugi'),				2000,  'lkz.png'),
	award('Medal za dlugoletnia sluzbe Brazowy', 	_('Medal za dlugoletnia sluzbe Brazowy'), 	3000,  'mdsb.png'),
	award('Medal za dlugoletnia sluzbe Srebrny', 	_('Medal za dlugoletnia sluzbe Srebrny'), 	3600,  'mdss.png'),
	award('Medal za dlugoletnia sluzbe Zloty', 		_('Medal za dlugoletnia sluzbe Zloty'), 	4400,  'mdsz.png'),
	award('Medal za dlugoletnia sluzbe Gwiazda', 	_('Medal za dlugoletnia sluzbe Gwiazda'), 	5000,  'mdsg.png'),
  },
  'Poland.lua'
);

country:add('ROMANIA',		_("Romania"),		"Romania"			, "ROU", use_default_ranks,	no_awards, no_squadrons);
country:add('SAUDI_ARABIA',	_("Saudi Arabia"),	"Saudi Arabia"		, "SAU", use_default_ranks,	no_awards, no_squadrons);
country:add('SERBIA',		_("Serbia"),		"Serbia"			, "SRB", use_default_ranks,	no_awards, no_squadrons);
country:add('SLOVAKIA',		_("Slovakia"),		"Slovakia"			, "SVK", use_default_ranks,	no_awards, no_squadrons);
country:add('SOUTH_KOREA',	_("South Korea"),	"South Korea"		, "KOR", use_default_ranks,	no_awards, no_squadrons);
country:add('SWEDEN',		_("Sweden"),		"Sweden"			, "SWE", use_default_ranks,	no_awards, no_squadrons);
country:add('SYRIA',		_("Syria"),			"Syria"				, "SYR", use_default_ranks,	no_awards, no_squadrons);


country:add('YEMEN',		_("Yemen"),			"Yemen"				, "YEM", use_default_ranks,	no_awards, no_squadrons);
country:add('VIETNAM',		_("Vietnam"),		"Vietnam"			, "VNM", use_default_ranks,	no_awards, no_squadrons);
country:add('VENEZUELA',	_("Venezuela"),		"Venezuela"			, "VEN", use_default_ranks,	no_awards, no_squadrons);
country:add('TUNISIA',		_("Tunisia"),		"Tunisia"			, "TUN", use_default_ranks,	no_awards, no_squadrons);
country:add('THAILAND',		_("Thailand"),		"Thailand"			, "THA", use_default_ranks,	no_awards, no_squadrons);
country:add('SUDAN',		_("Sudan"),			"Sudan"				, "SDN", use_default_ranks,	no_awards, no_squadrons);
country:add('PHILIPPINES',	_("Philippines"),	"Philippines"		, "PHL", use_default_ranks,	no_awards, no_squadrons);
country:add('MOROCCO',		_("Morocco"),		"Morocco"			, "MAR", use_default_ranks,	no_awards, no_squadrons);
country:add('MEXICO',		_("Mexico"),		"Mexico"			, "MEX", use_default_ranks,	no_awards, no_squadrons);
country:add('MALAYSIA',		_("Malaysia"),		"Malaysia"			, "MYS", use_default_ranks,	no_awards, no_squadrons);
country:add('LIBYA',		_("Libya"),			"Libya"				, "LBY", use_default_ranks,	no_awards, no_squadrons);
country:add('JORDAN',		_("Jordan"),		"Jordan"			, "JOR", use_default_ranks,	no_awards, no_squadrons);
country:add('INDONESIA',	_("Indonesia"),		"Indonesia"			, "IDN", use_default_ranks,	no_awards, no_squadrons);
country:add('HONDURAS',		_("Honduras"),		"Honduras"			, "HND", use_default_ranks,	no_awards, no_squadrons);
country:add('ETHIOPIA',		_("Ethiopia"),		"Ethiopia"			, "ETH", use_default_ranks,	no_awards, no_squadrons);
country:add('CHILE',		_("Chile"),			"Chile"				, "CHL", 
 {
	rank('Second lieutenant', _('Sub-Teniente'), 0, {0, 0, 64, 32}),
	rank('First lieutenant', _('Teniente'), 15, {0, 32, 64, 32}),
	rank('Captain', _('Capitan'), 30, {0, 64, 64, 32}),
	rank('Major', _('Cmdte. de Escuadrilla'), 60, {0, 96, 64, 32}),
	rank('Lieutenant colonel', _('Cmdte. de Grupo'), 120, {0, 128, 64, 32}),
	rank('Colonel', _('Coronel'), 240, {0, 160, 64, 32}),
  },
  {
	award('Piloto Militar', _('Piloto Militar'), 200, 'Piloto_Militar.png'),
	award('Piloto de Guerra', _('Piloto de Guerra'),600, 'Piloto_de_Guerra.png'),
	award('Medalla Institucional', _('Medalla Institucional'), 1000, 'Medalla_Institucional.png'),
	award('Medalla Gran Merito', _('Medalla Gran Merito'), 1400, 'Medalla_Gran_Merito.png'),
	award('Cruz al Merito', _('Cruz al Merito'), 1800, 'Cruz_al_Merito.png'),
	award('Servicios Distinguidos', _('Servicios Distinguidos'),2200, 'SD.png'),
  },
  'Chile.lua'
);

country:add('BRAZIL', _("Brazil"), "Brazil", "BRA",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('BAHRAIN', _("Bahrain"), "Bahrain", "BHR",
  use_default_ranks,
  no_awards,
  no_squadrons
);

--<WWII/ 
country:add('THIRDREICH', _("Third Reich"), "Third Reich", "NZG",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('YUGOSLAVIA', _("Yugoslavia"),"Yugoslavia", "YUG",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('USSR', _("USSR"), "USSR", "SUN",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('ITALIAN_SOCIAL_REPUBLIC', _("Italian Social Republic"), "Italian Social Republic", "RSI",
  use_default_ranks,
  no_awards,
  no_squadrons
);
--/WWII>

country:add('ALGERIA',_("Algeria"), "Algeria", "DZA",
{
	rank('Second lieutenant', _('Second lieutenant'), 0, {0, 0, 64, 32}),
	rank('Lieutenant', _('Lieutenant'), 15, {0, 32, 64, 32}),
	rank('Captain', _('Captain'), 30, {0, 64, 64, 32}),
	rank('Commandant', _('Commandant'), 60, {0, 96, 64, 32}),
	rank('Lieutenant colonel', _('Lieutenant colonel'), 120, {0, 128, 64, 32}),
	rank('Colonel', _('Colonel'), 240, {0, 160, 64, 32}),
  },
  {
	award('Medal of Military Merit',_('Medal of Military Merit'), 200, 'Medal of Military Merit.png'),
	award('Medal of the National Peoples Army',_('Medal of the National Peoples Army'), 600, 'Medal of the National Peoples Army.png'),
	award('Medal of the National Peoples Army  II',_('Medal of the National Peoples Army II'), 1000, 'Medal of the National Peoples Army II.png'),
	award('Medal of the Resistance',_('Medal of the Resistance'), 1400, 'Medal of the Resistance.png'),
	award('Combat Wounded Medal',_('Combat Wounded Medal'), 1800, 'Combat Wounded Medal.png'),
	award('Medal of the National Liberation Army',_('Medal of the National Liberation Army'), 2200, 'Medal of the National Liberation Army.png'),
	award('Medal of Veterans of the Revolution',_('Medal of Veterans of the Revolution'), 2600, 'Medal of Veterans of the Revolution.png'),
  },
  'Algeria.lua'
);

country:add('KUWAIT', _("Kuwait"), "Kuwait", "KWT",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('QATAR', _("Qatar"), "Qatar", "QAT",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('OMAN', _("Oman"), "Oman", "OMN",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('UNITED_ARAB_EMIRATES', _("United Arab Emirates"),	"United Arab Emirates", "ARE",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('SOUTH_AFRICA',_("South Africa"), "South Africa", "RSA",
  use_default_ranks,
  {
	award('Unitas Medal', _('Unitas Medal'), 400, 'Unitas_Medal.png'),
	award('General Service Medal', _('General Service Medal'), 800, 'General_Service_Medal.png'),
	award('Pro Virtute Medal', _('Pro Virtute Medal'), 1200, 'Pro_Virtute_Medal.png'),	
	award('Ad Astra Decoration', _('Ad Astra Decoration'), 1600,  'Ad_Astra_Decoration.png'), 
	award('Bronze Protea Medal', _('Bronze Protea Medal'), 2000, 'Bronze_Protea_Medal.png'),
	award('Air Force Cross', _('Air Force Cross'), 2400,  'Air_Force_Cross.png'),	
	award('Southern Africa Medal', _('Southern Africa Medal'), 2800,  'Southern_Africa_Medal.png'),  
	award('Bronze Leopard Medal', _('Bronze Leopard Medal'), 3200, 'Bronze_Leopard_Medal.png'),
	award('Pro Merito Medal', _('Pro Merito Medal'), 3600, 'Pro_Merito_Medal.png'),
	award('Medal for Loyal Service', _('Medal for Loyal Service'), 4000, 'Medal_for_Loyal_Service.png'),
	award('Silver Protea Medal', _('Silver Protea Medal'), 4400, 'Silver_Protea_Medal.png'),
	award('Pro Patria Medal', _('Pro Patria Medal'), 4800, 'Pro_Patria_Medal.png'), 
	award('Silver Leopard Medal', _('Silver Leopard Medal'), 5200, 'Silver_Leopard_Medal.png'),	
	award('Pro Virtute Decoration', _('Pro Virtute Decoration'), 5600, 'Pro_Virtute_Decoration.png'), 
	award('Pro Merito Decoration', _('Pro Merito Decoration'), 6000, 'Pro_Merito_Decoration.png'),
	award('Golden Protea Medal', _('Golden Protea Medal'), 6500, 'Golden_Protea_Medal.png'),
	award('Golden Leopard Medal', _('Golden Leopard Medal'), 7000, 'Golden_Leopard_Medal.png'),
  },
  'South Africa.lua'
);

country:add('CUBA', _("Cuba"), "Cuba", "CUB",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('PORTUGAL', _("Portugal"), "Portugal", "PRT",
  use_default_ranks,
  {
	award('Gold Degree Exemplary Behavior Medal', _('Gold Degree Exemplary Behavior Medal'), 200,  'PT-01-Gold_Degree_Exemplary_Behavior_Medal.png'),
	award('MВrito Aeronаutico Medal 1st Class for OF-5 and above', _('MВrito Aeronаutico Medal 1st Class for OF-5 and above'), 600,  'PT-02-MВrito_Aeronаutico_Medal_1st_Class_for_OF-5_and_above.png'),
	award('Grand Cross Military Merit Medal for OF-6 and above', _('Grand Cross Military Merit Medal for OF-6 and above'), 1000, 'PT-03-Grand_Cross_Military_Merit_Medal_for_OF-6_and_above.png'),
	award('Distinguished Service Medal Silver', _('Distinguished Service Medal Silver'), 1400, 'PT-04-Distinguished_Service_Medal_Silver.png'),
	award('Military Order of Avis', _('Military Order of Avis'), 1800, 'PT-05-Military_Order_of_Avis.png'),
	award('Military Medal of the 4th War Cross Class', _('Military Medal of the 4th War Cross Class'), 2200, 'PT-06-Military_Medal_of_the_4th_War_Cross_Class.png'),
	award('Order of Liberty Officer class', _('Order of Liberty Officer class'), 2600, 'PT-07-Order_of_Liberty_Officer_class.png'),
	award('Military Order of the Tower and Sword', _('Military Order of the Tower and Sword'), 3000, 'PT-08-Military_Order_of_the_Tower_and_Sword.png'),
  },
  'Portugal.lua'
);

country:add('GDR',_("GDR"), "GDR", "GDR",
  use_default_ranks,
  {
	award('Medal Brotherhood in Arms', _('Medal Brotherhood in Arms'), 200,  'GDR-01-Medal_Brotherhood_in_Arms.png'),
	award('Medal For Faithful Service in the National Peoples Army', _('Medal For Faithful Service in the National Peoples Army'), 600,  'GDR-02-Medal_For_Faithful_Service_in_the_National_Peoples_Army.png'),
	award('Meritorious Military Pilot of the GDR', _('Meritorious Military Pilot of the GDR'), 1000, 'GDR-03-Meritorious_Military_Pilot_of_the_GDR.png'),
	award('Blucher Order', _('Blucher Order'), 1400, 'GDR-04-Blucher_Order.png'),
	award('Combat Order of Merit', _('Combat Order of Merit'), 1800, 'GDR-05-Combat_Order_of_Merit.png'),
	award('Star of Peoples Friendship', _('Star of Peoples Friendship'), 2200, 'GDR-06-Star_of_Peoples_Friendship.png'),
	award('Scharnhorst Order', _('Scharnhorst Order'), 2600, 'GDR-07-Scharnhorst_Order.png'),
	award('Hero of the GDR', _('Hero of the GDR'), 3000, 'GDR-08-Hero_of_the_GDR.png'),
  },
  'GDR.lua'
);

country:add('LEBANON', _("Lebanon"), "Lebanon", "LBN",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('CJTF_BLUE' ,_("Combined Joint Task Forces Blue"), "CJTF Blue", "BLUE",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('CJTF_RED'  ,_("Combined Joint Task Forces Red"), "CJTF Red", "RED",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('UN_PEACEKEEPERS'  ,_("United Nations Peacekeepers"), "UN", "UN",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('ARGENTINA', _("Argentina"), "Argentina", "ARG",
  {
	rank('Second lieutenant', _('Teniente'), 0, {0, 0, 64, 32}),
	rank('First lieutenant', _('Teniente Primero'), 15, {0, 32, 64, 32}),
	rank('Captain', _('Captain'), 30, {0, 64, 64, 32}),
	rank('Major', _('Major'), 60, {0, 96, 64, 32}),
	rank('Lieutenant colonel', _('Vicecomodoro'), 120, {0, 128, 64, 32}),
	rank('Colonel', _('Comondoro'), 240, {0, 160, 64, 32}),
  },
  {
	award('Combatientes', _('Combatientes'), 200, 'Combatientes.png'),
	award('Armada Operaciones en Combate', _('Armada Operaciones en Combate'),600, 'Armada Operaciones en Combate.png'),
	award('Al Valor en Combate', _('Al Valor en Combate'),600, 'Al Valor en Combate.png'),
	award('Heroismo en Combate', _('Heroismo en Combate'), 1000, 'Heroismo en Combate.png'),
	award('Armada al Esfuerzo', _('Armada al Esfuerzo'), 1400, 'Armada al Esfuerzo.png'),
	award('Armada al Valor', _('Armada al Valor'), 1800, 'Armada al Valor.png'),
	award('Armada Heroismo en combate', _('Armada Heroismo en combate'),2200, 'Armada Heroismo en combate.png'),
	award('Orden de Mayo', _('Orden de Mayo'),2200, 'Orden de Mayo.png'),
	award('Gran Cruz Libertador San Martin', _('Gran Cruz Libertador San Martin'),2200, 'Gran Cruz Libertador San Martin.png'),
  },
  'Argentina.lua'
);

country:add('CYPRUS', _("Cyprus"), "Cyprus", "CYP",
  use_default_ranks,
  no_awards,
  no_squadrons
);

country:add('SLOVENIA', _("Slovenia"), "Slovenia", "SVN",
  {
	rank('Second lieutenant', _('Porocnik'), 0, {0, 0, 64, 32}),
	rank('First lieutenant', _('Nadporocnik'), 15, {0, 32, 64, 32}),
	rank('Captain', _('Stotnik'), 30, {0, 64, 64, 32}),
	rank('Major', _('Major'), 60, {0, 96, 64, 32}),
	rank('Lieutenant colonel', _('Podpolkovnik'), 120, {0, 128, 64, 32}),
	rank('Colonel', _('Polkovnik'), 240, {0, 160, 64, 32}),
  },
  {
	award('Castni vojni znak', _('Castni vojni znak'), 200, 'SLO-01.png'),
	award('Medalja za ranjence', _('Medalja za ranjence'), 600, 'SLO-02.png'),
	award('Red generala Maistra I.stopnje', _('Red generala Maistra I.stopnje'), 1000, 'SLO-03.png'),
	award('Red Slovenske vojske', _('Red Slovenske vojske'), 1400, 'SLO-04.png'),
	award('Zlata medalja vojaku Slovenske vojske', _('Zlata medalja vojaku Slovenske vojske'), 1800, 'SLO-05.png'),
	award('Zlata medalja nacelnika generalstaba', _('Zlata medalja nacelnika generalstaba'), 2200, 'SLO-06.png'),
	award('Medalja za zasluge', _('Medalja za zasluge'), 2600, 'SLO-07.png'),
	award('Srebrna medalja generala Maistra', _('Srebrna medalja generala Maistra'), 3000, 'SLO-08.png'),
	award('Zlata medalja generala Maistra', _('Zlata medalja generala Maistra'), 4000, 'SLO-09.png'),
	award('Srebrna medalja Slovenske vojske', _('Srebrna medalja Slovenske vojske'), 5000, 'SLO-10.png'),
	award('Zlata medalja Slovenske vojske', _('Zlata medalja Slovenske vojske'), 6000, 'SLO-11.png'),
	award('Medalja za hrabrost', _('Medalja za hrabrost'), 7000, 'SLO-12.png'),
  },
  'Slovenia.lua'
);

-->
