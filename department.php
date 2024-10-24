<?php
	include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Department Management Page </title>
	</head>
	<body>
	<h2 align="center">
	<a href="adddepartment.php"> Add a Department Here </a>  |  <a href="index.php"> Back to Menu </a>
	</h2>
	<br>
	<table width="100%" border="1px">
		<tr>
			<th align="center"> Code </th>
			<th align="center"> Name </th>
			<th align="center"> Head </th>
			<th align="center"> Tel No. </th>
			<th align="center"> Actions </th>
		</tr>
		<?php
			$select = "SELECT * FROM `department`";
			$query = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
					?>
						<tr>
							<td align="center"style="background:pink"><?php echo $row['depCode'];?></td>
							<td align="center" style="background:yellow"><?php echo $row['depName'];?></td>
							<td align="center" style="background:cyan"><?php echo $row['depHead'];?></td>
							<td align="center" style="background:lightgreen"><?php echo $row['depTelNo'];?></td>
							<td align="center">
								<button> <a href="editdepartment.php?id=<?php echo $row['depCode']; ?>"> Edit </a> </button>
								<button> <a href="deletedepartment.php?id=<?php echo $row['depCode']; ?>" onclick="return confirm ('Do you wish to delete this department?')"> Delete </a> </button>
							</td>
						</tr>
					<?php
				}
			} else {
				?>
					<th align="center" colspan="5" style="background:yellow"> No Department Records </th>
				<?php
			}
		?>
	</table>
	</body>
</html