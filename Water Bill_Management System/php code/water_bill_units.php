<?php
session_start();

if(!isset($_SESSION["userid"]) || $_SESSION["userid"] != 1) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $range_start = mysqli_real_escape_string($conn, $_POST['range_start']);
    $range_end = mysqli_real_escape_string($conn, $_POST['range_end']);
    $energy_charge = mysqli_real_escape_string($conn, $_POST['energy_charge']);
    $fixed_charge = mysqli_real_escape_string($conn, $_POST['fixed_charge']);

    $sql = "UPDATE water_bill_units SET energy_charge = '$energy_charge', fixed_charge = '$fixed_charge' WHERE range_start = '$range_start' AND range_end = '$range_end'";

    if ($conn->query($sql) === TRUE) {
        echo "Rates updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Change Rates</h2>

<form action="water_bill_units.php" method="post">
  <label for="range_start">Range Start:</label><br>
  <input type="number" id="range_start" name="range_start"><br>
  <label for="range_end">Range End:</label><br>
  <input type="number" id="range_end" name="range_end"><br>
  <label for="energy_charge">Energy Charge:</label><br>
  <input type="number" id="energy_charge" name="energy_charge" step="0.01"><br>
  <label for="fixed_charge">Fixed Charge:</label><br>
  <input type="number" id="fixed_charge" name="fixed_charge" step="0.01"><br>
  <input type="submit" value="Submit" class="submit-button">
</form> 

<form action="home.php" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>

</body>
</html>

