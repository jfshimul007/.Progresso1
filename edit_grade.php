<?php
session_start();
include('db.php');

// Check if ID is set
if (!isset($_GET['id'])) {
    header("Location: manage_grades.php");
    exit();
}

$grade_id = $_GET['id'];

// Fetch grade details with student name and roll number
$query = "SELECT grades.*, students.name AS student_name, students.roll_number, courses.course_name 
          FROM grades 
          JOIN students ON grades.student_id = students.id 
          JOIN courses ON grades.course_id = courses.id 
          WHERE grades.id = '$grade_id'";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Invalid Grade ID");
}

$grade = mysqli_fetch_assoc($result);

// Update grades
if (isset($_POST['update_grade'])) {
    $ct1 = $_POST['ct_01'];
    $ct2 = $_POST['ct_02'];
    $mid = $_POST['mid_term'];
    $assignment = $_POST['assignment'];
    $attendance = $_POST['attendance'];
    $final_exam = $_POST['final_exam'];
    $total = $ct1 + $ct2 + $mid + $assignment + $attendance + $final_exam;
    $cgpa = ($total / 100) * 4;

    $update_sql = "UPDATE grades SET ct_01='$ct1', ct_02='$ct2', mid_term='$mid', assignment='$assignment', attendance='$attendance', final_exam='$final_exam', cgpa='$cgpa' WHERE id='$grade_id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: manage_grades.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Grade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h3>Edit Grade</h3>

<form action="" method="POST" class="mb-4">
    <input type="hidden" name="grade_id" value="<?= $grade['id'] ?>">
    
    <div class="mb-3">
        <label>Student Name: <strong><?= isset($grade['student_name']) ? $grade['student_name'] : 'N/A' ?></strong> (Roll: <strong><?= isset($grade['roll_number']) ? $grade['roll_number'] : 'N/A' ?></strong>)</label>
    </div>

    <div class="mb-3">
        <label>Course Name: <strong><?= isset($grade['course_id']) ? $grade['course_name'] : 'N/A' ?></strong></label>
    </div>

    <div class="mb-3">
        <label>CT-01:</label>
        <input type="number" step="0.1" name="ct_01" class="form-control" value="<?= isset($grade['ct_01']) ? $grade['ct_01'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>CT-02:</label>
        <input type="number" step="0.1" name="ct_02" class="form-control" value="<?= isset($grade['ct_02']) ? $grade['ct_02'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Midterm:</label>
        <input type="number" step="0.1" name="mid_term" class="form-control" value="<?= isset($grade['mid_term']) ? $grade['mid_term'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Assignment:</label>
        <input type="number" step="0.1" name="assignment" class="form-control" value="<?= isset($grade['assignment']) ? $grade['assignment'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Attendance:</label>
        <input type="number" step="0.1" name="attendance" class="form-control" value="<?= isset($grade['attendance']) ? $grade['attendance'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Final Exam:</label>
        <input type="number" step="0.1" name="final_exam" class="form-control" value="<?= isset($grade['final_exam']) ? $grade['final_exam'] : '' ?>" required>
    </div>

    <button type="submit" name="update_grade" class="btn btn-primary mt-3">Update Grade</button>
    <a href="manage_grades.php" class="btn btn-secondary mt-3">Cancel</a>
</form>

</body>
</html>
