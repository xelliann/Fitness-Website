<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/dashboard.css" />
    <!-- Google Fonts: Montserrat & Rubik -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet"> 
</head>
<body>

<?php include 'sidebar.php'; ?>
    
<div class="ex">
  <div class="profile-container">
    <h1>👤 Profile Page</h1>

    <div class="profile-card">
      <div class="card-title">User Details</div>
      <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Role:</strong> <span class="badge"><?= ucfirst($user['role']) ?></span></p>
    </div>

    <div class="profile-card">
      <div class="card-title">Your Plans</div>
      <p><i class="fas fa-utensils"></i> <a href="<?= ROOT_URL ?>view_diet_plan.php" class="badge">View Diet Plan</a></p>
      <p><i class="fas fa-dumbbell"></i> <a href="<?= ROOT_URL ?>view_exercise_plan.php" class="badge">View Exercise Plan</a></p>
    </div>

    <div class="profile-card">
      <div class="card-title">Quick Links</div>
      <div class="quick-links">
        <a href="<?= ROOT_URL ?>feedback.php"><i class="fas fa-comment-dots"></i> Feedback</a><br><br>
        <a href="<?= ROOT_URL ?>auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
