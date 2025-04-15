<?php
session_start();
$conn = new mysqli("localhost", "root", "", "cloud");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current user info
$username = $_SESSION['user_name'] ?? 'Guest';
$role = $_SESSION['user_role'] ?? 'student';

// Insert message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat - Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_chat.css">
    <link rel="stylesheet" href="student_home.css">
</head>
<body>

<!-- Video Background -->
<div class="video-container">
    <video autoplay muted loop id="bgVideo">
        <source src="bg.mp4" type="video/mp4">
    </video>
</div>

<!-- Navigation -->
<nav class="navbar">
    <div class="logo-container"><img src="image/logo.png" alt="Logo" width="50"></div>
    <ul class="nav-links">
        <li><a href="student_home.php">Home</a></li>
        <li><a href="student_about.php">About Us</a></li>
        <li><a href="student_event.php">Event</a></li>
        <li><a href="student_chat.php" class="active">Chat</a></li>
        <li><a href="student_annount.php">Announcement</a></li>
        <li><a href="student_faq.php">FAQ</a></li>
        <li><a href="login.php">Log Out</a></li>
    </ul>
</nav>

<!-- Chat Box -->
<div class="chat-container">
    <h2>Live Chat - Sekolah Kebangsaan Binjai</h2>
    <div class="chat-box" id="chatBox">
        <?php
        $res = $conn->query("SELECT * FROM messages ORDER BY created_at ASC");
        while ($row = $res->fetch_assoc()) {
            $colorClass = 'student';
            if (stripos($row['username'], 'ADMIN') !== false) $colorClass = 'admin';
            elseif (stripos($row['username'], 'YUSOF') !== false) $colorClass = 'teacher'; // adjust as needed

            echo "<div class='bubble $colorClass'>
                    <strong>{$row['username']}:</strong> {$row['message']}
                    <span class='time'>{$row['created_at']}</span>
                  </div>";
        }
        ?>
    </div>

    <form method="POST" class="chat-form">
        <input type="text" name="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</div>

<footer>&copy; <?= date("Y") ?> Sekolah Kebangsaan Binjai. All rights reserved.</footer>
</body>
</html>
