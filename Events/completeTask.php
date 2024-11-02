<?php
session_start();
require '../db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized access";
    exit;
}

// Get the task ID from the form
$task_id = $_POST['task_id'];

// Prepare the SQL statement to update the task status
$stmt = $conn->prepare("UPDATE tasks SET status = 'Completed' WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $_SESSION['user_id']);

// Execute the statement
if ($stmt->execute()) {
    echo "Success"; // Return "Success" for the AJAX call
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
