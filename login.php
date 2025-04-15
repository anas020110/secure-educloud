<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "educloud";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND is_enabled = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($pass, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_role"] = strtolower($user["role"]); // Normalize case
            $_SESSION["user_name"] = $user["name"];

            // Role-based redirection (case-insensitive)
            $role = $_SESSION["user_role"];
            if ($role === "admin") {
                header("Location: admin_home.php");
            } elseif ($role === "teacher") {
                header("Location: home_teacher.php");
            } else {
                header("Location: student_home.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found or disabled.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="background"></div>
  <div class="login-box">
    <h2>Login</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
      <?php endif; ?>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</body>
</html>
