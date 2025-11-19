<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OÜme Admin Dashboard</title>
  
  <!-- LYNK Css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sibebar.css">
  
  <!-- Librairie Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Script principal -->
  <script defer src="js/script.js"></script>
  
  <!-- lynk Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h2 class="textorume">OrÜme</h2>
      <button class="hamburger" id="hamburger">
        <i class="fas fa-bars"></i>
      </button>
    </div>
    
    <nav class="menu">
      <a href="#" class="active">
        <span class="icon"><i class="fas fa-home"></i></span>
        <span class="text">Acceuil</span>
      </a>
      <a href="Messages.php">
        <span class="icon"><i class="fas fa-envelope"></i></span>
        <span class="text">Messages</span>
      </a>
      <a href="portfolio.php">
        <span class="icon"><i class="fas fa-briefcase"></i></span>
        <span class="text">Sites</span>
      </a>
      <a href="affiche.php">
        <span class="icon"><i class="fas fa-image"></i></span>
        <span class="text">Affiches</span>
      </a>
      <a href="identités.html">
        <span class="icon"><i class="fas fa-id-card icon"></i></span>
        <span class="text">Identités visuelles</span>
      </a>
      <a href="Shooting.html">
        <span class="icon"><i class="fa-solid fa-camera"></i></span>
        <span class="text">Shooting</span>
      </a>
      <a href="Quitter.html">
        <span class="icon"><i class="fa-solid fa-arrow-left"></i></span>
        <span class="text">Quitter</span>
      </a>
    </nav>
  </aside>

  <!-- Overlay : <div id="overlay" class="overlay"></div>-->

  <!-- Main -->
  <main class="main-content">
    <!-- Topbar -->
    <header class="topbar">
      <button class="hamburger" id="hamburger-top">
        <i class="fas fa-bars"></i>
      </button>
          <h1 class="titrePage">Acceuil</h1>
    </header>

    <!-- Welcome Section -->
    <section class="welcome">
      <h1>Bienvenue Admin Orume</h1>
      <p>dans votre espace de gestion. <strong></strong>.</p>
    </section>

    <!-- Charts Section -->
    <section class="charts">
      <div class="chart-card">
        <h3>Line Chart</h3>
        <canvas id="lineChart"></canvas>
      </div>
      <div class="chart-card">
        <h3>Bar Chart</h3>
        <canvas id="barChart"></canvas>
      </div>
      <div class="chart-card">
        <h3>Area Chart</h3>
        <canvas id="areaChart"></canvas>
      </div>
      <div class="chart-card">
        <h3>Doughnut Chart</h3>
        <canvas id="doughnutChart"></canvas>
      </div>
    </section>
  </main>

  <script src="js/script.js"></script>
  <script src="js/sibebar.js"></script>

</body>
</html>
