<?php
session_start(); // Start the session to store user information
include '../db_connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user datas
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            // Password is correct, create session and redirect to index.php
            $_SESSION['user_id'] = $user['id']; // Storing user ID in the session
            $_SESSION['user_name'] = $user['name']; // Storing user name in the session
            $_SESSION['user_role'] = $user['role']; // Storing user role in the session

            // Redirect to index.php
            header("Location: ../Pages/index.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password. Please try again.";
        }
    } else {
        // Email does not exist
        echo "No account found with that email. Please check your email or sign up.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - TaskXpert</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="../CSS/signIn.css">
</head>
<body>
    <div class="signup-container">
        <!-- Right Section with Image (now swapped to the right) -->
        <div class="signup-right">
            <img src="../Assets/signIn.png" alt="Sign In Illustration">
        </div>

        <!-- Left Section with Form -->
        <div class="signup-left">
            <div class="form-header">
                <img src="../Assets/FormLogo.png" alt="TaskXpert Logo" class="logo">
                <p>Sign in to your account</p>
            </div>

            <!-- Ensure the form submits to itself -->
            <form action="" method="POST" class="signup-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn-primary">Sign In</button>
                <p class="signin-link">
                    Don't have an account? <a href="signUp.php">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
