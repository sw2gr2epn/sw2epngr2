<h1>Customer List</h1>

<?php $result = $mysqli->query("SELECT * FROM Customer"); ?>

<table class="table table-striped">
    <tr>
        <th>CustomerId</th>
        <th>FName</th>
        <th>LName</th>
        <th>Gender</th>
        <th>Email</th>
    </tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<tr>
			<td><?php echo $row['CustomerID']; ?></td>
			<td><?php echo $row['FName']; ?></td>
            <td><?php echo $row['LName']; ?></td>
            <td><?php echo $row['Gender']; ?></td>
            <td><?php echo $row['Email']; ?></td>
        </tr>
	<?php } ?>
</table>

<?php $result->close(); ?>
