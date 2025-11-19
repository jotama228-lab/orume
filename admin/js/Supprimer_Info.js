document.querySelectorAll(".btn-delete").forEach(btn => {
  btn.addEventListener("click", function() {
    if (confirm("Voulez-vous vraiment supprimer ce portfolio ?")) {
      this.closest(".portfolio-card").remove();
    }
  });
});
