<?php
// login_test.php

// Database configuration
$db_host = 'db';
$db_name = 'advanced_messaging_system';
$db_username = 'bakill3';
$db_password = '12345';

// Connect to the database
$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user's hashed password from the database
    $stmt = $db->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $hashed_password = $stmt->fetchColumn();

    // Verify the provided password against the hashed password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!-- HTML form for user login -->
<form method="post" action="login_test.php">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>