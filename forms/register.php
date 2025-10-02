<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, phone, district) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$username, $email, $password, $phone, $district])) {
        header("Location: login.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT MJ - Register</title>
    <!-- Bootstrap CSS CDN as fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN as fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Your local files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/css/main.css" rel="stylesheet" />
</head>
<body class="d-flex align-items-center log">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card form-card shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="text-white text-center mb-4">Create an Account</h2>
                        <form action="register.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label text-white">
                                    <i class="bi bi-person-fill text-danger me-2"></i>Username
                                </label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-white">
                                    <i class="bi bi-envelope-fill text-danger me-2"></i>Email
                                </label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
    <label for="phone" class="form-label text-white">
        <i class="bi bi-telephone-fill text-danger me-2"></i>Phone Number
    </label>
    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
</div>

<div class="mb-3">
    <label for="district" class="form-label text-white">
        <i class="bi bi-geo-alt-fill text-danger me-2"></i>District
    </label>
    <select id="district" name="district" class="form-control" required>
        <option value="" disabled selected>Select your district</option>
        <option value="Colombo">Colombo</option>
        <option value="Gampaha">Gampaha</option>
        <option value="Kalutara">Kalutara</option>
        <option value="Kandy">Kandy</option>
        <option value="Matale">Matale</option>
        <option value="Nuwara Eliya">Nuwara Eliya</option>
        <option value="Galle">Galle</option>
        <option value="Matara">Matara</option>
        <option value="Hambantota">Hambantota</option>
        <option value="Jaffna">Jaffna</option>
        <option value="Kilinochchi">Kilinochchi</option>
        <option value="Mannar">Mannar</option>
        <option value="Vavuniya">Vavuniya</option>
        <option value="Mullaitivu">Mullaitivu</option>
        <option value="Batticaloa">Batticaloa</option>
        <option value="Ampara">Ampara</option>
        <option value="Trincomalee">Trincomalee</option>
        <option value="Kurunegala">Kurunegala</option>
        <option value="Puttalam">Puttalam</option>
        <option value="Anuradhapura">Anuradhapura</option>
        <option value="Polonnaruwa">Polonnaruwa</option>
        <option value="Badulla">Badulla</option>
        <option value="Monaragala">Monaragala</option>
        <option value="Ratnapura">Ratnapura</option>
        <option value="Kegalle">Kegalle</option>
    </select>
</div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-white">
                                    <i class="bi bi-lock-fill text-danger me-2"></i>Password
                                </label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 fw-bold mt-3">Register</button>
                        </form>
                        <p class="text-white text-center mt-4 mb-0">
                            Already have an account? <a href="login.php" class="text-danger-link text-decoration-none fw-bold">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>