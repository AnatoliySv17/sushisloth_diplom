<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sushisloth_1";

// Створення підключення
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
?>
