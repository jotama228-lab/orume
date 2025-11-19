/**
 * ============================================
 * GESTION DE LA SUPPRESSION D'UN PORTFOLIO
 * ============================================
 * 
 * Ce script gère la suppression d'un élément du portfolio
 * depuis l'interface d'administration. Il supprime visuellement
 * l'élément du DOM et devrait être connecté à une API backend
 * pour la suppression en base de données.
 * 
 * @file Supprimer_Info.js
 * @package Orüme\Admin\JS
 * @version 1.0.0
 */

document.addEventListener("DOMContentLoaded", function() {
    /**
     * Récupérer tous les boutons de suppression
     * @type {NodeList}
     */
    const deleteButtons = document.querySelectorAll(".btn-delete");

    /**
     * Ajouter un écouteur d'événement à chaque bouton de suppression
     */
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function() {
            // Demander confirmation avant suppression
            if (confirm("Voulez-vous vraiment supprimer ce portfolio ?")) {
                // Récupérer la carte parente
                const card = this.closest(".portfolio-card");
                
                if (card) {
                    // Supprimer visuellement la carte du DOM
                    card.remove();
                    
                    /**
                     * TODO: Implémenter l'appel API pour supprimer en base de données
                     * 
                     * Exemple d'implémentation :
                     * 
                     * const portfolioId = card.dataset.id; // ID stocké dans data-id
                     * 
                     * fetch(`/admin/api/portfolio/delete.php?id=${portfolioId}`, {
                     *     method: 'DELETE',
                     *     headers: {
                     *         'Content-Type': 'application/json'
                     *     }
                     * })
                     * .then(res => res.json())
                     * .then(data => {
                     *     if (data.success) {
                     *         card.remove(); // Supprimer seulement si succès
                     *     } else {
                     *         alert('Erreur : ' + data.message);
                     *     }
                     * })
                     * .catch(err => {
                     *     console.error('Erreur :', err);
                     *     alert('Une erreur est survenue lors de la suppression.');
                     * });
                     */
                }
            }
        });
    });
});
