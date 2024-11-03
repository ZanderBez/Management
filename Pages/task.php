<?php
session_start();
$is_logged_in = isset($_SESSION['user_name']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : 'Guest';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'boss';

require '../db_connect.php';

$tasks = [];
$all_tasks = [];

// Fetch tasks for the "Your Tasks" section
if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // Check if the task is past due
        if ($row['date'] < date('Y-m-d') && $row['status'] != 'Complete') {
            $row['status'] = 'Late';
            // Update the status in the database
            $update_stmt = $conn->prepare("UPDATE tasks SET status = 'Late' WHERE id = ?");
            $update_stmt->bind_param("i", $row['id']);
            $update_stmt->execute();
            $update_stmt->close();
        }

        $row['subtasks'] = [];

        // Fetch subtasks related to the main task
        $subtask_stmt = $conn->prepare("SELECT * FROM subtasks WHERE task_id = ?");
        $subtask_stmt->bind_param("i", $row['id']);
        $subtask_stmt->execute();
        $subtask_result = $subtask_stmt->get_result();

        while ($subtask = $subtask_result->fetch_assoc()) {
            $row['subtasks'][] = $subtask;
        }
        $subtask_stmt->close();

        $tasks[] = $row;
    }
    $stmt->close();
}

// Fetch all tasks for the calendar (only the admin will see all tasks on the calendar)
$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Check if the task is past due
    if ($row['date'] < date('Y-m-d') && $row['status'] != 'Complete') {
        $row['status'] = 'Late';
        // Update the status in the database
        $update_stmt = $conn->prepare("UPDATE tasks SET status = 'Late' WHERE id = ?");
        $update_stmt->bind_param("i", $row['id']);
        $update_stmt->execute();
        $update_stmt->close();
    }

    $row['subtasks'] = [];

    // Fetch subtasks related to the main task
    $subtask_stmt = $conn->prepare("SELECT * FROM subtasks WHERE task_id = ?");
    $subtask_stmt->bind_param("i", $row['id']);
    $subtask_stmt->execute();
    $subtask_result = $subtask_stmt->get_result();

    while ($subtask = $subtask_result->fetch_assoc()) {
        $row['subtasks'][] = $subtask;
    }
    $subtask_stmt->close();

    $all_tasks[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tasks - Task Management App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/task.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <style>
        /* Styling for Late tasks */
        .task-late {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="task.php" class="active">Task</a>
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
    <div class="hamburger" id="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<section class="task-list">
    <h2>Your Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Urgency</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Actions</th>
            </tr>
        </thead>
                <tbody>
                    <?php if (count($tasks) > 0): ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr id="task-row-<?php echo $task['id']; ?>" class="<?php echo $task['status'] === 'Late' ? 'task-late' : ''; ?>" onclick="openModal(<?php echo htmlspecialchars(json_encode($task)); ?>)">
                                <td><?php echo htmlspecialchars($task['title']); ?></td>
                                <td><?php echo htmlspecialchars($task['description']); ?></td>
                                <td><?php echo htmlspecialchars($task['date']); ?></td>
                                <td><?php echo htmlspecialchars($task['urgency']); ?></td>
                                <!-- Update this <td> for Status -->
                                <td id="status-<?php echo $task['id']; ?>" class="<?php echo $task['status'] === 'Late' ? 'task-late' : ''; ?>">
                                    <?php echo !empty($task['status']) ? htmlspecialchars($task['status']) : 'Pending'; ?>
                                </td>
                                <td><?php echo htmlspecialchars($task['assigned_to']); ?></td>
                                <td class="task-actions">
                                    <button class="action-btn complete-btn" onclick="event.stopPropagation(); completeTask(<?php echo $task['id']; ?>)">Complete</button>
                                    <button class="action-btn delete-btn" onclick="event.stopPropagation(); deleteTask(<?php echo $task['id']; ?>)">Delete</button>
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

<!-- Modal Structure -->
<div id="taskModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Task Title</h2>
        <p><strong>Description:</strong> <span id="modalDescription"></span></p>
        <p><strong>Urgency:</strong> <span id="modalUrgency"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        <p><strong>Assigned To:</strong> <span id="modalAssignedTo"></span></p>
        <h3>Subtasks</h3>
        <div id="modalSubtasks"></div>
        <button onclick="closeModal()" class="close-modal-btn">Close</button>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="../Assets/FooterLogo.png" alt="TaskManager Logo">
        </div>

        <div class="footer-menu">
            <h3>Quick Menu</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
                <li><a href="contactUs.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>+27 98 678 463</p>
            <p>info@TaskXpert.co.za</p>
            <div class="social-icons">
                <a href="https://www.instagram.com/openwindowinstitute/?hl=en"><img src="../Assets/instagram.png" alt="Instagram"></a>
                <a href="https://www.facebook.com/OWIstudentlife/"><img src="../Assets/facebook.png" alt="Facebook"></a>
                <a href="https://x.com/open_window_?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img src="../Assets/twitter.png" alt="Twitter"></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 TaskXpert, Inc. All Rights Reserved.</p>
    </div>
</footer>

<script>

document.getElementById('hamburger-menu').addEventListener('click', function() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
    });

function openModal(task) {
    document.getElementById("modalTitle").textContent = task.title;
    document.getElementById("modalDescription").textContent = task.description;
    document.getElementById("modalUrgency").textContent = task.urgency;
    document.getElementById("modalStatus").textContent = task.status;
    document.getElementById("modalAssignedTo").textContent = task.assigned_to;

    const subtaskList = document.getElementById("modalSubtasks");
    subtaskList.innerHTML = ""; 
    task.subtasks.forEach(subtask => {
        const subtaskDiv = document.createElement("div");
        subtaskDiv.classList.add("subtask-item");

        subtaskDiv.innerHTML = `
            <p><strong>Title:</strong> ${subtask.title}</p>
            <p><strong>Description:</strong> ${subtask.description}</p>
        `;

        subtaskList.appendChild(subtaskDiv);
    });

    document.getElementById("taskModal").style.display = "block";
}

function closeModal() {
    document.getElementById("taskModal").style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("taskModal")) {
        closeModal();
    }
}

