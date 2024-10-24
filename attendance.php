<?php
	include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Attendance Recording Page </title>
	</head>
	<body>
	<h2 align="center">
	<a href="addattendance.php"> Record Attendance Here </a>  |  <a href="index.php"> Back to Menu </a>
	</h2>
	<br>
	<table width="100%" border="1px">
		<tr>
			<th align="center"> Record # </th>
			<th align="center"> EMP ID </th>
			<th align="center"> Date/Time In </th>
			<th align="center"> Date/Time Out </th>
			<th align="center"> Actions </th>
		</tr>
		<?php
		$select = "SELECT * FROM `attendance`";
		$query = mysqli_query($conn, $select);
		if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_array($query)){
				?>
					<tr>
						<td align="center"style="background:lightgreen"><?php echo $row['attRN'];?></td>
						<td align="center"style="background:cyan"><?php echo $row['empID'];?></td>
						<td align="center"style="background:yellow"><?php echo $row['attTimeIn'];?></td>
						<td align="center"style="background:yellow"><?php echo $row['attTimeOut'];?></td>
						<td align="center"style="background:lightgray">
						<?php
						if($row['attStat'] == "Cancelled"){
							?>
							<button> <a href="attend.php?id=<?php echo $row['attRN'];?>" onclick="return confirm('Do you wish not to cancel the Attendance?')"> Cancelled </a> </button>
							<?php
						} else if($row['attStat'] == "Not"){
							?>
							<button> <a href="attend.php?id=<?php echo $row['attRN'];?>" onclick="return confirm('Do you wish to cancel the Attendance?')"> Not </a> </button>
							<?php
						}
						?>
						</td>
					</tr>
				<?php
			}
		} else {
			?>
				<th align="center" colspan="5" style="background:yellow"> No Attendance Record! </th>
			<?php
		}
		?>
	</table>
	</body>
</html