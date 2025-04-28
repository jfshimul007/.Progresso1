<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <!-- Button positioned top-right -->
        <div class="d-flex justify-content-end mb-4">
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <h2 class="mb-4">Attendance Records</h2>
     
        
        <!-- <table class="table table-bordered">
        <h2 class="mb-4">Attendance Records</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a> -->
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Student Name</th>
                    <th>Roll Number</th>
                    <th>Status</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("
                    SELECT a.id AS attendance_id, a.date, c.name AS class_name, s.name AS student_name, s.roll_number, a.status 
                    FROM attendance a
                    JOIN students s ON a.student_id = s.id
                    JOIN classes c ON a.class_id = c.id
                    ORDER BY a.date DESC
                ");
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['date']}</td>
                            <td>{$row['class_name']}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['roll_number']}</td>
                            <td class='text-uppercase font-weight-bold' style='color: " . getStatusColor($row['status']) . "'>" . ucfirst($row['status']) . "</td>
                            <td>
                                <a href='edit_attendance.php?id={$row['attendance_id']}' class='btn btn-warning btn-sm'>Edit</a> 
                                <a href='delete_attendance.php?id={$row['attendance_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No attendance records found</td></tr>";
                }

                function getStatusColor($status) {
                    switch ($status) {
                        case 'present':
                            return 'green';
                        case 'absent':
                            return 'red';
                        case 'late':
                            return 'orange';
                        default:
                            return 'black';
                    }
                }
                ?>
            </tbody>
        </table>
        
    </div>
    <?php include 'footer.php';?>

</body>
</html>
