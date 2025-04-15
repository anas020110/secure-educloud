<?php
$conn = new mysqli("localhost", "root", "", "educloud");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
session_start();
$user_id = 2; // ✅ Example teacher ID, replace with $_SESSION['user_id'] in real app

// Handle upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $title = $_POST["title"];
    $file = $_FILES["file"];
    $filename = basename($file["name"]);
    $tmpname = $file["tmp_name"];
    $mime = mime_content_type($tmpname);
    $size = filesize($tmpname);
    move_uploaded_file($tmpname, "uploads/$filename");

    $stmt = $conn->prepare("INSERT INTO files (title, filename, mime, size, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $title, $filename, $mime, $size, $user_id);
    $stmt->execute();
}

// Handle search
$search = isset($_GET["search"]) ? $_GET["search"] : '';
$sql = "SELECT f.*, u.name as owner FROM files f JOIN users u ON f.user_id = u.id WHERE f.user_id = $user_id";
if ($search) $sql .= " AND f.title LIKE '%$search%'";
$sql .= " ORDER BY f.created_timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher Home</title>
  <link rel="stylesheet" href="home_teacher.css">
</head>
<body>
  <div class="background"></div>
  <header>
    <div class="logo">Secure EduCloud</div>
    <nav>
      <a href="home_teacher.php" class="active">Home</a>
      <a href="teacher_chat.php">Chat</a>
      <a href="login.php">Logout</a>
    </nav>
  </header>

  <main>
    <div class="card">
      <h2>Files</h2>
      <form method="POST" enctype="multipart/form-data" class="upload-form">
        <input type="text" name="title" placeholder="File title" required>
        <input type="file" name="file" required>
        <button type="submit">Upload File</button>
      </form>

      <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search by title" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="home_teacher.php" class="reset">Reset</a>
      </form>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>MiMe</th>
            <th>Size (KB)</th>
            <th>Owner</th>
            <th>Date and Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows): $i = 1; while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= $row['mime'] ?></td>
            <td><?= number_format($row['size'] / 1024, 2) ?></td>
            <td><?= $row['owner'] ?></td>
            <td><?= $row['created_timestamp'] ?></td>
            <td>
              <a class="btn download" href="uploads/<?= urlencode($row['filename']) ?>" download>Download</a>
              <a class="btn edit" href="teacher_edit.php?id=<?= $row['id'] ?>">Edit</a>
              <a class="btn delete" href="teacher_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this file?')">Delete</a>
            </td>
          </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="7">No files found</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
