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
        <button type="submit" class="btn btn-default btn-lg" name="SubmitSelectProfile">Select</button>
    </div>
</form>

<?php
if(isset($_POST['SubmitSelectProfile'])){ //check if form was submitted
?>

<?php $result2 = $mysqli->query("SELECT * FROM Customer WHERE CustomerID=" . $_POST['CustomerID']);
$value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
?>
<table class="table table-striped">
    <div class="col-md-12">
        <?php $result0 = $mysqli->query("SELECT * FROM Customer WHERE CustomerID=" .  $_POST['CustomerID']);
        $value0 = mysqli_fetch_array($result0, MYSQLI_ASSOC);
        ?>
        <h1><?php echo $value0['FName']; ?> <?php echo $value0['LName']; ?></h1>
    </div>
    <tr>
		<th>CustomerId</th>
		<th>FName</th>
		<th>LName</th>
		<th>Gender</th>
		<th>Email</th>
	</tr>
		<tr>
			<td><?php echo $value2['CustomerID']; ?></td>
			<td><?php echo $value2['FName']; ?></td>
			<td><?php echo $value2['LName']; ?></td>
			<td><?php echo $value2['Gender']; ?></td>
			<td><?php echo $value2['Email']; ?></td>
		</tr>
</table>

<?php } ?>

<?php $result->close(); ?>

<?php include 'template/footer.php'; ?>
