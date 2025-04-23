<?php
session_start();

include '../includes/db.php';

// Fetch all feedback
$query = "SELECT f.id, f.message, f.created_at, u.username, u.email 
          FROM feedback f 
          JOIN users u ON f.user_id = u.id 
          ORDER BY f.created_at DESC";
$result = $conn->query($query);
$feedbacks = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Feedback</title>
  <link rel="stylesheet" href="../assets/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="admin-container">
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <h1>User Feedback</h1>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($feedbacks as $fb): ?>
            <tr>
              <td><?= $fb['id'] ?></td>
              <td><?= htmlspecialchars($fb['username']) ?></td>
              <td><?= htmlspecialchars($fb['email']) ?></td>
              <td><?= nl2br(htmlspecialchars($fb['message'])) ?></td>
              <td><?= date('d M Y, h:i A', strtotime($fb['created_at'])) ?></td>
              <td>
                <a href="delete_feedback.php?id=<?= $fb['id'] ?>" class="btn-delete" onclick="return confirm('Delete this feedback?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <script src="../assets/script.js"></script>

  </div>
</div>
</body>
</html>
