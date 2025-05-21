<?php
$current_page = basename($_SERVER['PHP_SELF']); // e.g., "users.php"

// Define if admin
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<div class="wrapper">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <img src="<?= ROOT_URL ?>assets/images/logo1.jpg" height="100px" width="100px">
    </div>

    <div class="nav">
      <div class="<?= $current_page === 'profile.php' ? 'active' : '' ?>">
        <a href="<?= ROOT_URL ?>/admin/profile.php"><span class="material-symbols-outlined">grid_view</span>Profile</a>
      </div>
    <div class="<?= $current_page === 'index.php' ? 'active' : '' ?>">
      <a href="<?= ROOT_URL ?>index.php"><span class="material-symbols-outlined">grid_view</span>Dashboard</a>
    </div>
      <?php if ($is_admin): ?>
      <div class="<?= $current_page === 'users.php' ? 'active' : '' ?>">
        <a href="<?= ROOT_URL ?>admin/users.php"><i class="fas fa-users"></i>Users</a>
      </div>
      <?php endif; ?>

      <div class="<?= $current_page === 'feedback.php' ? 'active' : '' ?>">
        <a href="<?= ROOT_URL ?>admin/feedback.php"><i class="fas fa-comment-alt"></i> Feedback</a>
      </div>

      <div class="<?= $current_page === 'upload_image.php' ? 'active' : '' ?>">
        <a href="<?= ROOT_URL ?>admin/upload_image.php"><span class="material-symbols-outlined">upload_file</span>Upload image</a>
      </div>

      <div class="<?= $current_page === 'logout.php' ? 'active' : '' ?>">
        <a href="<?= ROOT_URL ?>auth/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </div>
  </aside>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;
    const sidebar = document.querySelector(".sidebar");
    const toggleBtn = document.getElementById("toggleSidebarBtn");
    const darkToggle = document.getElementById("darkModeToggle");

    // Sidebar collapse
    toggleBtn?.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
      document.querySelector('.main-content')?.classList.toggle("collapsed");
    });

    // Dark mode toggle
    darkToggle?.addEventListener("change", () => {
      body.classList.toggle("dark");
    });
  });
  </script>
</div>
