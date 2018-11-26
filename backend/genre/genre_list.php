<h1>Genre List</h1>

<?php $result = $mysqli->query("SELECT * FROM Genre"); ?>

<table class="table table-striped">
	<tr>
		<th>GenreID</th>
		<th>Genre</th>
	</tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<tr>
			<td><?php echo $row['GenreID']; ?></td>
			<td><?php echo $row['Genre']; ?></td>
		</tr>
	<?php } ?>
</table>

<?php $result->close(); ?>
