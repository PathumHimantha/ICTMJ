<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ICT MJ</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;600&family=Raleway:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
  </head>

  <body class="index-page">
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center px-3 sticky-top">
      <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <h1 class="sitename">ICTMJ</h1>
        </a>

        <nav id="navmenu" class="navmenu">
<ul>
  <li><a href="index.php" class="active">Home</a></li>
  <li class="dropdown">
    <a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
    <ul class="bg-black">
      <li><a href="#tutes">Tutes</a></li>
      <li><a href="pastpaper.php">Past Papers</a></li>
      <li><a href="videopage.php">Videos</a></li>
    </ul>
  </li>
  <li><a href="index.php#about">About</a></li>
  <li><a href="index.php#contact">Contact</a></li>

  <?php if (isset($_SESSION['user_id'])): ?>
    <!-- Show only if logged in -->
    <li><a href="profile.php"><i class="bi bi-person-circle me-1"></i>Profile</a></li>
<li><a href="forms/logout.php"><i class="bi bi-box-arrow-right me-1"></i>Logout</a></li>


    <?php if ($_SESSION['user_id'] === 0): ?>
      <!-- Admin only -->
      <li><a href="admin.php"><i class="bi bi-gear-fill me-1"></i>Settings</a></li>
    <?php endif; ?>

  <?php else: ?>
    <!-- Show only if NOT logged in -->
    <li><a href="forms/login.php"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
    <li><a href="forms/register.php"><i class="bi bi-person-plus me-1"></i>Register</a></li>
  <?php endif; ?>
</ul>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>
    
    <!-- End Header -->
