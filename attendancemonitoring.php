<?php
	include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Attendance Monitoring (By Employee) Page </title>
	</head>
	<body>
	<br>
	<form action="" method="POST" align="center">
	<label> Employee ID#: </label>
	<input type="text" name="empID" placeholder="Enter Employee ID#" required>
	<button name="search" style="background:yellow"> Search </button> <button style="background:cyan"> <a href="index.php"> Back To Menu </a> </button>
	
	<?php
		$empFName = "";
		$empLName = "";
		$empRPH = 0;
		$totalHours = 0;
		$salary = 0;
		$depName = "";
		if(isset($_POST['search'])){
			$empID = $_POST['empID'];
		$select = "SELECT
					employee.empFName,
					employee.empLName,
					employee.empRPH,
					department.depName,
					TIMESTAMPDIFF(HOUR, attendance.attTimeIn, attendance.attTimeOut) as TotalHours
					FROM employee
					INNER JOIN department on employee.depCode = department.depCode
					INNER JOIN attendance on employee.empID = attendance.empID
					WHERE employee.empID = '$empID'";
		$query = mysqli_query($conn, $select);
		if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_array($query)){
			$empFName = $row['empFName'];
			$empLName = $row['empLName'];
			$empRPH = $row['empRPH'];
			$depName = $row['depName'];
			
			$totalHours += $row['TotalHours'];
			
			}
			$salary = $totalHours * $empRPH;
		}
		else {
					?>
					<p align="center"style="color:red"> Employee ID has exist but no records! </p>
					<?php
				}
	}
	?>
	

 	</form>
	<br>
	<p>Name: <?php echo $empFName . " " . $empLName;?></p>
	<p>Department: <?php echo $depName;?></p>
	<p> Rate Per Hour: <?php echo $empRPH;?></p>
	<p> Salary:<?php echo $salary;?> </p>
	<p> Total Hours Worked: <?php echo $totalHours;?> </p>
	
	<table width="100%" border="1px">
		<tr>
			<th align="center"> Record # </th>
			<th align="center"> Emp ID </th>
			<th align="center"> Date/Time In </th>
			<th align="center"> Date/Time Out </th>
			<th align="center"> Total Hours </th>
			
		</tr>
		<?php
			if(isset($_POST['search']) && mysqli_num_rows($query) > 0){
				$selects = "SELECT
							employee.empID,
							attendance.attRN,
							attendance.attTimeIn,
							attendance.attTimeOut,
							TIMESTAMPDIFF(HOUR, attendance.attTimeIn, attendance.attTimeOut) as TotalHours
							FROM employee
							INNER JOIN attendance on employee.empID = attendance.empID
							WHERE employee.empID = '$empID'";
				$querys = mysqli_query($conn, $selects);
				if(mysqli_num_rows($querys) > 0){
					while($row = mysqli_fetch_array($querys)){
						?>
							<tr>
								<td align="center"style="background:lightgreen"><?php echo $row['attRN'];?></td>
								<td align="center" style="background:cyan"><?php echo $row['empID'];?></td>
								<td align="center"style="background:yellow"><?php echo $row['attTimeIn'];?></td>
								<td align="center"style="background:yellow"><?php echo $row['attTimeOut'];?></td>
								<td align="center"style="background:lightgray"><?php echo $row['TotalHours'];?></td>
							</tr>
						<?php
					}
				} else {
					?>
					<th align="center" colspan="5" style="background:yellow"> Employee ID does not exist! </th>
					<?php
				}
				?>
				 <p> Date Generated: <?php echo date("M-y-d H:i:s");?> </p>
				<?php
			}
		?>
		
		
		
	</table>
	</body>
</html>