<?php
require 'db.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $delete_query = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $student_id);
    
    if ($stmt->execute()) {
        header("Location:index1.php?msg=Student deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
