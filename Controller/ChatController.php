<?php
require_once 'Model/Chat.php';

class ChatController
{
    private $chatModel;

    public function __construct($conn)
    {
        $this->chatModel = new Chat($conn);
    }

    public function saveMessage($username, $message)
    {
        if ($this->chatModel->saveMessage($username, $message)) {
            echo "Message sent successfully.";
        } else {
            echo "Failed to send message.";
        }
    }

    public function getMessages()
    {
        return $this->chatModel->getMessages();
    }
}
