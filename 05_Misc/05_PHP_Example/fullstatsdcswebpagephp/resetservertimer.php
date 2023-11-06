    <script>
	//SOURCE CREDIT: https://stackoverflow.com/questions/4508488/how-to-make-a-countdown-using-php
    //NOTE: This code has been modified to work with values from SQL Database
	// Set the date we're counting down to
    // 1. JavaScript
    // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
    // 2. PHP
	
	
	<?php
		$con = mysqli_connect($config_db_host,$config_db_username,$config_db_password,$config_db_database); 	
		$sql ="SELECT a.`pe_OnlineStatus_mission_modeltime`AS mission_duration, (12*60*60 - a.`pe_OnlineStatus_mission_modeltime`) AS reset_time FROM pe_onlinestatus AS a 
		ORDER BY pe_OnlineStatus_instance DESC LIMIT 1";
		$res = mysqli_query($con, $sql);
		while( $rows = mysqli_fetch_array($res)){
	?>

	var now = <?php   echo time() ?> *1000;
	var resettime = <?php echo $rows['reset_time']  ?>	*1000;
	var now2 =  now + resettime;	
	
	//var datte = '2021-11-30 22:00:00';
	//document.write(datte);
	//document.write(resettime);
	//document.write(now);
	//document.write(now2);

	//var countDownDate = <?php echo strtotime('2021-11-30 22:00:00') ?> * 1000;
	//document.write(countDownDate);
	
		<?php
		//$result->close();
		} ?>
	
    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        // 1. JavaScript
        // var now = new Date().getTime();
        // 2. PHP
        now = now + 1000;

        // Find the distance between now an the count down date
        //var distance = missiondurationplus12hours - now;
		//var distance = timeleft - now;
		var distance = now2 - now;
		//var distance = missionduration - now;
		//var distance = countDownDate - now;
		//var distance = now - resettime;

        // Time calculations for days, hours, minutes and seconds
        //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML =  + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "SERVER RESTARTING";
        }
    }, 1000);
    </script>