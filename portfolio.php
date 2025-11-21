<!DOCTYPE html>
<html lang="fr">
<?php
include 'partials/head.php';
?>
<br>
<br>

<!-- === SECTION BANNIÈRE === -->
<section class="banner-section">
  <div class="banner-container">
    <img src="assets/img/banner-portfolio.png" alt="Votre visibilité notre préoccupation" class="banner-image">
  </div>
</section>

<section class="portfolio-section">
  <div class="portfolio-conteneur">
    <div class="filter-row">
      <div class="filter-buttons">
        <a href="portfolio.php" class="filter-btn <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'active' : ''; ?>">Tout</a>
        <a href="portfolio-sites.php" class="filter-btn <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio-sites.php' ? 'active' : ''; ?>">Sites</a>
        <a href="portfolio-shooting.php" class="filter-btn <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio-shooting.php' ? 'active' : ''; ?>">Shooting</a>
        <a href="portfolio-identite.php" class="filter-btn <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio-identite.php' ? 'active' : ''; ?>">Identité visuelle</a>
        <a href="portfolio-affiches.php" class="filter-btn <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio-affiches.php' ? 'active' : ''; ?>">Affiches</a>
      </div>
    </div>

    <div class="portfolio-grid">
      <?php
      // Charger tous les éléments du portfolio depuis la base de données
      require_once __DIR__ . '/partials/connect.php';
      
      $allItems = [];
      
      if (isset($connect) && $connect) {
          // Charger les sites
          $querySites = "SELECT *, 'sites' as type FROM sites ORDER BY date_realisation DESC";
          $resultSites = mysqli_query($connect, $querySites);
          if ($resultSites) {
              while ($row = mysqli_fetch_assoc($resultSites)) {
                  $allItems[] = $row;
              }
          }
          
          // Charger les affiches
          $queryAffiches = "SELECT *, 'affiches' as type FROM affiches ORDER BY date_realisation DESC";
          $resultAffiches = mysqli_query($connect, $queryAffiches);
          if ($resultAffiches) {
              while ($row = mysqli_fetch_assoc($resultAffiches)) {
                  $allItems[] = $row;
              }
          }
          
          // Charger les identités visuelles
          $queryIdentites = "SELECT *, 'identite' as type FROM identites ORDER BY date_realisation DESC";
          $resultIdentites = mysqli_query($connect, $queryIdentites);
          if ($resultIdentites) {
              while ($row = mysqli_fetch_assoc($resultIdentites)) {
                  $allItems[] = $row;
              }
          }
          
          // Charger les shootings
          $queryShootings = "SELECT *, 'shooting' as type FROM shootings ORDER BY date_realisation DESC";
          $resultShootings = mysqli_query($connect, $queryShootings);
          if ($resultShootings) {
              while ($row = mysqli_fetch_assoc($resultShootings)) {
                  $allItems[] = $row;
              }
          }
      }
      
      // Afficher tous les éléments
      if (!empty($allItems)) {
          foreach ($allItems as $item) {
              $type = $item['type'] ?? 'sites';
              $imagePath = htmlspecialchars($item['image_path'] ?? '', ENT_QUOTES, 'UTF-8');
              $clientName = htmlspecialchars($item['client_name'] ?? '', ENT_QUOTES, 'UTF-8');
              
              // Normaliser le chemin de l'image
              if (empty($imagePath)) {
                  // Image par défaut selon le type
                  $defaultPaths = [
                      'sites' => '/admin/images/Admin/sites/agri.jpeg',
                      'affiches' => '/admin/images/Admin/affiches/default.jpg',
                      'identite' => '/admin/images/Admin/identités/default.jpg',
                      'shooting' => '/assets/img/logo-acceuil.png'
                  ];
                  $imagePath = $defaultPaths[$type] ?? '/assets/img/logo-acceuil.png';
              } elseif (strpos($imagePath, '/') === 0 && strpos($imagePath, '/admin/') === 0) {
                  // Chemin absolu depuis la racine commençant par /admin/, déjà correct
              } elseif (strpos($imagePath, 'http://') === 0 || strpos($imagePath, 'https://') === 0) {
                  // URL complète, déjà correct
              } elseif (strpos($imagePath, 'admin/images/') === 0) {
                  $imagePath = '/' . $imagePath;
              } elseif (strpos($imagePath, 'images/') === 0) {
                  $imagePath = '/admin/' . $imagePath;
              } else {
                  // Chemin relatif ou nom de fichier seul, construire le chemin complet
                  $typeFolders = [
                      'sites' => 'sites/',
                      'affiches' => 'affiches/',
                      'identite' => 'identités/',
                      'shooting' => 'Shoot/'
                  ];
                  $folder = $typeFolders[$type] ?? 'sites/';
                  
                  // Si c'est juste un nom de fichier (sans slash), construire le chemin complet
                  if (strpos($imagePath, '/') === false && strpos($imagePath, '\\') === false) {
                      $imagePath = '/admin/images/Admin/' . $folder . $imagePath;
                  } else {
                      // Sinon, utiliser le basename et construire le chemin
                      $imagePath = '/admin/images/Admin/' . $folder . basename($imagePath);
                  }
              }
              
              // Vérifier si le fichier existe, sinon utiliser une image par défaut
              $fullPath = __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, $imagePath);
              if (!file_exists($fullPath) && strpos($imagePath, '/assets/img/logo-acceuil.png') === false) {
                  // Si l'image n'existe pas, utiliser une image par défaut selon le type
                  $fallbackPaths = [
                      'sites' => '/admin/images/Admin/sites/agri.jpeg',
                      'affiches' => '/admin/images/Admin/affiches/afiche1.jpg',
                      'identite' => '/admin/images/Admin/affiches/Affiche6.jpg',
                      'shooting' => '/admin/images/Admin/affiches/afiche1.jpg' // Utiliser une affiche par défaut pour les shootings
                  ];
                  $imagePath = $fallbackPaths[$type] ?? '/assets/img/logo-acceuil.png';
              }
              ?>
              <div class="item <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">
                <img src="<?php echo $imagePath; ?>" 
                     alt="<?php echo $clientName; ?>" 
                     class="portfolio-item-img"
                     onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;">
              </div>
              <?php
          }
      } else {
          // Données par défaut si la BDD n'est pas disponible
          ?>
          <div class="item sites"><img src="/assets/img/afiche1.jpg" alt="Site web" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <div class="item shooting"><img src="/assets/img/afiche1.jpg" alt="Shooting" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <div class="item identite"><img src="/assets/img/Affiche6.jpg" alt="Identité visuelle" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <div class="item affiches"><img src="/assets/img/Affiche6.jpg" alt="Affiche" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <div class="item sites"><img src="/assets/img/Affiche5.jpg" alt="Site web" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <div class="item affiches"><img src="/assets/img/Affiche6.jpg" alt="Affiche" class="portfolio-item-img" onerror="this.src='/assets/img/logo-acceuil.png'; this.onerror=null;"></div>
          <?php
      }
      ?>
    </div>
  </div>
