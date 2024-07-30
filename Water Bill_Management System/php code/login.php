<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM customers WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                echo "Login successful";

                session_start();

                $_SESSION["userid"] = $row['id'];
                $_SESSION["username"] = $username;

                header("Location: home.php");
                exit;

            } else {
                echo "Invalid password";
            }
        }
    } else {
        echo "Username not found";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Login</h2>

    <form action="login.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Login" class="submit-button">
    </form> 

    <form action="index.html" method="post">
        <input type="submit" value="Back" class="back-button">
    </form>

</body>
</html>

