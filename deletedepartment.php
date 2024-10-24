<?php
	include 'config.php';
	$depCode = $_GET['id'];
	$delete = "DELETE FROM `department` WHERE depCode = '$depCode'";
	$query = mysqli_query($conn, $delete);
	if($query){
		header('location:department.php');
	}
?>