function completeTask(taskId) {
    $.ajax({
        url: '../Events/completeTask.php',
        type: 'POST',
        data: { task_id: taskId },
        success: function(response) {
            if (response.trim() === "Success") {
                $('#status-' + taskId).text('Completed');
                $('#calendar').fullCalendar('removeEvents', taskId);
            } else {
                alert('Failed to complete the task: ' + response);
            }
        },
        error: function() {
            alert('Error completing task.');
        }
    });
}

function deleteTask(taskId) {
    if (confirm("Are you sure you want to delete this task?")) {
        $.ajax({
            url: '../Events/deleteTask.php',
            type: 'POST',
            data: { task_id: taskId },
            success: function(response) {
                if (response.trim() === "Success") {
                    $('#task-row-' + taskId).remove();
                    $('#calendar').fullCalendar('removeEvents', taskId);
                } else {
                    alert('Failed to delete the task: ' + response);
                }
            },
            error: function() {
                alert('Error deleting task.');
            }
        });
    }
}

$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: [
            <?php 
            foreach ($is_admin ? $all_tasks : $tasks as $task): 
            ?>
                {
                    id: '<?php echo $task['id']; ?>',
                    title: '<?php echo htmlspecialchars($task['title']); ?>',
                    start: '<?php echo $task['date']; ?>',
                    description: '<?php echo htmlspecialchars($task['description']); ?>',
                    assigned_to: '<?php echo htmlspecialchars($task['assigned_to'] ?? 'Unknown'); ?>',
                    urgency: '<?php echo htmlspecialchars($task['urgency']); ?>',
                    status: '<?php echo htmlspecialchars($task['status']); ?>',
                    subtasks: <?php echo json_encode($task['subtasks']); ?>,
                    color: '<?php echo $task['status'] === 'Late' ? 'red' : ''; ?>'
                },
            <?php endforeach; ?>
        ],
        eventClick: function(event) {
            openModal(event);
            return false;
        }
    });
});
</script>
</body>
</html>
