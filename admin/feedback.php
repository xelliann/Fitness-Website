<?php
include '../includes/db.php';
// Fetch feedbacks from SQL
$sql = "SELECT f.message, f.created_at, u.username 
        FROM feedback f
        JOIN users u ON f.user_id = u.id
        ORDER BY f.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Users</title>
  <title>Daily Meal Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="<?= ROOT_URL ?>assets/dashboard.css" />
  <!-- Google Fonts: Montserrat & Rubik -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet"> 
<style>
.feedback-section {
  margin-top: -580px;
  padding: 2rem;
  max-width: 1000px;
    margin-left: 256px;
}

.feedback-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.feedback-header h2 {
  font-size: 2rem;
  color: #9b5de5;
}

.feedback-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.feedback-box {
  background-color: #f1eaff;
  padding: 1.5rem;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transition: 0.3s ease;
}

.feedback-box:hover {
  transform: translateY(-4px);
}

.feedback-box .message {
  font-style: italic;
  font-size: 1rem;
  margin-bottom: 0.8rem;
}

.feedback-box .meta {
  font-size: 0.85rem;
  color: #555;
}

.btn {
  background: #9b5de5;
  color: white;
  padding: 0.5rem 1.2rem;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  transition: 0.3s ease;
}

.btn:hover {
  background: #7c3aed;
}

</style>
</head>
<body>
    
<?php include 'sidebar.php'; ?>
  <div class="feedback-section">
    <div class="feedback-header">
      <h2>User Feedback</h2>
      <a href="<?= ROOT_URL ?>feedback.php"" class="btn">+ Add Review</a>
    </div>

    <div class="feedback-container">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="feedback-box">
            <p class="message">“<?= htmlspecialchars($row['message']) ?>”</p>
            <p class="meta">– <?= htmlspecialchars($row['username']) ?> | <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No feedback yet. Be the first to add one!</p>
      <?php endif; ?>
    </div>
    </div>
</div>
</body>
