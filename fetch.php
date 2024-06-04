<?php
require_once 'config.php';

// Lakukan koneksi ke database menggunakan variabel $conn dari config.php
$messages = array(); // Inisialisasi array untuk menyimpan pesan

// Lakukan kueri SQL untuk mengambil pesan dari database
$query = "SELECT username, message FROM messages ORDER BY timestamp DESC";
$result = $conn->query($query);

if ($result) {
    // Periksa apakah ada baris hasil kueri
    if ($result->num_rows > 0) {
        // Ambil setiap baris hasil kueri dan tambahkan ke array $messages
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
    // Bebaskan hasil kueri
    $result->free();
}

// Tampilkan pesan dalam format yang diinginkan
foreach ($messages as $message) {
    $name = isset($message['username']) ? htmlentities(trim($message['username'])) : '';
    $content = isset($message['message']) ? htmlentities(trim($message['message'])) : '';

    echo '<div class="messages__item_grup"> <label class="sub_title">' . $name . '</label> <div class="messages__item form_style">' . $content . '</div> </div>';
}

// Tutup koneksi database jika Anda tidak menggunakan mekanisme koneksi persisten
$conn->close();
