<?php
	include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Employees Management Page </title>
	</head>
	<body>
	<h2 align="center">
	<a href="addemployee.php"> Add an Employee Here </a>  |  <a href="index.php"> Back to Menu </a>
	</h2>
	<br>
	<table width="100%" border="1px">
		<tr>
			<th align="center"> ID </th>
			<th align="center"> Dept </th>
			<th align="center"> Lastname </th>
			<th align="center"> Firstname </th>
			<th align="center"> Rate Per Hour </th>
			<th align="center"> Actions </th>
		</tr>
		<?php
			$select = "SELECT * FROM `employee`";
			$query  = mysqli_query($conn, $select);
			if(mysqli_num_rows($query) > 0){
				while ($row = mysqli_fetch_array($query)){
					?>
						<tr>
							<td align="center"style="background:pink"><?php echo $row['empID']; ?> </td>
							<td align="center"style="background:cyan"><?php echo $row['depCode']; ?> </td>
							<td align="center"style="background:yellow"><?php echo $row['empLName']; ?> </td>
							<td align="center"style="background:yellow"><?php echo $row['empFName']; ?> </td>
							<td align="center"style="background:lightgreen"><?php echo $row['empRPH']; ?> </td>
							<td align="center"style="background:lightgray">
								<button> <a href="editemployee.php?id=<?php echo $row['empID'];?>"> Edit </a> </button>
								<button> <a href="deleteemployee.php?id=<?php echo $row['empID'];?>" onclick="return confirm ('Do you wish to delete this employee?')"> Delete </a> </button>
							</td>
						</tr>
					<?php
				}
			} else {
				?>
					<th align="center" colspan="6" style="background:yellow"> No Employee Records! </th>
				<?php
			}
		?>
	</table>
	</body>
</html