<?php
	include 'config.php';
	$empID = $_GET['id'];
	$delete = "DELETE FROM `employee` WHERE empID = '$empID'";
	$query = mysqli_query($conn, $delete);
	if($query){
		header('location:employee.php');
	}
?>