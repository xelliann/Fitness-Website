<?php
session_start();
include '../includes/db.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Access denied.";
    header('Location: ../index.php'); // or redirect to login.php
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['message'] = "Invalid user ID.";
    header('Location: users.php');
    exit();
}

$stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['message'] = "User promoted to admin.";
header('Location: users.php');
exit();
?>
