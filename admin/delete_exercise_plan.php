<?php
session_start();

include '../includes/db.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM exercise_plans WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: exercise_plans.php");
exit;
?>
