<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST["class_id"];
    $date = $_POST["attendance_date"];

    $stmt = $conn->prepare("INSERT INTO attendance (student_id, class_id, date, status) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        foreach ($_POST["attendance"] as $student_id => $status) {
            if (!in_array($status, ['present', 'absent', 'late'])) {
                $status = 'absent'; // Default to absent if invalid
            }
            $stmt->bind_param("iiss", $student_id, $class_id, $date, $status);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "<script>alert('Attendance Submitted Successfully!'); window.location.href='index1.php';</script>";
}
?>
