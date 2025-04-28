<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST["class_name"];
    $user_id = $_SESSION['user_id']; // Get current logged-in user ID
    $conn->query("INSERT INTO classes (name, user_id) VALUES ('$class_name', '$user_id')");
    header("Location: index1.php");
}
?>
