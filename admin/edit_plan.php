<?php
session_start();

include '../includes/db.php';

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $diet = $_POST['diet'] ?? '';
  $goal = $_POST['goal'] ?? '';
  $query = "UPDATE diet_plans SET diet = ?, goal = ? WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssi", $diet, $goal, $id);
  $stmt->execute();
  header("Location: plans.php");
  exit;
}

$query = "SELECT * FROM diet_plans WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$plan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Diet Plan</title>
  <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>
<div class="admin-container">
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <h1>Edit Diet Plan</h1>
    <form method="POST">
      <label>Fitness Goal:</label>
      <input type="text" name="goal" value="<?= htmlspecialchars($plan['goal']) ?>" required>
      <label>Diet Plan:</label>
      <textarea name="diet" rows="6"><?= htmlspecialchars($plan['diet']) ?></textarea>
      <button type="submit" class="btn-edit">Update</button>
    </form>
  </div>
</div>
</body>
</html>
