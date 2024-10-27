<?php
session_start();
require '../db_connect.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Get the task ID from the form
$task_id = $_POST['task_id'];

// Prepare the SQL statement to update the task status
$stmt = $conn->prepare("UPDATE tasks SET status = 'Completed' WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $_SESSION['user_id']);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Task marked as completed successfully.'); window.location.href='../Pages/task.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='../Pages/task.php';</script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
