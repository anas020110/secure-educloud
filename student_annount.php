<?php
require_once 'Utils.php';
require 'vendor/autoload.php';

use App\Utils;

session_start();
date_default_timezone_set('Asia/Kuching');

// Check session
if (!isset($_SESSION['user_id'])) {
    die("Error: No session found. Please log in first.");
}

if (!isset($_SESSION['user_role'])) {
    die("Error: User role not set.");
}

// Fetch announcements
$statement = Utils::database()->prepare('SELECT * FROM information ORDER BY created_timestamp DESC');
$statement->execute();
$information = $statement->fetchAll();
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_annount.css">
</head>
<body>

<!-- Video Background -->
<div class="video-container">
    <video autoplay muted loop id="bgVideo">
        <source src="bg1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="logo-container">
        <img src="image/logo.png" alt="Logo" width="50">
    </div>
    <ul class="nav-links">
        <li><a href="student_home.php">Home</a></li>
        <li><a href="student_about.php">About Us</a></li>
        <li><a href="student_event.php">Event</a></li>
        <li><a href="student_chat.php">Chat</a></li>
        <li><a href="student_annount.php" class="active">Announcement</a></li>
        <li><a href="student_faq.php">FAQ</a></li>
        <li><a href="login.php">Log Out</a></li>
    </ul>
</nav>

<!-- Announcement Section -->
<div class="container">
    <h2 class="section-title">Latest Announcements</h2>

    <?php if (!empty($information)): ?>
        <?php foreach ($information as $info): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($info['title']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($info['content'])) ?></p>
                    <p class="card-text">
                        <small class="text-muted">Last updated: <?= date('j/n/Y g:i A', strtotime($info['updated_timestamp'])) ?></small>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-announcement">No announcements available.</div>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer>
    &copy; <?= date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
</footer>

</body>
</html>
