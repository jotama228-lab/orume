<!DOCTYPE php>
<php lang="fr">
  <?php
     include'adminpartials/head.php'
 ?>


<body>

<?php
    include 'adminpartials/aside.php'
?>
  <!-- Main -->
  <main class="main-content">
    <header class="topbar">
      <h1>Messages</h1>
    </header>

    <!-- Cartes récap -->
    <section class="cards-summary">
      <div class="card green">
        <i class="fas fa-envelope-open-text"></i>
        <div>
          <h3>152</h3>
          <p>Mails reçus</p>
        </div>
      </div>
      <div class="card orange">
        <i class="fas fa-envelope"></i>
        <div>
          <h3>12</h3>
          <p>Mails non lus</p>
        </div>
      </div>
    </section>

    <!-- Liste des messages -->
    <section class="messages-list">
     <h2>Derniers messages</h2>
  <table>
    <thead>
      <tr>
        <th>Expéditeur</th>
        <th>Email</th>
        <th>Objet</th>
        <th>Message</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Jean Dupont</td>
        <td>jean.dupont@example.com</td>
        <td>Demande de devis</td>
        <td class="message-content">Bonjour, j’aimerais avoir un devis pour la 
          création d’un site vitrine.
        </td>
        <td>13 Oct 2025</td>
        <td><span class="badge unread">Non lu</span></td>
        <td class="actions">
          <button class="btn-reply" onclick="repondre('jean.dupont@example.com','Demande de devis')">
            <i class="fa-solid fa-reply"></i> Répondre
          </button>
          <button class="btn-delete" onclick="supprimerMessage(this)">
            <i class="fa-solid fa-trash"></i> Supprimer
          </button>
        </td>
      </tr>

      <tr>
        <td>Marie Togo</td>
        <td>marie.togo@gmail.com</td>
        <td>Collaboration possible</td>
        <td class="message-content">Bonjour, je souhaite collaborer avec votre agence sur un projet web.</td>
        <td>12 Oct 2025</td>
        <td><span class="badge read">Lu</span></td>
        <td class="actions">
          <button class="btn-reply" onclick="repondre('marie.togo@gmail.com','Collaboration possible')">
            <i class="fa-solid fa-reply"></i> Répondre
          </button>
          <button class="btn-delete" onclick="supprimerMessage(this)">
            <i class="fa-solid fa-trash"></i> Supprimer
          </button>
        </td>
      </tr>

      <tr>
        <td>Koffi Sena</td>
        <td>koffi.sena@outlook.com</td>
        <td>Demande identité visuelle</td>
        <td class="message-content">Salut, j’aimerais confier la création de mon logo à Orüme.</td>
        <td>10 Oct 2025</td>
        <td><span class="badge unread">Répondre</span></td>
        <td class="actions">
          <button class="btn-reply" onclick="repondre('koffi.sena@outlook.com','Demande identité visuelle')">
            <i class="fa-solid fa-reply"></i> Répondre
          </button>
          <button class="btn-delete" onclick="supprimerMessage(this)">
            <i class="fa-solid fa-trash"></i> Supprimer
          </button>
        </td>
      </tr>
    </tbody>
  </table>
    </section>
  </main>

  <script>
    // Sidebar responsive JS
    const sidebar = document.querySelector('.sidebar');
    const hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  </script>
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
  <script src="js/repondre.js"></script>

  
</body>
</php>
