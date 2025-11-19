<!DOCTYPE html>
<html lang="fr">


<?php
    include'adminpartials/head.php'
?>


<body>

 <?php
     include'adminpartials/aside.php'
 ?>
  <!-- Overlay : <div id="overlay" class="overlay"></div>-->
  

  <!-- Main content --> 

  <main class="main-content">
    <header class="topbar">
      <h1 class="titrepage">Site</h1>
    </header>

    <!-- SECTION PORTFOLIO -->
    <section class="portfolio">
      <h1 class="portfolio-title">Ajouter un site-web</h1>
 
     
       <!-- AJOUT d'un site -->
            <!-- section d'ajout de site -->
     <div class="portfolio-header">
     
        <form id="portfolioForm" class="portfolio-form">
          <div class="form-group">
            <label for="clientName">Nom du client</label>
            <input type="text" id="clientName" placeholder="Ex: Alpha Group" required>
          </div>

          <div class="form-group">
            <label for="dateRealisation">Date de réalisation</label>
            <input type="month" id="dateRealisation" required>
          </div>

          
          <div class="form-group">
            <label for="contact">Contact / Email</label>
            <input type="text" id="contact" placeholder="contact@client.com" required>
          </div>

          <div class="form-group">
            <label for="image">Image du site</label>
            <input type="file" id="image" accept="image/*" required>
          </div>
           <button type="submit" id="addPortfolioBtn" class="btn-submit">
              <i class="fa-solid fa-paper-plane"></i> Enregistrer
           </button>
        </form>
      </div>

        <!-- GRID -->

    <section>
           <h1 class="portfolio-title">Site clients Ajoutés</h1>
    </section>
    <Section>
      <div class="portfolio-grid">

              <!-- CARD 1 -->
              <div class="portfolio-card">
                <img src="images/Admin/sites/agri.jpeg" alt="Site Web Client 1" class="portfolio-img">
                <div class="portfolio-info">
                  <h3>Client : Alpha Group</h3>
                  <p><i class="fa-solid fa-calendar"></i> Date : Mars 2024</p>
                  <p><i class="fa-solid fa-envelope"></i> Email : Alpha@gmail.com</p>
                  <p><i class="fa-solid fa-phone"></i> Contact : +33 6 12 34 56 78</p>

                  <!-- Actions -->
                  <div class="portfolio-actions">
                    <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                    <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
                  </div>
                </div>
              </div>

              <!-- CARD 2 -->
              <div class="portfolio-card">
                <img src="images/Admin/sites/furniture.jpeg" alt="Site Web Client 2" class="portfolio-img">
                <div class="portfolio-info">
                  <h3>Client : Bella Studio</h3>
                  <p><i class="fa-solid fa-calendar"></i> Date : Juin 2024</p>
                  <p><i class="fa-solid fa-envelope"></i> Email : contact@bellastudio.fr</p>
                  <p><i class="fa-solid fa-phone"></i> Contact : +225 70 30 46 30</p>

                  <!-- Actions -->
                  <div class="portfolio-actions">
                    <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                    <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
                  </div>
                </div>
              </div>

              <!-- CARD 3 -->
              <div class="portfolio-card">
                <img src="images/Admin/sites/grenade.jpeg" alt="Site Web Client 3" class="portfolio-img">
                <div class="portfolio-info">
                  <h3>Client : GreenMarket</h3>
                  <p><i class="fa-solid fa-calendar"></i> Date : Janvier 2025</p>
                  <p><i class="fa-solid fa-envelope"></i> Email : GreenMarket@gmail.com</p>
                  <p><i class="fa-solid fa-phone"></i> Contact : +228 90 12 34 56</p>

                  <!-- Actions -->
                  <div class="portfolio-actions">
                    <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                    <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
                  </div>
                </div>
          </div>

        <!-- CARD 4 -->
        <div class="portfolio-card">
          <img src="images/Admin/sites/raisin.jpeg" alt="Site Web Client 4" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : DigitalFood</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Avril 2025</p>
            <p><i class="fa-solid fa-envelope"></i> Email : info@digitalfood.com</p>
            <p><i class="fa-solid fa-phone"></i> Contact : +228 96 15 08 33</p>

            <!-- Actions -->
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

          <!-- CARD 5 -->
        <div class="portfolio-card">
          <img src="images/Admin/sites/raisin.jpeg" alt="Site Web Client 4" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : DigitalFood</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Avril 2025</p>
            <p><i class="fa-solid fa-envelope"></i> Email : info@digitalfood.com</p>
            <p><i class="fa-solid fa-phone"></i> Contact : +228 96 15 08 33</p>

            <!-- Actions -->
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>
</div>

   </section>
  </main>

  <!-- POPUP IMAGE -->
  <div id="imgModal" class="img-modal">
    <span class="close-modal">&times;</span>
    <img class="modal-content" id="imgPreview">
    <div id="caption"></div>
  </div>

  <!-- formulaire DE MODIFICATION -->
<div id="editModal" class="edit-modal">
  <div class="edit-modal-content">
    <span class="close-edit">&times;</span>
    <h2>Modifier le Portfolio</h2>

    <form id="editForm">
      <div class="form-group">
        <label for="editClientName">Nom du client</label>
        <input type="text" id="editClientName" required>
      </div>

      <div class="form-group">
        <label for="editDate">Date de réalisation</label>
        <input type="month" id="editDate" required>
      </div>

      <div class="form-group">
        <label for="editEmail">Email / Contact</label>
        <input type="text" id="editEmail" required>
      </div>

      <div class="form-group">
        <label for="editImage">Changer l'image (optionnel)</label>
        <input type="file" id="editImage" accept="image/*">
      </div>

      <button type="submit" class="btn-edit-save">
        <i class="fa-solid fa-floppy-disk"></i> Enregistrer les modifications
      </button>
    </form>
  </div>
</div>

   <script>
    // ---------- ZOOM IMAGE ----------
    const modal = document.getElementById("imgModal");
    const modalImg = document.getElementById("imgPreview");
    const captionText = document.getElementById("caption");
    const span = document.getElementsByClassName("close-modal")[0];

    document.querySelectorAll(".portfolio-img").forEach(img => {
      img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
      };
    });

    span.onclick = function() {
      modal.style.display = "none";
    };
  </script> 
  
  <script src="js/script.js"></script>
   <script src="js/Ajout.js"></script>
   <script src="js/sibebar.js"></script>
  <script src="js/Supprimer_Info.js"></script>
  <script src="js/Modifier_info.js"></script>

</body>
</html>
