<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<!-- [Head] start -->

<head>
  <title>ENSAH-service | Chef département </title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/png"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="assets/css/style-preset.css" >

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
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/chef-sidebar.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/header/header.php";

?>

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
                <h5 class="m-b-10">Home</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
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
            <div class="card-body">
              <h5 class="mb-2 f-w-400 text-muted">Total des unités d'enseignememt</h5>
              <h4 class="mb-0 mt-3">
                <?php
                   require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php' ;      
                    $sql = "SELECT COUNT(*) FROM unite" ;
                    $stmt = $pdo->query($sql); 
                    $nombre_unite = $stmt->fetchColumn();
                    echo htmlspecialchars($nombre_unite) ;     
                ?>
              </h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-2 f-w-400 text-muted">Total des unités d'enseignement réservées</h5>
              <h4 class="mb-0 mt-3">
                <?php 
                    $sql = "SELECT COUNT(*) FROM voeux WHERE status=1 " ;
                    $stmt = $pdo->query($sql); 
                    $nombre_unite_reserve = $stmt->fetchColumn();
                    echo htmlspecialchars($nombre_unite_reserve) ;     
                  ?>
              </h4>        
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
              <h4 class="mb-3">18,800 <span class="badge bg-light-warning border border-warning"><i
                    class="ti ti-trending-down"></i> 27.4%</span></h4>
              <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning">1,943</span> this year</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-2 f-w-400 text-muted">Total Sales</h6>
              <h4 class="mb-3">$35,078 <span class="badge bg-light-danger border border-danger"><i
                    class="ti ti-trending-down"></i> 27.4%</span></h4>
              <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span> this year
              </p>
            </div>
          </div>
        </div>

         <div class="pc-content">            
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                  <h4 class="mb-4">Unités d'enseignement appartenant au département </h4>

                    <div class="card table-card">
                        <div class="card-body">
                        
                               <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            
                                            <th rowspan="2">Unité d'enseignement</th>
                                            <th rowspan="2">Spécialité</th>
                                            <th rowspan="2">Responsable</th>
                                            <th colspan="3">Volume horaire</th>
                                            <th rowspan="2">Semestre</th>
                                             <th rowspan="2">Affecter un professeur</th>
                                       </tr>
                                        <tr>
                                           <th >Cours</th>
                                           <th>TD</th>
                                           <th>TP</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                      
                                       <?php 
                                         $sql = "SELECT * FROM unite u 
                                         JOIN filiere f ON f.filiere_ID=u.filiere_ID 
                                         JOIN departement d ON d.depart_ID=f.depart_ID 
                                         WHERE d.depart_ID=? " ;

                                         $stmt1 = $pdo->prepare($sql);
                               if($stmt1->execute([$_SESSION['user']['depart_id']])){
                                      $sql = "SELECT * FROM professeur p 
                                            JOIN filiere f ON f.filiere_ID=p.filiere_id 
                                            JOIN user u ON u.user_ID=p.user_ID 
                                            WHERE depart_ID=? " ;

                                            $stmt2 = $pdo->prepare($sql) ;
                                            $stmt2->execute([$_SESSION['user']['depart_id']]) ;

                                           

                                  while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                     $sql_aff = "SELECT u.nom, u.prenom,u.CIN, p.prof_ID 
                                             FROM affect_ue_prof a
                                             JOIN professeur p ON p.prof_ID = a.id_prof
                                             JOIN user u ON u.user_ID = p.user_ID
                                              WHERE a.id_unite = ?";

                                            $stmt3 = $pdo->prepare($sql_aff);
                                           $stmt3->execute([$row['unite_ID']]);
                                          $prof_affecte = $stmt3->fetch(PDO::FETCH_ASSOC);
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["unite_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["unite_specialite"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["unite_resp"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["volume_cours"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["volume_td"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["volume_tp"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["semestre"]) . "</td>";

    echo "<td>";
    if ($prof_affecte) {
    // Affichage du label + bouton modifier
    echo "<div class='d-flex align-items-center justify-content-between'>";
    echo "<span class='fw-bold'>" . htmlspecialchars($prof_affecte['nom']) . " " . htmlspecialchars($prof_affecte['prenom']) . "</span>";
    echo "<form method='POST' action='affecter_prof.php' class='ms-2 d-inline-flex'>";
    echo "<input type='hidden' name='id_unite' value='" . $row["unite_ID"] . "'>";
    echo "<select name='choix' class='form-select form-select-sm me-2' style='width:auto; display:none;' onchange='this.form.submit()'>";
    
    echo "<option value=''>--choisir--</option>";
    $stmt2->execute([$_SESSION['user']['depart_id']]);
    while ($row_prof = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $selected = $row_prof['prof_ID'] == $prof_affecte['prof_ID'] ? 'selected' : '';
        echo "<option value='" . $row_prof['prof_ID'] . "' $selected>" .
             htmlspecialchars($row_prof['nom']) . " " . htmlspecialchars($row_prof['prenom']) .
             " (" . htmlspecialchars($row_prof['CIN']) . ")</option>";
    }

    echo "</select>";
    echo "<button type='button' class='btn btn-sm btn-outline-primary' onclick='toggleSelect(this)'>Modifier</button>";
    echo "</form>";
    echo "</div>";
} else {
    // Affichage du formulaire normal (aucun prof affecté)
    echo "<form method='POST' action='affecter_prof.php' class='d-flex align-items-center'>";
    echo "<input type='hidden' name='id_unite' value='" . $row["unite_ID"] . "'>";
    echo "<select name='choix' class='form-select form-select-sm' style='width: auto;' required>";
    echo "<option value=''>--choisir--</option>";
    $stmt2->execute([$_SESSION['user']['depart_id']]);
    while ($row_prof = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row_prof['prof_ID'] . "'>" .
             htmlspecialchars($row_prof['nom']) . " " . htmlspecialchars($row_prof['prenom']) .
             " (" . htmlspecialchars($row_prof['CIN']) . ")</option>";
    }
    echo "</select>";
    echo "<button type='submit' class='btn btn-sm btn-primary ms-2'>Affecter</button>";
    echo "</form>";
}

    echo "</td>";

    echo "</tr>";
}

                                }                    
                                ?>
                               
                                    </tbody>
                                </table>
                            </div>
                            <form method="POST" action="export_unites.php" target="_blank" class="m-3">
  <button type="submit" class="btn btn-success">
      Exporter
  </button>
