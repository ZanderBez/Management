<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management App</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
            <div class="nav-left">
                <img src="your-logo-path.png" alt="TaskManager Logo" class="logo">
            </div>
            <div class="nav-center">
                <a href="#">Home</a>
                <a href="#">Features</a>
            </div>
            <div class="nav-right">
                <a href="#">Login</a>
                <a href="#">Sign Up</a>
            </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="overlay">
            <video autoplay muted loop class="hero-video">
                <source src="../Assets/AdobeStock_508396632.mp4" type="video/mp4"> 
                <source src="../Assets/AdobeStock_508396632.mp4.webm" type="video/webm"> 
                Your browser does not support the video tag.
            </video>
            
            <div class="hero-info">
                <h1>Welcome to TaskManager</h1>
                <p>Your simple and effective way to manage tasks</p>
                <a href="#" class="cta-btn">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Introduction Section -->
    <section class="intro-section">
        <div class="container">
            <h2>Why TaskManager?</h2>
            <p>TaskManager is designed to help you and your team stay organized. Whether you’re working solo or collaborating with others, TaskManager gives you the tools to track tasks, set deadlines, and achieve your goals. It's fast, simple, and best of all, free.</p>
        </div>
    </section>

    <div class="accordion-text"><h1>QUICK ANSWERS</h1></div>
    <!-- Features Section -->
    <section class="accordion-section">
        
        <!-- Accordion Item 1 -->
        <div class="accordion-item">
            <button class="accordion-header" onclick="toggleAccordion('panel1', this)">Booking Process
                <span class="arrow">&#9662;</span>
            </button>
            <div id="panel1" class="accordion-panel">
                <p>The cruise booking process involves searching for available cruises based on your preferences. Once you make the payment, you'll receive a booking confirmation with all the details. Before the cruise, you'll complete pre-cruise planning tasks and collect necessary documents for embarkation.</p>
            </div>
        </div>

        <!-- Accordion Item 2 -->
        <div class="accordion-item">
            <button class="accordion-header" onclick="toggleAccordion('panel2', this)">Cancellation and Refund Policies
                <span class="arrow">&#9662;</span>
            </button>
            <div id="panel2" class="accordion-panel">
                <p>Details about cancellation and refund policies go here...</p>
            </div>
        </div>

        <!-- Accordion Item 3 -->
        <div class="accordion-item">
            <button class="accordion-header" onclick="toggleAccordion('panel3', this)">Travel Documentation
                <span class="arrow">&#9662;</span>
            </button>
            <div id="panel3" class="accordion-panel">
                <p>Information about travel documentation goes here...</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <h2>What Our Users Say</h2>
        <div class="testimonials">
            <div class="testimonial">
                <p>"TaskManager has transformed how I organize my work. It's simple, easy to use, and incredibly efficient!"</p>
                <span>- John Doe</span>
            </div>
            <div class="testimonial">
                <p>"My team loves using TaskManager! We can collaborate seamlessly and stay on top of our tasks."</p>
                <span>- Jane Smith</span>
            </div>
            <div class="testimonial">
                <p>"My team loves using TaskManager! We can collaborate seamlessly and stay on top of our tasks."</p>
                <span>- Jane Smith</span>
            </div>
            <div class="testimonial">
                <p>"My team loves using TaskManager! We can collaborate seamlessly and stay on top of our tasks."</p>
                <span>- Jane Smith</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="your-logo-path.png" alt="TaskManager Logo">
                <h2>Task Manager</h2>
                <p>Your perfect task manager solution.</p>
            </div>

            <div class="footer-menu">
                <h3>Quick Menu</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>+27 98 678 483</p>
                <p><a href="mailto:info@taskmanager.co.za">info@taskmanager.co.za</a></p>
                <div class="social-icons">
                    <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
                    <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                    <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 TaskManager, Inc. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function toggleAccordion(panelId, element) {
        const panel = document.getElementById(panelId);
        
        // Toggle the display of the panel
        if (panel.style.display === "block") {
            panel.style.display = "none";
            element.classList.remove('active'); 
        } else {
            panel.style.display = "block";
            element.classList.add('active');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const introSection = document.querySelector(".intro-section");

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    introSection.classList.add("visible");
                    observer.unobserve(introSection); // Stops observing once the animation is triggered
                }
            });
        });

        observer.observe(introSection);
    });
    </script>

</body>
</html>
