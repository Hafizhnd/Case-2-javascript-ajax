<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require_once 'Model/Chat.php'; // Include the Chat.php file
require_once 'config.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

$chat = new Chat($conn); // Create an instance of the Chat class

// Check if form is submitted for sending a message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    $message = $_POST['message'];
    $chat->saveMessage($username, $message); // Save the message
}

$messages = $chat->getMessages(); // Get messages to display

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="view/style.css">
    <link rel="stylesheet" href="view/chat.css">
    <link rel="stylesheet" href="view/typing.css">
    <link rel="stylesheet" href="view/styles.css">
    <title>Chatbox</title>

</head>

<body>

    <header>
        <?php include 'view/header.php'; ?>
    </header>
    
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="container col-md-6">
                <img src="img/pic.svg" class="img-fluid mx-auto d-block" alt="Chat with Us!">
            </div>
            <div class="col-md-6 pb-4">
                <h1 class="fw-bold pb-4">
                    Welcome, <?php echo $username; ?>!
                </h1>
                <h3 class="pb-5">
                    Connect seamlessly, chat effortlessly. Experience the future of communication, Chat with Us!
                </h3>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="chatbox">
      <div class="chatbox__support">
        <div class="chatbox__header">
          <div class="chatbox__content--header" id="UsernameContainer">
            <span id="UsernameDisplay">
              <h4 class="chatbox__heading--header" id="username"><?php echo $username ?></h4>
            </span>
            <input type="text" id="newUsernameInput" style="display: none;" placeholder="Enter new username">
            <button id="changeUsernameBtn" style="display: none;">Change Username</button>
          </div>
          <div class="chatbox__image--header">
            <img src="./img/profile.svg" alt="image"><br>
          </div>
        </div>
        <div class="chatbox__messages">
          <div class="chat-box" id="chatBox">
            <!-- Display chat messages -->
            <?php foreach ($messages as $message) : ?>
              <div class="message">
                <p><strong><?php echo $message['username']; ?>:</strong> <?php echo $message['message']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="chatbox__footer">
          <form id="messageForm" method="post">
            <input type="text" name="message" placeholder="Send a message." required>
            <button type="submit" name="send">Send</button>
          </form>
        </div>
      </div>
      <div class="chatbox__button">
        <button type="button" class="btn-chat">
          <img src="img/icon.svg" class="img-fluidd mx-auto -block img-chat" alt="Chat">
        </button>
      </div>
    </div>
  </div>


    <div class="container">
        <h1>Welcome, <?php echo $username; ?></h1>
        <form id="messageForm" method="post">
            <input type="text" name="message" placeholder="Send a message." required>
            <button type="submit" name="send">Send</button>
        </form>
        <div id="chatBox">

            <?php foreach ($messages as $message) : ?>
                <div class="message">
                    <p><strong><?php echo $message['username']; ?>:</strong> <?php echo $message['message']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <?php include 'view/footer.php'; ?>
    </footer>

    <script src="view/chat.js"></script>
    <script src="view/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="view/index.js"></script>
</body>

</html>