</form>

                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>

       <h4 class="mb-4 mt-5">Unités d'enseignement vacantes</h4>
       <div class="row">
       <?php
   $sql = "SELECT * FROM unite u 
          JOIN filiere f ON f.filiere_ID = u.filiere_ID 
          JOIN departement d ON d.depart_ID = f.depart_ID 
          WHERE d.depart_ID = ? 
          AND u.unite_ID NOT IN (
              SELECT id_unite FROM affect_ue_prof
          )
          AND u.unite_ID NOT IN (
              SELECT unite_ID FROM affect_ue_vac
          )";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user']['depart_id']]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.card-hover {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 0.75rem;
}

.card-hover:hover {
  transform: scale(1.02);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>

<div class="container">
  <div class="row">
    <?php if (!empty($rows)): ?>
      <?php foreach ($rows as $row): ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card card-hover h-100 border-0 bg-white shadow-sm rounded-3">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="card-title mb-0 text-primary fw-bold">
                  <?= htmlspecialchars($row["unite_name"]) ?>
                </h5>
              </div>
              <p class="mb-1"><strong>Spécialité :</strong> <?= htmlspecialchars($row["unite_specialite"]) ?></p>
              <p class="mb-1"><strong>Responsable :</strong> <?= htmlspecialchars($row["unite_resp"]) ?></p>
              <p class="mb-1"><strong>Semestre :</strong> <?= htmlspecialchars($row["semestre"]) ?></p>

              <hr>
              <div class="row text-center">
                <div class="col">
                  <small class="text-muted">Cours</small><br>
                  <strong><?= $row["volume_cours"] ?>h</strong>
                </div>
                <div class="col">
                  <small class="text-muted">TD</small><br>
                  <strong><?= $row["volume_td"] ?>h</strong>
                </div>
                <div class="col">
                  <small class="text-muted">TP</small><br>
                  <strong><?= $row["volume_tp"] ?>h</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-success text-center shadow-sm" role="alert">
          ✅ Toutes les unités d’enseignement du département sont déjà affectées.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

</div>
 
 
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">ENSAH-service &copy; 2025-All rights reserved </p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="../index.html">Home</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/mantis-bootstrap"
                                target="_blank">Documentation</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.authordesk.app/"
                                target="_blank">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> <!-- Required Js -->
    <script src="/ENSAH-service/assets/js/plugins/popper.min.js"></script>
    <script src="/ENSAH-service/assets/js/plugins/simplebar.min.js"></script>
    <script src="/ENSAH-service/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/ENSAH-service/assets/js/fonts/custom-font.js"></script>
    <script src="/ENSAH-service/assets/js/pcoded.js"></script>
    <script src="/ENSAH-service/assets/js/plugins/feather.min.js"></script>
    <script src="/ENSAH-service/assets/js/upload-image.js"></script>

    <script>layout_change('dark');</script>




    <script>change_box_container('false');</script>



    <script>layout_rtl_change('false');</script>


    <script>preset_change("preset-1");</script>


    <script>font_change("Public-Sans");</script>

    <script>
function loadContent(page) {
  fetch(page + ".php")  
    .then(response => response.text())
    .then(data => {
      document.getElementById("pc-container-unite").innerHTML = data;
    })
    .catch(error => {
      console.error("Erreur de chargement :", error);
    });
}

</script>

  <script>
function toggleSelect(button) {
    const form = button.closest("form");
    const select = form.querySelector("select");
    select.style.display = "inline-block";
    button.style.display = "none";
}
</script>

  
</body>
<!-- [Body] end -->

</html>