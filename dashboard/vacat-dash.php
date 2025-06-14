<?php
session_start();
if (!isset($_SESSION['user'])) {
  // Redirect to login if not authenticated
  header('Location: ../login.php');
  exit();
}
if ($_SESSION['user']['role'] !== 'vacataire') {
  // Redirect to unauthorized access page if not an admin
  header('Location: /ENSAH-service/login.php');
  exit();
}
include('../inc/functions/connections.php');
// global data
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Home | ENSAH-service</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description"
    content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords"
    content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">
  <!-- [Favicon] icon -->
  <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/x-icon">
  <!-- [Google Font] Family -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style-preset.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/css/main.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] start -->
  <?php require_once(__DIR__ . "/../inc/sidebar/vacat-sidebar.php"); ?>
  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <?php require_once(__DIR__ . "/../inc/header/header.php"); ?>
  <!-- [ Header ] end -->
  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ENSAH-service/dashboard/admin-dash.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->

        <div class="col-md-6 col-xl-3">
          <div class="card " style="background-color:rgb(188, 196, 255);border-radius: 0.375rem;">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span
                  class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa-solid fa-users fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des vacataires</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `vacataire`";
                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="card " style="background-color:rgb(207, 207, 207);border-radius: 0.375rem;">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span
                  class="bg-secondary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-notes"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M9 7l6 0" /><path d="M9 11l6 0" /><path d="M9 15l4 0" /></svg>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des vacants</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `unite` where filiere_ID=:filiereID and not EXISTS (SELECT * FROM affect_ue_vac WHERE affect_ue_vac.unite_ID = unite.unite_ID)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':filiereID', $filiere_ID, PDO::PARAM_INT);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="card " style="background-color: #d4edda;">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span
                  class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa-solid fa-graduation-cap fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Les unités affectées</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM affect_ue_vac A join unite U on A.unite_ID=U.unite_ID  join filiere F on F.filiere_ID=U.filiere_ID  where A.vacataire_ID = :vacataire_ID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':vacataire_ID', $_SESSION['user']['vacat_ID'], PDO::PARAM_INT);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card " style="background-color: #f8d7da;border-radius: 0.375rem;">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span
                  class="bg-danger bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stopwatch"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a7 7 0 1 0 14 0a7 7 0 0 0 -14 0z" /><path d="M14.5 10.5l-2.5 2.5" /><path d="M17 8l1 -1" /><path d="M14 3h-4" /></svg>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total de volume horaire</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT SUM(volume_cours + volume_td + volume_tp) FROM affect_ue_vac A join unite U on A.unite_ID=U.unite_ID  join filiere F on F.filiere_ID=U.filiere_ID  where A.vacataire_ID = :vacataire_ID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':vacataire_ID', $_SESSION['user']['vacat_ID'], PDO::PARAM_INT);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                echo $count . " h";
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-8">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="card" style="width:100%">
              <div class="card-header">
                <h5>Les volumes horaires</h5>
              </div>
              <div class="card-body">
                <div id="bar-chart-2"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-4">
          <h5 class="mb-3">Les annonces</h5>
          <div class="card p-3 shadow-sm border-0">
            <?php
            $sql = "SELECT * FROM annonces ORDER BY annonce_date DESC LIMIT 4";
            $stmt = $pdo->query($sql);
            $annonceCount = 0; // Use a counter for optimization
            
            while ($annonce = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $annonceCount++;
              ?>
                <div class="mb-4 pb-3 border-bottom">
                  <div class="d-flex justify-content-between align-items-start">
                    <h6 class="mb-1 text-primary"><i class="ti ti-speakerphone"></i>
                      <?= htmlspecialchars($annonce["annonce_head"]) ?></h6>
                    <small class="text-muted"><?= date("d M Y H:i", strtotime($annonce["annonce_date"])) ?></small>
                  </div>
                  <p class="mb-0 text-secondary">
                    <?= (strlen($annonce['annonce_body']) > 50) ? substr(htmlspecialchars($annonce['annonce_body'], ENT_QUOTES, 'UTF-8'), 0, 50) . ' . . .' : htmlspecialchars($annonce['annonce_body'], ENT_QUOTES, 'UTF-8') ?>
                  </p>
                </div>
                <?php
            }

            if ($annonceCount === 0) { // Check the counter
              echo '<p class="text-muted">Aucune annonce pour le moment.</p>';
            }
            ?>
            <div class="text-center py-2" style="padding: 0;">
              <a href="/ENSAH-service/pages/annonces-list.php" class="link-primary">View all</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">ENSAH-service &copy; 2025 All rights reserved</p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-link mb-0">
            <li class="list-inline-item"><a href="/ENSAH-service/">Home</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- [ Chart script ] -->
  <!-- [Page Specific JS] start -->
  <script src="/ENSAH-service/assets/js/plugins/apexcharts.min.js"></script>
  <script src="/ENSAH-service/assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="/ENSAH-service/assets/js/plugins/popper.min.js"></script>
  <script src="/ENSAH-service/assets/js/plugins/simplebar.min.js"></script>
  <script src="/ENSAH-service/assets/js/plugins/bootstrap.min.js"></script>
  <script src="/ENSAH-service/assets/js/fonts/custom-font.js"></script>
  <script src="/ENSAH-service/assets/js/pcoded.js"></script>
  <script src="/ENSAH-service/assets/js/plugins/feather.min.js"></script>
  <script src="/ENSAH-service/assets/js/users-chart.js"></script>






  <script>layout_change('light');</script>




  <script>change_box_container('false');</script>



  <script>layout_rtl_change('false');</script>


  <script>preset_change("preset-1");</script>


  <script>font_change("Public-Sans");</script>

</body>
<!-- [Body] end -->

</html>