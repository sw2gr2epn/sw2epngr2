<?php include 'template/header.php'; ?>

<form action="" method="post">
    <div class="col-md-11">
        <br><br>

        <h1>Filters</h1>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>Genre</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>RoomNumber</th>
                    <th>MovieName</th>

                </tr>
                <tr>
                    <td>
                        <?php $result = $mysqli->query("SELECT * FROM Genre"); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="GenreID">
                            <option value=""> - </option>
                            <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
                                <option value="<?php echo $row['GenreID'] ?>"><?php echo $row['GenreID'] . " - " . $row['Genre'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input id="datetimepicker3" type="text" class="form-control" name="StartDate"></td>
                    <td><input id="datetimepicker4" type="text" class="form-control" name="EndDate"></td>
                    <td>
                        <?php $resul2 = $mysqli->query("SELECT * FROM Theatre"); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="RoomNumber">
                            <option value=""> - </option>
                            <?php while($row = mysqli_fetch_array($resul2, MYSQLI_ASSOC)){ ?>
                                <option value="<?php echo $row['RoomNumber'] ?>"><?php echo $row['RoomNumber'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <?php $result3 = $mysqli->query("SELECT * FROM Movie"); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="MovieID">
                            <option value=""> - </option>
                            <?php while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)){ ?>
                                <option value="<?php echo $row['MovieID'] ?>"><?php echo $row['MovieID'] . " - " . $row['MovieName'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-1">
        <br><br><br><br><br>
        <button type="submit" class="btn btn-default btn-lg" name="SubmitSelectFilters">Search</button>
    </div>
</form>




<?php
if(isset($_POST['SubmitSelectFilters'])){ //check if form was submitted
?>

    <div class="col-md-12">
        <br><br><br>
    </div>

<h1>Showing Results</h1>

<?php
    $query_string = "SELECT * FROM Showing JOIN Theatre ON Theatre.RoomNumber = Showing.RoomNumber JOIN Movie ON Showing.MovieID = Movie.MovieID JOIN GenreMap ON Movie.MovieID = GenreMap.MovieID JOIN Genre ON GenreMap.GenreID = Genre.GenreID ";
    if($_POST['GenreID'] || $_POST['StartDate'] || $_POST['EndDate'] || $_POST['RoomNumber'] || $_POST['MovieID']){
        $query_string = $query_string . " WHERE Showing.ShowingID LIKE \"%%\"";
    }
    if($_POST['GenreID']){
        $query_string = $query_string . " AND Genre.GenreID=" . $_POST['GenreID'];
    }

    if($_POST['StartDate']){
        $query_string = $query_string . " AND Showing.Date>=\"" . $_POST['StartDate'] . "\"";
    }
    if($_POST['EndDate']){
        $query_string = $query_string . " AND Showing.Date<=\"" . $_POST['EndDate'] .  "\"";
    }
    if($_POST['RoomNumber']){
        $query_string = $query_string . " AND Showing.RoomNumber=" . $_POST['RoomNumber'];
    }
    if($_POST['MovieID']){
        $query_string = $query_string . " AND Showing.MovieID=" . $_POST['MovieID'];
    }

    $result = $mysqli->query($query_string);
    $temp = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($_POST['GenreID']){
        echo "<h4> Genre: " . $temp["Genre"] . "</h4>";
    }
    if($_POST['StartDate']){
        echo "<h4> StartDate: " . $_POST['StartDate'] . "</h4>";
    }
    if($_POST['EndDate']){
        echo "<h4> EndDate: " . $_POST['EndDate'] . "</h4>";
    }
    if($_POST['RoomNumber']){
        echo "<h4> RoomNumber: " . $_POST['RoomNumber'] . "</h4>";
    }
    if($_POST['MovieID']){
        echo "<h4> MovieName: " . $temp["MovieName"] . "</h4>";
    }

    $result = $mysqli->query($query_string);


    ?>



<h5><b>Note that RED showings are sold out.</b></h5>
<table class="table table-striped">
	<tr>
		<th>ShowingID</th>
		<th>MovieName</th>
        <th>Genre</th>
        <th>RoomNumber</th>
		<th>Date</th>
		<th>Time</th>
	</tr>
	<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
        <?php
            $num_seats = $row['Capacity'];
            $result2 = $mysqli->query("SELECT COUNT(*) AS SeatsSold FROM Viewing WHERE ShowingID=" . $row['ShowingID']);
            $value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $num_left = $num_seats - $value2["SeatsSold"];
        ?>
        <?php if($num_left <= 0){?>
            <tr class="danger">
        <?php }else{ ?>
		    <tr>
        <?php } ?>

        <td><?php echo $row['ShowingID']; ?></td>
			<td><?php echo $row["MovieName"]; ?></td>
            <td><?php echo $row["Genre"]; ?></td>
            <td><?php echo $row['RoomNumber']; ?></td>
			<td><?php echo $row['Date']; ?></td>
			<td><?php echo $row["Time"]; ?></td>
		</tr>
	<?php } ?>
</table>
<?php } ?>




<script type="text/javascript">
    $(function () {
        $('#datetimepicker3').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>


<?php include 'template/footer.php'; ?>
