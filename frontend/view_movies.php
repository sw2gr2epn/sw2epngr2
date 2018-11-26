<?php include 'template/header.php'; ?>

<h1>Top Movies</h1>

<?php $result = $mysqli->query("SELECT * FROM Movie"); ?>

<table class="table table-striped">
	<tr>
		<th>MovieID</th>
		<th>MovieName</th>
		<th>ReleaseYear</th>
		<th>Genre</th>
        <th>Average Rating</th>
    </tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
		<?php
		$result2 = $mysqli->query("SELECT GenreID FROM GenreMap WHERE MovieID=" . $row['MovieID']);
		$value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
		$result3 = $mysqli->query("SELECT Genre FROM Genre WHERE GenreID=" . $value2["GenreID"]);
		$value3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

        $result4 = $mysqli->query("SELECT AvgRating FROM ( SELECT AVG(Rating) AS AvgRating FROM Viewing JOIN Showing ON Viewing.ShowingID = Showing.ShowingID JOIN Movie ON Showing.MovieID = Movie.MovieID  WHERE Movie.MovieID=" . $row["MovieID"] . " ) AS T WHERE AvgRating >= 4");
        $value4 = mysqli_fetch_array($result4, MYSQLI_ASSOC);
        ?>

        <?php if ($value4["AvgRating"] != NULL){ ?>
		<tr>
			<td><?php echo $row['MovieID']; ?></td>
			<td><?php echo $row['MovieName']; ?></td>
			<td><?php echo $row['ReleaseYear']; ?></td>
			<td><?php echo $value3["Genre"]; ?></td>
            <td><?php echo $value4["AvgRating"]; ?></td>
        </tr>
        <?php } ?>
	<?php } ?>
</table>

<?php $result->close(); ?>

<?php include 'template/footer.php'; ?>
