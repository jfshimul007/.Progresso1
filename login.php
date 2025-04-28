<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['login_email']);
    $password = mysqli_real_escape_string($conn, $_POST['login_password']);

    // Check if user exists
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            echo "<script>alert('Login Successful!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect Password!'); window.location.href='signup.php';</script>";
        }
    } else {
        echo "<script>alert('User not found! Please register.'); window.location.href='signup.php';</script>";
    }
}

mysqli_close($conn);
?>
