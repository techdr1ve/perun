

	<?php
		$k = $_POST['pe_dataplayers_id'];
		$k = trim($k);
		$con = mysqli_connect($config_db_host, $config_db_username, $config_db_password, $config_db_database); 	
		$sql ="SELECT
		pe_dataplayers_id,
		pe_dataplayers_lastname
		FROM pe_dataplayers
		WHERE pe_dataplayers_id='{$k}'";
		$res = mysqli_query($con, $sql);
		while($rows = mysqli_fetch_array($res)){
	?>
		<tr>
			<td> <?php echo $rows['pe_dataplayers_id']; ?> </td>
			<td> <?php echo $rows['pe_dataplayers_lastname']; ?> </td>	
		</tr>
	
	<?php
		
		}
	
		echo $sql;
	?>