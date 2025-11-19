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
     * Gérer la soumission du formulaire
     */
    const form = document.getElementById("portfolioForm");
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault(); // Empêcher le rechargement de la page
            
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

            // Envoyer les données au backend via API
            const formData = new FormData();
            formData.append('clientName', clientName);
            formData.append('dateRealisation', date);
            formData.append('contact', contact);
            formData.append('image', imageInput.files[0]);

            // Déterminer l'endpoint selon la page
            const currentPage = window.location.pathname;
            let apiEndpoint = 'api/add_site.php';
            
            if (currentPage.includes('affiche')) {
                apiEndpoint = 'api/add_affiche.php';
            }

            fetch(apiEndpoint, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Afficher un message de succès
                    alert('✅ ' + data.message);
                    
                    // Recharger la page pour afficher le nouvel élément
                    window.location.reload();
                } else {
                    alert('❌ Erreur : ' + data.message);
                }
            })
            .catch(err => {
                console.error('Erreur :', err);
                alert('Une erreur est survenue lors de l\'ajout. Veuillez réessayer.');
            });
        });
    }
});
