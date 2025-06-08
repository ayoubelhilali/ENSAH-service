<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php';

// Données pour le graphe par filière
$sql = "SELECT f.filiere_nom, COUNT(*) as total 
        FROM unite u 
        JOIN filiere f ON u.filiere_ID = f.filiere_ID 
        GROUP BY f.filiere_ID";
$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$labels = array_column($data, 'filiere_nom');
$values = array_column($data, 'total');

// Données pour le graphe affectées / non affectées
$sql_affectees = "SELECT COUNT(*) AS total_affectees
                  FROM unite
                  WHERE unite_ID IN (
                      SELECT id_unite FROM affect_ue_prof
                      UNION
                      SELECT unite_ID FROM affect_ue_vac
                  )";

$sql_non_affectees = "SELECT COUNT(*) AS total_non_affectees
                      FROM unite
                      WHERE unite_ID NOT IN (
                          SELECT id_unite FROM affect_ue_prof
                          UNION
                          SELECT unite_ID FROM affect_ue_vac
                      )";

$total_affectees = $pdo->query($sql_affectees)->fetchColumn();
$total_non_affectees = $pdo->query($sql_non_affectees)->fetchColumn();

$labels_affect = ['UE Affectées', 'UE Non Affectées'];
$values_affect = [$total_affectees, $total_non_affectees];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Reporting</title>
  <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/png"> 

  <!-- Fonts & Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css">
  <link rel="stylesheet" href="assets/fonts/feather.css">
  <link rel="stylesheet" href="assets/fonts/fontawesome.css">
  <link rel="stylesheet" href="assets/fonts/material.css">

  <!-- Styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/style-preset.css">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    .card {
      border-radius: 0.6rem !important;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .btn {
      transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .btn:hover {
      transform: scale(1.03);
    }
  </style>
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

  <!-- Loader -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- Sidebar & Header -->
  <?php
    $sidebarPath = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/chef-sidebar.php";
    $headerPath = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/header/header.php";

    if (file_exists($sidebarPath)) require_once($sidebarPath);
    if (file_exists($headerPath)) require_once($headerPath);
  ?>

  <!-- Contenu principal -->
  <div class="pc-container">
    <div class="pc-content">
      <div class="container py-4">
        <div class="row g-4 justify-content-center">

          <!-- Graphique Unités par Filière -->
          <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body">
                <h4 class="card-title text-center mb-4 text-primary">
                  Nombre d’unités d’enseignement par filière
                </h4>
                <canvas id="ueChart" height="280"></canvas>
                <div class="d-flex justify-content-center gap-3 mt-4">
                  <a href="export_excel_graph1.php" class="btn btn-success shadow-sm px-4">
                    <i class="ti ti-file-spreadsheet me-2"></i>Exporter Excel
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Graphique UE Affectées vs Non Affectées -->
          <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body">
                <h4 class="text-center mb-4 text-primary">Répartition des UE affectées</h4>
                <canvas id="uePieChart" height="280"></canvas>
                <div class="text-center mt-4">
                  <a href="export_excel_graph2.php" class="btn btn-success me-2">Exporter en Excel</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>  
    </div>
  </div>

  <!-- Chart JS -->
  <script>
    const ctx = document.getElementById('ueChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
          label: "Unités d'enseignement",
          data: <?php echo json_encode($values); ?>,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderRadius: 6,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#f8f9fa',
            titleColor: '#333',
            bodyColor: '#000'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const ctx2 = document.getElementById('uePieChart').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: <?php echo json_encode($labels_affect); ?>,
        datasets: [{
          data: <?php echo json_encode($values_affect); ?>,
          backgroundColor: ['#36A2EB', '#FF6384'],
          hoverOffset: 10
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });
  </script>
</body>
</html>
