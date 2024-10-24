<?php
	include 'config.php';
	$empID = "";
	$depCode = "";
	$empFName = "";
	$empLName = "";
	$empRPH = "";
	$error = "";
	
	if(isset($_GET['error'])){
		$error = $_GET['error'];
	}
	
	if(isset($_POST['add'])){
		$empID = $_POST['empID'];
		$depCode = $_POST['depCode'];
		$empFName = $_POST['empFName'];
		$empLName = $_POST['empLName'];
		$empRPH = $_POST['empRPH'];
		
		if(!ctype_digit($empID)){
			$error = "Employee ID must be numeric!";
		}else if(!ctype_digit($depCode)){
			$error = "Department Code must be numeric!";
		}else if(strpbrk($empFName, "1234567890-=!@#$%^&*()_+") || $empFName[0] == " " || $empFName[0] == 0){
			$error = "Employee First Name must not contain contraint spaces, numbers and symbols!";
		}if(strpbrk($empLName, "1234567890-=!@#$%^&*()_+") || $empLName[0] == " " || $empLName[0] == 0){
			$error = "Employee Last Name must not contain contraint spaces, numbers and symbols!";
		}else if($empRPH <= 0){
			$error = "Rate Per Hour must be greater than Zero!";
		}else{
			$select = "SELECT * FROM `department` WHERE depCode = '$depCode'";
			$query = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) == 0){
				$error = "Department Code still not exists in the Department!";
			}
			else {
			$select = "SELECT * FROM `employee` WHERE empID = '$empID'";
			$query = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) > 0){
				$error = "Employee ID already exists!";
			} else {
				$insert = "INSERT INTO `employee` (`empID`, `depCode`, `empFName`, `empLName`, `empRPH`) VALUES ('$empID', '$depCode', '$empFName', '$empLName', '$empRPH')";
				$query = mysqli_query($conn, $insert);
				if($query){
					?>
						<script type="text/javascript"> alert("Employee Was Successfully Been Added!");
						window.location.href='employee.php';
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
		<title> Add Employee Page </title>
	</head>
	<body>
	<h1 align="center"> Add Employee </h1>
	<?php if($error):?>
	<p align="center" style="color:red"><?php echo $error;?></p>
	<?php endif; ?>
	<br>
	<form action="" method="POST">
		<center>
		<label> Employee ID: </label>
		<input type="text" name="empID" placeholder="Enter Employee ID" value="<?php echo $empID;?>" required><br><br>
		<label> Department Code: </label>
		<input type="text" name="depCode" placeholder="Enter Department Code" value="<?php echo $depCode;?>" required><br><br>
		<label> Employee First Name: </label>
		<input type="text" name="empFName" placeholder="Enter Employee First Name" value="<?php echo $empFName;?>" required><br><br>
		<label> Employee Last Name: </label>
		<input type="text" name="empLName" placeholder="Enter Employee Last Name" value="<?php echo $empLName;?>" required><br><br>
		<label> Employee Rate Per Hour </label>
		<input type="number" name="empRPH" placeholder="Enter Rate Per Hour" value="<?php echo $empRPH; ?>" required><br><br>
		<button name="add" style="background:cyan"> Add Employee </button> <button style="background:yellow"> <a href="employee.php"> Cancel </a> </button>
		</center>
	</form>
	</body>
</html>