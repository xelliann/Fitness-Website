<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Health Planner</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h2><span class="dot"></span> Sign Up</h2>
      <?php if (isset($_SESSION['error'])): ?>
        <div class="error-box"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>
      <form action="process_register.php" method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit" class="login-btn">Register</button>
        <p class="signup-text">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
    <div class="image-section">
      <img src="../assets/images/front.png" alt="Signup" height="400" width="400">
    </div>
  </div>
</body>
</html>
