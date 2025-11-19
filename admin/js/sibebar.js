// ======== TOGGLE SIDEBAR ========
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const hamburger = document.getElementById("hamburger");
const hamburgerTop = document.getElementById("hamburger-top");

// Fonction pour basculer la sidebar
function toggleSidebar() {
  sidebar.classList.toggle("collapsed");
  overlay.classList.toggle("active");
}

// Clic sur le hamburger (dans la sidebar ou le header)
if (hamburger) hamburger.addEventListener("click", toggleSidebar);
if (hamburgerTop) hamburgerTop.addEventListener("click", toggleSidebar);

// Fermer la sidebar si on clique sur l’overlay (en mobile)
if (overlay) {
  overlay.addEventListener("click", () => {
    sidebar.classList.remove("collapsed");
    overlay.classList.remove("active");
  });
}
