<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM attendance WHERE id = '$id'");
}

header("Location: view_attendance.php");
exit();
?>
