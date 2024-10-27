<?php
session_start(); // Start session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_name']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : 'Guest';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'boss'; // Check if the user is admin (boss)

// Include database connection
require '../db_connect.php';

// Retrieve tasks for the logged-in user
$tasks = [];
$all_tasks = []; // To hold all tasks for the calendar
if ($user_id) {
    // Admin retrieves all tasks for the calendar
    if ($is_admin) {
        $stmt = $conn->prepare("SELECT * FROM tasks");
    } else {
        // Worker retrieves only their tasks
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        if ($is_admin) {
            // If admin, push all tasks into the calendar array
            $all_tasks[] = $row;
        } else {
            // If worker, push only their tasks into the tasks array
            $tasks[] = $row;
        }
    }
    $stmt->close();

    // Fetch the boss's own tasks for "Your Tasks"
    if ($is_admin) {
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row; // Include the boss's own tasks here
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tasks - Task Management App</title>
    <link rel="stylesheet" href="../CSS/task.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="task.php">Task</a>
        <a href="createTask.php">Create Task</a>
        <a href="aboutUs.php">About us</a>
        <a href="contactUs.php">Contact us</a>
    </div>
    <div class="nav-right">
        <?php if ($is_logged_in): ?>
            <span class="user-name"><?php echo htmlspecialchars($user_name); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="signUp.php" class="cta-btn">Get Started</a>
        <?php endif; ?>
    </div>
</nav>

<section class="task-list">
    <h2>Your Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Due Date</th>
                <th>Urgency</th>
                <th>Status</th>
                <th>Actions</th> <!-- Add actions column -->
            </tr>
        </thead>
        <tbody>
            <?php if (count($tasks) > 0): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr id="task-row-<?php echo $task['id']; ?>">
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo htmlspecialchars($task['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($task['date']); ?></td>
                        <td><?php echo htmlspecialchars($task['urgency']); ?></td>
                        <td class="status" id="status-<?php echo $task['id']; ?>"><?php echo htmlspecialchars($task['status']); ?></td>
                        <td>
                            <button class="action-btn complete-btn" onclick="completeTask(<?php echo $task['id']; ?>)">Complete</button>
                            <button class="action-btn delete-btn" onclick="deleteTask(<?php echo $task['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<section class="calendar-section">
    <div id="calendar"></div>
</section>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="../Assets/FooterLogo.png" alt="TaskManager Logo">
        </div>

        <div class="footer-menu">
            <h3>Quick Menu</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>+27 98 678 463</p>
            <p>info@TaskXpert.co.za</p>
            <div class="social-icons">
                <a href="#"><img src="../Assets/instagram.png" alt="Instagram"></a>
                <a href="#"><img src="../Assets/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="../Assets/twitter.png" alt="Twitter"></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 TaskXpert, Inc. All Rights Reserved.</p>
    </div>
</footer>

<script>
function completeTask(taskId) {
    $.ajax({
        url: '../Events/completeTask.php',
        type: 'POST',
        data: { task_id: taskId },
        success: function(response) {
            // Update the status cell without refreshing the page
            $('#status-' + taskId).text('Completed');
            
            // Remove the task from the calendar
            $('#calendar').fullCalendar('removeEvents', taskId);
        },
        error: function() {
            alert('Error completing task.');
        }
    });
}

function deleteTask(taskId) {
    $.ajax({
        url: '../Events/deleteTask.php',
        type: 'POST',
        data: { task_id: taskId },
        success: function(response) {
            // Remove the row from the table
            $('#task-row-' + taskId).remove();

            // Also remove the task from the calendar
            $('#calendar').fullCalendar('removeEvents', taskId);
        },
        error: function() {
            alert('Error deleting task.');
        }
    });
}

$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: [
            <?php foreach ($is_admin ? $all_tasks : $tasks as $task): ?>
                {
                    id: '<?php echo $task['id']; ?>', // Add task ID
                    title: '<?php echo $task['title']; ?>',
                    start: '<?php echo $task['date']; ?>',
                    description: '<?php echo $task['description']; ?>',
                    urgency: '<?php echo $task['urgency']; ?>',
                    status: '<?php echo $task['status']; ?>'
                },
            <?php endforeach; ?>
        ],
        eventRender: function(event, element) {
            element.bind('click', function() {
                alert(event.title + "\nDue Date: " + event.start.format('YYYY-MM-DD') + "\nDescription: " + event.description);
            });
        }
    });
});
</script>
</body>
</html>
