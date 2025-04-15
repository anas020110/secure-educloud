<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Gallery</title>
    <link rel="stylesheet" href="student_gallery.css">
</head>
<body>
    <div class="gallery-container">
        <h1>School Gallery</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="file" name="image" required>
            <button type="submit" name="upload">Upload Image</button>
        </form>

        <div class="image-gallery">
            <?php
            $conn = new mysqli("localhost", "root", "", "educloud");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="gallery-item">';
                    echo '<img src="uploads/' . htmlspecialchars($row['image_name']) . '" alt="Image">';
                    echo '</div>';
                }
            } else {
                echo '<p>No images found. Please upload some images.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
