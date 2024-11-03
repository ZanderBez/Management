<?php
session_start(); // Start session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_name']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management App</title>
    <link rel="stylesheet" href="../CSS/createTask.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="task.php">Task</a>
        <a href="createTask.php" class="active">Create Task</a>
        <a href="aboutUs.php">About us</a>
        <a href="contactUs.php">Contact us</a>
    </div>
    <div class="nav-right">
        <?php if ($is_logged_in): ?>
            <!-- Display username and Logout button if logged in -->
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

<section class="create-task">
    <div class="task-text">
        <h3>Get Started with Your New Task</h3>
        <p>Define and Organize Your Work Here</p>
    </div>
</section>

<!-- Task Creation Section -->
<section class="task-creation">
    <h2>Create a New Task</h2>
    <div class="form-container">
    <form id="task-form" method="POST">
    <div class="form-row">
        <div class="form-group">
            <label for="task-title">Task Title</label>
            <input type="text" name="task_title" id="task-title" placeholder="Enter task title" required>
        </div>
        <div class="form-group">
            <label for="task-date">Due Date</label>
            <input type="date" name="due_date" id="task-date" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="urgency">Urgency</label>
            <select name="urgency" id="urgency">
                <option value="Urgent">Urgent</option>
                <option value="Not Urgent">Not Urgent</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Pending">Pending</option>
                <option value="Complete">Complete</option>
            </select>
        </div>
        <div class="form-group">
            <label for="assigned-to">Assigned To</label>
            <input type="text" name="assigned_to" id="assigned-to" placeholder="Assignee name" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group full-width">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter task description" required></textarea>
        </div>
    </div>
     <!-- Subtask Fields -->
     <div class="subtask-container">
            <h3>Subtasks</h3>
            <div class="subtask-row">
                <input type="text" name="subtask_title[]" placeholder="Subtask Title" required>
                <input type="text" name="subtask_description[]" placeholder="Subtask Description" required>
            </div> 
        </div>
        <button type="button" id="add-subtask">Add Another Subtask</button>
        
        <button type="submit">Create Task</button>
</form>

    </div>
</section>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('hamburger-menu').addEventListener('click', function() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
    });
    $(document).ready(function() {
        $('#task-form').on('submit', function(e) {
            e.preventDefault();

            // Serialize the form data, including subtasks
            const formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '../Events/submitTask.php',
                data: formData,
                success: function(response) {
                    alert(response);
                    $('#task-form')[0].reset(); // Reset the form after successful submission
                },
                error: function() {
                    alert('Error submitting the task.');
                }
            });
        });

        // Add functionality to add more subtasks
        $('#add-subtask').on('click', function() {
            const subtaskContainer = $('.subtask-container');
            const newSubtaskRow = $('<div class="subtask-row">');
            newSubtaskRow.html(`
                <input type="text" name="subtask_title[]" placeholder="Subtask Title" required>
                <input type="text" name="subtask_description[]" placeholder="Subtask Description" required>
            `);
            subtaskContainer.append(newSubtaskRow);
        });
    });
</script>

</body>
</html>