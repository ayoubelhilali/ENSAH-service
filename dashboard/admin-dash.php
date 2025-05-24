<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  // Redirect to login if not authenticated
  header('Location: /ENSAH-service/login.php');

  exit();
}
include('../inc/functions/connections.php');
$sql = "SELECT COUNT(*) FROM `user`";
$stmt = $pdo->query($sql);
$count = $stmt->fetchColumn();
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
  <?php require_once __DIR__ . "/../inc/sidebar/admin-sidebar.php"; ?>
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
          <div class="card">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa fa-users fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des employés</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `user`";
                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card ">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa fa-users fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des professeurs</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `professeur`";
                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card ">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa-solid fa-graduation-cap fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des filieres</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `filiere`";
                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body d-flex align-items-center">
              <div class="me-3">
                <span class="bg-warning bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center"
                  style="width:48px; height:48px;">
                  <i class="fa-solid fa-school fa-lg"></i>
                </span>
              </div>
              <div>
                <h6 class="mb-1 f-w-400 text-muted">Total des départements</h6>
                <h4 class="mb-0"><?php
                $sql = "SELECT COUNT(*) FROM `departement`";
                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                echo $count;
                ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-8">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="card" style="width:100%">
              <div class="card-header">
                <h5>Les personnels</h5>
              </div>
              <div class="card-body">
                <div id="bar-chart-1"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-4">
          <h5 class="mb-3">Les annonces</h5>
          <div class="card p-3 shadow-sm border-0 annonces-card">
            <?php
            $sql = "SELECT * FROM `annonces` ORDER BY annonce_date DESC limit 4";
            $stmt = $pdo->query($sql);
            $hasAnnonces = false;

            while ($annonce = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $hasAnnonces = true;
              ?>
              <div class="mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                  <h6 class="mb-1 text-primary"><i class="ti ti-speakerphone"></i>
                    <?= htmlspecialchars($annonce["annonce_head"]) ?></h6>
                  <small class="text-muted"><?= date("d M Y H:i", strtotime($annonce["annonce_date"])) ?></small>
                </div>
                <p class="mb-0 text-secondary"><?= nl2br(htmlspecialchars($annonce["annonce_body"])) ?></p>
              </div>
              <?php
            }

            if (!$hasAnnonces) {
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
            <li class="list-inline-item"><a href="/ENSAH-service/dashboard/admin-dash.php">Home</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- [Page Specific JS] start -->
  <script src="/ENSAH-service/assets/js/plugins/apexcharts.min.js"></script>
  <script src="/ENSAH-service/assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../assets/js/pages/chart-apex.js"></script>
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