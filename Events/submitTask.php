<?php
session_start();
require '../db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Get the form data for the main task
$task_title = $_POST['task_title'];
$due_date = $_POST['due_date'];
$urgency = $_POST['urgency'];
$status = $_POST['status'];
$assigned_to = $_POST['assigned_to']; // This is now the name directly
$description = $_POST['description'];
$user_id = $_SESSION['user_id'];

// Prepare the SQL statement for the main task, including assigned_to as a name
$stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, created_at, date, urgency, status, assigned_to) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)");
$stmt->bind_param("issssss", $user_id, $task_title, $description, $due_date, $urgency, $status, $assigned_to);

// Execute the statement for the main task
if ($stmt->execute()) {
    $task_id = $stmt->insert_id;

    // Insert subtasks
    if (!empty($_POST['subtask_title']) && !empty($_POST['subtask_description'])) {
        $subtask_stmt = $conn->prepare("INSERT INTO subtasks (task_id, title, description) VALUES (?, ?, ?)");
        foreach ($_POST['subtask_title'] as $index => $subtask_title) {
            $subtask_description = $_POST['subtask_description'][$index];
            $subtask_stmt->bind_param("iss", $task_id, $subtask_title, $subtask_description);
            $subtask_stmt->execute();
        }
        $subtask_stmt->close();
    }

    echo "New task created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
