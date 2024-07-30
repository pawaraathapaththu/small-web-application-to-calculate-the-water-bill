<?php
session_start();

if(!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

$user_id = $_SESSION["userid"];

$sql = "SELECT * FROM water_usage WHERE customer_id = '$user_id' ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='styled-table'>";
    echo "<tr><th colspan='2'>Monthly Usage</th></tr>"; 
    echo "<tr><th>Month</th><th>Units Used</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["month"]. "</td><td>" . $row["units_used"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No water usage history found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usage History</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form action="home.php" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>
</body>
</html>
