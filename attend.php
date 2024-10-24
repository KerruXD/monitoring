<?php
	include 'config.php';
	$attRN = $_GET['id'];
	$select = "SELECT * FROM `attendance` WHERE attRN = '$attRN'";
	$query = mysqli_query($conn, $select);
	$row = mysqli_fetch_array($query);
	
	if($row['attStat'] == "Cancelled"){
		$update = "UPDATE `attendance` SET attStat = 'Not' WHERE attRN = '$attRN'";
		$query = mysqli_query($conn, $update);
		if($query){
			header('location:attendance.php');
		}
	}else if($row['attStat'] == "Not"){
		$update = "UPDATE `attendance` SET attStat = 'Cancelled' WHERE attRN = '$attRN'";
		$query = mysqli_query($conn, $update);
		if($query){
			header('location:attendance.php');
		}
	}
	

?>