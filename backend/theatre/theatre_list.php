<h1>Theatre List</h1>

<?php $result = $mysqli->query("SELECT * FROM Theatre"); ?>

<table class="table table-striped">
	<tr>
		<th>RoomNumber</th>
		<th>Capacity</th>
	</tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<tr>
			<td><?php echo $row['RoomNumber']; ?></td>
			<td><?php echo $row['Capacity']; ?></td>
		</tr>
	<?php } ?>
</table>

<?php $result->close(); ?>
