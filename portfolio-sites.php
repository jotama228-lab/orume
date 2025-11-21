<?php
/**
 * ============================================
 * PAGE PORTFOLIO - SITES WEB
 * ============================================
 * 
 * Cette page affiche uniquement les sites web du portfolio
 * en récupérant les données depuis la base de données.
 * 
 * @package Orüme
 * @version 1.0.0
 */

// Charger les sites depuis la base de données
$sites = [];

// Essayer avec une connexion directe à la BDD
try {
    require_once __DIR__ . '/partials/connect.php';
    if (isset($connect) && $connect && mysqli_ping($connect)) {
        $query = "SELECT * FROM sites ORDER BY date_realisation DESC";
        $result = mysqli_query($connect, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sites[] = $row;
            }
        }
    }
} catch (Exception $e) {
    error_log("Erreur connexion BDD : " . $e->getMessage());
}

// Si toujours pas de sites, utiliser des données par défaut
if (empty($sites)) {
    $sites = [
        ['image_path' => '/admin/images/Admin/sites/agri.jpeg', 'client_name' => 'Alpha Group'],
        ['image_path' => '/admin/images/Admin/sites/furniture.jpeg', 'client_name' => 'Bella Studio'],
        ['image_path' => '/admin/images/Admin/sites/grenade.jpeg', 'client_name' => 'GreenMarket'],
        ['image_path' => '/admin/images/Admin/sites/raisin.jpeg', 'client_name' => 'DigitalFood'],
        ['image_path' => '/admin/images/Admin/sites/tech.jpeg', 'client_name' => 'TechCorp']
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'partials/head.php'; ?>
<br>
<br>

<!-- === SECTION BANNIÈRE === -->
<section class="banner-section">
    <div class="banner-container">
        <img src="assets/img/banner-portfolio.png" alt="Votre visibilité notre préoccupation" class="banner-image">
    </div>
</section>

<!-- === SECTION PORTFOLIO SITES === -->
<section class="portfolio-section">
    <div class="portfolio-conteneur">
        <div class="filter-row">
            <div class="filter-buttons">
                <button onclick="window.location.href='portfolio.php'" class="filter-btn">Tout</button>
                <button onclick="window.location.href='portfolio-sites.php'" class="filter-btn active">Sites</button>
                <button onclick="window.location.href='portfolio-shooting.php'" class="filter-btn">Shooting</button>
                <button onclick="window.location.href='portfolio-identite.php'" class="filter-btn">Identité visuelle</button>
                <button onclick="window.location.href='portfolio-affiches.php'" class="filter-btn">Affiches</button>
            </div>
        </div>
        <h2 class="portfolio-title">Nos Sites Web</h2>
        
        <div class="portfolio-grid">
            <?php if (!empty($sites)): ?>
                <?php foreach ($sites as $site): ?>
                    <?php 
                    // Déterminer le chemin de l'image
                    $imagePath = $site['image_path'] ?? '';
                    
                    // Normaliser le chemin de l'image
                    if (empty($imagePath)) {
                        $imagePath = '/admin/images/Admin/sites/agri.jpeg'; // Image par défaut
                    } elseif (strpos($imagePath, '/') === 0) {
                        // Chemin absolu depuis la racine, déjà correct
                    } elseif (strpos($imagePath, 'admin/') === 0) {
                        // Ajouter le / au début
                        $imagePath = '/' . $imagePath;
                    } elseif (strpos($imagePath, 'images/') === 0) {
                        $imagePath = '/admin/' . $imagePath;
                    } else {
                        // Chemin relatif, construire le chemin complet
                        $imagePath = '/admin/images/Admin/sites/' . basename($imagePath);
                    }
                    
                    $altText = htmlspecialchars($site['client_name'] ?? 'Site web', ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="item sites">
                        <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo $altText; ?>" 
                             class="portfolio-item-img"
                             onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-items">Aucun site web disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- === MODALE POUR VISUALISER LES IMAGES === -->
<div class="modal" id="imageModal">
    <span class="close">&times;</span>
    <img class="modal-image" src="" alt="">
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
</div>

<?php include 'partials/footer.php'; ?>

<script>
/**
 * Gestion de la modale pour visualiser les images en grand
 */
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const modalImg = modal.querySelector('.modal-image');
    const closeBtn = modal.querySelector('.close');
    const prevBtn = modal.querySelector('.prev');
    const nextBtn = modal.querySelector('.next');
    const images = Array.from(document.querySelectorAll('.portfolio-item-img'));
    let currentIndex = 0;

    // Ouvrir la modale au clic sur une image
    images.forEach((img, index) => {
        img.addEventListener('click', function() {
            currentIndex = index;
            modal.style.display = 'flex';
            modalImg.src = this.src;
            modalImg.alt = this.alt;
        });
    });

    // Fermer la modale
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Fermer en cliquant en dehors de l'image
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Navigation précédente
    prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImg.src = images[currentIndex].src;
        modalImg.alt = images[currentIndex].alt;
    });

    // Navigation suivante
    nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        currentIndex = (currentIndex + 1) % images.length;
        modalImg.src = images[currentIndex].src;
        modalImg.alt = images[currentIndex].alt;
    });

    // Navigation au clavier
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowLeft') {
                prevBtn.click();
            } else if (e.key === 'ArrowRight') {
                nextBtn.click();
            } else if (e.key === 'Escape') {
                closeBtn.click();
            }
        }
    });
});
</script>

</body>
</html>
