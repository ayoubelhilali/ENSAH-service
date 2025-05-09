<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$avatar = '/ENSAH-service/assets/images/avatar-M.jpg'; // chemin par défaut
include('../inc/functions/connections.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/isStrongPass.php");
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
                <li class="breadcrumb-item"><a href="../dashboard/admin-dash.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Professeurs</li>
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
              <!-------------------------------------->
              <div class="text-end p-4 pb-0">
                <a href="#" class="btn btn-primary d-inline-flex align-items-center" data-bs-toggle="modal"
                  data-bs-target="#user-add-modal">
                  <i class="ti ti-plus f-18"></i> Ajouter professeur
                </a>

                <div id="success-message" class="success-msg" style="color: green; margin-top: 10px;">
                  <?php if (isset($_GET['success'])):
                    echo "✅" . $_SESSION["success_message"];
                  endif; ?>
                </div>
                <script>
                  setTimeout(function () {
                    document.getElementById('success-message').style.display = 'none';
                  }, 10000); // 10 seconds
                </script>
              </div>

              <!---------------------------------->
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>Photo</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Email</th>
                      <th>specialite</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $profs = "SELECT * FROM `professeur` P 
                  JOIN `user` U ON P.user_ID = U.user_ID";
                    $all_profs = $pdo->query($profs);
                    if ($all_profs) {
                      while ($prof = $all_profs->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox">
                            </div>
                          </td>
                          <td><?php echo $prof['prof_ID'] ?></td>
                          <td>
                            <div class="col-auto pe-0">
                              <img src="<?php if (!empty($prof['image']))
                                echo $prof['image'];
                              else
                                echo "/ENSAH-service/assets/images/avatar-M.jpg" ?>" alt="user-image"
                                  class="wid-40 rounded-circle">
                              </div>
                            </td>
                            <td>
                              <div class="row">
                                <div class="col">
                                  <h5 class="mb-1"><?php echo $prof['nom'] ?></h5>
                              </div>
                            </div>
                          </td>
                          <td>
                            <tdv class="row">
                              <div class="col">
                                <h5 class="mb-0"><?php echo $prof['prenom']; ?></h5>
                              </div>
                            </tdv>
                          </td>
                          <td><?php echo $prof['email'] ?></td>
                          <td><?php echo $prof['specialite'] ?></td>
                          <td class="text-center">
                            <ul class="list-inline me-auto mb-0">
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                                <a href="#" class="avtar avtar-xs btn-link-secondary view-btn" 
                                  data-bs-toggle="modal"
                                  data-bs-target="#user-modal" 
                                  data-nom="<?= $prof['nom']; ?>"
                                  data-prenom="<?= $prof['prenom']; ?>"
                                  data-address="<?= $prof['address']; ?>"
                                  data-email="<?= $prof['email']; ?>"
                                  data-specialite="<?= $prof['specialite']; ?>"
                                  data-img="<?= $prof['image']; ?>"
                                  data-cin="<?= $prof['CIN']; ?>"
                                  data-genre="<?= $prof['genre']; ?>"
                                  data-bio="<?= $prof['bio']; ?>"
                                  data-birthday="<?= $prof['date_naissance']; ?>"
                                  data-phone="<?= (isset($prof['Phone']) && $prof['Phone'] != "0") ? $prof['Phone'] : '(+212)  - - - - - - - - -   '; ?>"
                                  data-linkedin="<?= $prof['linkedin']; ?>">
                                  <i class="ti ti-eye f-18"></i>
                                </a>

                              </li>
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">
                                <a href="#" class="avtar avtar-xs btn-link-primary edit-btn" data-bs-toggle="modal"
                                  data-bs-target="#user-edit-modal" data-nom="<?= $prof['nom']; ?>" 
                                  data-prenom="<?= $prof['prenom']; ?>" data-email="<?= $prof['email']; ?>"
                                  data-pass="<?php echo $prof['password']; ?>"
                                  data-specialite="<?= $prof['specialite']; ?>" data-img="<?= $prof['image']; ?>"
                                  data-cin="<?= $prof['CIN']; ?>" data-genre="<?= $prof['genre']; ?>"
                                  data-birthday="<?= $prof['date_naissance']; ?>">
                                  <i class="ti ti-edit-circle f-18"></i>
                                </a>
                              </li>
                              <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                                <a href="#" class="avtar avtar-xs btn-link-danger remove-user"
                                  data-user="<?php echo $prof["user_ID"] ?>" data-prof="<?php echo $prof["prof_ID"] ?>">
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
          <h5 class="mb-0">Détails du professeur</h5>
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
                    <span class="badge bg-primary">Professeur</span>
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
                      <a href="#" class="link-primary">
                        <p class="mb-0" id="modal-linkedin">--</p>
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
                  <h5>Détails personnels</h5>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Nom complet</p>
                          <h6 class="mb-0" id="modal-fullname"></h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">CIN</p>
                          <h6 class="mb-0" id="modal-cin"></h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Date de naissance</p>
                          <h6 class="mb-0" id="modal-birthday"></h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Genre</p>
                          <h6 class="mb-0" id="modal-genre"></h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                      <p class="mb-1 text-muted">Adresse</p>
                      <h6 class="mb-0" id="modal-address"></h6>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h5>À propos</h5>
                </div>
                <div class="card-body">
                  <p class="mb-0" id="modal-bio">
                    -- À propos du professeur --
                  </p>
                </div>
              </div>
            </div>
          </div> <!-- /row -->
        </div> <!-- /modal-body -->
      </div> <!-- /modal-content -->
    </div> <!-- /modal-dialog -->
  </div>


  <?php
  // Initialize variables and error messages
  $nom = $prenom = $cin = $birthday_day = $birthday_month = $birthday_year = "";
  $genre = $email = $password = $md5_pass = $specialite = "";
  $errors = 0;

  $CIN_error = $nom_error = $prenom_error = $birthday_error = "";
  $genre_error = $email_error = $password_error = $specialite_error = $upload_error = "";

  // Check if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Nom
    if (empty($_POST["nom"])) {
      $nom_error = "Nom is required";
      $errors++;
    } else {
      $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Prénom
    if (empty($_POST["prenom"])) {
      $prenom_error = "Prénom is required";
      $errors++;
    } else {
      $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate CIN
    if (empty($_POST["CIN"])) {
      $CIN_error = "CIN is required";
      $errors++;
    } else {
      $cin = htmlspecialchars($_POST["CIN"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Birthday
    if (empty($_POST["birthday_day"]) || empty($_POST["birthday_month"]) || empty($_POST["birthday_year"])) {
      $birthday_error = "Birthday is required";
      $errors++;
    } else {
      $birthday_day = htmlspecialchars($_POST["birthday_day"], ENT_QUOTES, 'UTF-8');
      $birthday_month = htmlspecialchars($_POST["birthday_month"], ENT_QUOTES, 'UTF-8');
      $birthday_year = htmlspecialchars($_POST["birthday_year"], ENT_QUOTES, 'UTF-8');
      $birthday = "$birthday_year-$birthday_month-$birthday_day"; // YYYY-MM-DD
  
      // Validate date format
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
      $genre = htmlspecialchars($_POST["genre"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Email
    if (empty($_POST["email"])) {
      $email_error = "Email is required";
      $errors++;
    } else {
      $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $errors++;
      } else {
        // Check if email already exists
        $check_email_query = "SELECT * FROM professeur WHERE email = ?";
        $check_email_stmt = $pdo->prepare($check_email_query);
        $check_email_stmt->execute([$email]);
        if ($check_email_stmt->rowCount() > 0) {
          $email_error = "Email already exists.";
          $errors++;
        }
      }
    }

    // Validate Password
    if (isStrongPassword($_POST["password"])) {
      $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
      $md5_pass = md5($password); // Hash the password
    } else {
      $password_error = "Password should include at least: 1 uppercase, 1 lowercase, 1 digit, 1 special character, and be at least 8 characters long.";
      $errors++;
    }

    // Validate Specialité
    if (empty($_POST["specialite"])) {
      $specialite_error = "Spécialité is required";
      $errors++;
    } else {
      $specialite = htmlspecialchars($_POST["specialite"], ENT_QUOTES, 'UTF-8');
    }

    // Handle avatar path
    $avatar_path = isset($_POST['avatar_path']) ? htmlspecialchars($_POST["avatar_path"], ENT_QUOTES, 'UTF-8') : '';

    // Proceed with insertion if no errors
    if ($errors == 0) {
      // Insert into user table
      $add_user = "INSERT INTO user(nom, prenom, CIN, image, date_naissance, genre) 
                     VALUES('$nom', '$prenom', '$cin', '$avatar_path', '$birthday', '$genre')";

      $stmt = $pdo->prepare($add_user);
      if ($stmt->execute()) {
        $user_id = $pdo->lastInsertId();
        if ($user_id) {
          // Insert into professeur table
          $add_prof = "INSERT INTO professeur(user_ID, email, password, md5_pass, specialite) 
                             VALUES('$user_id', '$email', '$password', '$md5_pass', '$specialite')";
          if ($pdo->query($add_prof)) {
            $_SESSION['success_message'] = "Professor added successfully!";
            header("Location: /ENSAH-service/pages/prof-list.php?success=1");
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
        var myModal = new bootstrap.Modal(document.getElementById('user-add-modal'));
        myModal.show();
      });
    </script>
  <?php endif; ?>
  <form method="post" class="modal fade" id="user-add-modal" data-bs-keyboard="false" tabindex="-1"
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

                <input type="file" id="uplfile" name="uplfile" class="d-none uplfile">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Nom</label>
                <input required name="nom" type="text" class="form-control nameInput" placeholder="Nom"
                  value="<?php echo htmlspecialchars($nom); ?>">
              </div>
              <p style="color: red"><?php if (isset($nom_error)) {
                echo $nom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Prénom</label>
                <input required name="prenom" type="text" class="form-control prenomInput" placeholder="Prénom"
                  value="<?php echo htmlspecialchars($nom); ?>">
              </div>
              <p style="color: red"><?php if (isset($prenom_error)) {
                echo $prenom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">CIN</label>
                <input required name="CIN" type="text" class="form-control cinInput" placeholder="CIN"
                  value="<?php echo htmlspecialchars($cin); ?>">
              </div>
              <p style="color: red"><?php if (isset($CIN_error)) {
                echo $CIN_error;
              } ?></p>
              <div class="form-group">
                <label for="day" class="form-label">Date de naissance :</label><br>

                <select name="birthday_day" class="selectInput" id="day" required>
                  <option value="" class="defaultOption" disabled <?php if (empty($birthday_day))
                    echo 'selected'; ?>>Jour</option>
                  <!-- Jours de 1 à 31 -->
                  <?php for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                  } ?>
                </select>

                <select name="birthday_month" class="selectInput" id="month" required>
                  <option disabled class="defaultOption" <?php if (empty($birthday_month))
                    echo 'selected'; ?>>Mois
                  </option>
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

                <select name="birthday_year" id="year" class="selectInput" required>
                  <option disabled class="defaultOption" value="" <?php if (empty($birthday_year))
                    echo 'selected'; ?>>Année</option>
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
                <select name="genre" class="form-select selectInput" required>
                  <option disabled class="defaultOption" <?php if (empty($genre))
                    echo 'selected'; ?>>Selectionner Genre
                  </option>
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
                <input name="email" type="email" class="form-control emailInput" placeholder="Email" required
                  value="<?php echo htmlspecialchars($email); ?>">
              </div>
              <p style="color: red"><?php if (isset($email_error)) {
                echo $email_error;
              } ?></p>
              <div class="form-group ">
                <label class="form-label">Password</label>
                <div style="position: relative;">
                  <input name="password" type="text" placeholder="Enter password" class="form-control passwordInput"
                    style="padding-right: 40px;" required>
                  <i class="fas fa-sync-alt generateBtn"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
              </div>
              <p style="color: red" class="error_msj"><?php if (isset($password_error)) {
                echo $password_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Specialité</label>
                <select name="specialite" class="form-select selectInput" required>
                  <option disabled class="defaultOption" <?php if (empty($specialite))
                    echo 'selected'; ?>>Specialitée
                  </option>
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
                <i class="ti ti-trash f-18 clearBtn"></i>
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
  <form method="post" class="modal fade" id="user-edit-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true"
    enctype="multipart/form-data">
    <input type="hidden" name="avatar_path" id="avatar-path">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Modifier professeur</h5>
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
                <img id="avatar-previewh" src="<?php echo $avatar; ?>" alt="img" class="img-fluid prof-img">
                <label for="uplfile" class="img-avtar-upload">
                  <i class="ti ti-camera f-24 mb-1"></i>
                  <span>Upload</span>
                </label>
                <input type="file" id="uplfile" name="uplfile" class="d-none uplfile">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Nom</label>
                <input required name="nom" type="text" class="form-control nameInput" placeholder="Nom" value=""
                  id="prof-nom">
              </div>
              <p style="color: red"><?php if (isset($nom_error)) {
                echo $nom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Prénom</label>
                <input required name="prenom" type="text" class="form-control prenomInput" placeholder="Prénom" value=""
                  id="prof-prenom">
              </div>
              <p style="color: red"><?php if (isset($prenom_error)) {
                echo $prenom_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">CIN</label>
                <input required name="CIN" type="text" class="form-control cinInput" placeholder="CIN" value=""
                  id="prof-cin">
              </div>
              <p style="color: red"><?php if (isset($CIN_error)) {
                echo $CIN_error;
              } ?></p>
              <div class="form-group">
                <label for="day" class="form-label">Date de naissance :</label><br>
  
                <select name="birthday_day" class="selectInput" id="prof_day" required>
                  <option value="" class="defaultOption" disabled <?php if (empty($birthday_day))
                    echo 'selected'; ?>>Jour
                  </option>
                  <!-- Jours de 1 à 31 -->
                  <?php for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                  } ?>
                </select>
  
                <select name="birthday_month" class="selectInput" id="prof_month" required>
                  <option disabled class="defaultOption" <?php if (empty($birthday_month))
                    echo 'selected'; ?>>Mois
                  </option>
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
  
                <select name="birthday_year" id="prof_year" class="selectInput" required>
                  <option disabled class="defaultOption" value="" <?php if (empty($birthday_year))
                    echo 'selected'; ?>>Année</option>
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
                <select name="genre" class="form-select selectInput" required id="prof-genre">
                  <option disabled class="defaultOption" value="" <?php if (empty($genre))
                    echo 'selected'; ?>>
                    Selectionner Genre
                  </option>
                  <option value="masculin" <?php if ($genre == "Masculin")
                    echo 'selected'; ?>>Masculin</option>
                  <option value="feminin" <?php if ($genre == "Féminin")
                    echo 'selected'; ?>>Féminin</option>
                </select>
  
              </div>
              <p style="color: red"><?php if (isset($genre_error)) {
                echo $genre_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control emailInput" placeholder="Email" required value=""
                  id="prof-email">
              </div>
              <p style="color: red"><?php if (isset($email_error)) {
                echo $email_error;
              } ?></p>
              <div class="form-group ">
                <label class="form-label">Password</label>
                <div style="position: relative;">
                  <input name="password" type="text" placeholder="Enter password" class="form-control passwordInput"
                    style="padding-right: 40px;" required id="prof-pass">
                </div>
              </div>
              <p style="color: red" class="error-msg"><?php if (isset($password_error)) {
                echo $password_error;
              } ?></p>
              <div class="form-group">
                <label class="form-label">Specialité</label>
                <select name="specialite" class="form-select selectInput" required id="prof-specialite">
                  <option disabled class="defaultOption">Specialitée</option>
                  <option value="computer science">Computer science</option>
                  <option value="Data analyst">Data analyst</option>
                  <option value="cybersecurity">cybersecurity</option>
                  <option value="Mathematics">Mathematics</option>
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
                <i class="ti ti-trash f-18 clearBtn"></i>
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
          <p class="m-0">ENSAH-service &copy; 2025 - All rights reserved; .</p>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', () => {
          // Get the data from the clicked button
          const cin = button.getAttribute('data-cin');
          const address = button.getAttribute('data-address');
          const phone = button.getAttribute('data-phone');
          const linkedin = button.getAttribute('data-linkedin');
          const bio = button.getAttribute('data-bio');
          const nom = button.getAttribute('data-nom');
          const prenom = button.getAttribute('data-prenom');
          const birthday = button.getAttribute('data-birthday');
          const genre = button.getAttribute('data-genre');
          const email = button.getAttribute('data-email');
          const specialite = button.getAttribute('data-specialite');
          const image = button.getAttribute('data-img') || '/ENSAH-service/assets/images/avatar-M.jpg';

          // Populate the modal with the data
          document.getElementById('modal-img').src = image;
          document.getElementById('modal-nom').textContent = `${nom} ${prenom}`;
          document.getElementById('modal-poste').textContent = specialite;
          document.getElementById('modal-cin').textContent = cin;
          document.getElementById('modal-phone').textContent = phone;
          document.getElementById('modal-linkedin').textContent = linkedin;
          document.getElementById('modal-bio').textContent = bio;
          document.getElementById('modal-address').textContent = address;
          document.getElementById('modal-birthday').textContent = birthday;
          document.getElementById('modal-genre').textContent = genre;
          document.getElementById('modal-email').textContent = email;
          document.getElementById('modal-fullname').textContent = `${nom} ${prenom}`;
          document.getElementById('modal-specialite').textContent = specialite; // Add any missing fields
        });
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
          // Get the data from the clicked button
          const prof_cin = button.getAttribute('data-cin');
          const prof_nom = button.getAttribute('data-nom');
          const prof_prenom = button.getAttribute('data-prenom');
          const prof_birthday = button.getAttribute('data-birthday');
          const [prof_year, prof_month, prof_day] = prof_birthday.split('-');
          console.log(prof_year + "-" + prof_month + "-" + prof_day);
          const prof_genre = button.getAttribute('data-genre');
          const prof_email = button.getAttribute('data-email');
          const prof_pass = button.getAttribute('data-pass');
          const prof_specialite = button.getAttribute('data-specialite');
          const prof_image = button.getAttribute('data-img') || '/ENSAH-service/assets/images/avatar-M.jpg';

          // Populate the modal with the data
          document.querySelector('.prof-img').src = prof_image;
          document.getElementById('prof-nom').value = `${prof_nom}`;
          document.getElementById('prof-prenom').value = `${prof_prenom}`;
          document.getElementById('prof-cin').value = prof_cin;
          document.querySelector(`#prof-genre option[value="${prof_genre}"]`).selected = true;
          document.getElementById('prof-email').value = prof_email;
          document.getElementById('prof-pass').value = prof_pass;
          document.querySelector(`#prof-specialite option[value="${prof_specialite}"]`).selected = true;
          // select the birthday
          document.querySelector(`#prof_year option[value="${prof_year}"]`).selected = true;
          document.querySelector(`#prof_month option[value="${prof_month}"]`).selected = true;
          document.querySelector(`#prof_day option[value="${prof_day}"]`).selected = true;

        });
      });
    });
  </script>
  <script>
    // Check password strength
    let pass = document.querySelector(".passwordInput");
    let error_msg = document.querySelector(".error_msj");
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
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.remove-user').forEach(button => {
        button.addEventListener('click', () => {
          const user_ID = button.getAttribute('data-user');
          const prof_ID = button.getAttribute('data-prof');

          // Show confirmation dialog
          if (confirm("Are you sure you want to delete this professor?")) {
            // Send fetch request to PHP script
            fetch('/ENSAH-service/inc/functions/delete-user.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({ user_ID: user_ID })
            })
              .then(response => {
                if (!response.ok) {
                  throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
              })
              .then(data => {
                if (data.success) {
                  let success_msg = document.querySelector(".success-msg");
                  if (success_msg) {
                    success_msg.innerHTML = "✅" + "Professeur with ID " + prof_ID + " has been deleted!";
                    success_msg.display = "block";
                  }
                  // Optionally, remove the row from the table
                  button.closest('tr').remove();
                } else {
                  console.error("❌ Failed to delete: " + (data.message || "Unknown error"));
                }
              })
              .catch(error => {
                console.error("❌ Error:", error.message || error);
              });
          }
        });
      });
    });
  </script>



  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/simple-datatables.js"></script>
  <script src="../assets/js/generatePass.js"></script>
  <script src="../assets/js/clearForm.js"></script>
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