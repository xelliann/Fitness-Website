<?php
session_start();

include '../includes/db.php';

// Fetch all diet plans with user info
$query = "SELECT diet_plans.*, users.username, users.email 
          FROM diet_plans 
          JOIN users ON diet_plans.user_id = users.id 
          ORDER BY diet_plans.created_at DESC";
$result = $conn->query($query);
$dietPlans = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Diet Plans</title>
  <link rel="stylesheet" href="../assets/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="admin-container">
  <?php include 'sidebar.php'; ?>

  <div class="main-content">
    <div class="header">
      <h1>Diet Plans</h1>
    </div>

    <div class="table-container">
      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Goal</th>
          <th>Diet Type</th>
          <th>Meals</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($dietPlans) > 0): ?>
          <?php foreach ($dietPlans as $plan): ?>
            <tr>
              <td><?= $plan['id'] ?></td>
              <td><?= htmlspecialchars($plan['username']) ?> <br><small><?= $plan['email'] ?></small></td>
              <td><?= htmlspecialchars($plan['goal']) ?></td>
              <td><?= htmlspecialchars($plan['diet_type']) ?></td>
              <td><?= htmlspecialchars($plan['meals']) ?></td>
              <td><?= date('d M Y', strtotime($plan['created_at'])) ?></td>
              <td>
                <a href="edit_diet_plan.php?id=<?= $plan['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
                <a href="delete_diet_plan.php?id=<?= $plan['id'] ?>" class="btn-delete" onclick="return confirm('Delete this plan?');"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="7">No diet plans found.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="../assets/script.js"></script>
</body>
</html>
