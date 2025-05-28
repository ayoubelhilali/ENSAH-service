<?php
session_start();
if (!isset($_SESSION['user'])) {
  // Redirect to login if not authenticated
  header('Location: /ENSAH-service/login.php');
  exit();
}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include '../inc/functions/connections.php';

$name = $_SESSION["user"]["nom"];
$prenom = $_SESSION["user"]["prenom"];
$image = $_SESSION["user"]["image"];
$email = $_SESSION["user"]["email"];
$role = $_SESSION["user"]["role"];
$genre = $_SESSION["user"]["genre"];
$phone = $_SESSION["user"]["phone"];
$linkedin = $_SESSION["user"]["linkedin"];
$address = $_SESSION["user"]["address"];
$bio = $_SESSION["user"]["bio"];
echo "----------------------$role";


// Calculate the age:
$birthday = $_SESSION["user"]["birthday"]; // 🎂 format: YYYY-MM-DD
$birthDate = new DateTime($birthday);
$today = new DateTime(); // current date

$age = $birthDate->diff($today)->y; // 'y' gives the number of full years

?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>ENSAH-SERVICE | profile</title>
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
  <link rel="icon" href="../assets/images/logo-small_noBG.png" type="image/x-icon"> <!-- [Google Font] Family -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="../assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="../assets/css/style-preset.css">

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
  <?php if($_SESSION["user"]["role"] == "admin") { ?>
      <?php require_once __DIR__ . "/../inc/sidebar/admin-sidebar.php"; ?>
   <?php } else if ($_SESSION["user"]["role"] == "coordonnateur") { ?>
      <?php require_once __DIR__ . "/../inc/sidebar/cord-sidebar.php"; ?>
   <?php } else if ($_SESSION["user"]["role"] == "vacataire") { ?>
      <?php require_once __DIR__ . "/../inc/sidebar/vacat-sidebar.php"; ?>

   <?php } ?>  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
                <li class="breadcrumb-item" aria-current="page">Account Profile</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Account Profile</h2>
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
          <div class="card">
            <div class="card-header pb-0">
              <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab"
                    aria-selected="true">
                    <i class="ti ti-user me-2"></i>Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                    aria-selected="true">
                    <i class="ti ti-file-text me-2"></i>Personal
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                    aria-selected="true">
                    <i class="ti ti-lock me-2"></i>Change Password
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab" href="#profile-6" role="tab"
                    aria-selected="true">
                    <i class="ti ti-settings me-2"></i>Settings
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                  <div class="row">
                    <div class="col-lg-4 col-xxl-3">
                      <div class="card">
                        <div class="card-body position-relative">
                          <div class="position-absolute end-0 top-0 p-3">
                            <span class="badge bg-primary"><?php echo $role ?></span>
                          </div>
                          <div class="text-center mt-3">
                            <div class="chat-avtar d-inline-flex mx-auto">
                              <img class="rounded-circle img-fluid wid-70" src="<?php echo empty($image) ? "/ENSAH-service/assets/images/user_empty.png" : $image?>" alt="User image">
                            </div>
                            <h5 class="mb-0"><?php echo $name . " " . $prenom ?></h5>
                            <p class="text-muted text-sm"><?php echo $role ?></p>
                            <hr class="my-3">
                            <hr class="my-3">
                            <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                              <i class="ti ti-mail"></i>
                              <p class="mb-0"><?php echo $email ?></p>
                            </div>
                            <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                              <i class="ti ti-phone"></i>
                              <p class="mb-0">(+212) <?php echo $phone ?></p>
                            </div>
                            <div class="d-inline-flex align-items-center justify-content-between w-100">
                              <i class="ti ti-brand-linkedin"></i>
                              <a href="#" class="link-primary">
                                <p class="mb-0"><a href="<?php echo $linkedin; ?>">linkedin</a></p>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-xxl-9">
                      <?php if (isset($_GET['success'])): ?>
                        <div id="success-message" class="alert alert-success" style="margin-top: 10px;">
                          <?php echo $_SESSION["success_message"] ?>
                        </div>
                        <script>
                          setTimeout(function () {
                            document.getElementById('success-message').remove();
                          }, 10000); // 10 seconds
                        </script>
                      <?php endif; ?>
                      <?php if (isset($_GET['error'])): ?>
                        <div id="error-message" class="alert alert-danger" style="margin-top: 10px;">
                          <?php echo $_SESSION["error_message"] ?>
                        </div>
                        <script>
                          setTimeout(function () {
                            document.getElementById('error-message').remove();
                          }, 10000); // 10 seconds
                        </script>
                      <?php endif; ?>
                      <div class="card">
                        <div class="card-header">
                          <h5>About me</h5>
                        </div>
                        <div class="card-body">
                          <p class="mb-0"><?php echo $bio ?></p>
                        </div>
                      </div>
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
                                  <p class="mb-0"><?php echo $name . " " . $prenom ?></p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Email</p>
                                  <p class="mb-0"><?php echo $email ?></p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Phone</p>
                                  <p class="mb-0">(+212) <?php echo $phone ?></p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Address</p>
                                  <p class="mb-0"><?php echo $address ?></p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Genre</p>
                                  <p class="mb-0"><?php echo $genre ?></p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Age</p>
                                  <p class="mb-0"><?php echo $age ?></p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0 pb-0">
                              <p class="mb-1 text-muted">Address</p>
                              <p class="mb-0"><?php echo $address ?></p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form action="/ENSAH-service/inc/functions/edit-profil.php" method="post" class="tab-pane" id="profile-2"
                  role="tabpanel" aria-labelledby="profile-tab-2">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-header">
                          <h5>Personal Information</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12 text-center mb-3">
                              <div class="user-upload wid-75">
                                <img class="rounded-circle img-fluid wid-70" src="<?php echo $image ?>"
                                  alt="User image">
                                <label for="uplfile" class="img-avtar-upload">
                                  <i class="ti ti-camera f-24 mb-1"></i>
                                  <span>Upload</span>
                                </label>
                                <input type="file" id="uplfile" class="d-none">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="nom" value="<?php echo $name ?>">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="prenom" value="<?php echo $prenom ?>">
                              </div>
                            </div>
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

                              <select name="birthday_year" id="year" class="selectInput" required>
                                <option disabled class="defaultOption" value="" <?php if (empty($birthday_year))
                                  echo 'selected'; ?>>Année</option>
                                <!-- Années de 2025 à 1900 -->
                                <?php for ($i = 2025; $i >= 1900; $i--) {
                                  echo "<option value='$i'>$i</option>";
                                } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Genre</label>
                              <select name="genre" class="form-select selectInput" required>
                                <option disabled class="defaultOption" <?php if (empty($genre))
                                  echo 'selected'; ?>>Selectionner Genre</option>
                                <option <?php if ($genre == "Masculin")
                                  echo 'selected'; ?>>Masculin</option>
                                <option <?php if ($genre == "Féminin")
                                  echo 'selected'; ?>>Féminin</option>
                              </select>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" name="bio"><?php echo $bio ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-header">
                          <h5>Contact Information</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="form-label">Linkedin</label>
                                <input type="text" name="linkedin" class="form-control" value="<?php echo $linkedin ?>">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address"><?php echo $address ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <input class="btn btn-primary" style="width:150px;" type="submit" name="submit"
                        value="Update Profile"></input>
                    </div>
                  </div>
                </form>
                <form method="POST" action="/ENSAH-service/inc/functions/changepass.php" class="tab-pane" id="profile-4"
                  role="tabpanel" aria-labelledby="profile-tab-4">
                  <div class="card">
                    <div class="card-header">
                      <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Old Password</label>
                            <input type="text" class="form-control passwordInput" name="oldpassword">
                          </div>
                          <p style="color:red"><?php if (isset($oldpass_error)) {
                            echo $oldpass_error;
                          } ?></p>
                          <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control newpassInput" name="newpassword">
                          </div>
                          <p style="color:red"><?php if (isset($newpass_error)) {
                            echo $newpass_error;
                          } ?></p>
                          <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control confirmpassInput" name="confirmpass">
                          </div>
                          <p style="color:red"><?php if (isset($confirmpass_error)) {
                            echo $confirmpass_error;
                          } ?></p>
                          <p style="color:red"><?php if (isset($changepass_error)) {
                            echo $changepass_error;
                          } ?></p>
                        </div>
                        <div class="col-sm-6">
                          <h5>New password must contain:</h5>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="lengthMsg"><i class="ti ti-minus me-2" id="checklength"></i>
                              At least 8
                              characters</li>
                            <li class="list-group-item" id="lowerMsg"><i class="ti ti-minus me-2" id="checklower"></i>
                              At least 1
                              lower letter (a-z)
                            </li>
                            <li class="list-group-item" id="upperMsg"><i class="ti ti-minus me-2" id="checkupper"></i>
                              At least 1
                              uppercase letter
                              (A-Z)</li>
                            <li class="list-group-item" id="numberMsg"><i class="ti ti-minus me-2" id="checknumber"></i>
                              At least 1
                              number (0-9)</li>
                            <li class="list-group-item" id="specialMsg"><i class="ti ti-minus me-2"
                                id="checkspecial"></i> At least 1
                              special characters
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <input type="submit" class="btn btn-primary" name="submit" value="Update Profile"></input>
                    </div>
                  </div>
                </form>
                <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                          <h5>Email Settings</h5>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-4">Setup Email Notification</h6>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Email Notification</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Send Copy To Personal Email</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <h5>Updates from System Notification</h5>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-4">Email you with?</h6>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">News about PCT-themes products and feature updates</p>
                            </div>
                            <div class="form-check p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Tips on getting more out of PCT-themes</p>
                            </div>
                            <div class="form-check p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Things you missed since you last logged into PCT-themes</p>
                            </div>
                            <div class="form-check  p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">News about products and other services</p>
                            </div>
                            <div class="form-check p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Tips and Document business products</p>
                            </div>
                            <div class="form-check p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                          <h5>Activity Related Emails</h5>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-4">When to email?</h6>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Have new notifications</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">You're sent a direct message</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Someone adds you as a connection</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <hr class="my-4">
                          <h6 class="mb-4">When to escalate emails?</h6>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Upon new order</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">New membership approval</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                              <p class="text-muted mb-0">Member registration</p>
                            </div>
                            <div class="form-check form-switch p-0">
                              <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch"
                                checked="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <div class="btn btn-primary">Update Profile</div>
                    </div>
                  </div>
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
  <!-- [ Main Content ] end -->
  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">ENSAH-service &COPY; 2025-Tous droits réservés.</p>
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





  <script>layout_change('light');</script>




  <script>change_box_container('false');</script>



  <script>layout_rtl_change('false');</script>


  <script>preset_change("preset-1");</script>


  <script>font_change("Public-Sans");</script>

  <script>
    // Declare passwordinput
    let password = document.querySelector(".passwordInput");
    let newpass = document.querySelector(".newpassInput"); // Updated to match the correct class
    let pass = [password, newpass];
    let confirmPass = document.querySelector(".confirmpassInput");
    // Declare checkpassword icons
    let checklength = document.querySelector("#checklength");
    let checklower = document.querySelector("#checklower");
    let checkupper = document.querySelector("#checkupper");
    let checknumber = document.querySelector("#checknumber");
    let checkspecial = document.querySelector("#checkspecial");
    // Declare checkpassword messages
    let lengthMsg = document.querySelector("#lengthMsg");
    let lowerMsg = document.querySelector("#lowerMsg");
    let upperMsg = document.querySelector("#upperMsg");
    let numberMsg = document.querySelector("#numberMsg");
    let specialMsg = document.querySelector("#specialMsg");


    function setCheckState(el, msg, isValid) {
      el.classList.remove("ti-minus", "me-2", isValid ? "ti-x" : "ti-check");
      el.classList.add(isValid ? "ti-check" : "ti-x");
      msg.style.color = isValid ? "green" : "red";
    }
    pass.forEach(element => {
      element.addEventListener("input", (e) => {
        let val = e.target.value;

        let isLengthValid = val.length >= 8;
        let hasLower = /[a-z]/.test(val);
        let hasUpper = /[A-Z]/.test(val);
        let hasNumber = /[0-9]/.test(val);
        let hasSpecial = /[!@#$%^&*(),.?:{}|<>]/.test(val);

        setCheckState(checklength, lengthMsg, isLengthValid);
        setCheckState(checklower, lowerMsg, hasLower);
        setCheckState(checkupper, upperMsg, hasUpper);
        setCheckState(checknumber, numberMsg, hasNumber);
        setCheckState(checkspecial, specialMsg, hasSpecial);

        let allValid = isLengthValid && hasLower && hasUpper && hasNumber && hasSpecial;
        e.target.style.borderColor = allValid ? "#00db00" : "red";
      });
    });
    confirmPass.addEventListener("input", (e) => {
      let val = e.target.value;
      let newPassValue = newpass.value || ""; // Access the first element of newpass NodeList
      if (val === newPassValue) {
        e.target.style.borderColor = "#00db00";
      } else {
        e.target.style.borderColor = "red";
      }
    });


  </script>




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