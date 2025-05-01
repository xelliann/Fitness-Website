<?php
session_start();
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['message'] = "Invalid user ID.";
    header('Location: users.php');
    exit();
}

// Prevent self-deletion (optional)
if ($_SESSION['user_id'] == $id) {
    $_SESSION['message'] = "You cannot delete your own account.";
    header('Location: users.php');
    exit();
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['message'] = "User deleted successfully.";
header('Location: users.php');
exit();
?>
