<?php
require 'db.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];

    $update_query = "UPDATE students SET name = ?, roll_number = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $name, $roll_number, $student_id);
    
    if ($stmt->execute()) {
        header("Location: index1.php?msg=Student updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Edit Student</h2>
    <form method="POST">
        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
        
        <div class="form-group">
            <label>Student Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Roll Number:</label>
            <input type="text" name="roll_number" class="form-control" value="<?php echo $student['roll_number']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index1.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
