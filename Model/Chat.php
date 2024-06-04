<?php
require_once 'config.php';

class Chat
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveMessage($username, $message)
    {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO messages (username, message, timestamp) VALUES (?, ?, NOW())");

        // Bind parameters to the statement
        $stmt->bind_param("ss", $username, $message);

        // Execute the statement
        $success = $stmt->execute();

        // Close the statement
        $stmt->close();

        return $success; // Return true if successful, false otherwise
    }

    public function getMessages()
    {
        // Prepare and execute the SQL statement
        $result = $this->conn->query("SELECT * FROM messages ORDER BY timestamp DESC");

        // Fetch all rows as an associative array
        $messages = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->close();

        return $messages; // Return the array of messages
    }
}
