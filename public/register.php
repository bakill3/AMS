<?php
require_once '../config/db.php';
require_once '../vendor/autoload.php';

use OTPHP\TOTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Generate a new TOTP object and secret
    $totp = TOTP::create();
    $totp->setLabel($email); // Use the user's email as the label in the authenticator app
    $secret = $totp->getSecret();

    // Insert user into the database, including the TOTP secret
    $sql = "INSERT INTO users (username, password, email, totp_secret) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$username, $password, $email, $secret])) {
        // Prepare user ID or another unique identifier for the next step
        $userId = $pdo->lastInsertId();

        // Redirect to a page or pass along data to show the QR code
        // Pass along the user ID or email, and the secret to generate the QR code on the next page
        header("Location: show_qr.php?user_id=$userId");
        exit;
    } else {
        echo "An error occurred during registration.";
    }
}
?>
<form method="post">
  Username: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  Email: <input type="email" name="email" required><br>
  <input type="submit" value="Register">
</form>
