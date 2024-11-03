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
    <title>Contact Us - Task Management App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
        <a href="aboutUs.php">About Us</a>
        <a href="contactUs.php" class="active">Contact Us</a>
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
        <h3>Get in Touch</h3>
        <h2>We're Here to Help You</h2>
        <p>If you have any questions or inquiries, feel free to reach out to us. We're always happy to assist you!</p>
    </div>
</section>

<!-- Contact Us Section -->
<section class="contact-detail">
    <div class="contact-info">
        <h1>Get in touch</h1>
        <br>
        <p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        <br>
        
        <div class="contact-item">
            <img src="../Assets/office.png" alt="Location Icon" class="contact-icon">
            <div>
                <h4>Head Office</h4>
                <p>1297 John Vorster Dr, Southdowns, Centurion, 0062</p>
            </div>
        </div>

        <div class="contact-item">
            <img src="../Assets/email.png" alt="Email Icon" class="contact-icon">
            <div>
                <h4>Email Us</h4>
                <p>info@TaskXpert.co.za</p>
            </div>
        </div>

        <div class="contact-item">
            <img src="../Assets/phone.png" alt="Phone Icon" class="contact-icon">
            <div>
                <h4>Call Us</h4>
                <p>0126489200</p>
            </div>
        </div>
    </div>

    <div class="contact-form">
        <h2>Send us a message</h2>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" placeholder="Your Phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
</section>

<!-- Google Map Section -->
<section class="google-map">
    <h1>Our Location</h1>
    <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3589.321356159123!2d28.20695667628068!3d-25.891804351325547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e956608911ce097%3A0x519896b4b6eda40a!2sOpen%20Window%20-%20Centurion!5e0!3m2!1sen!2sza!4v1729962547141!5m2!1sen!2sza" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                <li><a href="task.php">Task</a></li>
                <li><a href="contactUs>php">Contact Us</a></li>
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
</script>

</body>
</html>
