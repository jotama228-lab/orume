<?php
/**
 * ============================================
 * PAGE PORTFOLIO - SHOOTINGS
 * ============================================
 * 
 * Cette page affiche uniquement les shootings du portfolio
 * en récupérant les données depuis la base de données.
 * 
 * @package Orüme
 * @version 1.0.0
 */

// Charger les shootings depuis la base de données
$shootings = [];

try {
    require_once __DIR__ . '/partials/connect.php';
    if (isset($connect) && $connect) {
        $query = "SELECT * FROM shootings ORDER BY date_realisation DESC";
        $result = mysqli_query($connect, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $shootings[] = $row;
            }
        }
    }
} catch (Exception $e) {
    error_log("Erreur connexion BDD : " . $e->getMessage());
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

<!-- === SECTION PORTFOLIO SHOOTINGS === -->
<section class="portfolio-section">
    <div class="portfolio-conteneur">
        <h2 class="portfolio-title">Nos Shootings</h2>
        
        <div class="portfolio-grid">
            <?php if (!empty($shootings)): ?>
                <?php foreach ($shootings as $shooting): ?>
                    <?php 
                    $imagePath = $shooting['image_path'] ?? '';
                    if (strpos($imagePath, 'admin/') !== 0 && strpos($imagePath, '/') !== 0) {
                        if (strpos($imagePath, 'images/') === 0) {
                            $imagePath = 'admin/' . $imagePath;
                        } else {
                            $imagePath = 'admin/images/Admin/Shoot/' . basename($imagePath);
                        }
                    }
                    $altText = htmlspecialchars($shooting['client_name'] ?? 'Shooting', ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="item shooting">
                        <img src="/<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo $altText; ?>" 
                             class="portfolio-item-img"
                             style="width: 100%; height: auto; object-fit: cover;"
                             onerror="this.src='assets/img/logo-acceuil.png'; this.onerror=null;">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-items">Aucun shooting disponible pour le moment.</p>
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
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const modalImg = modal.querySelector('.modal-image');
    const closeBtn = modal.querySelector('.close');
    const prevBtn = modal.querySelector('.prev');
    const nextBtn = modal.querySelector('.next');
    const images = Array.from(document.querySelectorAll('.portfolio-item-img'));
    let currentIndex = 0;

    images.forEach((img, index) => {
        img.addEventListener('click', function() {
            currentIndex = index;
            modal.style.display = 'flex';
            modalImg.src = this.src;
            modalImg.alt = this.alt;
        });
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImg.src = images[currentIndex].src;
        modalImg.alt = images[currentIndex].alt;
    });

    nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        currentIndex = (currentIndex + 1) % images.length;
        modalImg.src = images[currentIndex].src;
        modalImg.alt = images[currentIndex].alt;
    });

    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowLeft') prevBtn.click();
            else if (e.key === 'ArrowRight') nextBtn.click();
            else if (e.key === 'Escape') closeBtn.click();
        }
    });
});
</script>

</body>
</html>

