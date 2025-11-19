<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Identités visuelles - Orume Admin</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sibebar.css">
  <script defer src="js/script.js"></script>
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <h2>Orume</h2>
      <button class="toggle-btn">&#9776;</button>
    </div>
    <ul class="sidebar-menu">
      <li><a href="index.html">🏠 Dashboard</a></li>
      <li><a href="messages.html">💬 Messages</a></li>
      <li><a href="portfolio.html">📁 Portfolio</a></li>
      <li><a href="affiches.html">🖼️ Affiches</a></li>
      <li><a href="identites.html" class="active">🎨 Identités visuelles</a></li>
    </ul>
  </aside>

  <!-- Main -->
  <main class="main-content">
    <header class="topbar">
      <h1>Identités visuelles réalisées</h1>
      <div class="user-info">👤 Admin</div>
    </header>

    <section class="content grid">
      <?php
      // Charger les identités visuelles depuis la base de données
      require_once __DIR__ . '/../partials/connect.php';
      
      $identites = [];
      if (isset($connect) && $connect) {
          $query = "SELECT * FROM identites ORDER BY date_realisation DESC";
          $result = mysqli_query($connect, $query);
          if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $identites[] = $row;
              }
          }
      }
      
      // Afficher les identités
      if (!empty($identites)) {
          foreach ($identites as $identite) {
              $id = htmlspecialchars($identite['id'], ENT_QUOTES, 'UTF-8');
              $clientName = htmlspecialchars($identite['client_name'], ENT_QUOTES, 'UTF-8');
              $imagePath = htmlspecialchars($identite['image_path'], ENT_QUOTES, 'UTF-8');
              
              // Normaliser le chemin de l'image
              if (strpos($imagePath, 'images/') === 0) {
                  $imagePath = $imagePath;
              } elseif (strpos($imagePath, 'admin/images/') === 0) {
                  $imagePath = str_replace('admin/images/', 'images/', $imagePath);
              }
              ?>
              <div class="card" data-id="<?php echo $id; ?>">
                <img src="<?php echo $imagePath; ?>" alt="<?php echo $clientName; ?>" 
                     onerror="this.src='https://via.placeholder.com/300x180'; this.onerror=null;">
                <h3><?php echo $clientName; ?></h3>
                <p>Identité visuelle complète.</p>
              </div>
              <?php
          }
      } else {
          ?>
          <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <p>Aucune identité visuelle ajoutée pour le moment.</p>
          </div>
          <?php
      }
      ?>
    </section>
  </main>

</body>
</html>
