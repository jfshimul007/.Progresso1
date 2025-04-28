<?php include 'header.php';?>

<?php
session_start();
include('db.php');

// Fetch students and courses
global $conn;
$students = mysqli_query($conn, "SELECT id, name, roll_number FROM students");
$courses = mysqli_query($conn, "SELECT * FROM courses");
$grades = mysqli_query($conn, "SELECT grades.*, students.name, students.roll_number, courses.course_name 
                              FROM grades 
                              INNER JOIN students ON grades.student_id = students.id 
                              INNER JOIN courses ON grades.course_id = courses.id");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_grade'])) {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $ct1 = $_POST['ct_01'];
    $ct2 = $_POST['ct_02'];
    $mid = $_POST['mid_term'];
    $assignment = $_POST['assignment'];
    $attendance = $_POST['attendance'];
    $final = $_POST['final_exam'];

    // Calculate CGPA (Assuming the total is out of 400 and CGPA is scaled to 4.0)
    $total_marks = $ct1 + $ct2 + $mid + $assignment + $attendance + $final;
    $cgpa = ($total_marks / 100) * 4;


    // Insert grades into database
    $sql = "INSERT INTO grades (student_id, course_id, ct_01, ct_02, mid_term, assignment, attendance, final_exam, cgpa) 
            VALUES ('$student_id', '$course_id', '$ct1', '$ct2', '$mid', '$assignment', '$attendance', '$final', '$cgpa')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_grades.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM grades WHERE id='$delete_id'");
    header("Location: manage_grades.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Grades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="container mt-4">

<h3>Manage Grades</h3>

<form action="" method="POST" class="mb-4">
    <select name="student_id" class="form-control mb-2" required>
        <option value="">Select Student</option>
        <?php while ($row = mysqli_fetch_assoc($students)) { ?>
            <option value="<?= $row['id'] ?>">
                <?= $row['roll_number'] ?> - <?= $row['name'] ?>
            </option>
        <?php } ?>
    </select>
    
    <select name="course_id" class="form-control mb-2" required>
        <option value="">Select Course</option>
        <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
            <option value="<?= $row['id'] ?>">
                <?= $row['course_name'] ?>
            </option>
        <?php } ?>
    </select>
    
    <input type="number" step="0.1" name="ct_01" placeholder="CT-01 Marks" class="form-control mb-2" required>
    <input type="number" step="0.1" name="ct_02" placeholder="CT-02 Marks" class="form-control mb-2" required>
    <input type="number" step="0.1" name="mid_term" placeholder="Midterm Marks" class="form-control mb-2" required>
    <input type="number" step="0.1" name="assignment" placeholder="Assignment Marks" class="form-control mb-2" required>
    <input type="number" step="0.1" name="attendance" placeholder="Attendance Marks" class="form-control mb-2" required>
    <input type="number" step="0.1" name="final_exam" placeholder="Final Exam Marks" class="form-control mb-2" required>
    <button type="submit" name="add_grade" class="btn btn-primary">Add Grade</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Roll Number</th>
            <th>Course Name</th>
            <th>CT-01</th>
            <th>CT-02</th>
            <th>Midterm</th>
            <th>Assignment</th>
            <th>Attendance</th>
            <th>Final Exam</th>
            <th>CGPA</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($grades)) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['roll_number'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><?= $row['ct_01'] ?></td>
            <td><?= $row['ct_02'] ?></td>
            <td><?= $row['mid_term'] ?></td>
            <td><?= $row['assignment'] ?></td>
            <td><?= $row['attendance'] ?></td>
            <td><?= $row['final_exam'] ?></td>
            <td><?= number_format($row['cgpa'], 2) ?></td>
            <td>
                <a href="edit_grade.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="manage_grades.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
<br>
<br>
<br>
<?php include 'footer.php';?>
</body>
</html>
