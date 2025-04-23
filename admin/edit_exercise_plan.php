<?php
session_start();

include '../includes/db.php';

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $exercise = $_POST['exercise'] ?? '';
  $goal = $_POST['goal'] ?? '';
  $query = "UPDATE exercise_plans SET exercise = ?, goal = ? WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssi", $exercise, $goal, $id);
  $stmt->execute();
  header("Location: exercise_plans.php");
  exit;
}

$query = "SELECT * FROM exercise_plans WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$plan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Exercise Plan</title>
  <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>
<div class="admin-container">
  <?php include 'sidebar.php'; ?>
  <div class="main-content">
    <h1>Edit Exercise Plan</h1>
    <form method="POST">
      <label>Fitness Goal:</label>
      <input type="text" name="goal" value="<?= htmlspecialchars($plan['goal']) ?>" required>
      <label>Exercise Plan:</label>
      <textarea name="exercise" rows="6"><?= htmlspecialchars($plan['exercise']) ?></textarea>
      <button type="submit" class="btn-edit">Update</button>
    </form>
  </div>
</div>
</body>
</html>
