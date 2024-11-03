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
    <link rel="stylesheet" href="../CSS/aboutUs&contactUs.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="task.php">Task</a>
        <a href="createTask.php">Create Task</a>
        <a href="aboutUs.php" class="active">About Us</a>
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

<!-- About Us Section -->
<section class="about-us">
    <div class="about-text">
        <p>About Us</p>
        <h1>Leading the way in task management intelligence</h1>
        <p>We believe what’s good for businesses is good for society. TaskXpert is here to build trust and demonstrate impact.</p>
    </div>
    <div class="about-image">
        <img src="../Assets/aboutUs.png" alt="About Us Image">
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stat-card" id="active-users">
        <h3>0</h3>
        <p>Active users</p>
    </div>
    <div class="stat-card" id="awarded-patents">
        <h3>0</h3>
        <p>Awarded patents</p>
    </div>
    <div class="stat-card" id="employees">
        <h3>0</h3>
        <p>Employees</p>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us">
    <h2>Why Choose TaskXpert?</h2>
    <p>At TaskXpert, we offer tailored task management solutions designed to fit the diverse needs of teams and individuals. Here’s how we stand out:</p>
    
    <div class="cards-container">
        <div class="card">
            <img src="../Assets/management.png" alt="Comprehensive Task Management Icon" class="card-icon">
            <h3>Comprehensive Task Management</h3>
            <p>Our platform provides a complete overview of tasks, allowing users to track progress and deadlines effectively.</p>
        </div>
        <div class="card">
            <img src="../Assets/Collaboration.png" alt="Real-Time Collaboration Icon" class="card-icon">
            <h3>Real-Time Collaboration</h3>
            <p>Work seamlessly with your team, share updates instantly, and enhance communication, no matter where you are.</p>
        </div>
        <div class="card">
            <img src="../Assets/task.png" alt="Easy Task Assignment Icon" class="card-icon">
            <h3>Easy Task Assignment</h3>
            <p>Delegate tasks effortlessly and monitor their progress through an intuitive dashboard.</p>
        </div>
        <div class="card">
            <img src="../Assets/friendly.png" alt="User-Friendly Interface Icon" class="card-icon">
            <h3>User-Friendly Interface</h3>
            <p>Our user-friendly design minimizes the learning curve, allowing users to maximize productivity from day one.</p>
        </div>
        <div class="card">
            <img src="../Assets/secure.png" alt="Secure Data Handling Icon" class="card-icon">
            <h3>Secure Data Handling</h3>
            <p>We prioritize your data security with advanced encryption and regular backups, ensuring your information is always safe.</p>
        </div>
        <div class="card">
            <img src="../Assets/support.png" alt="24/7 Support Icon" class="card-icon">
            <h3>24/7 Support</h3>
            <p>Our dedicated support team is available around the clock to assist you with any inquiries or technical issues.</p>
        </div>
        <div class="card">
            <img src="../Assets/custom.png" alt="Customizable Features Icon" class="card-icon">
            <h3>Customizable Features</h3>
            <p>Tailor the platform to suit your unique workflows and preferences, enhancing your team’s efficiency.</p>
        </div>
    </div>
</section>


<!-- Mission and Vision Section -->
<section class="mission-vision">
    <div class="mission">
        <div class="mission-box">
        <img src="../Assets/Story.png" alt="Mission Image" class="mission-image">
        </div>
        
        <div class="mission-text">
            <h3>OUR STORY</h3>
            <p>We strive to empower teams and individuals with the tools they need to effectively manage their tasks and projects, fostering productivity and success.</p>
        </div>
    </div>
    <div class="vision">
        <div class="vision-text">
            <h3>OUR VISION</h3>
            <p>To be the leading provider of task management solutions that inspire organizations to achieve excellence through effective collaboration.</p>
        </div>
        <div class="vision-box">
        <img src="../Assets/Vision.png" alt="Vision Image" class="vision-image">
        </div>
    </div>
    <div class="mission">
        <div class="mission-box">
        <img src="../Assets/Mission.png" alt="Mission Image" class="mission-image">
        </div>
        
        <div class="mission-text">
            <h3>OUR MISSION</h3>
            <p>Our mission is to simplify task management and boost productivity by delivering intuitive, reliable, and effective tools that empower individuals and teams to stay organized, meet their goals, and unlock their full potential.</p>
        </div>
    </div>
</section>
<!-- Footer -->
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

<script>
    document.getElementById('hamburger-menu').addEventListener('click', function() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
    });
     // Function to animate the counting effect
     function animateCounter(id, start, end, duration) {
        let obj = document.getElementById(id).getElementsByTagName('h3')[0];
        let range = end - start;
        let current = start;
        let increment = end > start ? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range));

        let timer = setInterval(function() {
            current += increment;
            obj.textContent = current.toLocaleString() + '+';
            if (current === end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Function to trigger the animation when the stats section is visible
    function startCounting() {
        animateCounter('active-users', 0, 6000, 2000);
        animateCounter('awarded-patents', 0, 150, 2000);
        animateCounter('employees', 0, 500, 2000);
    }

    // Check if the stats section is in the viewport
    window.addEventListener('scroll', function() {
        const statsSection = document.querySelector('.stats');
        const statsTop = statsSection.getBoundingClientRect().top;
        const statsVisible = statsTop < window.innerHeight && statsTop >= 0;

        if (statsVisible) {
            startCounting();
            window.removeEventListener('scroll', arguments.callee);
        }
    });
</script>

</body>
</html>
