<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $nama = $_POST['username'];

    if (!empty($message)) {
        $timestamp = date('Y-m-d H:i:s'); 
        $file = fopen("log.txt", "a");
        fwrite($file, "[$nama] [$timestamp] $message" . PHP_EOL);
        fclose($file);
        echo 'Message sent successfully';
    } else {
        echo 'Message is empty';
    }
}


?>
