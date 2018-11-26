<?php include 'template/header.php'; ?>

<?php

if(isset($_POST['SubmitMovieRating'])){ //check if form was submitted
	if($_POST['ViewingID']){
		$result = $mysqli->query(" UPDATE Viewing SET Rating=\"" . $_POST['Rating'] . "\" WHERE ViewingID=" . $_POST['ViewingID']);
	};
	echo "<meta http-equiv='refresh' content='0'>";
}
?>




<form action="" method="post">
	<div class="col-md-11">
		<br><br>

		<h1>Select Customer</h1>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<th>Customer</th>
				</tr>
				<tr>
					<td>
                        <?php $result = $mysqli->query("SELECT * FROM Customer"); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="CustomerID">
							<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
                                <option value="<?php echo $row['CustomerID'] ?>"><?php echo $row['CustomerID'] . " - " . $row['FName'] . " " . $row['LName'] ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-1">
        <br><br><br><br><br>
        <button type="submit" class="btn btn-default btn-lg" name="SubmitSelectCustomer">Select</button>
	</div>
</form>

<?php
if(isset($_POST['SubmitSelectCustomer'])){ //check if form was submitted
?>



    <form action="" method="post">
	<div class="col-md-11">
		<br><br>

        <div class="col-md-12">
            <?php $result0 = $mysqli->query("SELECT * FROM Customer WHERE CustomerID=" .  $_POST['CustomerID']);
            $value0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
            ?>
            <h1><?php echo $value0['FName']; ?> <?php echo $value0['LName']; ?></h1>
        </div>

        <h1>Give Rating</h1>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<th>Viewing</th>
				</tr>
				<tr>
					<td>
                        <?php $result2 = $mysqli->query("SELECT * FROM Viewing WHERE CustomerID=" .  $_POST['CustomerID']); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="ViewingID">
                            <?php while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){ ?>
                                <?php
                                $result3 = $mysqli->query("SELECT * FROM Showing WHERE ShowingID=" . $row['ShowingID']);
                                $value3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                ?>
                                <?php
                                $result4 = $mysqli->query("SELECT MovieName FROM Movie WHERE MovieID=" . $value3['MovieID']);
                                $value4 = mysqli_fetch_array($result4, MYSQLI_ASSOC);
                                ?>
                                <option value="<?php echo $row['ViewingID'] ?>"><?php echo $row['ViewingID'] . " - " . $value4['MovieName'] . " - " . $value3['RoomNumber'] . " - " . $value3['Date'] . " - " . $value3['Time'] ?></option>
                            <?php } ?>
                        </select>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-1">
		<br><br><br><br>
	</div>


	<div class="col-md-11">
        <div class="row">
			<table class="table table-striped">
				<tr>
					<th>Rating</th>
				</tr>
				<tr>
					<td>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="Rating">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-1">
		<button type="submit" class="btn btn-default btn-lg" name="SubmitMovieRating">Update</button>
	</div>
</form>
    <?php
}
?>

<?php $result->close(); ?>

<?php include 'template/footer.php'; ?>

