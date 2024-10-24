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
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Logo (1).png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php">Home</a>
        <a href="aboutUs.php">Task</a>
        <a href="#">Create Task</a>
        <a href="#">About us</a>
        <a href="#">Contact us</a>
    </div>
    <div class="nav-right">
        <?php if ($is_logged_in): ?>
            <!-- Display username and Logout button if logged in -->
            <span class="user-name"><?php echo htmlspecialchars($user_name); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <!-- If not logged in, show Get Started button -->
            <a href="signUp.php" class="cta-btn">Get Started</a>
        <?php endif; ?>
    </div>
    <div class="hamburger" id="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <p>Welcome to TaskManager</p>
        <h1>We solve business problems with technology.</h1>
        <p>Our performance is your success. Our passion iheros innovation. Our expertise is unmatched. We get you more.</p>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Create a Task</a>
            <a href="#" class="btn-secondary">View Your task</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="../Assets/Asset 1.png" alt="Task Manager Illustration">
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="services">
        <div class="service-card">
            <img src="../Assets/task.png" alt="Software Services">
            <h3>Streamlined Task Creation</h3>
            <p>Our platform allows you to create tasks easily, assign them to team members, and set deadlines efficiently.</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
        <div class="service-card">
            <img src="../Assets/Collaboration.png" alt="Cloud Services">
            <h3>Real-Time Collaboration</h3>
            <p>Collaborate with your team in real-time, ensuring seamless updates and transparent communication..</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
        <div class="service-card">
            <img src="../Assets/management.png" alt="Security Services">
            <h3>Comprehensive Task Management</h3>
            <p>Manage tasks, track progress, and stay on top of your project goals with our all-in-one task management tool.</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
    </div>

    <div class="happy-customers">
        <h1>Join our <span id="customer-count">0</span> happy customers with your task today</h1>
    </div>
</section>

<section class="why-us-section">
    <div class="why-us-container">
        <div class="why-us-image">
            <img src="../Assets/whyus1.png" alt="Why Us Image">
        </div>
        <div class="why-us-content">
            <h2>Why Choose Us</h2>
            <p>We provide expert task management solutions with features designed to help you succeed. Here’s why our platform stands out:</p>
            <ul>
                <li>✔ Comprehensive Task Management</li>
                <li>✔ Real-time Collaboration</li>
                <li>✔ Easy Task Assignment and Progress Tracking</li>
                <li>✔ Intuitive and User-Friendly Interface</li>
                <li>✔ Secure and Reliable Data Handling</li>
                <li>✔ 24/7 Support and Assistance</li>
            </ul>
            <a href="#" class="read-more-btn">Read More</a>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section">
    <div class="testimonial-container">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-content">
            <button class="testimonial-arrow left-arrow" id="left-arrow">&#8249;</button>
            
            <!-- Testimonial Cards Wrapper -->
            <div class="testimonial-cards-wrapper">
                <div class="testimonial-card active">
                    <p class="testimonial-text">"We had a great time using TaskManager. The task organization was seamless, and the real-time collaboration feature made our work much easier. We recommend it."</p>
                    <div class="testimonial-stars">
                        &#9733;&#9733;&#9733;&#9733;&#9734;
                    </div>
                    <p class="testimonial-author">John Doe - Cape Town</p>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"TaskManager has completely transformed how we handle our projects. The ease of use and integration into our workflow has saved us hours of time every week!"</p>
                    <div class="testimonial-stars">
                        &#9733;&#9733;&#9733;&#9733;&#9733;
                    </div>
                    <p class="testimonial-author">Jane Smith - Johannesburg</p>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"The best task management platform we’ve ever used! Simple, intuitive, and effective. Highly recommend TaskManager to all growing teams.Its a live saver"</p>
                    <div class="testimonial-stars">
                        &#9733;&#9733;&#9733;&#9733;&#9733;
                    </div>
                    <p class="testimonial-author">Mike Brown - Durban</p>
                </div>
            </div>

            <button class="testimonial-arrow right-arrow" id="right-arrow">&#8250;</button>
        </div>
    </div>
</section>


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

    function animateValue(id, start, end, duration) {
        let obj = document.getElementById(id);
        let range = end - start;
        let current = start;
        let increment = end > start ? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range)); // Speed up animation by reducing duration
        let timer = setInterval(function () {
            current += increment;
            obj.textContent = current.toLocaleString();
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Start the animation when the section is in view
    document.addEventListener("DOMContentLoaded", function() {
        const customerSection = document.querySelector(".happy-customers");

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateValue("customer-count", 0, 10000, 1000); // Increase to 30,000 in 1 second
                    observer.unobserve(customerSection);
                }
            });
        });

        observer.observe(customerSection);
    });
    const cards = document.querySelectorAll('.testimonial-card');
    const leftArrow = document.getElementById('left-arrow');
    const rightArrow = document.getElementById('right-arrow');
    let currentIndex = 0;

    // Function to show the current testimonial card
    function showCard(index) {
        cards.forEach((card, i) => {
            card.classList.remove('active');
            if (i === index) {
                card.classList.add('active');
            }
        });
    }

    // Event listeners for arrows
    leftArrow.addEventListener('click', () => {
        currentIndex = (currentIndex === 0) ? cards.length - 1 : currentIndex - 1;
        showCard(currentIndex);
    });

    rightArrow.addEventListener('click', () => {
        currentIndex = (currentIndex === cards.length - 1) ? 0 : currentIndex + 1;
        showCard(currentIndex);
    });

    // Initialize the first testimonial card
    showCard(currentIndex);
</script>

</body>
</html>
