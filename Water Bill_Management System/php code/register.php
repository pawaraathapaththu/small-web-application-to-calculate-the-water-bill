<?php
    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $bill_number = mysqli_real_escape_string($conn, $_POST['bill_number']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($username)) {
        echo "Username cannot be empty.";
        exit;
    }

    $check_sql = "SELECT * FROM customers WHERE username = '$username'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        echo "Username already exists.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customers (name, address, email, bill_number, username, password) VALUES ('$name', '$address', '$email', '$bill_number', '$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
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
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    </head>
    <body>

    <h2>Registration</h2>

    <form action="register.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="bill_number">Bill Number:</label><br>
    <input type="text" id="bill_number" name="bill_number"><br>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Register" class="submit-button">
    </form> 

    <form action="index.html" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>

</body>
</html>