<?php include 'template/header.php'; ?>

<?php
if(isset($_POST['SubmitSellTicket'])) { //check if form was submitted
    $result = $mysqli->query("SELECT MAX( ViewingID ) AS max FROM Viewing");
    $max_query = max(mysqli_fetch_array($result, MYSQLI_ASSOC));
    $max_id = $max_query + 1;
    $result = $mysqli->query("INSERT INTO Viewing(ViewingID, ShowingID, Rating, TicketCost, CustomerID) VALUES (" . $max_id . "," . $_POST['ShowingID'] . ",0," . $_POST['TicketCost'] . "," . $_POST['CustomerID'] . ")");
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="col-md-11">
        <br><br>
        <h1>Sell Ticket</h1>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>CustomerId</th>
                    <th>Showing</th>
                    <th>TicketCost</th>
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
                    <td>
                        <?php $result2 = $mysqli->query("SELECT * FROM Showing"); ?>
                        <select class="btn btn-default dropdown-toggle" type="button"  name="ShowingID">
                            <?php while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){ ?>
                                <?php
                                $result2 = $mysqli->query("SELECT MovieName FROM Movie WHERE MovieID=" . $row['MovieID']);
                                $value2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                ?>
                                <option value="<?php echo $row['ShowingID'] ?>"><?php echo $row['ShowingID'] . " - " . $value2['MovieName'] . " - " . $row['RoomNumber'] . " - " . $row['Date'] . " - " . $row['Time']  ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input type="text" name="TicketCost"/></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-1">
        <br><br><br><br><br>
        <td><button type="submit" class="btn btn-default btn-lg" name="SubmitSellTicket">Execute</button>
    </div>
</form>

<?php include 'template/footer.php'; ?>
