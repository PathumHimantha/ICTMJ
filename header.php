<?php
session_start();

// Determine current page
$current_page = basename($_SERVER['PHP_SELF']);
$is_admin_page = in_array($current_page, ['manage_students.php', 'settings.php', 'profile.php']);

// Safe session check
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = ($is_logged_in && $_SESSION['user_id'] === 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>ICT MJ</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />

  <!-- Vendor CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />

  <!-- Main CSS -->
  <link href="assets/css/main.css" rel="stylesheet" />
</head>

<body class="index-page">

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center px-3 sticky-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="index.php" class="logo d-flex align-items-center">
      <h1 class="sitename">ICTMJ</h1>
    </a>

    <!-- Navigation -->
    <nav id="navmenu" class="navmenu">
      <ul>

        <!-- Home -->
        <li>
          <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
            Home
          </a>
        </li>

        <!-- Resources -->
        <li class="dropdown">
          <a href="#">
            <span>Resources</span>
            <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul class="bg-black">
            <li><a href="tute.php">Tute</a></li>
            <li><a href="pastpaper.php">Past Papers</a></li>
            <li><a href="videopage.php">Videos</a></li>
          </ul>
        </li>

        <!-- Hide About/Contact on admin pages -->
        <?php if (!$is_admin_page): ?>
          <li><a href="index.php#about">About</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        <?php endif; ?>


        <!-- ===== Authentication Section ===== -->
        <?php if ($is_logged_in): ?>

          <!-- Logged in users -->
          <li>
            <a href="profile.php">
              <i class="bi bi-person-circle me-1"></i>Profile
            </a>
          </li>

          <li>
            <a href="forms/logout.php">
              <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
          </li>

          <!-- Admin only -->
          <?php if ($is_admin): ?>
            <li>
              <a href="settings.php">
                <i class="bi bi-gear-fill me-1"></i>Settings
              </a>
            </li>
          <?php endif; ?>

        <?php else: ?>

          <!-- Guest users -->
          <li>
            <a href="forms/login.php">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </li>

          <li>
            <a href="forms/register.php">
              <i class="bi bi-person-plus me-1"></i>Register
            </a>
          </li>

        <?php endif; ?>

      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>
<!-- End Header -->
