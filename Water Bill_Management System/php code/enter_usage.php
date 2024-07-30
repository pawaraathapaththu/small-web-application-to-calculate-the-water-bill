<?php
session_start();

if(!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = mysqli_real_escape_string($conn, $_POST['month']);
    $units_used = mysqli_real_escape_string($conn, $_POST['units_used']);

    $user_id = $_SESSION["userid"];

    $sql = "INSERT INTO water_usage (customer_id, month, units_used) VALUES ('$user_id', '$month', '$units_used')";

    if ($conn->query($sql) === TRUE) {
        echo "Water usage entered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Usage</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <h2>Enter Water Usage</h2>

    <form action="enter_usage.php" method="post">
    <label for="month">Month:</label><br>
    <select id="month" name="month">
        <option value="select">Select The Month...</option>
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
      </select><br>
    <label for="units_used">Units Used:</label><br>
    <input type="number" id="units_used" name="units_used"><br>
    <input type="submit" value="Submit" class="submit-button">
    </form> 

    <form action="home.php" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>

</body>
</html>