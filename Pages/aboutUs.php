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
    <link rel="stylesheet" href="../CSS/index.css"> <!-- For Navbar and Footer -->
    <link rel="stylesheet" href="../CSS/aboutUs.css"> <!-- Specific styles for About Us -->
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Logo (1).png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="#">Task</a>
        <a href="#">Create Task</a>
        <a href="aboutUs.php">About Us</a>
        <a href="#">Contact Us</a>
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

<!-- About Us Section -->
<section class="about-us">
    <div class="about-text">
        <h2>Leading the way in task management intelligence</h2>
        <p>We believe what’s good for businesses is good for society. TaskXpert is here to build trust and demonstrate impact.</p>
    </div>
    <div class="about-image">
        <img src="../Assets/aboutus.png" alt="About Us Image">
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stat-card">
        <h3>6,000+</h3>
        <p>Active users</p>
    </div>
    <div class="stat-card">
        <h3>150+</h3>
        <p>Awarded patents</p>
    </div>
    <div class="stat-card">
        <h3>500+</h3>
        <p>Employees</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="our-story">
    <div class="our-story-container">
        <div class="our-story-title">
            <h2>Our Story</h2>
        </div>
        <div class="our-story-content">
            <p>At TaskXpert, we were founded on the belief that businesses can drive positive change. Our mission is to empower organizations with innovative task management solutions that enhance productivity and foster collaboration.</p>
            <p>In a world where technology and teamwork are vital, we strive to build trust and create impact. Our platform is designed to help teams streamline their processes, enabling them to focus on what truly matters: achieving their goals.</p>
            <p>Today, we partner with businesses of all sizes, delivering a market-defining task management platform that prioritizes transparency, efficiency, and user satisfaction. Together, we're shaping the future of work and transforming how teams operate.</p>
            <p>Join us on our journey as we continue to redefine what good business looks like, ensuring every company can thrive in an ever-evolving landscape.</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="../Assets/Logo (1).png" alt="TaskManager Logo">
        </div>

        <div class="footer-menu">
            <h3>Quick Menu</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Task</a></li>
                <li><a href="#">Create Task</a></li>
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
    document.getElementById('hamburger-menu').addEventListener('click', function() {
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('open');
    });
</script>

</body>
</html>
