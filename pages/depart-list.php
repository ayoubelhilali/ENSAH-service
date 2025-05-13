<?php if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>ENSAH-service | chef des departements</title>
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
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style-preset.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] start -->
  <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/sidebar/admin-sidebar.php") ?>
  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/header/header.php") ?>
  <!-- [ Header ] end -->
  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Les départements</a></li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">List des départements</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-0">
                <a href="#" class="btn btn-primary d-inline-flex align-item-center" data-bs-toggle="modal"
                  data-bs-target="#depart-add-modal">
                  <i class="ti ti-plus f-18"></i> Ajouter
                </a>
                <div class="success-msg">
                  <?php
                  if (isset($_SESSION["success_message"])) {
                    echo "<div class='alert alert-success'>" . $_SESSION["success_message"] . "</div>";
                    unset($_SESSION["success_message"]);
                  }
                  ?>
                </div>
                <div class="error-msg">
                  <?php
                  if (isset($_SESSION["error_message"])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
                    unset($_SESSION["error_message"]);
                  }
                  ?>
                </div>
              </div>
              <div class="table-responsive" style="margin-top: 20px;">
                <div class="accordion" id="departements">
                  <?php
                  $departs = "SELECT * FROM `departement` P";
                  $all_departs = $pdo->query($departs);
                  if ($all_departs) {
                    while ($depart = $all_departs->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <?php
                      // Get the chef of the current department
                      $chef_query = "SELECT * FROM chef_depart C 
                      JOIN professeur P ON C.prof_ID = P.prof_ID
                      JOIN user U ON P.user_ID = U.user_ID
                      WHERE C.depart_ID = :depart_id";
                      $stmt = $pdo->prepare($chef_query);
                      $stmt->execute(['depart_id' => $depart['depart_ID']]);
                      $chef_row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                      // Get all filieres for the current department
                      $filiere_query = "SELECT * FROM filliere F WHERE F.depart_ID = " . $depart['depart_ID'];
                      $all_filiere = $pdo->query($filiere_query);
                      $filieres = [];
                      // get all filieres without depart
                      $filiere_query = "SELECT * FROM filliere F WHERE F.depart_ID IS NULL";
                      $stmt = $pdo->prepare($filiere_query);
                      $stmt->execute();
                      $all_filiere_without_depart = $stmt;
                      $filieres_nodepart = [];
                      while ($row = $all_filiere_without_depart->fetch(PDO::FETCH_ASSOC)) {
                        $filieres_nodepart[] = $row['filliere_nom'];
                      }
                      // Get all profs from database
                      $profs_query = "SELECT * FROM professeur P
                      JOIN user U ON P.user_ID = U.user_ID
                      WHERE P.prof_ID NOT IN (SELECT prof_ID FROM chef_depart WHERE depart_ID = :depart_id)";
                      $stmt = $pdo->prepare($profs_query);
                      $stmt->execute(['depart_id' => $depart['depart_ID']]);
                      $all_profs = $stmt;
                      $profs = [];
                      while ($prof = $all_profs->fetch(PDO::FETCH_ASSOC)) {
                        $profs[] = [
                          'prof_ID' => $prof['prof_ID'],
                          'nom' => $prof['nom'],
                          'prenom' => $prof['prenom'],
                          'email' => $prof['email']
                        ];
                      }
                      $profs_json = htmlspecialchars(json_encode($profs), ENT_QUOTES, 'UTF-8');
                      ?>
                      <!-- First Department -->
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="depart<?php echo $depart['depart_ID']; ?>">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#dep<?php echo $depart['depart_ID']; ?>">
                            <?php echo $depart['depart_nom']; ?>
                          </button>
                        </h2>
                        <div id="dep<?php echo $depart['depart_ID']; ?>" class="accordion-collapse collapse"
                          data-bs-parent="#departements">
                          <div class="accordion-body departement-content"
                            style="display: flex; justify-content: space-between;">
                            <div class="chef-dep">
                              <strong>Chef du département:</strong><br>
                              <?php if ($chef_row) { ?>
                                <div class="d-flex align-items-center" style="margin: 20px;">
                                  <img
                                    src="<?php echo isset($chef_row["image"]) && !empty($chef_row["image"]) ? $chef_row["image"] : '/ENSAH-service/assets/images/avatar-M.jpg'; ?>"
                                    alt="Chef du département" class="rounded-circle img-fluid wid-60 me-3"
                                    style="width: 50px;">
                                  <div style="display: flex; flex-direction: column;justify-content: center;">
                                    <h5 class="mb-0"><?php echo $chef_row["nom"] . " " . $chef_row["prenom"]; ?></h5>
                                    <p class="text-muted text-sm" style="margin: 0;">Professeur Associé</p>
                                  </div>
                                </div>
                                <button class="btn btn-danger btn-sm add-fil-dep remove-user"
                                  onclick="deleteChef(<?= $depart['depart_ID']; ?>)"
                                  data-chef="<?php echo $chef_row["chef_ID"] ?>">supprimer</button>
                              <?php } else { ?>
                                <p>le département n'a aucun chef</p>
                                <a href="#" class="btn btn-success btn-sm add-chef-dep" data-bs-toggle="modal"
                                  data-bs-target="#chef-add-modal" data-profs="<?= $profs_json ?>"
                                  data-depart="<?php echo $depart['depart_nom']; ?>">
                                  Ajouter
                                </a>
                              <?php } ?>
                            </div>
                            <div class="filliere-dep">
                              <strong>Filières : </strong>
                              <ul style="margin-top: 10px;list-style: none; padding: 0;">
                                <?php

                                if ($all_filiere) {
                                  while ($row = $all_filiere->fetch(PDO::FETCH_ASSOC)) {
                                    $filieres[] = $row['filliere_nom'];
                                    ?>
                                    <li><a href="" class="btn btn-outline-primary"
                                        style="width: 100%;margin-bottom:5px"><?php echo $row['filliere_nom']; ?></a></li>
                                  <?php }
                                } else { ?>
                                  <li>Aucune filière trouvée</li>
                                <?php }
                                $filieres_json = htmlspecialchars(json_encode($filieres), ENT_QUOTES, 'UTF-8');
                                $filieres_nodepart_json = htmlspecialchars(json_encode($filieres_nodepart), ENT_QUOTES, 'UTF-8');
                                ?>

                              </ul>
                              <a href="#" class="btn btn-success btn-sm add-fil-dep" data-bs-toggle="modal"
                                data-bs-target="#fil-add-modal" data-filiere="<?= $filieres_nodepart_json ?>"
                                data-depart="<?php echo $depart['depart_nom']; ?>">
                                Ajouter
                              </a>
                            </div>
                            <div class="view-departement">
                              <button class="btn btn-outline-primary view-btn" data-bs-toggle="modal"
                                data-bs-target="#user-modal" data-nomDep="<?= $depart['depart_nom']; ?>"
                                data-nomChef="<?php echo isset($chef_row["nom"]) && !empty($chef_row["nom"]) ? $chef_row["nom"] : 'département sans chef'; ?>"
                                data-email="<?php echo isset($chef_row["chef_email"]) && !empty($chef_row["chef_email"]) ? $chef_row["chef_email"] : '--'; ?>"
                                data-img="<?php echo isset($chef_row["image"]) && !empty($chef_row["image"]) ? $chef_row["image"] : '/ENSAH-service/assets/images/avatar-M.jpg'; ?>"
                                data-bio="<?= $depart['depart_details']; ?>" data-filiere="<?= $filieres_json ?>"
                                data-phone="<?= (isset($chef_row['Phone']) && $chef_row['Phone'] != "0") ? $chef_row['Phone'] : '(+212)  - - - - - - - - -   '; ?>"
                                data-linkedin="<?php echo isset($chef_row["linkedin"]) && !empty($chef_row["linkedin"]) ? $chef_row["linkedin"] : '#'; ?>">Voir
                                plus</button><br>
                              <button class="btn btn-warning btn-sm edit-btn"
                                style="width: 100%; height: 40px;margin-top:5px;border-radius:5px;">Modifier</button><br>
                              <button class="btn btn-danger btn-sm delete-btn"
                                onclick="deleteDep(<?= $depart['depart_ID']; ?>)"
                                style="width: 100%; height: 40px;margin-top:5px;border-radius:5px;">Supprimer</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }
                  } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <div class="modal fade" id="user-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0">
          <h5 class="mb-0">Détails du département</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Colonne gauche : infos principales -->
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body position-relative">
                  <div class="position-absolute end-0 top-0 p-3">
                    <span class="badge bg-primary">chef du département</span>
                  </div>
                  <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto">
                      <img id="modal-img" class="rounded-circle img-fluid wid-60" src="" alt="User image">
                    </div>
                    <h5 class="mb-0" id="modal-nom"></h5>
                    <p class="text-muted text-sm" id="modal-poste"></p>
                    <hr class="my-3">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-mail"></i>
                      <p class="mb-0" id="modal-email"></p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-phone"></i>
                      <p class="mb-0" id="modal-phone">--</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                      <i class="ti ti-brand-linkedin"></i>
                      <a href="#" class="link-primary" id="modal-linkedin">
                        <p class="mb-0">--</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Colonne droite : détails personnels -->
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h5>Détails du département</h5>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Nom du département</p>
                          <h6 class="mb-0" id="modal-fullname"></h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                      <p class="mb-1 text-muted">Filières</p>
                      <ul class="mb-0 modal-filieres">
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h5>À propos</h5>
                </div>
                <div class="card-body">
                  <p class="mb-0" id="modal-about">
                    <?php ?>
                    -- À propos du département --
                  </p>
                </div>
              </div>
            </div>
          </div> <!-- /row -->
        </div> <!-- /modal-body -->
      </div> <!-- /modal-content -->
    </div> <!-- /modal-dialog -->
  </div>

  <form method="post" action="/ENSAH-service/inc/functions/add-depart.php" class="modal fade" id="depart-add-modal"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Ajouter Département</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Nom du Département</label>
                <input type="text" name="depart_nom" class="form-control" placeholder="Nom du Département" required>
              </div>
              <div class="form-group">
                <label class="form-label">Détails du Département</label>
                <textarea name="depart_details" class="form-control" id=""
                  placeholder="Détails du Département"></textarea>
              </div>
              <div class="form-group">
                <label class="form-label">Chef du Département</label>
                <select name="chef_id" class="form-select" required>
                  <option disabled selected>choisir chef</option>
                  <option>ELHILALI ayoub</option>
                  <option>LAMAIZI amin</option>
                  <option>BABou EL hassane</option>
                </select>
              </div>
              <hr class="my-3">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <ul class="list-inline me-auto mb-0">
            <li class="list-inline-item align-bottom">
              <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip" title="Delete">
                <i class="ti ti-trash f-18"></i>
              </a>
            </li>
          </ul>
          <div class="flex-grow-1 text-end">
            <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="add-depart" class="btn btn-primary">Ajouter</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <form method="post" action="/ENSAH-service/inc/functions/add-chef-dep.php" class="modal fade" id="chef-add-modal"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Ajouter chef du departement</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Nom du Département</label>
                <input type="text" name="depart_nom" class="form-control dep-nom" placeholder="Nom du Département"
                  required readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Chef du Département</label>
                <select name="chef_depart" class="form-select" id="modal-profs" required>
                  <option disabled selected>Choisir Chef</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Email du chef</label>
                <input type="email" name="chef_email" class="form-control" placeholder="Email du chef" required
                  id="chef_email">
              </div>
              <div class="form-group">
                <label class="form-label">Password du chef</label>
                <div style="position: relative;">
                  <input name="chef_password" type="text" placeholder="Enter password"
                    class="form-control passwordInput" style="padding-right: 40px;" required>
                  <i class="fas fa-sync-alt generateBtn"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
              </div>
              <p style="color: red;" class="error_msg"></p>
              <hr class="my-3">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <ul class="list-inline me-auto mb-0">
            <li class="list-inline-item align-bottom">
              <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip" title="Delete">
                <i class="ti ti-trash f-18"></i>
              </a>
            </li>
          </ul>
          <div class="flex-grow-1 text-end">
            <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="add-depart" class="btn btn-primary">Ajouter</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <form method="post" action="/ENSAH-service/inc/functions/add-fil-dep.php" class="modal fade" id="fil-add-modal"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Ajouter filiere au departement</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Nom du Département</label>
                <input type="text" name="depart_nom" class="form-control dep-nom" placeholder="Nom du Département"
                  required readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Choisir la filiere</label>
                <select name="fil_depart" class="form-select modal-fil" id="modal-fil" required>
                  <option disabled selected>Choisir filiere</option>
                </select>
              </div>
              <p style="color: red;" class="error_msg"></p>
              <hr class="my-3">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <ul class="list-inline me-auto mb-0">
            <li class="list-inline-item align-bottom">
              <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip" title="Delete">
                <i class="ti ti-trash f-18"></i>
              </a>
            </li>
          </ul>
          <div class="flex-grow-1 text-end">
            <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="add-filiere" class="btn btn-primary">Ajouter</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- [ Main Content ] end -->
  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">ENSAH-service &copy; tous droits sont réservés</p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-link mb-0">
            <li class="list-inline-item"><a href="/ENSAH-service/dashboard/admin-dash.php">Home</a></li>
            <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/mantis-bootstrap"
                target="_blank">Documentation</a></li>
            <li class="list-inline-item"><a href="https://codedthemes.authordesk.app/" target="_blank">Support</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer> <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>
  <script>
    document.querySelectorAll('.view-btn').forEach(button => {
      button.addEventListener('click', () => {
        document.getElementById('modal-img').src = button.getAttribute('data-img');
        const nomChef = button.getAttribute('data-nomChef');
        document.getElementById('modal-nom').textContent = nomChef && nomChef.trim() !== '' ? nomChef : 'Département sans chef';
        document.getElementById('modal-email').textContent = button.getAttribute('data-email');
        document.getElementById('modal-fullname').textContent = button.getAttribute('data-nomDep');
        document.getElementById('modal-about').textContent = button.getAttribute('data-bio');
        const linkedinUrl = button.getAttribute('data-linkedin');
        document.getElementById('modal-linkedin').href = linkedinUrl;

        const filiereData = button.getAttribute('data-filiere');
        const filiereList = document.querySelectorAll('.modal-filieres');
        filiereList.innerHTML = ''; // Clear existing list
        try {
          const filieres = JSON.parse(filiereData); // Parse JSON string
          filieres.forEach(filiere => {
            const li = document.createElement('li');
            li.textContent = filiere;
            filiereList.forEach(element => {
              element.appendChild(li);
            });
          });
        } catch (error) {
          console.error('Invalid filiere data:', error);
        }

      });
    });
    // add chef to a departeement
    document.querySelectorAll(".add-chef-dep").forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.dep-nom').forEach(element => {
          element.value = button.getAttribute('data-depart');
        });
        const profsData = button.getAttribute('data-profs');
        const profsList = document.getElementById('modal-profs');
        try {
          const profs = JSON.parse(profsData); // Parse JSON string
          profs.forEach(prof => {
            const option = document.createElement('option');
            option.textContent = prof.nom + " " + prof.prenom; // Set the text of the option to the professor's name
            option.value = prof.prof_ID; // Set the value of the option to the professor's ID
            profsList.appendChild(option);
          });
        } catch (error) {
          console.error('Invalid profs data:', error);
        }
      })
    });
    // add filiere to a departeement
    document.querySelectorAll(".add-fil-dep").forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.dep-nom').forEach(element => {
          element.value = button.getAttribute('data-depart');
        });
        const filiereData = button.getAttribute('data-filiere');
        const filiereList = document.querySelectorAll('.modal-fil');
        filiereList.forEach(element => {
          const firstOption = element.querySelector('option:first-child');
          element.innerHTML = ''; // Clear existing list
          if (firstOption) {
            element.appendChild(firstOption); // Keep the first option
            firstOption.selected = true; // Make the first option selected
          }
        });
        try {
          const filieres = JSON.parse(filiereData); // Parse JSON string
          filieres.forEach(filiere => {
            const option = document.createElement('option');
            option.textContent = filiere;
            filiereList.forEach(element => {
              element.appendChild(option);
            });
          });
        } catch (error) {
          console.error('Invalid filiere data:', error);
        }
      })
    });
  </script>
  <script>layout_change('light');</script>
  <script>change_box_container('false');</script>
  <script>layout_rtl_change('false');</script>

  <script>preset_change("preset-1");</script>

  <script>font_change("Public-Sans");</script>
  <!------------ Supprimer le chef d'un departement   ------------->
  <script>
    function deleteChef(departID) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce chef ?")) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.style.display = 'none';

        const input = document.createElement('input');
        input.name = 'delete_chef';
        input.value = departID;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
  <?php
  function deleteChef($departID)
  {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM chef_depart WHERE depart_ID = :depart_id");
    $stmt->execute(['depart_id' => $departID]);
    return $stmt->rowCount() > 0;
  }

  if (isset($_POST['delete_chef'])) {
    $depart_id = $_POST['delete_chef'];
    if (deleteChef($depart_id)) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '<div class=\"alert alert-success\">Chef supprimé avec succès.</div>';
                  }
                  window.location.reload();
              });
            </script>";
    }
  }
  ?>
  <!------------ Supprimer un departement   ------------->
  <script>
    function deleteDep(departID) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce département ?")) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.style.display = 'none';

        const input = document.createElement('input');
        input.name = 'delete_dep';
        input.value = departID;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
  <?php
  function deleteDep($departID)
  {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM departement WHERE depart_ID = :depart_id");
    $stmt->execute(['depart_id' => $departID]);
    return $stmt->rowCount() > 0;
  }

  if (isset($_POST['delete_dep'])) {
    $depart_id = $_POST['delete_dep'];
    if (deleteDep($depart_id)) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '<div class=\"alert alert-success\">departement supprimé avec succès.</div>';
                  window.location.reload();
                }
              });
            </script>";
    }
  }
  ?>
  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/simple-datatables.js"></script>
  <script src="../assets/js/generatePass.js"></script>
  <script>
    // Check password strength
    let pass = document.querySelector(".passwordInput");
    let error_msg = document.querySelector(".error_msg");
    pass.addEventListener("input", (e) => {
      if (e.target.value.length >= 8) {
        if (/[A-Z]/.test(e.target.value)) {
          if (/[0-9]/.test(e.target.value)) {
            if (/[!@#$%^&*(),.?":{}|<>]/.test(e.target.value)) {
              e.target.style.borderColor = "#00db00";
              error_msg.innerHTML = "";
            } else {
              e.target.style.borderColor = "red";
              error_msg.innerHTML = "Password should have at least one special character";
            }
          } else {
            e.target.style.borderColor = "red";
            error_msg.innerHTML = "Password should have at least one digit";
          }
        } else {
          e.target.style.borderColor = "red";
          error_msg.innerHTML = "Password should have at least one capital letter";
        }
      } else {
        e.target.style.borderColor = "red";
        error_msg.innerHTML = "Password should have at least 8 digits";
      }
    });
  </script>
  <script>
    const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
      sortable: false,
      perPage: 5
    });
  </script>
  <!-- [Page Specific JS] end -->
  <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
    <div class="offcanvas-header bg-primary">
      <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="pct-body" style="height: calc(100% - 60px)">
      <div class="offcanvas-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-xs bg-light-primary">
                    <i class="ti ti-layout-sidebar f-18"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Theme Layout</h6>
                  <span>Choose your layout</span>
                </div>
                <i class="ti ti-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="pctcustcollapse1">
              <div class="pct-content">
                <div class="pc-rtl">
                  <p class="mb-1">Direction</p>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                    <label class="form-check-label" for="layoutmodertl">RTL</label>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-xs bg-light-primary">
                    <i class="ti ti-brush f-18"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Theme Mode</h6>
                  <span>Choose light or dark mode</span>
                </div>
                <i class="ti ti-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="pctcustcollapse2">
              <div class="pct-content">
                <div class="theme-color themepreset-color theme-layout">
                  <a href="#!" class="active" onclick="layout_change('light')" data-value="false"><span><img
                        src="../assets/images/customization/default.svg" alt="img"></span><span>Light</span></a>
                  <a href="#!" class="" onclick="layout_change('dark')" data-value="true"><span><img
                        src="../assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-xs bg-light-primary">
                    <i class="ti ti-color-swatch f-18"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Color Scheme</h6>
                  <span>Choose your primary theme color</span>
                </div>
                <i class="ti ti-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="pctcustcollapse3">
              <div class="pct-content">
                <div class="theme-color preset-color">
                  <a href="#!" class="active" data-value="preset-1"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      1</span></a>
                  <a href="#!" class="" data-value="preset-2"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      2</span></a>
                  <a href="#!" class="" data-value="preset-3"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      3</span></a>
                  <a href="#!" class="" data-value="preset-4"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      4</span></a>
                  <a href="#!" class="" data-value="preset-5"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      5</span></a>
                  <a href="#!" class="" data-value="preset-6"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      6</span></a>
                  <a href="#!" class="" data-value="preset-7"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      7</span></a>
                  <a href="#!" class="" data-value="preset-8"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      8</span></a>
                  <a href="#!" class="" data-value="preset-9"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme
                      9</span></a>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item pc-boxcontainer">
            <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-xs bg-light-primary">
                    <i class="ti ti-border-inner f-18"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Layout Width</h6>
                  <span>Choose fluid or container layout</span>
                </div>
                <i class="ti ti-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="pctcustcollapse4">
              <div class="pct-content">
                <div class="theme-color themepreset-color boxwidthpreset theme-container">
                  <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img
                        src="../assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                  <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img
                        src="../assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-xs bg-light-primary">
                    <i class="ti ti-typography f-18"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Font Family</h6>
                  <span>Choose your font family.</span>
                </div>
                <i class="ti ti-chevron-down"></i>
              </div>
            </a>
            <div class="collapse show" id="pctcustcollapse5">
              <div class="pct-content">
                <div class="theme-color fontpreset-color">
                  <a href="#!" class="active" onclick="font_change('Public-Sans')"
                    data-value="Public-Sans"><span>Aa</span><span>Public Sans</span></a>
                  <a href="#!" class="" onclick="font_change('Roboto')"
                    data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                  <a href="#!" class="" onclick="font_change('Poppins')"
                    data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                  <a href="#!" class="" onclick="font_change('Inter')"
                    data-value="Inter"><span>Aa</span><span>Inter</span></a>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="collapse show">
              <div class="pct-content">
                <div class="d-grid">
                  <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>
<!-- [Body] end -->

</html>