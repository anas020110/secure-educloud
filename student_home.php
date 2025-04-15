<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_home.css">
</head>
<body>

<!-- Video Background -->
<div class="video-container">
    <video autoplay muted loop id="bgVideo">
        <source src="bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="logo-container">
        <img src="image/logo.png" alt="Logo" width="50">
    </div>
    <ul class="nav-links">
        <li><a href="student_home.php" class="active">Home</a></li>
        <li><a href="student_about.php">About Us</a></li>
        <li><a href="student_event.php">Event</a></li>
        <li><a href="student_chat.php">Chat</a></li>
        <li><a href="student_annount.php">Announcement</a></li>
        <li><a href="student_faq.php">FAQ</a></li>
        <li><a href="login.php">Log Out</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="content">
    <h1>Welcome to Secure EduCloud</h1>
    <p>"The trusted Cloud Document Management System of Sekolah Kebangsaan Binjai."</p>
    <a href="student_team.php" class="cta-button">Our Admin</a>
</div>

<!-- Gallery Section (Image) -->
<div class="featured-grid">
    <div class="item"><img src="image/img1.jpg" alt="Gallery Image 1"></div>
    <div class="item"><img src="image/img2.jpg" alt="Gallery Image 2"></div>
    <div class="item"><img src="image/img3.jpg" alt="Gallery Image 3"></div>
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
</footer>
</body>
</html>
