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
    <title>About Us - Task Management App</title>
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="../CSS/aboutUs.css"> <!-- Specific styles for About Us -->
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="#">Task</a>
        <a href="#">Create Task</a>
        <a href="aboutUs.php">About Us</a>
        <a href="contactUs.php">Contact Us</a>
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

<section class="contact-us">
    <div class="contact-text">
        <h3>ABOUT US</h3>
        <h2>Leading the way in task management intelligence</h2>
        <p>We believe what’s good for businesses is good for society. TaskXpert is here to build trust and demonstrate impact.</p>
    </div>
</section>
</body>
</html>