<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OÜme Admin Dashboard</title>
  
  <!-- LYNK Css -->
  <link rel="stylesheet" href="css/sidebar-unified.css">
  <link rel="stylesheet" href="css/style.css">
  
  <!-- Librairie Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- lynk Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php
  include 'adminpartials/aside.php';
?>

  <!-- Main -->
  <main class="main-content">
    <!-- Topbar -->
    <header class="topbar">
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

  <script src="js/sibebar.js"></script>
  <script src="js/active_sidebar.js"></script>
  
  <!-- Script pour initialiser les graphiques Chart.js -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Line Chart
      const lineCtx = document.getElementById('lineChart');
      if (lineCtx) {
        new Chart(lineCtx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
              label: 'Ventes',
              data: [12, 19, 3, 5, 2, 3],
              borderColor: '#05382c',
              tension: 0.1
            }]
          }
        });
      }

      // Bar Chart
      const barCtx = document.getElementById('barChart');
      if (barCtx) {
        new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
              label: 'Visites',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: '#f27c1e'
            }]
          }
        });
      }

      // Area Chart
      const areaCtx = document.getElementById('areaChart');
      if (areaCtx) {
        new Chart(areaCtx, {
          type: 'line',
          data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
              label: 'Revenus',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: 'rgba(5, 56, 44, 0.2)',
              borderColor: '#05382c',
              fill: true
            }]
          }
        });
      }

      // Doughnut Chart
      const doughnutCtx = document.getElementById('doughnutChart');
      if (doughnutCtx) {
        new Chart(doughnutCtx, {
          type: 'doughnut',
          data: {
            labels: ['Sites', 'Affiches', 'Identités', 'Shootings'],
            datasets: [{
              data: [30, 25, 20, 25],
              backgroundColor: ['#05382c', '#f27c1e', '#1e8b5a', '#0b7b4b']
            }]
          }
        });
      }
    });
  </script>

</body>
</html>
