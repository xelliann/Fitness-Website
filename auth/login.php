<?php
include '../includes/db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');   
    exit;
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Health Planner</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="container">
    <div class="form-section-login">
      <h2><span class="dot"></span> Log In</h2>
      <p>Welcome back! Please enter your details.</p>

      <?php if ($error): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="process_login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" class="login-btn">Log in</button>

        <p class="signup-text">Don’t have an account? <a href="register.php">Sign up</a></p>
      </form>
    </div>

    <div class="image-section-login">
      <img src="../assets/images/front.png" alt="Fitness Image">
    </div>
  </div>
</body>
</html>
