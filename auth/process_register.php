<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Basic field check
    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header('Location: register.php');
        exit();
    }

    // Email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: register.php');
        exit();
    }

    // Password strength validation
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $special   = preg_match('@[^\w]@', $password);
    $length    = strlen($password) >= 8;

    if (!$uppercase || !$lowercase || !$number || !$special || !$length) {
        $_SESSION['error'] = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
        header('Location: register.php');
        exit();
    }

    // Password match
    if ($password !== $confirm) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: register.php');
        exit();
    }

    // Check for existing user
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "User already exists.";
        header('Location: register.php');
        exit();
    }

    // Register new user
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
