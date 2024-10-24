<?php
$servername = "localhost"; // Your server (most likely localhost)
$username = "root"; // Default username for phpMyAdmin
$password = ""; // Leave blank if there's no password
$dbname = "managment"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

