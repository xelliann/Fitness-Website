<?php
include '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    $genre = $_POST['genre'];
    $uploadDir = "../assets/uploads/$genre/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetPath = $uploadDir . $fileName;
        $relativePath = "assets/uploads/$genre/$fileName";

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $stmt = $conn->prepare("INSERT INTO exercise_images (genre, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $genre, $relativePath);
            $stmt->execute();
        }
    }

    $_SESSION['success'] = "Images uploaded successfully.";
    header('Location: upload_image.php');
    exit();
}
?>
