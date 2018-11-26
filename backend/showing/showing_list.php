<h1>Showing List</h1>

<?php $result = $mysqli->query("SELECT * FROM Showing"); ?>

<table class="table table-striped">
	<tr>
		<th>ShowingID</th>
		<th>MovieName</th>
		<th>RoomNumber</th>
		<th>Date</th>
		<th>Time</th>
	</tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<?php
		$result2 = $mysqli->query("SELECT MovieName FROM Movie WHERE MovieID=" . $row['MovieID']);
		$value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
		?>
		<tr>
			<td><?php echo $row['ShowingID']; ?></td>
			<td><?php echo $value2["MovieName"]; ?></td>
			<td><?php echo $row['RoomNumber']; ?></td>
			<td><?php echo $row['Date']; ?></td>
			<td><?php echo $row["Time"]; ?></td>
		</tr>
	<?php } ?>
</table>

<?php $result->close(); ?>
