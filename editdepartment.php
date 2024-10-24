<?php
	include 'config.php';
	
	$depCode = $_GET['id'];
	
	$select = "SELECT * FROM `department` WHERE depCode = '$depCode'";
	$query = mysqli_query($conn, $select);
	$row = mysqli_fetch_array($query);
	
	$error = "";
	if(isset($_GET['error'])){
		$error = $_GET['error'];
	}
	
	if(isset($_POST['save'])){
		$new_depCode = $_POST['depCode'];
		$depName = $_POST['depName'];
		$depHead = $_POST['depHead'];
		$depTelNo = $_POST['depTelNo'];
		
		if(!ctype_digit($new_depCode)){
			$error = "Department Code must be numeric!";
		} else if($depName[0] == " "){
			$error = "Department Name must contain constraint spaces!";
		}else if($depHead[0] == " " || strpbrk($depHead,"1234567890-=!@#$%^&*()_+") || $depHead[0] == 0){
			$error = "Department Head must contain constraint spaces, numbers and special symbols!";
		}else if(!ctype_digit($depTelNo)){
			$error = "Department Telephone Number must be a numbers!";
		} else{
			$check = "SELECT * FROM `department` WHERE depCode = '$new_depCode' and depCode != '$depCode'";
			$query = mysqli_query($conn,$check);
			if(mysqli_num_rows($query) > 0){
				$error = "Department Code already exists!";
			} else {
				$update = "UPDATE `department` SET 
							depCode = '$new_depCode',
							depName = '$depName',
							depHead = '$depHead',
							depTelNo = '$depTelNo'
							WHERE depCode = '$depCode'";
				$query = mysqli_query($conn, $update);
				if($query){
					?>
						<script type="text/javascript"> alert("Department Was Saved Successfully!");
						window.location.href="department.php";
						</script>
					<?php
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
		<title> Add Department Page </title>
	</head>
	<body>
	<h1 align="center"> Add Department </h1>
	<?php if($error):?>
	<p align="center" style="color:red"><?php echo $error;?></p>
	<?php endif; ?>
	<br>
	<form action="" method="POST">
		<center>
		<label> Department Code: </label>
		<input type="text" name="depCode" placeholder="Enter Department Code" value="<?php echo $row['depCode'];?>" required><br><br>
		<label> Department Name: </label>
		<input type="text" name="depName" placeholder="Enter Department Name" value="<?php echo $row['depName'];?>" required><br><br>
		<label> Department Head Name: </label>
		<input type="text" name="depHead" placeholder="Enter Department Head" value="<?php echo $row['depHead'];?>" required><br><br>
		<label> Department TelNo: </label>
		<input type="tel" name="depTelNo" placeholder="Enter Department Tel No#" minlength="11" maxlength="11" value="<?php echo $row['depTelNo'];?>" required><br><br>
		<button name="save" style="background:cyan"> Save Changes </button> <button style="background:yellow"> <a href="department.php"> Cancel </a> </button>
		</center>
	</form>
	</body>
</html>