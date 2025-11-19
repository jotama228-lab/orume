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
      <?php
      // Charger les statistiques depuis la base de données
      require_once __DIR__ . '/../partials/connect.php';
      
      $totalMessages = 0;
      $nonLus = 0;
      
      if (isset($connect) && $connect) {
          // Compter tous les messages
          $queryTotal = "SELECT COUNT(*) as total FROM messages";
          $resultTotal = mysqli_query($connect, $queryTotal);
          if ($resultTotal) {
              $row = mysqli_fetch_assoc($resultTotal);
              $totalMessages = $row['total'];
          }
          
          // Compter les messages non lus
          $queryNonLus = "SELECT COUNT(*) as total FROM messages WHERE statut = 'non_lu'";
          $resultNonLus = mysqli_query($connect, $queryNonLus);
          if ($resultNonLus) {
              $row = mysqli_fetch_assoc($resultNonLus);
              $nonLus = $row['total'];
          }
      }
      ?>
      <div class="card green">
        <i class="fas fa-envelope-open-text"></i>
        <div>
          <h3><?php echo $totalMessages; ?></h3>
          <p>Mails reçus</p>
        </div>
      </div>
      <div class="card orange">
        <i class="fas fa-envelope"></i>
        <div>
          <h3><?php echo $nonLus; ?></h3>
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
      <?php
      // Charger les messages depuis la base de données
      require_once __DIR__ . '/../partials/connect.php';
      
      $messages = [];
      if (isset($connect) && $connect) {
          $query = "SELECT * FROM messages ORDER BY created_at DESC";
          $result = mysqli_query($connect, $query);
          if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $messages[] = $row;
              }
          }
      }
      
      // Afficher les messages
      if (!empty($messages)) {
          foreach ($messages as $message) {
              $id = htmlspecialchars($message['id'], ENT_QUOTES, 'UTF-8');
              $nom = htmlspecialchars($message['nom'], ENT_QUOTES, 'UTF-8');
              $email = htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8');
              $sujet = htmlspecialchars($message['sujet'], ENT_QUOTES, 'UTF-8');
              $msg = htmlspecialchars(substr($message['message'], 0, 100), ENT_QUOTES, 'UTF-8');
              $date = date('d M Y', strtotime($message['created_at']));
              $statut = $message['statut'];
              
              $badgeClass = $statut === 'non_lu' ? 'unread' : ($statut === 'repondu' ? 'repondu' : 'read');
              $badgeText = $statut === 'non_lu' ? 'Non lu' : ($statut === 'repondu' ? 'Répondu' : 'Lu');
              ?>
              <tr data-id="<?php echo $id; ?>">
                <td><?php echo $nom; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $sujet; ?></td>
                <td class="message-content"><?php echo $msg; ?><?php echo strlen($message['message']) > 100 ? '...' : ''; ?></td>
                <td><?php echo $date; ?></td>
                <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $badgeText; ?></span></td>
                <td class="actions">
                  <button class="btn-reply" onclick="repondre('<?php echo $email; ?>','<?php echo $sujet; ?>')">
                    <i class="fa-solid fa-reply"></i> Répondre
                  </button>
                  <button class="btn-delete" onclick="supprimerMessage(<?php echo $id; ?>)">
                    <i class="fa-solid fa-trash"></i> Supprimer
                  </button>
                </td>
              </tr>
              <?php
          }
      } else {
          ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 20px;">
              Aucun message pour le moment.
            </td>
          </tr>
          <?php
      }
      ?>
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
  <script>
    // Fonction pour supprimer un message
    function supprimerMessage(id) {
      if (confirm("Voulez-vous vraiment supprimer ce message ?")) {
        fetch(`api/delete_message.php?id=${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            // Supprimer la ligne du tableau
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
              row.style.transition = 'opacity 0.3s';
              row.style.opacity = '0';
              setTimeout(() => row.remove(), 300);
            }
            alert('Message supprimé avec succès');
            // Recharger la page pour mettre à jour les statistiques
            setTimeout(() => window.location.reload(), 500);
          } else {
            alert('Erreur : ' + data.message);
          }
        })
        .catch(err => {
          console.error('Erreur :', err);
          alert('Une erreur est survenue lors de la suppression.');
        });
      }
    }
  </script>

  
</body>
</php>
