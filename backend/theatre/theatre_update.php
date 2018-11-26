

<?php

if(isset($_POST['SubmitTheatreUpdate'])){ //check if form was submitted
	if($_POST['Capacity']){
		$result = $mysqli->query(" UPDATE Theatre SET Capacity=" . $_POST['Capacity'] . " WHERE RoomNumber=" . $_POST['RoomNumber']);
	};
	echo "<meta http-equiv='refresh' content='0'>";
}
?>


<?php $result = $mysqli->query("SELECT * FROM Theatre"); ?>
<form action="" method="post">
	<div class="col-md-11">
		<br><br>

		<h1>Theatre Update</h1>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<th>Theatre</th>
				</tr>
				<tr>
					<td>
						<select class="btn btn-default dropdown-toggle" type="button"  name="RoomNumber">
							<?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $row['RoomNumber'] ?>"><?php echo $row['RoomNumber'] ?></option>
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
					<th>Capacity</th>
				</tr>
				<tr>
					<td><input type="text" name="Capacity"/></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-1">
		<button type="submit" class="btn btn-default btn-lg" name="SubmitTheatreUpdate">Update</button>
	</div>
</form>

<?php $result->close(); ?>