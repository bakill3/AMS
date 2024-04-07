<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$searchResults = [];
$activeChatUserId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $receiverId = $_POST['receiver_id'] ?? $userId; // For demonstration, using the user's ID
    if ($message !== '') {
        $encryptedMessage = encryptMessage($message);
        storeMessage($userId, $receiverId, $encryptedMessage);
        echo json_encode(['status' => 'success', 'message' => 'Message sent']);
        exit;
    }
}

if (isset($_GET['chat_with'])) {
    $activeChatUserId = $_GET['chat_with'];
    $messages = getMessagesForUser($userId, $activeChatUserId);
} else {
    $messages = getMessagesForUser($userId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #36393f;
            color: #dcddde;
        }
        .chat-container {
            max-width: 800px;
            margin: auto;
            margin-top: 20px;
        }
        .chat-box {
            background-color: #40444b;
            height: 500px;
            overflow-y: auto;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            margin-bottom: 15px;
        }
        .message {
            display: flex;
            align-items: flex-end;
            margin-bottom: 10px;
        }
        .message .bubble {
            max-width: 70%;
            background-color: #5865f2;
            color: #fff;
            padding: 10px;
            border-radius: 20px;
            border-bottom-right-radius: 0;
            word-wrap: break-word;
        }
        .message.sent .bubble {
            background-color: #57f287;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 0;
            align-self: flex-end;
        }
        .send-message-box {
            padding: 15px;
            background-color: #40444b;
            position: fixed;
            bottom: 0;
            width: calc(100% - 30px);
        }
        .btn-primary {
            background-color: #5865f2;
            border-color: #5865f2;
        }
        .input-group-text {
            background-color: #202225;
            border-color: #202225;
            color: #dcddde;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div class="chat-box" id="chat-box">
        <?php foreach ($messages as $message): ?>
            <div class="message sent">
                <div class="bubble">
                    <?= htmlspecialchars(decryptMessage($message['message'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="send-message-box">
    <form id="message-form">
        <div class="input-group">
            <textarea id="message-input" name="message" class="form-control" placeholder="Type your message here..." rows="2"></textarea>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const chatBox = document.getElementById('chat-box');

    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const message = messageInput.value.trim();
        if (message) {
            fetch('chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'message=' + encodeURIComponent(message) + '&receiver_id=<?= $activeChatUserId ?>'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Append message to chat box or handle accordingly
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', 'sent');
                    messageElement.innerHTML = `<div class="bubble">${message}</div>`;
                    chatBox.appendChild(messageElement);
                    chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
                    messageInput.value = ''; // Clear the input field
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom initially
</script>
</body>
</html>
