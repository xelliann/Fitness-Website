<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header('Location: register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: register.php');
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: register.php');
        exit();
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "User already exists.";
        header('Location: register.php');
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $username, $email, $hashed);

    if ($insert->execute()) {
        $_SESSION['success'] = "Registration successful!";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Try again.";
        header('Location: register.php');
        exit();
    }
}
?>
