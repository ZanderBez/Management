<?php
include '../db_connect.php'; // Adjusted the path to point to the correct location

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check if the passwords match
    if ($password === $confirm_password) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to signIn.php after successful signup
            header("Location: signIn.php");
            exit(); // Make sure to stop further script execution after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TaskXpert</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="../CSS/signUp.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-right">
            <!-- Replacing heading with the logo -->
            <div class="form-header">
                <img src="../Assets/FormLogo.png" alt="TaskXpert Logo">
                <p>Create an Account</p>
            </div>

            <form action="" method="POST" class="signup-form" onsubmit="return validatePasswords()">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="8+ characters" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>

                <!-- Radio Buttons for Role Selection -->
                <div class="form-group">
                    <p>Select your role:</p>
                    <div class="role-option-group">
                        <label class="role-option">
                            <input type="radio" name="role" value="boss" required> Boss
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="worker" required> Worker
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Sign Up</button>

                <p class="signup-link">Already have an Account?<a href="signIn.php">Sign In</a></p>
            </form>
        </div>

        <!-- Left Section with Image (now moved to the right) -->
        <div class="signup-left">
            <img src="../Assets/signUp.png" alt="Sign Up Illustration">
        </div>
    </div>

    <script>
    function validatePasswords() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return false; // Prevent form submission
        }
        return true; // Allow form submission if passwords match
    }
    </script>
</body>
</html>
