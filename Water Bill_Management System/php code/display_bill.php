<?php
    session_start();

    if(!isset($_SESSION["userid"])) {
        header("Location: login.php");
        exit;
    }

    include 'db_connection.php';

    $user_id = $_SESSION["userid"];

    $sql = "SELECT *, month FROM water_usage WHERE customer_id = '$user_id' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $units_used = $row['units_used'];
            $month = $row['month']; 
            
            $ranges = [
                ['start' => 0, 'end' => 60, 'variable_charge' => 25.00, 'fixed_charge' => 400.00],
                ['start' => 61, 'end' => 90, 'variable_charge' => 35.00, 'fixed_charge' => 600.00],
                ['start' => 91, 'end' => 120, 'variable_charge' => 50.00, 'fixed_charge' => 1000.00],
                ['start' => 121, 'end' => 180, 'variable_charge' => 50.00, 'fixed_charge' => 1500.00],
                ['start' => 181, 'end' => 5000, 'variable_charge' => 75.00, 'fixed_charge' => 2000.00]
            ];

            $total_charge = 0;
            $fixed_charge = 0;

            foreach ($ranges as $range) {
                if ($units_used > $range['start']) {
                    $units_in_range = min($units_used, $range['end']) - $range['start'] + 1;
                    $total_charge += $units_in_range * $range['variable_charge'];
                    $fixed_charge = $range['fixed_charge'];
                }
            }

            $vat = $total_charge * 0.18;

            $final_bill = $total_charge + $fixed_charge + $vat;

            echo "<h2>Monthly Water Bill for " . $month . "</h2>";
            echo "<h3>Total units used:  " . $units_used . "</h3>"; 

            echo "<table>";
            echo "<tr><th>Description</th><th>Amount (LKR)</th></tr>";
            echo "<tr><td>Variable charge for " . $units_used . " units</td><td>" . number_format($total_charge, 2) . "</td></tr>";
            echo "<tr><td>Fixed charge</td><td>" . number_format($fixed_charge, 2) . "</td></tr>";
            echo "<tr><td>VAT (18%)</td><td>" . number_format($vat, 2) . "</td></tr>";
            echo "<tr><td><strong>Total Bill</strong></td><td><strong>" . number_format($final_bill, 2) . "</strong></td></tr>";
            echo "</table>";
        }
    } else {
        echo "No water usage found";
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Water Bill</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form action="home.php" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>
</body>
</html>
