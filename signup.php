<?php include('db.php'); ?> <!-- Include database connection -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Progresso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Your custom styles -->
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Create an Account</h3>
                        <form action="register.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        <p class="mt-3 text-center">
                            Already Signed Up? <a href="#" id="showLogin">Login Here</a>
                        </p>
                    </div>
                </div>

                <!-- Login Form (Initially Hidden) -->
                <div class="card shadow-lg mt-3 d-none" id="loginForm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Login</h3>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="login_email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="login_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </form>
                        <p class="mt-3 text-center">
                            <a href="forgot_password.php">Forgot Password?</a>
                        </p>
                        <p class="text-center">
                            Don't have an account? <a href="#" id="showSignup">Sign Up</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
 
    <script>
        document.getElementById("showLogin").addEventListener("click", function() {
            document.getElementById("loginForm").classList.remove("d-none");
        });

        document.getElementById("showSignup").addEventListener("click", function() {
            document.getElementById("loginForm").classList.add("d-none");
        });
    </script>

</body>
</html>
