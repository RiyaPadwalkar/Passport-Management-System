<?php
session_start();


// Check if login was successful to show an alert
// $loginSuccess = false;
// if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
//     $loginSuccess = true;
//     unset($_SESSION['login_success']); // Clear the flag after displaying the alert
// }

// // Check if there is a signup success message to show
// $signupMessage = '';
// if (isset($_SESSION['signup_success'])) {
//     $signupMessage = $_SESSION['signup_success'];
//     unset($_SESSION['signup_success']); // Clear the signup success message after displayingc
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PassportPro - Passport Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <img src="logo.jpg" alt="PassportPro Logo">
        </div>
        <div class="header-title">
            <h1>PassportPro</h1>
            <p>Passport Management System</p>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <ul>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="profile.html">User Profile</a></li>
            <li><a href="security.html">Security</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Background Image with Links -->
    <div class="background-image" id="home-content">
        <div class="links">
            <ul>
                <div class="f"><li><a href="fresh.php">Fresh Passport</a></li></div>
                <div class="f"><li><a href="renewal.php">Renewal</a></li></div>
                <div class="f"><li><a href="appointment.php">Appointment</a></li></div>
              
                <div class="f"><li><a href="payment.php">Payment</a></li></div>
            </ul>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2023 PassportPro - Passport Management System</p>
            <p>Address: 123 Main St, Anytown, INDIA</p>
            <p>Phone: 555-555-5555</p>
            <p>Email: <a href="mailto:info@passportpro.com">info@passportpro.com</a></p>
            <p>Follow us on social media:</p>
            <ul>
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
        <!-- User ID Display -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <p style="text-align:center;">Your User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
    <?php endif; ?>
    </footer>
     
    <script>
        document.getElementById('home-content').style.display = 'none';

        // Display the homepage content after a delay (e.g., 1 second)
        setTimeout(() => {
            document.getElementById('home-content').style.display = 'block';
        }, 1000);
    </script>
</body>
</html>
