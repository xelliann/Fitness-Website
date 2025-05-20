<?php
session_start();

include '../includes/db.php';

// Fetch all users
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
$stmt = $conn->prepare($query);
$searchParam = "%$search%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

// Count users
$countQuery = "SELECT COUNT(*) AS total FROM users";
$countResult = $conn->query($countQuery);
$totalUsers = $countResult->fetch_assoc()['total'];
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

</head>
<body>
  <!-- Sidebar -->
  <?php include 'sidebar.php'; ?>
  
  <!-- Main Content -->
  <div class="mohit">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="success-message">
        <?= $_SESSION['message']; unset($_SESSION['message']); ?>
      </div>
      <?php endif; ?>
      
      <div class="ex">
      <div class="header">
        <h1>Manage Users</h1>
        <p>Total Users: <strong><?= $totalUsers ?></strong></p>
      </div>

      <!-- Search Form -->
      <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($search) ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>

      <!-- Users Table -->
            <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['role'] === 'admin' ? 'Admin' : 'User' ?></td>
                        <td><?= date('d M Y', strtotime($user['created_at'] ?? '')) ?></td>
                        <td>
                        <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn-delete" onclick="return confirm('Delete this user?');" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        <?php if ($user['role'] !== 'admin'): ?>
                            <a href="make_admin.php?id=<?= $user['id'] ?>" class="btn-promote" onclick="return confirm('Make this user an admin?');" title="Promote to Admin">
                            <i class="fas fa-user-shield"></i>
                            </a>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No users found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
            </div>

    </div>
  </div>
  <script src="../assets/script.js"></script>

</body>
</html>
