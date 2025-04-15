

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_about.css">
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
        <li><a href="student_about.php" class="active">About Us</a></li>
        <li><a href="student_event.php">Event</a></li>
        <li><a href="student_chat.php">Chat</a></li>
        <li><a href="student_annount.php">Announcement</a></li>
        <li><a href="student_faq.php">FAQs</a></li>
        <li><a href="login.php">LogOut</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="section">
        <img src="image/history.jpg" alt="History Image">
        <div class="text">
            <h3>Our History</h3>
            <p>Sekolah Kebangsaan Binjai was established in 1936 with a humble beginning of just 20 students and a single classroom. Over the decades, it has grown into a well-equipped institution providing quality education to generations of students.</p>
        </div>
    </div>

    <div class="section">
        <div class="text">
            <h3>Our Vision</h3>
            <p>To be an outstanding educational institution that nurtures well-rounded students with academic excellence, strong moral values, and leadership qualities by 2030.</p>
        </div>
        <img src="image/vision1.jpg" alt="Vision Image 1">
    </div>

    <div class="section">
        <img src="image/vision2.jpg" alt="Vision Image 2">
        <div class="text">
            <h3>Our Mission</h3>
            <ul>
                <li>To provide a high-quality and inclusive education for all students.</li>
                <li>To create a safe, engaging, and supportive learning environment.</li>
                <li>To instill strong character, discipline, and leadership skills.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
</footer>

</body>
</html>
