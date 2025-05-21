<?php
session_start();
include '../includes/db.php';

$success = $error = '';
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
<style>
    .upload-container {
              padding: 30px;
              max-width: 600px;
              margin: 40px auto;
              border-radius: 16px;
          }

          h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
          }

          .form-group {
              margin-bottom: 18px;
          }

          label {
              font-weight: 600;
              display: block;
              margin-bottom: 6px;
              
          }

          input[type="text"],
          input[type="file"] {
              width: 100%;
              padding: 10px 12px;
              border-radius: 8px;
              border: 1px solid #ccc;
              font-size: 16px;
          }

          button {
              background: #9b5de5;
              color: white;
              padding: 10px 16px;
              border: none;
              border-radius: 8px;
              font-size: 16px;
              cursor: pointer;
              transition: 0.3s;
          }

          button:hover {
              background: #7a3dd3;
          }

          .alert {
              margin-top: 15px;
              padding: 10px;
              border-radius: 6px;
              font-weight: bold;
          }

          .success {
              background: #d1ffd6;
              color: #2e7d32;
          }

          .error {
              background: #ffd6d6;
              color: #c62828;
          }
</style>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  
  <div class="ex">
    <div class="mohit">
      <h2><i class="fas fa-upload"></i> Upload New Image</h2>
        <div class="upload-container">

            <?php if ($success): ?>
                <div class="alert success"><?= $success ?></div>
            <?php elseif ($error): ?>
                <div class="alert error"><?= $error ?></div>
            <?php endif; ?>

        <form action="process_upload.php" method="POST" enctype="multipart/form-data">
                <label for="images">Select Images:</label>
            <input type="file" name="images[]" multiple required>

            <br>
            <br>
            <label for="genre">Select Genre:</label>
            <select name="genre" required>
                <option value="cardio">Cardio</option>
                <option value="strength">Strength</option>
                <option value="abs">Abs</option>
                <option value="Wellness">Wellness</option>
                <option value="Yoga">Yoga</option>
                <option value="Stretching">Stretching</option>
            </select>
<br>
<br>
<br>
            <button type="submit" class="btn">Upload</button>
        </form>
        </div>
    </div>
</div>
</body>
</html>