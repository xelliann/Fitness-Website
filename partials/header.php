<?php
session_start();
include 'includes/db.php'; 

$user_id = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? '';

if (!$user_id) {
  header('Location: auth/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daily Meal Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="<?= ROOT_URL ?>assets/dashboard.css" />
  <!-- Google Fonts: Montserrat & Rubik -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet"> 

</head> 
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <?php
$current_page = basename($_SERVER['PHP_SELF']); // e.g., "exercise_plans.php"
?>

<aside class="sidebar">
  <div class="logo">
    <img src="<?= ROOT_URL ?>assets/images/logo1.jpg" height="100px" width="100px">
  </div>
  <div class="nav">
    <div class="<?= $current_page === 'index.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>index.php"><span class="material-symbols-outlined">grid_view</span>Dashboard</a>
    </div>

    <div class="<?= $current_page === 'exercise_plans.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>exercise_plans.php"><span class="material-symbols-outlined">exercise</span>Exercise Plans</a>
    </div>

    <div class="<?= $current_page === 'diet_plans.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>diet_plans.php"><span class="material-symbols-outlined">assignment</span> Diet Plans</a>
    </div>

    <div class="<?= $current_page === 'calorie_input.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>calorie_input.php"><span class="material-symbols-outlined">cycle</span> Calorie Counter</a>
    </div>

    <div class="<?= $current_page === 'bmi_input.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>bmi_input.php"><span class="material-symbols-outlined">body_fat</span>BMI</a>
    </div>
  </div>
</aside>


  <!-- Main Content -->
  <main class="main-content">
    <!-- Topbar -->
    <div class="nav1">
      <div class="nav-search">
        <form action="search_engine.php" method="get" class="search-form">
          <input type="text" name="genre" class="search-bar" placeholder="Search workouts (e.g. cardio, strength, abs)" required>
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>


      <nav class="top-nav">
        <a href="feedback.php">Feedback</a>
        <a href="contact_us.php">Contact Us</a>
        <a href="about_us.php">About Us</a>
        <a href="help.php">Help</a>

        <?php if ($user_id): ?>
          <div class="user-menu" onclick="toggleUserMenu()">
          <span><?= htmlspecialchars($username) ?> 
          <i class="fas fa-caret-down"></i></span>
            <ul class="dropdown" id="userDropdown">
              <li><a href="<?= ROOT_URL ?>admin/profile.php"><i class="fas fa-user"></i> Settings</a></li>
              <li><a href="<?= ROOT_URL ?>auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
          </div>

        <?php else: ?>
          <a href="<?=ROOT_URL?>auth/login.php" class="login-link">Login</a>
        <?php endif; ?>
      </nav>
    </div>
<hr>

  </main>
<script>
  function toggleUserMenu() {
  const dropdown = document.getElementById('userDropdown');
  dropdown.classList.toggle('show');
}
</script>