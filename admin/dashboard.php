<?php
session_start();
include '../includes/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Get counts
$userCount = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$planCount = $conn->query("SELECT COUNT(*) FROM plans")->fetch_row()[0];
$feedbackCount = $conn->query("SELECT COUNT(*) FROM feedback")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <main class="dashboard-content">
    <h1>Dashboard</h1>
    <div class="cards">
      <div class="card fade-in">
        <i class="fas fa-users card-icon"></i>
        <h3>Total Users</h3>
        <p><?= $userCount ?></p>
      </div>

      <div class="card fade-in" style="animation-delay: 0.2s;">
        <i class="fas fa-dumbbell card-icon"></i>
        <h3>Active Plans</h3>
        <p><?= $planCount ?></p>
      </div>

      <div class="card fade-in" style="animation-delay: 0.4s;">
        <i class="fas fa-comment-dots card-icon"></i>
        <h3>Feedbacks</h3>
        <p><?= $feedbackCount ?></p>
      </div>
    </div>
  </main>
  <script src="../assets/script.js"></script>
</body>
</html>

