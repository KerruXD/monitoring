<?php
	include 'config.php';
	$attRN = "";
	$empID = "";
	$attTimeIn = "";
	$attTimeOut = "";
	
	$error = "";
	
	if(isset($_GET['error'])){
		$error = $_GET['error'];
	}
	
	if(isset($_POST['add'])){
		$attRN = $_POST['attRN'];
		$empID = $_POST['empID'];
		$attTimeIn = $_POST['attTimeIn'];
		$attTimeOut = $_POST['attTimeOut'];
		
		
		if(!ctype_digit($attRN)){
			$error = "Attendance Record Number must be numeric!";
		}else if(!ctype_digit($empID)){
			$error = "Employee ID must be numeric!";
		}else{
			$select = "SELECT * FROM `employee` WHERE empID = '$empID'";
			$query = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) == 0){
				$error = "Employee ID still not exists in the Employee!";
			}
			else {
			$select = "SELECT * FROM `attendance` WHERE attRN = '$attRN'";
			$query = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) > 0){
				$error = "Attendance Record Number already exists!";
			} else {
				$insert = "INSERT INTO `attendance` (`attRN`, `empID`, `attTimeIn`, `AttTimeOut`) VALUES ('$attRN', '$empID', '$attTimeIn', '$attTimeOut')";
				$query = mysqli_query($conn, $insert);
				if($query){
					?>
						<script type="text/javascript"> alert("Attendace Record Was Successfully Been Added!");
						window.location.href='attendance.php';
						</script>
					<?php
				}
			}			
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Record Attendance Page </title>
	</head>
	<body>
	<h1 align="center"> Add Attendance </h1>
	<?php if($error):?>
	<p align="center" style="color:red"><?php echo $error;?></p>
	<?php endif; ?>
	<br>
	<form action="" method="POST">
		<center>
		<label> Attendace Record #: </label>
		<input type="text" name="attRN" placeholder="Enter Attendance Record #" value="<?php echo $attRN;?>" required><br><br>
		<label> Employee ID: </label>
		<input type="text" name="empID" placeholder="Enter Employee ID" value="<?php echo $empID;?>" required><br><br>
		<label> Date/Time In: </label>
		<input type="datetime-local" name="attTimeIn" value="<?php echo $attTimeIn;?>" required><br><br>
		<label> Date/Time Out: </label>
		<input type="datetime-local" name="attTimeOut" value="<?php echo $attTimeOut;?>" required><br><br>
		<button name="add" style="background:cyan"> Add Attendance </button> <button style="background:yellow"> <a href="attendance.php"> Cancel </a> </button>
		</center>
	</form>
	</body>s
</html>