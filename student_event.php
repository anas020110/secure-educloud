<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event - Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_event.css">
</head>
<body>

<!-- Video Background -->
<div class="video-container">
    <video autoplay muted loop id="bgVideo">
        <source src="bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<!-- Navigation -->
<nav class="navbar">
    <div class="logo-container">
        <img src="image/logo.png" alt="Logo" width="50">
    </div>
    <ul class="nav-links">
        <li><a href="student_home.php">Home</a></li>
        <li><a href="student_about.php">About Us</a></li>
        <li><a href="student_event.php" class="active">Event</a></li>
        <li><a href="student_chat.php">Chat</a></li>
        <li><a href="student_annount.php">Announcement</a></li>
        <li><a href="student_faq.php">FAQs</a></li>
        <li><a href="login.php">LogOut</a></li>
    </ul>
</nav>

<!-- Carousel Section -->
<div class="carousel-container">
    <button class="arrow left">&#8249;</button>
    <img src="" id="carousel-image" alt="Event Banner">
    <button class="arrow right">&#8250;</button>
</div>

<!-- Event List -->
<div class="events">
    <h2>Upcoming Events</h2>
    <div class="event-card">
        <h3>Annual Sports Day</h3>
        <p>Date: 15th August 2025 | Location: SK Binjai Field</p>
    </div>
    <div class="event-card">
        <h3>National Day Celebration</h3>
        <p>Date: 31st August 2025 | Location: School Hall</p>
    </div>
    <div class="event-card">
        <h3>Science & Innovation Fair</h3>
        <p>Date: 10th September 2025 | Location: Science Lab</p>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
</footer>

<!-- JavaScript for carousel -->
<script>
    const images = ["image/e4.png", "image/e5.png", "image/e6.png"];
    let current = 0;
    const imgEl = document.getElementById("carousel-image");

    // Display first image on page load
    imgEl.src = images[current];

    document.querySelector(".left").onclick = () => {
        current = (current - 1 + images.length) % images.length;
        imgEl.src = images[current];
    };

    document.querySelector(".right").onclick = () => {
        current = (current + 1) % images.length;
        imgEl.src = images[current];
    };
</script>

</body>
</html>
