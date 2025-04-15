<?php
$conn = new mysqli("localhost", "root", "", "educloud");
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = $_POST['title'];
    $stmt = $conn->prepare("UPDATE files SET title = ? WHERE id = ?");
    $stmt->bind_param("si", $newTitle, $id);
    $stmt->execute();
    header("Location: admin_home.php");
    exit();
}

$result = $conn->query("SELECT * FROM files WHERE id = $id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit File Title</title>
  <link rel="stylesheet" href="edit.css">
</head>
<body>
  <div class="background"></div>
  <div class="edit-card">
    <h2>Edit File Title</h2>
    <form method="POST">
      <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required>
      <div class="buttons">
        <button type="submit">Save</button>
        <a href="admin_home.php" class="cancel">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
