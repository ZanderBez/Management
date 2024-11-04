<?php
$servername = "localhost";
$username = "gxjkzokc_managment"; // Username from your hosting provider
$password = "DjMQ4x9TG7GsMQQ4ktT4"; // Password from your hosting provider
$dbname = "gxjkzokc_managment"; // Database name from your hosting provider

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

