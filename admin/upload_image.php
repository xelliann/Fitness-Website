<!-- upload_image.php -->
<form action="upload_image.php" method="post">
  <input type="text" name="image_url" placeholder="Google Drive image link" required>
  <input type="text" name="tags" placeholder="Tags (comma-separated)" required>
  <textarea name="description" placeholder="Description (optional)"></textarea>
  <button type="submit">Upload</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include 'includes/db.php';
  $url = $_POST['image_url'];
  $tags = $_POST['tags'];
  $desc = $_POST['description'] ?? '';

  $stmt = $conn->prepare("INSERT INTO exercise_images (image_url, tags, description) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $url, $tags, $desc);
  $stmt->execute();
  echo "Image uploaded!";
}
?>
