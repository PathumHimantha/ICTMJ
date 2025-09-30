<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php"); // Create this page
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT MJ - Login</title>
    <!-- Bootstrap CSS CDN as fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN as fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Your local files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/css/main.css" rel="stylesheet" />
</head>
<body class="d-flex align-items-center bg-dark log">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card form-card shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-white text-center mb-4">Welcome Back</h2>
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label text-white">
                                    <i class="bi bi-envelope-fill text-danger me-2"></i>Email
                                </label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-white">
                                    <i class="bi bi-lock-fill text-danger me-2"></i>Password
                                </label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-white" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 fw-bold mt-3">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="#" class="text-danger-link text-decoration-none">Forgot password?</a>
                        </div>
                        <p class="text-white text-center mt-4 mb-0">
                            Don't have an account? <a href="register.php" class="text-danger-link text-decoration-none fw-bold">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>