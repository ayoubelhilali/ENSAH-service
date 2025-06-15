<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to login if not authenticated
    header('Location: ../login.php');
    exit();
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$avatar = '/ENSAH-service/assets/images/avatar-M.jpg'; // chemin par défaut
include($_SERVER['DOCUMENT_ROOT'] . '/ENSAH-service/inc/functions/connections.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/functions/isStrongPass.php");
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
    <title>ENSAH-service | les filières</title>
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
                                <li class="breadcrumb-item" aria-current="page">filieres</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Liste des filières</h2>
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
                            <!-- get profs data -->
                            <?php
                            // Get all profs from database
                            $profs_query = "SELECT * FROM professeur P
                            JOIN user U ON P.user_ID = U.user_ID";
                            $stmt = $pdo->prepare($profs_query);
                            $stmt->execute();
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
                            // Get all departs from database
                            $departs_query = "SELECT * FROM departement D";
                            $stmt = $pdo->prepare($departs_query);
                            $stmt->execute();
                            $all_departs = $stmt;
                            $departs = [];
                            while ($depart = $all_departs->fetch(PDO::FETCH_ASSOC)) {
                                $departs[] = [
                                    'depart_ID' => $depart['depart_ID'],
                                    'nom' => $depart['depart_nom'],
                                    'details' => $depart['depart_details']
                                ];
                            }
                            $profs_json = htmlspecialchars(json_encode($profs), ENT_QUOTES, 'UTF-8');
                            $departs_json = htmlspecialchars(json_encode($departs), ENT_QUOTES, 'UTF-8');
                            ?>
                            <div class="text-end p-4 pb-0">
                                <a href="#" class="btn btn-primary d-inline-flex align-items-center add-filiere"
                                    data-bs-toggle="modal" data-bs-target="#filiere-add-modal"
                                    data-profs='<?= $profs_json ?>' data-departs='<?= $departs_json ?>'>
                                    <i class="ti ti-plus f-18"></i> Ajouter filière
                                </a>
                                <div id="success-msg" class="success-msg" style="color: green; margin-top: 10px;">
                                    <?php if (isset($_GET['success']) && isset($_SESSION["success_message"])): ?>
                                        <?= "✅" . htmlspecialchars($_SESSION["success_message"], ENT_QUOTES, 'UTF-8'); ?>
                                    <?php endif;
                                    unset($_SESSION["success_message"]);
                                    ?>
                                </div>
                                <script>
                                    setTimeout(function () {
                                        document.getElementById('success-msg').style.display = 'none';
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
                                            <th>Nom du filière</th>
                                            <th>coordonnateur</th>
                                            <th>Département</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $filieres = "SELECT * FROM filiere F";
                                        $all_filieres = $pdo->query($filieres);
                                        if ($all_filieres) {
                                            while ($filiere = $all_filieres->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <?php
                                                if ($filiere['depart_ID'] != null) {
                                                    $depart_query = "SELECT * FROM departement WHERE depart_ID = :depart_id";
                                                    $stmt = $pdo->prepare($depart_query);
                                                    $stmt->execute(['depart_id' => $filiere['depart_ID']]);
                                                    $depart_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                }
                                                // Get the chef of the current department
                                                $cord_query = "SELECT * FROM coordonnateur C 
                                                JOIN professeur P ON C.prof_ID = P.prof_ID
                                                JOIN user U ON P.user_ID = U.user_ID
                                                WHERE C.filiere_ID = :filiere_id";
                                                $stmt = $pdo->prepare($cord_query);
                                                $stmt->execute(['filiere_id' => $filiere['filiere_ID']]);
                                                $cord_row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox">
                                                        </div>
                                                    </td>
                                                    <td><?php echo $filiere['filiere_ID'] ?></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="mb-1"><?php echo $filiere['filiere_nom'] ?></h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $has_cord = 0;
                                                        if ($cord_row) {
                                                            $has_cord = 1;
                                                            ?>
                                                            <div class="d-flex align-items-center" style="margin: 20px;">
                                                                <img src="<?php echo isset($cord_row["image"]) && !empty($cord_row["image"]) ? $cord_row["image"] : '/ENSAH-service/assets/images/avatar-M.jpg'; ?>"
                                                                    alt="Chef du département"
                                                                    class="rounded-circle img-fluid wid-60 me-3"
                                                                    style="width: 50px;">
                                                                <div
                                                                    style="display: flex; flex-direction: column;justify-content: center;">
                                                                    <h5 class="mb-0">
                                                                        <?php echo $cord_row["nom"] . " " . $cord_row["prenom"]; ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="deleteCordin(<?= $filiere['filiere_ID']; ?>)"
                                                                data-cord="<?php echo $cord_row["cord_ID"] ?>">supprimer</button>
                                                        <?php } else { ?>
                                                            <p>le filiere n'a aucun coordonnateur</p>
                                                            <a href="#" class="btn btn-success btn-sm add-cord-fil"
                                                                data-bs-toggle="modal" data-bs-target="#cord-add-modal"
                                                                data-profs="<?= $profs_json ?>"
                                                                data-nom="<?= $filiere['filiere_nom']; ?>"
                                                                data-bio="<?= $filiere['filiere_details']; ?>"
                                                                data-filiere="<?= $filiere['filiere_ID']; ?>">
                                                                Ajouter coordonnateur
                                                            </a>
                                                        <?php } ?>

                                                    </td>
                                                    <td><?php if ($filiere['depart_ID'] != null)
                                                        echo $depart_row['depart_nom'];
                                                    else
                                                        echo "aucun département" ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <ul class="list-inline me-auto mb-0">
                                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                                    title="View">
                                                                    <a href="#" class="avtar avtar-xs btn-link-secondary view-btn"
                                                                        data-bs-toggle="modal" data-bs-target="#filiere-modal"
                                                                        data-cord="<?= $has_cord ? $cord_row['nom'] . " " . $cord_row['prenom'] : "la filiere a aucun coordonnateur"; ?>"
                                                                    data-cordEmail="<?= $has_cord ? $cord_row['cord_email'] : ''; ?>"
                                                                    data-phone="<?= $has_cord ? (($cord_row['Phone'] && $cord_row['Phone'] != '0') ? $cord_row['Phone'] : '(+212)') : ' '; ?>"
                                                                    data-linkedin="<?= $has_cord ? $cord_row['linkedin'] : ''; ?>"
                                                                    data-cordImg="<?php echo isset($cord_row["image"]) && !empty($cord_row["image"]) ? $cord_row["image"] : '/ENSAH-service/assets/images/avatar-M.jpg'; ?>"
                                                                    data-nom="<?= $filiere['filiere_nom']; ?>"
                                                                    data-bio="<?= $filiere['filiere_details']; ?>"
                                                                    data-departement="<?= $depart_row['depart_nom']; ?>">
                                                                    <i class="ti ti-eye f-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                                title="Edit">
                                                                <a href="#" class="avtar avtar-xs btn-link-primary edit-btn"
                                                                    data-bs-toggle="modal" data-bs-target="#filire-edit-modal"
                                                                    data-filiere="<?= $filiere['filiere_ID']; ?>"
                                                                    data-nom="<?= $filiere['filiere_nom']; ?>"
                                                                    data-bio="<?= $filiere['filiere_details']; ?>"
                                                                    data-departement="<?= $depart_row['depart_nom']; ?>">
                                                                    <i class="ti ti-edit-circle f-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                                title="Delete">
                                                                <a href="#"
                                                                    onclick="deleteFil(<?= $filiere['filiere_ID']; ?>)"
                                                                    class="avtar avtar-xs btn-link-danger remove-filiere"
                                                                    data-filiere="<?php echo $filiere["filiere_ID"] ?>">
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
    <div class="modal fade" id="filiere-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="mb-0">Détails du filière</h5>
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
                                        <span class="badge bg-primary">coordonnateur</span>
                                    </div>
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img id="modal-coord-img" class="rounded-circle img-fluid wid-60" src=""
                                                alt="User image">
                                        </div>
                                        <h5 class="mb-0" id="modal-coord"></h5>
                                        <p class="text-muted text-sm" id="modal-poste"></p>
                                        <hr class="my-3">
                                        <div
                                            class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                            <i class="ti ti-mail"></i>
                                            <p class="mb-0" id="modal-email"></p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
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

                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Département</p>
                                                    <h6 class="mb-0" id="modal-departement"></h6>
                                                </div>
                                            </div>
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
                                        -- À propos du filière --
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
    $nom = $details = $departement = $coordonnateur = "";
    $nom_error = $general_error = "";
    $errors = 0;
    $valid_Id = 0;

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Validate Nom
        if (empty($_POST["nom"])) {
            $nom_error = "Nom du filière est obligatoire";
            $errors++;
        } else {
            $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
        }
        $details = htmlspecialchars($_POST["fil_details"], ENT_QUOTES, 'UTF-8');
        if (isset($_POST["dep-fil"]) && is_numeric($_POST["dep-fil"]) && $_POST["dep-fil"] > 0) {
            $departement_id = (int) $_POST["dep-fil"];

            // Vérifie si le département existe
            $stmt_check = $pdo->prepare("SELECT 1 FROM departement WHERE depart_ID = ?");
            $stmt_check->execute([$departement_id]);

            if ($stmt_check->rowCount() > 0) {
                $departement = $departement_id; // ID valide
                $valid_Id = 1;
            } else {
                $departement = 0; // ID invalide
            }
        } else {
            $departement = 0; // Aucun département sélectionné OU "Aucun département" choisi
        }
        echo "filiere: -----------> " . $nom;
        echo "details: -----------> " . $details;
        echo "Depart_ID: -----------> " . $departement;

        // Proceed with insertion if no errors
        if ($errors == 0) {
            // Insert into user table
            if ($departement == 0 || $valid_Id == 0) {
                $add_filiere = "INSERT INTO filiere(filiere_nom, filiere_details) 
                     VALUES('$nom', '$details')";
            } else {
                $add_filiere = "INSERT INTO filiere(filiere_nom, filiere_details, depart_ID) 
                     VALUES('$nom', '$details', '$departement')";
            }
            $stmt = $pdo->prepare($add_filiere);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "filière ajoutée avec succés!";
                header("Location: /ENSAH-service/pages/admin/filiere-list.php?success=1");
                unset($_SESSION["success_message"]);
                exit;
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
                $general_error = "Erreur lors de l'ajout du filière.";
            }
        } else {
            $general_error = "Please correct the errors in the form.";
        }
    }
    ?>
    <form method="post" class="modal fade" id="filiere-add-modal" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" enctype="multipart/form-data">
        <input type="hidden" name="avatar_path" id="avatar-path">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Ajouter filière</h5>
                    <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
                        <i class="ti ti-x f-20"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label class="form-label">Nom du filière</label>
                                <input required name="nom" type="text" class="form-control nameInput"
                                    placeholder="Nom du filière" value="<?php echo htmlspecialchars($nom); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Détails du filière</label>
                                <textarea name="fil_details" class="form-control"
                                    placeholder="Détails du Filière"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">département du filière</label>
                                <select value="" name="dep-fil" class="form-select" id="dep-fil" required>
                                    <option disabled selected>choisir département</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <ul class="list-inline me-auto mb-0">
                        <li class="list-inline-item align-bottom">
                            <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip"
                                title="Delete">
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

    <form method="post" action="/ENSAH-service/inc/functions/admin/add-cord-fil.php" class="modal fade"
        id="cord-add-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Ajouter coordonnateur du filière</h5>
                    <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
                        <i class="ti ti-x f-20"></i> </a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label class="form-label">Nom du filière</label>
                                <input type="text" name="filiere_nom" class="form-control fil-nom"
                                    placeholder="Nom du filière" required readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Coordonnateur du filière</label>
                                <select name="cord_fil" class="form-select" id="modal-profs" required>
                                    <option disabled selected>Choisir Coordonnateur</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email du coordonnateur</label>
                                <input type="email" name="cord_email" class="form-control"
                                    placeholder="Email du coordonnateur" required id="cord_email">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password du coordonnateur</label>
                                <div style="position: relative;">
                                    <input name="cord_password" type="text" placeholder="Entrer password"
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
                            <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip"
                                title="Delete">
                                <i class="ti ti-trash f-18"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-grow-1 text-end">
                        <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add-cord-fil" class="btn btn-primary">Ajouter</button>
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
                    <p class="m-0">ENSAH-service &copy; 2025-All rights reserved </p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/ENSAH-service/">Home</a></li>
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
    <!------------ Supprimer le coordonnateur d'un filiere   ------------->
    <script>
        function deleteCordin(filiereID) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce coordonnateur ?")) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';

                const input = document.createElement('input');
                input.name = 'delete_cord';
                input.value = filiereID;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    <?php
    function deleteCord($filiereID)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM coordonnateur WHERE filiere_ID = :filiere_id");
        $stmt->execute(['filiere_id' => $filiereID]);
        return $stmt->rowCount() > 0;
    }

    if (isset($_POST['delete_cord'])) {
        $filiere_id = $_POST['delete_cord'];
        if (deleteCord($filiere_id)) {
            echo '<script>
                console.log("Coordonnateur deleted successfully");
                </script>';

        }
    }
    ?>
    <script>
        // add coordonnateur to a filiere
        document.querySelectorAll(".add-cord-fil").forEach(button => {
            button.addEventListener('click', () => {
                console.log("btn clicked!");
                const filiereNom = button.getAttribute('data-nom');
                const profsData = button.getAttribute('data-profs');
                const profsList = document.getElementById('modal-profs');
                document.querySelectorAll('.fil-nom').forEach(element => {
                    element.value = filiereNom;
                });
                console.log(filiereNom);
                try {
                    // Clear existing options
                    const firstOption = profsList.querySelector('option:first-child');
                    profsList.innerHTML = '';
                    if (firstOption) {
                        profsList.appendChild(firstOption); // Keep the first option
                        firstOption.selected = true;
                    }
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
        // add departement to a filiere
        document.querySelectorAll(".add-filiere").forEach(button => {
            button.addEventListener('click', () => {

                const departsData = button.getAttribute('data-departs');
                const departList = document.getElementById('dep-fil');
                try {
                    // Clear existing options
                    const firstOption = departList.querySelector('option:first-child');
                    departList.innerHTML = '';
                    if (firstOption) {
                        departList.appendChild(firstOption); // Keep the first option
                        firstOption.selected = true;
                    }
                    const departs = JSON.parse(departsData); // Parse JSON string
                    departs.forEach(depart => {
                        const option = document.createElement('option');
                        option.textContent = depart.nom; // Set the text of the option to the professor's name
                        option.value = depart.depart_ID; // Set the value of the option to the professor's ID
                        departList.appendChild(option);
                    });
                } catch (error) {
                    console.error('Invalid departs data:', error);
                }
            })
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Get the data from the clicked button
                    const bio = button.getAttribute('data-bio');
                    const filiere_nom = button.getAttribute('data-nom');
                    const depart_nom = button.getAttribute('data-departement');
                    const cord_nom = button.getAttribute('data-cord');
                    const cord_img = button.getAttribute('data-cordImg');
                    const cord_email = button.getAttribute('data-cordEmail');
                    const phone = button.getAttribute('data-phone');
                    const linkedin = button.getAttribute('data-linkedin');

                    // Populate the modal with the data
                    document.getElementById('modal-bio').textContent = bio;
                    document.getElementById('modal-fullname').textContent = `${filiere_nom}`;
                    document.getElementById('modal-departement').textContent = `${depart_nom}`;
                    document.getElementById('modal-coord').textContent = `${cord_nom}`;
                    document.getElementById('modal-coord-img').src = cord_img;
                    document.getElementById('modal-email').textContent = `${cord_email}`;
                    document.getElementById('modal-phone').textContent = `${phone}`;
                    document.getElementById('modal-linkedin').textContent = `${linkedin}`;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Get the data from the clicked button
                    const fil_ID = button.getAttribute('data-filiere');
                    const fil_nom = button.getAttribute('data-nom');
                    const fil_bio = button.getAttribute('data-bio');
                    const dep_nom = button.getAttribute('data-departement');

                });
            });
        });
    </script>
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
    <!------------ Supprimer un filière   ------------->
  <script>
    function deleteFil(filiereID) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce filière ?")) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.style.display = 'none';

        const input = document.createElement('input');
        input.name = 'delete_fil';
        input.value = filiereID;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
  <?php
    function deleteFil($filiereID)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM filiere WHERE filiere_ID = :filiere_id");
        $stmt->execute(['filiere_id' => $filiereID]);
        return $stmt->rowCount() > 0;
    }

    if (isset($_POST['delete_fil'])) {
        $filiere_id = $_POST['delete_fil'];
        if (deleteFil($filiere_id)) {
            echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '<div class=\"alert alert-success\">departement supprimé avec succès.</div>';
                }
              });
            </script>";
        }
    }
    ?>
    <!-- [Page Specific JS] start -->
    <script src="/ENSAH-service/assets/js/plugins/simple-datatables.js"></script>
    <script src="/ENSAH-service/assets/js/generatePass.js"></script>
    <script src="/ENSAH-service/assets/js/clearForm.js"></script>
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
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
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
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="layoutmodertl">
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
                                    <a href="#!" class="active" onclick="layout_change('light')"
                                        data-value="false"><span><img src="../assets/images/customization/default.svg"
                                                alt="img"></span><span>Light</span></a>
                                    <a href="#!" class="" onclick="layout_change('dark')" data-value="true"><span><img
                                                src="../assets/images/customization/dark.svg"
                                                alt="img"></span><span>Dark</span></a>
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
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 1</span></a>
                                    <a href="#!" class="" data-value="preset-2"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 2</span></a>
                                    <a href="#!" class="" data-value="preset-3"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 3</span></a>
                                    <a href="#!" class="" data-value="preset-4"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 4</span></a>
                                    <a href="#!" class="" data-value="preset-5"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 5</span></a>
                                    <a href="#!" class="" data-value="preset-6"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 6</span></a>
                                    <a href="#!" class="" data-value="preset-7"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 7</span></a>
                                    <a href="#!" class="" data-value="preset-8"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 8</span></a>
                                    <a href="#!" class="" data-value="preset-9"><span><img
                                                src="../assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 9</span></a>
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
                                    <a href="#!" class="active" onclick="change_box_container('false')"
                                        data-value="false"><span><img src="../assets/images/customization/default.svg"
                                                alt="img"></span><span>Fluid</span></a>
                                    <a href="#!" class="" onclick="change_box_container('true')"
                                        data-value="true"><span><img src="../assets/images/customization/container.svg"
                                                alt="img"></span><span>Container</span></a>
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