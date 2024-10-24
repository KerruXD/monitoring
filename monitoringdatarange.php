<?php
	include 'config.php';
	
	$select = "SELECT
				employee.empID,
				attendance.attRN,
				attendance.attTimeIn,
				attendance.attTimeOut,
				TIMESTAMPDIFF(HOUR, attendance.attTimeIn, attendance.attTimeOut) as TotalHours
				FROM employee
				INNER JOIN attendance on employee.empID = attendance.empID";
	$query = mysqli_query($conn, $select);
	$totalhours = 0;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Attendance Monitoring (Data Range) Page </title>
	</head>
	<body>
	<br>
	<h2 align="center">
	<a href="index.php"> Back To Home </a>
	</h2>
	<br>
	<p>Date From: <b><?php echo date("M-d-y, H:i:s");?></b></p>
	<p>Date To: <b><?php echo date("M-d-y, H:i:s");?></b></p>
	<table width="100%" border="1px">
		<tr>
			<th align="center"> Record # </th>
			<th align="center"> Emp ID </th>
			<th align="center"> Date/Time In </th>
			<th align="center"> Date/Time Out </th>
			<th align="center"> Total Hours </th>
		</tr>
		<?php
		
		if(mysqli_num_rows($query) > 0){
			
			
				while($row = mysqli_fetch_array($query)){
						?>
							<tr>
								<td align="center"style="background:lightgreen"><?php echo $row['attRN'];?></td>
								<td align="center" style="background:cyan"><?php echo $row['empID'];?></td>
								<td align="center"style="background:yellow"><?php echo $row['attTimeIn'];?></td>
								<td align="center"style="background:yellow"><?php echo $row['attTimeOut'];?></td>
								<td align="center"style="background:lightgray"><?php echo $row['TotalHours'];?></td>
							</tr>
						<?php
						$totalhours += $row['TotalHours'];
					}
					
			}
		?>
	</table>
		<p>Total Hours Worked: <?php echo $totalhours; ?> </p>
		<p>Date Generated: <?php echo date("M-d-y, H:i:s");?></p>
		

	</body>
</html>