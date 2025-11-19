<!DOCTYPE html>
<html lang="fr">

<?php
    include'adminpartials/head.php'
?>


<body>
 <?php
     include'adminpartials/aside.php'
 ?>

  <!-- Contenu principal -->
  <main class="main-content">
    <header class="topbar">
      <h1 class="titrepage">Affiches</h1>
    </header>

    <section class="portfolio">
      <h1 class="portfolio-title">Ajouter une Affiche</h1>

      <!-- FORMULAIRE D’AJOUT -->
      <div class="portfolio-header">
        <form id="afficheForm" class="portfolio-form">
          <div class="form-group">
            <label for="clientAffiche">Nom du client</label>
            <input type="text" id="clientAffiche" placeholder="Ex: Maison Luxe" required>
          </div>

          <div class="form-group">
            <label for="dateAffiche">Date de réalisation</label>
            <input type="month" id="dateAffiche" required>
          </div>

          <div class="form-group">
            <label for="imageAffiche">Image de l’affiche</label>
            <input type="file" id="imageAffiche" accept="image/*" required>
          </div>

          <button type="submit" id="addAfficheBtn" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Enregistrer
          </button>
        </form>
      </div>

      <!-- SECTION AFFICHES AJOUTÉES -->
      <section>
        <h1 class="portfolio-title">Affiches Réalisées</h1>
      </section>

      <!-- CARTES D’AFFICHES -->
      <div class="portfolio-grid" id="afficheContainer">
        
        <!-- Affiche 1 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/Agrocore.jpeg" alt="Affiche Client 1" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Agrocore</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Février 2024</p>
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

        <!-- Affiche 2 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/SkincareBrand.jpeg" alt="Affiche Client 2" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Skincare Brand</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Mars 2024</p>
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

        <!-- Affiche 3 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/Coffee shop drink.jpeg" alt="Affiche Client 3" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Café Aroma</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Avril 2024</p>
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

        <!-- Affiche 4 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/StudioFlyer.jpeg" alt="Affiche Client 4" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Studio Vision</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Mai 2024</p>
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

        <!-- Affiche 5 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/urban grill.jpeg" alt="Affiche Client 5" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Urban grill</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Juin 2024</p>
            <div class="portfolio-actions">
              <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
              <button class="btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</button>
            </div>
          </div>
        </div>

        <!-- Affiche 6 -->
        <div class="portfolio-card">
          <img src="images/Admin/affiches/Affiche6.jpg" alt="Affiche Client 6" class="portfolio-img">
          <div class="portfolio-info">
            <h3>Client : Decus</h3>
            <p><i class="fa-solid fa-calendar"></i> Date : Juillet 2024</p>
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


  <!-- MODAL DE MODIFICATION -->
  <div id="editModalAffiche" class="edit-modal">
    <div class="edit-modal-content">
      <span class="close-edit">&times;</span>
      <h2>Modifier une Affiche</h2>

      <form id="editAfficheForm">
        <div class="form-group">
          <label for="editClientAffiche">Nom du client</label>
          <input type="text" id="editClientAffiche" required>
        </div>

        <div class="form-group">
          <label for="editDateAffiche">Date de réalisation</label>
          <input type="month" id="editDateAffiche" required>
        </div>

        <div class="form-group">
          <label for="editEmailAffiche">Email / Contact</label>
          <input type="text" id="editEmailAffiche" required>
        </div>

        <div class="form-group">
          <label for="editImageAffiche">Changer l’image (optionnel)</label>
          <input type="file" id="editImageAffiche" accept="image/*">
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
  
  <!-- SCRIPTS -->
  <script src="js/sibebar.js"></script>
  <script src="js/modifier_info_affiche.js"></script>
  <script src="js/Supprimer_affiche.js"></script>
</body>
</html>
