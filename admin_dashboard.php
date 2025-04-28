<?php include 'header.php'; ?>
<?php 
session_start();
include('db.php');

// Check if the admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Progresso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>

<div class="container mt-4">
<h2 class="text-center custom-color">Admin Dashboard - .Progresso</h2>

    <!-- Attendance Section -->
    <div class="card shadow-sm">
        <div class="card-header">Attendance Management</div>
        <div class="card-body">
            <a href="index1.php" class="btn btn-outline-blue btn-lg">Manage Attendance</a>
        </div>
    </div>

    <!-- Grades Section -->
    <div class="card shadow-sm">
        <div class="card-header">Grades Management</div>
        <div class="card-body">
            <a href="manage_grades.php" class="btn btn-outline-blue btn-lg">Manage Grades</a>
        </div>
    </div>

   

    <!-- Logout -->
    <div class="logout-btn-container">
        <a href="logout.php" class="btn logout-btn btn-lg">Logout</a>
    </div>
</div>
<br>
<br>
<br>
<?php include 'footer.php'; ?>
</body>
</html>
