<?php
	$con = mysqli_connect("127.0.0.1","root","bigspringsbrew","vietnamtest"); 	
	$sql ="SELECT DISTINCT
	pe_dataplayers_lastname
	FROM pe_dataplayers";
	$res = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="js/fetchpilot.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<style type="text/css">
		table{
			border: 1px solid;
			border-collapse: collapse;
			padding: 10px;
			
		}
		th, td, tr{
			border: 1px solid:
		}
		
	</style>

</head>
<body>
	Select Pilot:
	<select id="pilotid" onchange="selectPilot()">
		<?php while( $rows = mysqli_fetch_array($res)){
			?>
			<option value="<?php echo $rows['pe_dataplayers_lastname'];  ?>  " > <?php echo $rows['pe_dataplayers_lastname'];   ?> </option>
			
		<?php
		}
		?>
		
	</select>
	
<table>
	<thead>
		<th style="width: 30%"> ID </th>
		<th style="width: 30%"> Pilot </th>		
	</thead>
	<tbody id="ans">
	
	</tbody>
</table>

</body>
</html>