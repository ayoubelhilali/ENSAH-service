<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$avatar = '/ENSAH-service/assets/images/avatar-M.jpg'; // chemin par défaut
include('../inc/functions/connections.php');
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>ENSAH-service | les professeurs</title>
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
  <link rel="stylesheet" href="/ENSAH-service/assets/css/main.css">


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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page">User List</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Liste des professeurs</h2>
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
                  data-bs-target="#user-edit_add-modal">
                  <i class="ti ti-plus f-18"></i> Ajouter professeur
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>Nom complet</th>
                      <th>Email</th>
                      <th>CIN</th>
                      <th>Genre</th>
                      <th>Age</th>
                      <th>specialite</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $profs = "SELECT * FROM `professeur` P 
                  JOIN `user` U ON P.user_ID = U.user_ID";
                    $all_profs = mysqli_query($conne, $profs);

                    if ($all_profs) {
                      while ($prof = mysqli_fetch_assoc($all_profs)) {
                        ?>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox">
                            </div>
                          </td>
                          <td><?php echo $prof['prof_ID'] ?></td>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="<?php echo $prof['image']; ?>" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0"><?php echo $prof['nom'] . " " . $prof['prenom'] ?></h5>
                              </div>
                            </div>
                          </td>
                          <td><?php echo $prof['email'] ?></td>
                          <td><?php echo $prof['CIN'] ?></td>
                          <td><?php echo $prof['genre'] ?></td>
                          <td><?php
                          $birthday = $prof["date_naissance"];
                          $birthDate = new DateTime($birthday);
                          $today = new DateTime(); // current date
                      
                          $age = $today->diff($birthDate)->y;

                          echo $age . " ans";

                          ?> </td>
                          <td><?php echo $prof['specialite'] ?></td>
                          <td><?php echo $prof['specialite'] ?></td>
                          <td class="text-center">
                            <ul class="list-inline me-auto mb-0">
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                                <a href="#" class="avtar avtar-xs btn-link-secondary" data-bs-toggle="modal"
                                  data-bs-target="#user-modal">
                                  <i class="ti ti-eye f-18"></i>
                                </a>
                              </li>
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                                <a href="#" class="avtar avtar-xs btn-link-primary" data-bs-toggle="modal"
                                  data-bs-target="#user-edit_add-modal">
                                  <i class="ti ti-edit-circle f-18"></i>
                                </a>
                              </li>
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                                <a href="#" class="avtar avtar-xs btn-link-danger">
                                  <i class="ti ti-trash f-18"></i>
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      <?php }
                    } ?>


                  </tbody>
                </table>
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
          <h5 class="mb-0">Customer Details</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body position-relative">
                  <div class="position-absolute end-0 top-0 p-3">
                    <span class="badge bg-primary">Relationship</span>
                  </div>
                  <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto">
                      <img class="rounded-circle img-fluid wid-60" src="../assets/images/user/avatar-5.jpg"
                        alt="User image">
                    </div>
                    <h5 class="mb-0">Aaron Poole</h5>
                    <p class="text-muted text-sm">Manufacturing Director</p>
                    <hr class="my-3">
                    <div class="row g-3">
                      <div class="col-4">
                        <h5 class="mb-0">45</h5>
                        <small class="text-muted">Age</small>
                      </div>
                      <div class="col-4 border border-top-0 border-bottom-0">
                        <h5 class="mb-0">86%</h5>
                        <small class="text-muted">Progress</small>
                      </div>
                      <div class="col-4">
                        <h5 class="mb-0">7634</h5>
                        <small class="text-muted">Visits</small>
                      </div>
                    </div>
                    <hr class="my-3">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-mail"></i>
                      <p class="mb-0">bo@gmail.com</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-phone"></i>
                      <p class="mb-0">email@test.com</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-map-pin"></i>
                      <p class="mb-0">Lesotho</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                      <i class="ti ti-link"></i>
                      <a href="#" class="link-primary">
                        <p class="mb-0">https://anshan.dh.url</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h5>Personal Details</h5>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Full Name</p>
                          <h6 class="mb-0">Aaron Poole</h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-0">Mr. Ralph Sabatini</h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Country</p>
                          <h6 class="mb-0">Lesotho</h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Zip Code</p>
                          <h6 class="mb-0">247 849</h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                      <p class="mb-1 text-muted">Address</p>
                      <h6 class="mb-0">647 Punam Center, Ulabifgu, Myanmar (Burma) - 41487</h6>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h5>About me</h5>
                </div>
                <div class="card-body">
                  <p class="mb-0">Hello, I’m Aaron Poole Manufacturing Director based in international company, Void
                    jiidki me na fep juih ced gihhiwi launke cu mig tujum peodpo.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php

  // Initialize variables and error arrays
  $nom = $prenom = $cin = $birthday_day = $birthday_month = $birthday_year = $genre = $email = $password = $md5_pass = $specialite = "";
  $errors = 0;
  $CIN_error = $nom_error = $prenom_error = $birthday_error = $genre_error = $email_error = $password_error = $specialite_error = $upload_error = "";

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Nom
    if (empty($_POST["nom"])) {
      $nom_error = "Nom is required";
      $errors++;
    } else {
      $nom = mysqli_real_escape_string($conne, $_POST["nom"]);
    }

    // Validate Prenom
    if (empty($_POST["prenom"])) {
      $prenom_error = "Prénom is required";
      $errors++;
    } else {
      $prenom = mysqli_real_escape_string($conne, $_POST["prenom"]);
    }
    if (empty($_POST["CIN"])) {
      $CIN_error = "CI? is required";
      $errors++;
    } else {
      $cin = mysqli_real_escape_string($conne, $_POST["CIN"]);
    }

    // Validate Birthday
    if (empty($_POST["birthday_day"]) || empty($_POST["birthday_month"]) || empty($_POST["birthday_year"])) {
      $birthday_error = "Birthday is required";
      $errors++;
    } else {
      $birthday_day = mysqli_real_escape_string($conne, $_POST["birthday_day"]);
      $birthday_month = mysqli_real_escape_string($conne, $_POST["birthday_month"]);
      $birthday_year = mysqli_real_escape_string($conne, $_POST["birthday_year"]);
      $birthday = $birthday_year . "-" . $birthday_month . "-" . $birthday_day;  //YYYY-MM-DD
  
      //Validate valid date
      if (!DateTime::createFromFormat('Y-m-d', $birthday)) {
        $birthday_error = "Invalid date format.";
        $errors++;
      }
    }

    // Validate Genre
    if (empty($_POST["genre"])) {
      $genre_error = "Genre is required";
      $errors++;
    } else {
      $genre = mysqli_real_escape_string($conne, $_POST["genre"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
      $email_error = "Email is required";
      $errors++;
    } else {
      $email = mysqli_real_escape_string($conne, $_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $errors++;
      }
      //Check if email exists
      $check_email_query = "SELECT * FROM professeur WHERE email = '$email'";
      $check_email_result = mysqli_query($conne, $check_email_query);
      if (mysqli_num_rows($check_email_result) > 0) {
        $email_error = "Email already exists.";
        $errors++;
      }
    }

    // Validate password
    if (empty($_POST["password"])) {
      $password_error = "Password is required";
      $errors++;
    } else if (strlen($_POST["password"]) < 8) {
      $password_err = "Password should contain minimum 8 digits";
    } else {
      $password = mysqli_real_escape_string($conne, $_POST["password"]);
      $md5_pass = md5($password); // Hash the password
    }

    // Validate Specialite
    if (empty($_POST["specialite"])) {
      $specialite_error = "Specialité is required";
      $errors++;
    } else {
      $specialite = mysqli_real_escape_string($conne, $_POST["specialite"]);
    }

    if (!empty($_POST['avatar_path'])) {
      $avatar = mysqli_real_escape_string($conne, $_POST['avatar_path']);
      // Save it in your INSERT query
    }
    $avatar_path = isset($_POST['avatar_path']) ? mysqli_real_escape_string($conne, $_POST['avatar_path']) : '';
    echo $avatar_path;
    // If there are no errors, proceed with database insertion
    if ($errors == 0) {
      // Ajouter le professeur dans la table des utilisateurs
      $add_user = "INSERT INTO user(nom, prenom,CIN,image, date_naissance, genre) 
        VALUES('$nom', '$prenom','$cin','$avatar_path', '$birthday', '$genre')";
      if (mysqli_query($conne, $add_user)) {
        // Récupérer l'ID de l'utilisateur inséré
        $user_id = mysqli_insert_id($conne);

        if ($user_id) {
          $add_prof = "INSERT INTO professeur(user_ID, email, password, md5_pass, specialite) 
                VALUES('$user_id', '$email', '$password', '$md5_pass', '$specialite')";
          if (mysqli_query($conne, $add_prof)) {
            $_SESSION['success_message'] = "Professor added successfully!";
            header("/ENSAH-service/pages/prof-list.php");
            exit;
          } else {
            $general_error = "Failed to add professor.";
          }
        } else {
          $general_error = "Failed to retrieve user ID.";
        }
      } else {
        $general_error = "Failed to add user to the database.";
      }
    } else {
      $general_error = "Please correct the errors in the form.";
    }
  }
  ?>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $errors > 0): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('user-edit_add-modal'));
        myModal.show();
      });
    </script>
  <?php endif; ?>
  <form method="post" class="modal fade" id="user-edit_add-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true" enctype="multipart/form-data">
    <input type="hidden" name="avatar_path" id="avatar-path">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Ajouter professeur</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <?php
            // Charger le traitement d'image en premier
            include "../inc/functions/upload-image.php";

            // Mettre à jour l'avatar si l'image a été uploadée
            $avatar = "/ENSAH-service/assets/images/avatar-M.jpg"; // Valeur par défaut
            if (isset($_SESSION['avatar_path'])) {
              $avatar = $_SESSION['avatar_path'];
            }
            ?>
            <div class="col-sm-3 text-center mb-3">
              <div class="user-upload wid-75">
                <img id="avatar-preview" src="<?php echo $avatar; ?>" alt="img" class="img-fluid">


                <label for="uplfile" class="img-avtar-upload">
                  <i class="ti ti-camera f-24 mb-1"></i>
                  <span>Upload</span>
                </label>

                <input type="file" id="uplfile" name="uplfile" class="d-none">
              </div>
            </div>
            <div class="col-sm-9">
              <p style="color: red"><?php if (isset($nom_error)) {
                echo $nom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Nom</label>
                <input required name="nom" type="text" class="form-control" placeholder="Nom"
                  value="<?php echo htmlspecialchars($nom); ?>">
              </div>
              <p style="color: red"><?php if (isset($prenom_error)) {
                echo $prenom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Prénom</label>
                <input required name="prenom" type="text" class="form-control" placeholder="Prénom"
                  value="<?php echo htmlspecialchars($nom); ?>">
              </div>
              <div class="form-group">
                <label class="form-label">CIN</label>
                <input required name="CIN" type="text" class="form-control" placeholder="CIN"
                  value="<?php echo htmlspecialchars($cin); ?>">
              </div>
              <div class="form-group">
                <label for="day" class="form-label">Date de naissance :</label><br>

                <select name="birthday_day" id="day" required>
                  <option value="">Jour</option>
                  <!-- Jours de 1 à 31 -->
                  <?php for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                  } ?>
                </select>

                <select name="birthday_month" id="month" required>
                  <option disabled <?php if (empty($birthday_month))
                    echo 'selected'; ?>>Mois</option>
                  <?php
                  $months = [
                    1 => "Janvier",
                    2 => "Février",
                    3 => "Mars",
                    4 => "Avril",
                    5 => "Mai",
                    6 => "Juin",
                    7 => "Juillet",
                    8 => "Août",
                    9 => "Septembre",
                    10 => "Octobre",
                    11 => "Novembre",
                    12 => "Décembre"
                  ];
                  foreach ($months as $key => $month) {
                    echo "<option value='$key' " . ($birthday_month == $month ? "selected" : "") . ">$month</option>";
                  }
                  ?>
                </select>

                <select name="birthday_year" id="year" required>
                  <option value="">Année</option>
                  <!-- Années de 2025 à 1900 -->
                  <?php for ($i = 2025; $i >= 1900; $i--) {
                    echo "<option value='$i'>$i</option>";
                  } ?>
                </select>
              </div>
              <p style="color: red"><?php if (isset($birthday_error)) {
                echo $birthday_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Genre</label>
                <select name="genre" class="form-select" required>
                  <option disabled <?php if (empty($genre))
                    echo 'selected'; ?>>Selectionner Genre</option>
                  <option <?php if ($genre == "Masculin")
                    echo 'selected'; ?>>Masculin</option>
                  <option <?php if ($genre == "Féminin")
                    echo 'selected'; ?>>Féminin</option>
                </select>
              </div>
              <p style="color: red"><?php if (isset($genre_error)) {
                echo $genre_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email" required
                  value="<?php echo htmlspecialchars($email); ?>">
              </div>
              <p style="color: red"><?php if (isset($email_error)) {
                echo $email_error;
              } ?></p>
              <div class="form-group ">
                <label class="form-label">Password</label>
                <div style="position: relative;">
                  <input name="password" type="password" placeholder="Enter password" class="form-control"
                    style="padding-right: 40px;" required>
                  <i class="fas fa-sync-alt"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

              </div>
              <p style="color: red"><?php if (isset($password_err)) {
                echo $password_err;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Specialité</label>
                <select name="specialite" class="form-select" required>
                  <option disabled selected>Select Specialité</option>
                  <option>Computer science</option>
                  <option>Data analyst</option>
                  <option>cybersecurity</option>
                  <option>Mathematics</option>
                </select>
              </div>
              <p style="color: red"><?php if (isset($specialite_error)) {
                echo $specialite_error;
              } ?></p>
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
            <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Annuler</button>
            <input type="submit" name="submit" class="btn btn-primary" value="enregistrer">
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
          <p class="m-0">Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes"
              target="_blank">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.</p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-link mb-0">
            <li class="list-inline-item"><a href="../index.html">Home</a></li>
            <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/mantis-bootstrap"
                target="_blank">Documentation</a></li>
            <li class="list-inline-item"><a href="https://codedthemes.authordesk.app/" target="_blank">Support</a></li>
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
  <script src="../assets/js/upload-image.js"></script>

  <script>layout_change('dark');</script>




  <script>change_box_container('false');</script>



  <script>layout_rtl_change('false');</script>


  <script>preset_change("preset-1");</script>


  <script>font_change("Public-Sans");</script>



  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/simple-datatables.js"></script>
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
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a>
                  <a href="#!" class="" data-value="preset-2"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a>
                  <a href="#!" class="" data-value="preset-3"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a>
                  <a href="#!" class="" data-value="preset-4"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a>
                  <a href="#!" class="" data-value="preset-5"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a>
                  <a href="#!" class="" data-value="preset-6"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a>
                  <a href="#!" class="" data-value="preset-7"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a>
                  <a href="#!" class="" data-value="preset-8"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a>
                  <a href="#!" class="" data-value="preset-9"><span><img
                        src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a>
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