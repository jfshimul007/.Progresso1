<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .notification {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Mark Attendance</h2>
        <button onclick="showPopup('addStudentPopup')" class="btn btn-primary">Add Student</button>
        <button onclick="showPopup('addClassPopup')" class="btn btn-primary">Add Class</button>
        <a href="view_attendance.php"><button class="btn btn-primary">View Attendance Records</button></a>

        <form action="submit_attendance.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="classSelector">Class:</label>
                <select id="classSelector" name="class_id" class="form-control" required>
                    <?php
                    $result = $conn->query("SELECT * FROM classes");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="attendanceDate">Select Date:</label>
                <input type="date" id="attendanceDate" name="attendance_date" class="form-control" required>
            </div>

            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Student Name</th>
                        <th>Roll Number</th>
                        <th>Attendance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $students = $conn->query("SELECT * FROM students");
                    while ($student = $students->fetch_assoc()) {
                        echo "<tr>
                                <td>{$student['name']}</td>
                                <td>{$student['roll_number']}</td>
                                <td>
                                    <input type='radio' name='attendance[{$student['id']}]' value='present' required> Present
                                    <input type='radio' name='attendance[{$student['id']}]' value='absent' required> Absent
                                    <input type='radio' name='attendance[{$student['id']}]' value='late' required> Late
                                </td>
                                <td>
                                    <a href='edit_data.php?id={$student['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_data.php?id={$student['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Submit Attendance</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

        </form>
    </div>

    <script>
        function showPopup(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
</body>

</html>