</section>

<!-- === MODALE === -->
<div class="modal" id="imageModal">
  <span class="close">&times;</span>
  <img class="modal-image" src="" alt="">
  <button class="prev">&#10094;</button>
  <button class="next">&#10095;</button>
</div>


<?php
include 'partials/footer.php';
?>

<script>
// Script de modale pour portfolio.php
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const modalImg = modal ? modal.querySelector('.modal-image') : null;
    const closeBtn = modal ? modal.querySelector('.close') : null;
    const nextBtn = modal ? modal.querySelector('.next') : null;
    const prevBtn = modal ? modal.querySelector('.prev') : null;
    const items = Array.from(document.querySelectorAll('.portfolio-grid .item'));
    
    if (!modal || !modalImg || !closeBtn || !nextBtn || !prevBtn) {
        console.warn('Éléments de la modale introuvables');
        return;
    }
    
    let currentImages = [];
    let currentIndex = 0;
    
    // Fonction pour récupérer les images visibles
    function getVisibleItems() {
        return items.filter(i => {
            const style = window.getComputedStyle(i);
            return style.display !== 'none' && 
                   !i.classList.contains('hide') && 
                   style.visibility !== 'hidden' &&
                   style.opacity !== '0';
        });
    }
    
    // Ouvrir la modale au clic sur une image
    items.forEach((item, index) => {
        const img = item.querySelector('img');
        if (img) {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Récupérer toutes les images visibles
                const visibleItems = getVisibleItems();
                
                currentImages = visibleItems.map(i => {
                    const imgEl = i.querySelector('img');
                    return imgEl ? imgEl.src : null;
                }).filter(src => src !== null);
                
                currentIndex = visibleItems.indexOf(item);
                if (currentIndex === -1) currentIndex = 0;
                
                if (currentImages.length > 0) {
                    modal.style.display = 'flex';
                    modalImg.src = currentImages[currentIndex];
                    modalImg.alt = img.alt || '';
                }
            });
        }
    });
    
    // Fermer la modale
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Navigation
    nextBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        // Mettre à jour les images visibles avant de naviguer
        const visibleItems = getVisibleItems();
        currentImages = visibleItems.map(i => {
            const imgEl = i.querySelector('img');
            return imgEl ? imgEl.src : null;
        }).filter(src => src !== null);
        
        if (currentImages.length > 0) {
            currentIndex = (currentIndex + 1) % currentImages.length;
            modalImg.src = currentImages[currentIndex];
        }
    });
    
    prevBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        // Mettre à jour les images visibles avant de naviguer
        const visibleItems = getVisibleItems();
        currentImages = visibleItems.map(i => {
            const imgEl = i.querySelector('img');
            return imgEl ? imgEl.src : null;
        }).filter(src => src !== null);
        
        if (currentImages.length > 0) {
            currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
            modalImg.src = currentImages[currentIndex];
        }
    });
    
    // Navigation au clavier
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowLeft') prevBtn.click();
            else if (e.key === 'ArrowRight') nextBtn.click();
            else if (e.key === 'Escape') closeBtn.click();
        }
    });
});
</script>
<script src="assets/js/filtrePortfolio.js"></script> 


</body>
</html>