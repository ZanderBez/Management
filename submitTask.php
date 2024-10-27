<?php
session_start();
require 'db_connect.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Get the form data
$task_title = $_POST['task_title'];
$due_date = $_POST['due_date'];
$urgency = $_POST['urgency'];
$status = $_POST['status'];
$assigned_to = $_POST['assigned_to'];
$description = $_POST['description'];
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, created_at, date, urgency, status) VALUES (?, ?, ?, NOW(), ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $task_title, $description, $due_date, $urgency, $status);

// Execute the statement
if ($stmt->execute()) {
    // If task creation is successful, send a success message back
    echo "New task created successfully.";
} else {
    // If there is an error, show the error in an alert
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
