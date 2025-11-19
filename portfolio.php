<!DOCTYPE html>
<html lang="fr">
 <?php
      include'partials/head.php'
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
        <button data-filter="all" class="active">Tout</button>
        <button data-filter="sites">Sites</button>
        <button data-filter="shooting">Shooting</button>
        <button data-filter="identite">Identité visuelle</button>
        <button data-filter="affiches">Affiches</button>
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
              if (strpos($imagePath, 'admin/images/') === 0) {
                  $imagePath = '/' . $imagePath;
              } elseif (strpos($imagePath, 'images/') === 0) {
                  $imagePath = '/admin/' . $imagePath;
              } elseif (strpos($imagePath, '/') !== 0) {
                  $imagePath = '/admin/images/Admin/' . ($type === 'sites' ? 'sites/' : ($type === 'affiches' ? 'affiches/' : ($type === 'identite' ? 'identités/' : 'Shoot/'))) . basename($imagePath);
              }
              ?>
              <div class="item <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">
                <img src="<?php echo $imagePath; ?>" alt="<?php echo $clientName; ?>">
              </div>
              <?php
          }
      } else {
          // Données par défaut si la BDD n'est pas disponible
          ?>
          <div class="item sites"><img src="assets/img/afiche1.jpg" alt=""></div>
          <div class="item shooting"><img src="assets/img/afiche1.jpg" alt=""></div>
          <div class="item identite"><img src="assets/img/Affiche6.jpg" alt=""></div>
          <div class="item affiches"><img src="assets/img/Affiche6.jpg" alt=""></div>
          <div class="item sites"><img src="assets/img/Affiche5.jpg" alt=""></div>
          <div class="item affiches"><img src="assets/img/Affiche6.jpg" alt=""></div>
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
      include'partials/footer.php'
  ?>
<script>
  
</script>  
<script src="assets/js/filtrePortfolio.js"></script> 


</body>
</html>