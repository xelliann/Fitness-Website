<?php

include 'partials/header.php';
$genre = isset($_GET['genre']) ? strtolower(trim($_GET['genre'])) : '';
$imageFolder = "assets/uploads/" . $genre;

// Validate folder
if (!in_array($genre, ['cardio', 'strength', 'abs', 'stretching', 'wellness']) || !is_dir($imageFolder)) {
    echo "<h2 style='text-align:center; padding:2rem;'>No matching category found for '$genre'.</h2>";
    include 'partials/footer.php';
    exit;
}


// Get image files
$images = array_diff(scandir($imageFolder), ['.', '..']);
?>
<style>
  .gallery-header {
  text-align: center;
  margin-top: 2rem;
  color: #6a00f4;
}

.custom-gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 2rem;
  padding: 2rem;
  max-width: 1200px;
  margin-top: 500px;
}

.custom-gallery-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: transform 0.3s ease;
}

.custom-gallery-card:hover {
  transform: translateY(-5px);
}

.custom-gallery-card img {
  width: 100%;
  height: auto;
  display: block;
}

.custom-caption {
  padding: 1rem;
  text-align: center;
}

.custom-caption p {
  font-size: 14px;
  color: #444;
  margin-bottom: 10px;
}

.download-btn {
  background: #9b5de5;
  color: white;
  padding: 6px 12px;
  font-size: 14px;
  border-radius: 8px;
  text-decoration: none;
}

.download-btn:hover {
  background: #7c3aed;
}

</style>
<main class="main-content">
  <div class="gallery-header">
    <h2><?= ucfirst($genre) ?> Workout Gallery</h2>
  </div>

  <div class="custom-gallery-grid">
    <?php foreach ($images as $image): ?>
      <?php $imagePath = "$imageFolder/$image"; ?>
      <div class="custom-gallery-card">
        <img src="<?= $imagePath ?>" alt="Workout Image">
        <div class="custom-caption">
          <a href="<?= $imagePath ?>" download class="download-btn">Download</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
</div>

<?php include 'partials/footer.php'; ?>
