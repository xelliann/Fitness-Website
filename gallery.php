<?php
include 'includes/db.php';

$search = $_GET['q'] ?? '';
$search_sql = "%" . $conn->real_escape_string($search) . "%";
$genre = isset($_GET['genre']) ? strtolower(trim($_GET['genre'])) : '';

$sql = "SELECT * FROM exercise_images";
$params = [];

if ($genre) {
    $sql .= " WHERE LOWER(genre) LIKE ?";
    $genreParam = "%$genre%";
    $params[] = $genreParam;
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param("s", ...$params);
}
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

