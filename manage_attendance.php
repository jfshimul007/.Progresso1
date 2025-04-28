<?php
include 'db.php'; // include database connection

// Fetch all students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Get the current month and year
$year = date("Y");
$month = date("m");
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Function to get attendance status
function getAttendance($conn, $student_id, $date) {
    $sql = "SELECT status FROM attendance WHERE student_id = '$student_id' AND date = '$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['status'];
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .attendance-checkbox { width: 20px; height: 20px; }
    .present { background-color: #28a745; color: white; }
    .absent { background-color: #dc3545; color: white; }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>Student Attendance</h2>

    <!-- Add New Student Form -->
    <!-- <form action="insert_student.php" method="POST" class="mb-3">
      <div class="input-group">
        <input type="text" name="name" class="form-control" placeholder="Student Name" required>
        <input type="text" name="id" class="form-control" placeholder="Student ID" required>
        <button type="submit" class="btn btn-success">Add Student</button>
      </div>
    </form> -->
    <form action="insert_student.php" method="POST">
  <input type="text" name="id" placeholder="Enter Student ID" required>
  <input type="text" name="name" placeholder="Enter Student Name" required>
  <button type="submit">Add Student</button>
</form>


    <form action="update_attendance.php" method="POST">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Student ID</th>
            <?php
            for ($i = 1; $i <= $daysInMonth; $i++) {
              echo "<th>$i</th>";
            }
            ?>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($student = $result->fetch_assoc()) { ?>
            <tr>
              <td>
                <input type="text" name="name[<?= $student['id'] ?>]" value="<?= $student['name'] ?>" class="form-control">
              </td>
              <td>
                <input type="text" name="id[<?= $student['id'] ?>]" value="<?= $student['id'] ?>" class="form-control">
              </td>
              <?php
              for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = "$year-$month-$i";
                $status = getAttendance($conn, $student['id'], $date);
                $checked = $status == 'present' ? "checked" : "";
                echo "<td><input type='checkbox' class='attendance-checkbox' name='attendance[" . $student['id'] . "][$date]' $checked></td>";
              }
              ?>
              <td>
                <button type="submit" formaction="update_student.php?id=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Edit</button>
                <button type="submit" formaction="delete_student.php?id=<?= $student['id'] ?>" class="btn btn-danger btn-sm">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Update Attendance</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
