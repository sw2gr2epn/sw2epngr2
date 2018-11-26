<?php include 'template/header.php'; ?>


<h1>Genre Stats</h1>

<?php $result = $mysqli->query("SELECT * FROM Genre"); ?>

<table class="table table-striped">
	<tr>
		<th>GenreID</th>
		<th>Genre</th>
        <th>Movie Count</th>
        <th>Ticket Sales</th>
    </tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<tr>
			<td><?php echo $row['GenreID']; ?></td>
			<td><?php echo $row['Genre']; ?></td>

            <?php
            $result2 = $mysqli->query("SELECT COUNT(*) AS \"MovieCount\" FROM Movie JOIN GenreMap ON Movie.MovieID = GenreMap.MovieID JOIN Genre ON GenreMap.GenreID = Genre.GenreID WHERE Genre.GenreID=" . $row['GenreID'] );
            $value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            ?>
            <td><?php echo $value2['MovieCount']; ?></td>

            <?php
            $result3 = $mysqli->query("SELECT SUM(TicketCost) AS \"TicketSales\" FROM Viewing JOIN Showing ON Viewing.ShowingID = Showing.ShowingID JOIN Movie ON Showing.MovieID = Movie.MovieID JOIN GenreMap ON Movie.MovieID = GenreMap.MovieID JOIN Genre ON GenreMap.GenreID = Genre.GenreID WHERE Genre.GenreID=" . $row['GenreID']  );
            $value3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
            ?>
            <td><?php echo $value3['TicketSales']; ?></td>
        </tr>
	<?php } ?>
</table>

<?php $result->close(); ?>

<?php include 'template/footer.php'; ?>
