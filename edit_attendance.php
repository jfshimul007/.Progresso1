<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM attendance WHERE id = '$id'");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $conn->query("UPDATE attendance SET status = '$status' WHERE id = '$id'");
    header("Location: view_attendance.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .btn-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h2 class="mb-4">Edit Attendance</h2>
        
        <form method="POST">
            <div class="form-group">
                <label for="status"><strong>Status:</strong></label>
                <select name="status" class="form-control" id="status">
                    <option value="present" <?php if ($row['status'] == 'present') echo 'selected'; ?>>Present</option>
                    <option value="absent" <?php if ($row['status'] == 'absent') echo 'selected'; ?>>Absent</option>
                    <option value="late" <?php if ($row['status'] == 'late') echo 'selected'; ?>>Late</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="view_attendance.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
