/**
 * ============================================
 * SYSTÈME DE FILTRAGE DU PORTFOLIO
 * ============================================
 * 
 * Ce script gère le filtrage des éléments du portfolio
 * selon leur catégorie (Sites, Shooting, Identité visuelle, Affiches).
 * Il permet d'afficher/masquer les éléments avec des animations fluides.
 * 
 * @file filtrePortfolio.js
 * @package Orüme\Assets\JS
 * @version 1.0.0
 */

document.addEventListener("DOMContentLoaded", () => {
    /**
     * Récupérer tous les boutons de filtre
     * @type {Array<HTMLElement>}
     */
    const filterButtons = Array.from(document.querySelectorAll(".filter-buttons button"));
    
    /**
     * Récupérer tous les éléments du portfolio
     * @type {Array<HTMLElement>}
     */
    const items = Array.from(document.querySelectorAll(".portfolio-grid .item"));

    // Vérifier que les éléments existent (debug)
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

    /**
     * Afficher les éléments d'une catégorie spécifique
     * 
     * @param {string} category - Catégorie à afficher ("all", "sites", "shooting", etc.)
     */
    function showCategory(category) {
        // Mettre à jour l'état actif des boutons
        filterButtons.forEach(btn => {
            btn.classList.toggle("active", btn.getAttribute("data-filter") === category);
        });

        // Filtrer les éléments
        items.forEach(item => {
            if (category === "all") {
                // Afficher tous les éléments
                item.classList.remove("hide");
                item.style.display = ""; // Remet le display par défaut (grid)
                item.classList.add("fade-in");
            } else {
                // Afficher uniquement les éléments de la catégorie
                if (item.classList.contains(category)) {
                    item.classList.remove("hide");
                    item.style.display = ""; // Laisse le CSS gérer l'affichage
                    item.classList.add("fade-in");
                } else {
                    // Masquer les autres éléments avec animation
                    item.classList.add("hide");
                    // Attendre la durée de l'animation avant de couper l'affichage
                    setTimeout(() => {
                        if (item.classList.contains("hide")) {
                            item.style.display = "none";
                        }
                    }, 220); // 220ms correspond à la durée de l'animation CSS
                }
            }
        });
    }

    /**
     * Attacher les écouteurs d'événements aux boutons de filtre
     */
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

    // Afficher tous les éléments par défaut au chargement
    showCategory("all");
});
