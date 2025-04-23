document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const modeToggle = document.getElementById("modeToggle");
  
    toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
    });
  
    // Mode persistence
    if (localStorage.getItem("darkMode") === "true") {
      document.body.classList.add("dark-mode");
      modeToggle.checked = true;
    }
  
    modeToggle.addEventListener("change", () => {
      document.body.classList.toggle("dark-mode");
      localStorage.setItem("darkMode", document.body.classList.contains("dark-mode"));
    });
  });
  