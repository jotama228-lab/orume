/**
 * ============================================
 * GESTION DE L'AJOUT D'UN SITE PORTFOLIO
 * ============================================
 * 
 * Ce script gère l'ajout dynamique d'un site web dans le portfolio
 * depuis l'interface d'administration. Il permet d'ajouter une carte
 * visuellement dans le DOM et devrait être connecté à une API backend
 * pour la persistance en base de données.
 * 
 * @file Ajout.js
 * @package Orüme\Admin\JS
 * @version 1.0.0
 */

document.addEventListener("DOMContentLoaded", function() {
    /**
     * Récupérer le bouton d'ajout
     * @type {HTMLElement|null}
     */
    const addBtn = document.getElementById("addPortfolioBtn");
    
    // Vérifier que le bouton existe
    if (!addBtn) {
        console.error("❌ Bouton 'addPortfolioBtn' introuvable dans le DOM.");
        return;
    }

    /**
     * Gérer le clic sur le bouton d'ajout
     */
    addBtn.addEventListener("click", () => {
        // Récupérer les valeurs du formulaire
        const clientName = document.getElementById("clientName").value.trim();
        const date = document.getElementById("dateRealisation").value;
        const prix = document.getElementById("prix") ? document.getElementById("prix").value : "N/A";
        const contact = document.getElementById("contact").value.trim();
        const imageInput = document.getElementById("image");

        // Validation des champs requis
        if (!clientName || !date || !contact || !imageInput.files.length) {
            alert("⚠️ Veuillez remplir tous les champs avant d'ajouter un portfolio.");
            return;
        }

        // Créer une URL d'aperçu pour l'image
        const imageUrl = URL.createObjectURL(imageInput.files[0]);

        // Créer l'élément de carte
        const card = document.createElement("div");
        card.className = "portfolio-card";
        card.innerHTML = `
            <img src="${imageUrl}" alt="Portfolio de ${clientName}" class="portfolio-img">
            <div class="portfolio-info">
                <h3>Client : ${clientName}</h3>
                <p><i class="fa-solid fa-calendar"></i> Date : ${date}</p>
                ${prix !== "N/A" ? `<p><i class="fa-solid fa-dollar-sign"></i> Prix : ${prix} FCFA</p>` : ""}
                <p><i class="fa-solid fa-envelope"></i> Contact : ${contact}</p>
            </div>
        `;

        // Ajouter la carte à la grille
        const portfolioGrid = document.querySelector(".portfolio-grid");
        if (portfolioGrid) {
            portfolioGrid.appendChild(card);
        }

        // Réinitialiser le formulaire
        document.getElementById("portfolioForm").reset();

        /**
         * TODO: Implémenter l'envoi vers le backend
         * 
         * Exemple d'implémentation avec fetch API :
         * 
         * const formData = new FormData(document.getElementById('portfolioForm'));
         * 
         * fetch('/admin/api/portfolio/add.php', {
         *     method: 'POST',
         *     body: formData
         * })
         * .then(res => res.json())
         * .then(data => {
         *     if (data.success) {
         *         console.log('✅ Portfolio ajouté :', data);
         *         // Optionnel : recharger la page ou mettre à jour l'affichage
         *     } else {
         *         alert('Erreur : ' + data.message);
         *     }
         * })
         * .catch(err => {
         *     console.error('Erreur :', err);
         *     alert('Une erreur est survenue lors de l\'ajout du portfolio.');
         * });
         */
    });
});
