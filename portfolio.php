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
      <div class="item sites"><img src="assets/img/afiche1.jpg" alt=""></div>
      <div class="item shooting"><img src="assets/img/afiche1.jpg" alt=""></div>
      <div class="item identite"><img src="assets/img/Affiche6.jpg" alt=""></div>
      <div class="item affiches"><img src="assets/img/Affiche6.jpg" alt=""></div>
      <div class="item sites"><img src="assets/img/Affiche5.jpg" alt=""></div>
      <div class="item affiches"><img src="assets/img/Affiche6.jpg" alt=""></div>
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