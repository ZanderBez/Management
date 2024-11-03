<?php
session_start(); // Start session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_name']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : 'Guest';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Include database connection
require '../db_connect.php';

// Retrieve tasks for the logged-in user
$tasks = [];
if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management App</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <img src="../Assets/Navlogo.png" alt="TaskManager Logo" class="logo">
    </div>
    <div class="nav-center" id="nav-links">
        <a href="index.php" class="active">Home</a>
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
    <div class="hamburger" id="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <p>Welcome to TaskXpert</p>
        <h1>We solve business problems with technology.</h1>
        <p>Our performance is your success. Our passion is innovation. Our expertise is unmatched. We get you more.</p>
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
        </div>
        <div class="service-card">
            <img src="../Assets/Collaboration.png" alt="Cloud Services">
            <h3>Real-Time Collaboration</h3>
            <p>Collaborate with your team in real-time, ensuring seamless updates and transparent communication.</p>
        </div>
        <div class="service-card">
            <img src="../Assets/management.png" alt="Security Services">
            <h3>Comprehensive Task Management</h3>
            <p>Manage tasks, track progress, and stay on top of your project goals with our all-in-one task management tool.</p>
        </div>
    </div>

    <div class="happy-customers">
        <p>Join our <span id="customer-count">0</span> happy customers with your task today</p>
    </div>
</section>

<!-- Task List Section -->
<section class="task-list">
    <h2>Your Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($tasks) > 0): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr class="<?php echo $task['status'] === 'Late' ? 'row-late' : ''; ?>">
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo htmlspecialchars($task['date']); ?></td>
                        <td><?php echo htmlspecialchars($task['status'] ?: 'Pending'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
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
            <br>
            <a href="aboutUs.php" class="read-more-btn">Read More</a>
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
                    <h4 class="testimonial-author">John Doe - Cape Town</h4>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"TaskManager has completely transformed how we handle our projects. The ease of use and integration into our workflow has saved us hours of time every week!"</p>
                    <div class="testimonial-stars">
                        &#9733;&#9733;&#9733;&#9733;&#9733;
                    </div>
                    <h4 class="testimonial-author">Jane Smith - Johannesburg</h4>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"The best task management platform we’ve ever used! Simple, intuitive, and effective. Highly recommend TaskManager to all growing teams. It's a lifesaver."</p>
                    <div class="testimonial-stars">
                        &#9733;&#9733;&#9733;&#9733;&#9733;
                    </div>
                    <h4 class="testimonial-author">Mike Brown - Durban</h4>
                </div>
            </div>

            <button class="testimonial-arrow right-arrow" id="right-arrow">&#8250;</button>
        </div>
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

<script>
    document.getElementById('hamburger-menu').addEventListener('click', function() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
    });

    function animateValue(id, start, end, duration) {
        let obj = document.getElementById(id);
        let range = end - start;
        let current = start;
        let increment = end > start ? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range));
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
                    animateValue("customer-count", 0, 9983, 1000);
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
