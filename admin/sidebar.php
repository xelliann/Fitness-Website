<div class="sidebar">
  <div class="sidebar-header">
    <h2 style="margin: 0;"><span class="sidebar-title">Admin</span></h2>
    <button class="toggle-btn" id="toggleSidebarBtn" title="Collapse Sidebar">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <ul class="sidebar-links">
    <li>
      <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
    </li>
    <li>
      <a href="users.php"><i class="fas fa-users"></i><span>Users</span></a>
    </li>
    <li><a href="diet_plans.php"><i class="fas fa-utensils"></i> <span>Diet Plans</span></a></li>
<li><a href="exercise_plans.php"><i class="fas fa-dumbbell"></i> <span>Exercise Plans</span></a></li>
    <li>
      <a href="feedback.php"><i class="fas fa-comment-alt"></i><span>Feedback</span></a>
    </li>
    <li>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </li>
  </ul>

  <!-- Dark mode toggle -->
  <div class="switch">
    <label>
      <input type="checkbox" id="darkModeToggle">
      <span class="slider"></span>
    </label>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const sidebar = document.querySelector(".sidebar");
  const toggleBtn = document.getElementById("toggleSidebarBtn");
  const darkToggle = document.getElementById("darkModeToggle");

  // Sidebar collapse
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
    document.querySelector('.main-content').classList.toggle("collapsed");
  });

  // Dark mode toggle
  darkToggle.addEventListener("change", () => {
    body.classList.toggle("dark");
  });
});
</script>

