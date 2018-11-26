<?php include 'template/header.php'; ?>


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
		<button type="submit" class="btn btn-default btn-lg" name="SubmitSelectHistory">Select</button>
	</div>
</form>

<?php
if(isset($_POST['SubmitSelectHistory'])){ //check if form was submitted
	?>



    <div class="col-md-12">
    <?php $result0 = $mysqli->query("SELECT * FROM Customer WHERE CustomerID=" .  $_POST['CustomerID']);
    $value0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
    ?>
    <h1><?php echo $value0['FName']; ?> <?php echo $value0['LName']; ?></h1>
    </div>


	<?php $result = $mysqli->query("SELECT * FROM Viewing WHERE CustomerID=" . $_POST['CustomerID']); ?>

	<table class="table table-striped">
		<tr>
			<th>MovieName</th>
			<th>Date</th>
			<th>Time</th>
			<th>Rating</th>
		</tr>
		<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
			<?php
			$result2 = $mysqli->query("SELECT * FROM Viewing JOIN Showing ON Viewing.ShowingID = Showing.ShowingID JOIN Movie ON Showing.MovieID = Movie.MovieID WHERE Showing.ShowingID=" . $row['ShowingID']);
			$value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
			?>
			<tr>
				<td><?php echo $value2['MovieName']; ?></td>
				<td><?php echo $value2['Date']; ?></td>
				<td><?php echo $value2['Time']; ?></td>
				<td><?php echo $row['Rating']; ?></td>
			</tr>
		<?php } ?>
	</table>







<?php } ?>

<?php include 'template/footer.php'; ?>
