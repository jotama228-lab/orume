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

      <!-- CARTES D'AFFICHES -->
      <div class="portfolio-grid" id="afficheContainer">
        <?php
        // Charger les affiches depuis la base de données
        require_once __DIR__ . '/../partials/connect.php';
        
        $affiches = [];
        if (isset($connect) && $connect) {
            $query = "SELECT * FROM affiches ORDER BY date_realisation DESC";
            $result = mysqli_query($connect, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $affiches[] = $row;
                }
            }
        }
        
        // Afficher les affiches
        if (!empty($affiches)) {
            foreach ($affiches as $affiche) {
                $id = htmlspecialchars($affiche['id'], ENT_QUOTES, 'UTF-8');
                $clientName = htmlspecialchars($affiche['client_name'], ENT_QUOTES, 'UTF-8');
                $date = date('F Y', strtotime($affiche['date_realisation']));
                $imagePath = htmlspecialchars($affiche['image_path'], ENT_QUOTES, 'UTF-8');
                
                // Normaliser le chemin de l'image
                if (strpos($imagePath, 'images/') === 0) {
                    $imagePath = $imagePath;
                } elseif (strpos($imagePath, 'admin/images/') === 0) {
                    $imagePath = str_replace('admin/images/', 'images/', $imagePath);
                }
                ?>
                <div class="portfolio-card" data-id="<?php echo $id; ?>">
                  <img src="<?php echo $imagePath; ?>" alt="Affiche <?php echo $clientName; ?>" class="portfolio-img">
                  <div class="portfolio-info">
                    <h3>Client : <?php echo $clientName; ?></h3>
                    <p><i class="fa-solid fa-calendar"></i> Date : <?php echo $date; ?></p>
                    <div class="portfolio-actions">
                      <button class="btn-edit" data-id="<?php echo $id; ?>"><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                      <button class="btn-delete" data-id="<?php echo $id; ?>"><i class="fa-solid fa-trash"></i> Supprimer</button>
                    </div>
                  </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
              <p>Aucune affiche ajoutée pour le moment.</p>
            </div>
            <?php
        }
        ?>
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
