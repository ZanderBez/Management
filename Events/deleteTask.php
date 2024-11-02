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

// Start a transaction to delete subtasks and main task
$conn->begin_transaction();

try {
    // Delete subtasks first
    $subtask_stmt = $conn->prepare("DELETE FROM subtasks WHERE task_id = ?");
    $subtask_stmt->bind_param("i", $task_id);
    $subtask_stmt->execute();
    $subtask_stmt->close();

    // Then delete the main task
    $task_stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $task_stmt->bind_param("ii", $task_id, $_SESSION['user_id']);
    $task_stmt->execute();
    $task_stmt->close();

    // Commit the transaction if both deletions succeed
    $conn->commit();
    echo "Success"; // Return "Success" for the AJAX call
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
