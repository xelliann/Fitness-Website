<?php
include 'includes/db.php';

$search = $_GET['q'] ?? '';
$search_sql = "%" . $conn->real_escape_string($search) . "%";

$sql = "SELECT * FROM exercise_images WHERE tags LIKE ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search_sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="gallery">
  <?php while ($row = $result->fetch_assoc()): ?>
    <?php
      $file_id = htmlspecialchars($row['file_id']);
      $thumbnail_url = "https://drive.google.com/thumbnail?id=$file_id";
      $download_url = "https://drive.google.com/uc?export=download&id=$file_id";
    ?>
    <div class="gallery-item">
      <a href="<?= $download_url ?>" target="_blank">
        <img src="<?= $thumbnail_url ?>" alt="<?= htmlspecialchars($row['description']) ?>">
      </a>
      <p><?= htmlspecialchars($row['description']) ?></p>
      <a href="<?= $download_url ?>" download>Download</a>
    </div>
  <?php endwhile; ?>
</div>

