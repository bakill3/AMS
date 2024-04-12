<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../src/Services/RandomOrgClient.php'; // Adjust path as necessary

// Load .env for API key
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$randomOrgClient = new RandomOrgClient($_ENV['RANDOMORG_API']);

$randomIntegers = $randomOrgClient->getRandomIntegers(10, 1, 10);

function encryptMessage($message, $randomIntegers) {
    // Simple encryption by shifting characters
    $encryptedMessage = '';
    foreach (str_split($message) as $i => $char) {
        $encryptedMessage .= chr(ord($char) + $randomIntegers[$i % count($randomIntegers)]);
    }
    return $encryptedMessage;
}

function decryptMessage($encryptedMessage, $randomIntegers) {
    $message = '';
    foreach (str_split($encryptedMessage) as $i => $char) {
        $message .= chr(ord($char) - $randomIntegers[$i % count($randomIntegers)]);
    }
    return $message;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $receiverId = $_POST['receiver_id']; // Assuming you have this in your form
    $message = $_POST['message'];

    $encryptedMessage = encryptMessage($message, $randomIntegers);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat Page</title>
</head>
<body>
<!-- Display messages here -->
<?php
// Assuming you have a MessageModel that fetches messages
// $messages = MessageModel::getMessagesForUser($currentUser);
// foreach ($messages as $message) {
//     echo '<p>' . decryptMessage($message['content'], $randomIntegers) . '</p>';
// }
?>
<!-- Message send form here -->
<form method="POST">
    <input type="hidden" name="receiver_id" value="1"> <!-- Replace with actual receiver ID -->
    <input type="text" name="message">
    <input type="submit" value="Send">
</form>
</body>
</html>