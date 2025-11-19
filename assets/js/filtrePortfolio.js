document.addEventListener("DOMContentLoaded", () => {
  const filterButtons = Array.from(document.querySelectorAll(".filter-buttons button"));
  const items = Array.from(document.querySelectorAll(".portfolio-grid .item"));

  // Debug simple pour vérifier que les éléments sont bien trouvés
  if (!filterButtons.length) {
    console.warn("[filtrePortfolio] Aucun bouton de filtre trouvé (.filter-buttons button).");
  } else {
    console.log(`[filtrePortfolio] ${filterButtons.length} boutons de filtre trouvés.`);
  }

  if (!items.length) {
    console.warn("[filtrePortfolio] Aucune .item trouvée dans .portfolio-grid.");
  } else {
    console.log(`[filtrePortfolio] ${items.length} éléments trouvés dans .portfolio-grid.`);
  }

  // Fonction principale d'affichage
  function showCategory(category) {
    // pour animation / lisibilité on supprime d'abord la classe active sur tous (si présente)
    filterButtons.forEach(btn => btn.classList.toggle("active", btn.getAttribute("data-filter") === category));

    items.forEach(item => {
      // si all --> visible, sinon visible si item a la classe category
      if (category === "all") {
        item.classList.remove("hide");
        item.style.display = ""; // remet le display par défaut (grid)
        item.classList.add("fade-in");
      } else {
        if (item.classList.contains(category)) {
          item.classList.remove("hide");
          item.style.display = ""; // laisse le CSS gérer l'affichage dans la grid
          item.classList.add("fade-in");
        } else {
          item.classList.add("hide");
          // on attend la durée de l'animation avant de couper l'affichage (permet transition)
          setTimeout(() => {
            if (item.classList.contains("hide")) item.style.display = "none";
          }, 220);
        }
      }
    });
  }

  // Attacher handlers aux boutons
  filterButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      const filterValue = (btn.getAttribute("data-filter") || "").trim();
      if (!filterValue) {
        console.warn("[filtrePortfolio] data-filter manquant sur le bouton", btn);
        return;
      }
      console.log(`[filtrePortfolio] Filtrer sur : ${filterValue}`);
      showCategory(filterValue);
    });
  });

  // Afficher "all" par défaut au chargement
  showCategory("all");
});
