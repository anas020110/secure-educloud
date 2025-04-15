<?php
session_start();
$conn = new mysqli("localhost", "root", "", "cloud");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['user_name'] ?? 'Guest';
$role = $_SESSION['user_role'] ?? 'student';

// Send message
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
  <meta charset="UTF-8" />
  <title>Admin Chat - SK Binjai</title>
  <link rel="stylesheet" href="teacher_chat.css" />
</head>
<body>

<!-- Background -->
<div class="background"></div>

<!-- Header -->
<header>
  <div class="logo">Secure EduCloud</div>
  <nav>
    <a href="home_teacher.php">Home</a>
    <a href="teacher_chat.php" class="active">Chat</a>
    <a href="login.php">LogOut</a>
  </nav>
</header>

<!-- Main Chat Layout -->
<main>
  <div class="card">
    <h2>Live Chat - Sekolah Kebangsaan Binjai</h2>
    <div class="chat-box" id="chatBox">
      <?php
        $res = $conn->query("SELECT * FROM messages ORDER BY created_at ASC");
        while ($row = $res->fetch_assoc()) {
            $colorClass = 'student';
            if (stripos($row['username'], 'ADMIN') !== false) $colorClass = 'admin';
            elseif (stripos($row['username'], 'YUSOF') !== false) $colorClass = 'teacher';

            echo "<div class='bubble $colorClass'>
                    <strong>{$row['username']}</strong>: {$row['message']}
                    <span class='time'>{$row['created_at']}</span>
                  </div>";
        }
      ?>
    </div>

    <form method="POST" class="chat-form">
      <input type="text" name="message" placeholder="Type your message... 😊👍❤️" required />
      <button type="submit">Send</button>
    </form>
  </div>
</main>

</body>
</html>
