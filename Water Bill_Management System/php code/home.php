<?php
session_start();

if(!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <h2>Water Bill Management System</h2>
    <h3>Welcome back, <?php echo $_SESSION["username"]; ?>!</h3>
    <br><br><br><br>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout" class="logout-button">
    </form>

    <ul class="main_buttons">
        <li><a href="enter_usage.php">Provide Usage</a></li>
        <li><a href="display_bill.php">View Bill</a></li>
        <li><a href="water_usage.php">Usage History</a></li>
        <li><a href="water_bill_units.php">Change Rates (Admin Access)</a></li>
    </ul>

</body>
</html>

