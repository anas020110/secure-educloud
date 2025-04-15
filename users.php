<?php
$conn = new mysqli("localhost", "root", "", "educloud");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Enable/Disable toggle
if (isset($_GET['toggle_id'])) {
    $id = intval($_GET['toggle_id']);
    $user = $conn->query("SELECT is_enabled FROM users WHERE id = $id")->fetch_assoc();
    $new_status = $user['is_enabled'] ? 0 : 1;
    $conn->query("UPDATE users SET is_enabled = $new_status WHERE id = $id");
    header("Location: users.php");
    exit;
}

// Handle search
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE ? ORDER BY id ASC");
    $like = "%$search%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    // Count total for searched result
    $stmtCount = $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE name LIKE ?");
    $stmtCount->bind_param("s", $like);
    $stmtCount->execute();
    $countResult = $stmtCount->get_result()->fetch_assoc();
    $totalUsers = $countResult['total'];
    $stmtCount->close();
} else {
    $result = $conn->query("SELECT * FROM users ORDER BY id ASC");
    $count = $conn->query("SELECT COUNT(*) AS total FROM users");
    $totalUsers = $count->fetch_assoc()['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management</title>
  <link rel="stylesheet" href="users.css">
  <style>
    /* Background */
    .background {
      background-image: url('image/a1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      filter: brightness(0.75);
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    /* Header */
    header {
      background-color: #222;
      color: white;
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo {
      font-weight: bold;
      font-size: 20px;
    }
    nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: bold;
    }
    nav a.active {
      text-decoration: underline;
    }

    /* Main */
    main {
      padding: 40px 20px;
    }

    .card {
      background: white;
      max-width: 1000px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    h2 {
      margin-bottom: 25px;
    }

    /* Search form */
    .search-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }
    .search-form input[type="text"] {
      flex: 1;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .search-form button,
    .search-form a {
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 16px;
      text-decoration: none;
      text-align: center;
    }
    .search-form button {
      background-color: #2196F3;
      color: white;
      border: none;
    }
    .search-form a {
      background-color: #f44336;
      color: white;
    }

    .user-count {
      font-weight: bold;
      font-size: 17px;
      margin-bottom: 15px;
      color: #333;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #f5f5f5;
    }

    /* Status Buttons */
    .btn.enable {
      background-color: #4CAF50;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
    }
    .btn.disable {
      background-color: #f44336;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
    }

    /* Mobile */
    @media (max-width: 768px) {
      .search-form {
        flex-direction: column;
      }
      table, thead, tbody, th, td, tr {
        display: block;
      }
      th {
        display: none;
      }
      td {
        position: relative;
        padding-left: 50%;
        text-align: left;
        border: none;
        border-bottom: 1px solid #ddd;
      }
      td::before {
        position: absolute;
        top: 10px;
        left: 10px;
        font-weight: bold;
        white-space: nowrap;
      }
      td:nth-of-type(1)::before { content: "No"; }
      td:nth-of-type(2)::before { content: "Name"; }
      td:nth-of-type(3)::before { content: "Email"; }
      td:nth-of-type(4)::before { content: "Role"; }
      td:nth-of-type(5)::before { content: "Date and Time"; }
      td:nth-of-type(6)::before { content: "Status"; }
    }
  </style>
</head>
<body>
  <div class="background"></div>

  <!-- Navigation -->
  <header>
    <div class="logo">Secure EduCloud</div>
    <nav>
      <a href="admin_home.php">Home</a>
      <a href="announcement.php">Announcement</a>
      <a href="users.php" class="active">Users</a>
      <a href="admin_chat.php">Chat</a>
      <a href="login.php">LogOut</a>
    </nav>
  </header>

  <!-- Content -->
  <main>
    <div class="card">
      <h2>Users</h2>

      <!-- Search -->
      <form class="search-form" method="GET">
        <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="users.php">Reset</a>
      </form>

      <!-- Total Users -->
      <div class="user-count">Total Users: <?= $totalUsers ?></div>

      <!-- Table -->
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date and Time</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= ucfirst($row['role']) ?></td>
            <td><?= date("n/j/Y g:i A", strtotime($row['created_timestamp'])) ?></td>
            <td>
              <a href="?toggle_id=<?= $row['id'] ?>" class="btn <?= $row['is_enabled'] ? 'disable' : 'enable' ?>">
                <?= $row['is_enabled'] ? 'Disable' : 'Enable' ?>
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
