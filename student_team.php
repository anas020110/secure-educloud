<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team - Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_team.css">
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
        <img src="image/logo.png" alt="Logo">
    </div>
    <ul class="nav-links">
        <li><a href="student_home.php">Home</a></li>
        <li><a href="student_about.php">About Us</a></li>
        <li><a href="student_event.php">Event</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="student_annount.php">Announcement</a></li>
        <li><a href="student_faq.php">FAQ</a></li>
        <li><a href="login.php">Log Out</a></li>
    </ul>
</nav>

<!-- Our Team Section -->
<section class="team-section">
    <h1>Meet Our Team</h1>
    <p>Get to know the dedicated individuals behind Sekolah Kebangsaan Binjai.</p>

    <div class="team-container">
        <div class="team-member">
            <img src="image/t1.png" alt="Admin 1">
            <h2>Ahmad Zulkarnain</h2>
            <p class="position">Principal</p>
            <p>Experienced school leader committed to excellence in education.</p>
        </div>
        <div class="team-member">
            <img src="image/t2.png" alt="Admin 2">
            <h2>Nor Aisyah Binti Rahman</h2>
            <p class="position">Vice Principal</p>
            <p>Passionate about student success and curriculum development.</p>
        </div>
        <div class="team-member">
            <img src="image/t3.png" alt="Admin 3">
            <h2>Muhammad Hakimi</h2>
            <p class="position">Head of ICT</p>
            <p>Driving technology and digital learning at Sekolah Kebangsaan Binjai.</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
</footer>

</body>
</html>
