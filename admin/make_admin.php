<?php
session_start();

include '../includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = intval($_GET['id']);
$update = $conn->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
$update->bind_param("i", $id);
$update->execute();

$_SESSION['message'] = "User promoted to admin.";
header("Location: users.php");
exit;
?>
