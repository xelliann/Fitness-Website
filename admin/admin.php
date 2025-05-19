<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Health Planner</title>
  <link rel="stylesheet" href="../assets/admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="admin-container">
    <aside class="sidebar">
      <h2 class="logo">Health<span>Admin</span></h2>
      <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">Plans</a></li>
        <li><a href="#">Feedback</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
      </ul>
    </aside>

    <main class="main-content">
      <h1>Welcome to Admin Dashboard</h1>
      <p>This is your control panel where you can manage everything.</p>

      <!-- Example Stats -->
      <div class="cards">
        <div class="card">
          <h3>Total Users</h3>
          <p>123</p>
        </div>
        <div class="card">
          <h3>Plans Created</h3>
          <p>45</p>
        </div>
        <div class="card">
          <h3>Feedback</h3>
          <p>19</p>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
