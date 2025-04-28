<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["student_name"];
    $roll = $_POST["student_roll"];
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO students (name, roll_number, user_id) VALUES ('$name', '$roll', '$user_id')");
    header("Location: index1.php");
}
?>
