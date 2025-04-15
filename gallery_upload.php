<?php
if (isset($_POST['upload'])) {
    $targetDir = "uploads/";
    $imageName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . $imageName;

    // Create the uploads folder if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $conn = new mysqli("localhost", "root", "", "educloud");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $validExtensions)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO gallery (image_name) VALUES (?)");
            $stmt->bind_param("s", $imageName);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: student_gallery.php");
        } else {
            echo "Error uploading the image. Please try again.";
        }
    } else {
        echo "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
    }
}
?>
