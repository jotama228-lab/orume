document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const hamburger = document.getElementById("hamburger");
  const hamburgerTop = document.getElementById("hamburger-top");
  const overlay = document.getElementById("overlay");


  // Toggle sidebar (both buttons)
  function toggleSidebar() {
   if (window.innerWidth <= 768) {
      sidebar.classList.toggle("open");
      overlay.classList.toggle("active");
    } else {
      sidebar.classList.toggle("collapsed");
    }
  }

  hamburger.addEventListener("click", toggleSidebar);
  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("active");
  });
  hamburgerTop.addEventListener("click", toggleSidebar);

 
});
