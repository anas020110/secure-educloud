<?php
$conn = new mysqli("localhost", "root", "", "educloud");

$id = $_GET["id"];
$conn->query("DELETE FROM files WHERE id = $id");
header("Location: home_teacher.php");
exit();
