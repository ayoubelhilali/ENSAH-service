<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to login if not authenticated
    header('Location: ../../login.php');
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
    <title>ENSAH-service | les modules</title>
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
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/sidebar/cord-sidebar.php") ?>
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
                                <li class="breadcrumb-item"><a href="/ENSAH-service/dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Unités d'enseignement</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Liste des unités d'enseignement</h2>
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

                            $profs_json = htmlspecialchars(json_encode($profs), ENT_QUOTES, 'UTF-8');
                            ?>
                            <div class="text-end p-4 pb-0">
                                <a href="#" class="btn btn-primary d-inline-flex align-items-center add-unite"
                                    data-bs-toggle="modal" data-bs-target="#ue-add-modal"
                                    data-profs='<?= $profs_json ?>'>
                                    <i class="ti ti-plus f-18"></i> Ajouter unité d'enseignement
                                </a>
                                <div id="success-msg" class="success-msg" style="color: green; margin-top: 10px;">
                                    <?php if (isset($_GET['success']) && isset($_SESSION["success_message"])): ?>
                                        <?= "✅" . htmlspecialchars($_SESSION["success_message"], ENT_QUOTES, 'UTF-8'); ?>
                                        <?php unset($_SESSION["success_message"]); ?>
                                    <?php endif; ?>
                                </div>

                                <div id="error-msg" class="error-msg" style="color: red; margin-top: 10px;">
                                    <?php if (isset($_GET['error']) && isset($_SESSION["error_message"])): ?>
                                        <?= htmlspecialchars($_SESSION["error_message"], ENT_QUOTES, 'UTF-8'); ?>
                                        <?php unset($_SESSION["error_message"]); ?>
                                    <?php endif; ?>
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
                                            <th>#</th>
                                            <th>Nom d'unité d'enseignement</th>
                                            <th colspan="3" style="text-align: center;">Volume horaire</th>
                                            <th>Spécialité</th>
                                            <th>responsable</th>
                                            <th>semestre</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $units_query = "SELECT * FROM unite WHERE filiere_ID = :filiere ORDER BY semestre,unite_ID";
                                        $stmt = $pdo->prepare($units_query);
                                        $stmt->execute([':filiere' => $_SESSION['filiere']['filiereID']]);
                                        $all_units = $stmt;
                                        while ($unit = $all_units->fetch(PDO::FETCH_ASSOC)) {
                                            $resp_query = $pdo->prepare("SELECT * FROM professeur P
                                            JOIN user U ON P.user_ID = U.user_ID
                                            WHERE P.prof_ID = :resp_ue");
                                            $resp_query->execute([':resp_ue' => $unit['unite_resp']]);
                                            $has_resp = false;
                                            if($resp_ue = $resp_query->fetch(PDO::FETCH_ASSOC)){
                                                $has_resp = true;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $unit['unite_ID'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($unit['unite_name'], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1"><span
                                                                    style="color: brown;"><?= $unit['volume_cours'] . "h" ?></span>
                                                                cours</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1"><span
                                                                    style="color: brown;"><?= $unit['volume_td'] . "h" ?></span>
                                                                TD</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1"><span
                                                                    style="color: brown;"><?= $unit['volume_tp'] . "h" ?></span>
                                                                TP</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($unit['unite_specialite'], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= $has_resp ? "Dr. " . htmlspecialchars($resp_ue['nom'], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($resp_ue['prenom'], ENT_QUOTES, 'UTF-8'): "Aucun responsable" ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($unit["semestre"], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            title="View">
                                                            <a href="#" class="avtar avtar-xs btn-link-secondary view-btn"
                                                                data-bs-toggle="modal" data-bs-target="#unit-modal"
                                                                data-resp="<?= $has_resp ? $resp_ue['nom'] . " " . $resp_ue['prenom'] : "l'unité n'est pas affecté a aucun professeur"; ?>"
                                                                data-respEmail="<?= $has_resp ? $resp_ue['email'] : ''; ?>"
                                                                data-phone="<?= $has_resp ? (($resp_ue['Phone'] && $resp_ue['Phone'] != '0') ? $resp_ue['Phone'] : '(+212)') : ' '; ?>"
                                                                data-linkedin="<?= $has_resp ? $resp_ue['linkedin'] : ''; ?>"
                                                                data-respImg="<?php echo isset($resp_ue["image"]) && !empty($resp_ue["image"]) ? $resp_ue["image"] : '/ENSAH-service/assets/images/avatar-M.jpg'; ?>"
                                                                data-unitName="<?= $unit['unite_name']; ?>"
                                                                data-spec="<?= $unit['unite_specialite']; ?>"
                                                                data-filiere="<?= $_SESSION['filiere']['filiereNom']?? "vide" ?>"
                                                                data-volume="<?=($unit["volume_cours"]+$unit["volume_td"]+$unit["volume_tp"]) ."h (". $unit['volume_cours']."h cours ".$unit["volume_td"]."h TD ".$unit["volume_tp"]."h TP )"; ?>">
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
                                                            <a href="#" onclick="deleteUnit(<?= $unit['unite_ID']; ?>)"
                                                                class="avtar avtar-xs btn-link-danger remove-filiere"
                                                                data-unite="<?php echo $unit["unite_ID"] ?>">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
    <div class="modal fade" id="unit-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="mb-0">Détails de l'unité</h5>
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
                                        <span class="badge bg-primary">responsable</span>
                                    </div>
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img id="modal-resp-img" class="rounded-circle img-fluid wid-60" src=""
                                                alt="User image">
                                        </div>
                                        <h5 class="mb-0" id="modal-resp"></h5>
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
                                    <h5>Détails de l'unité</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Nom de l'unité</p>
                                                    <h6 class="mb-0" id="modal-fullname"></h6>
                                                </div>

                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">filière</p>
                                                    <h6 class="mb-0" id="modal-filiere"></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Spécialité</p>
                                                    <h6 class="mb-0" id="modal-spec"></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">volume horaire</p>
                                                    <h6 class="mb-0" id="modal-volume"></h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /row -->
                </div> <!-- /modal-body -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dialog -->
    </div>

    <form action="/ENSAH-service/inc/functions/cord/ajouter_ue.php" method="post" class="modal fade" id="ue-add-modal"
        data-bs-keyboard="false" tabindex="-1" aria-hidden="true" enctype="multipart/form-data">
        <input type="hidden" name="avatar_path" id="avatar-path">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Ajouter unité s'enseignement</h5>
                    <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
                        <i class="ti ti-x f-20"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label class="form-label">Nom d'unité d'enseignement</label>
                                <input required name="nom" type="text" class="form-control nameInput"
                                    placeholder="Nom de l'unité" value="">
                            </div>
                            <div class="form-group">
                                <label class="form-label">volume horaire</label>
                                <div class="volume-inp" style="display:flex;gap:30px;">
                                    <input required name="volume_cours" type="number" class="form-control"
                                        placeholder="cours(h)" value="">
                                    <input required name="volume_td" type="number" class="form-control"
                                        placeholder="TD (h)" value="">
                                    <input required name="volume_tp" type="number" class="form-control"
                                        placeholder="TP (h)" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">spécialité du module</label>
                                <select value="" name="spec_ue" class="form-select" id="" required>
                                    <option disabled selected>choisir spécialité</option>
                                    <option>spécialité 1</option>
                                    <option>spécialité 2</option>
                                    <option>spécialité 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">responsable du module</label>
                                <select value="" name="resp_ue" class="form-select" id="modal-profs" required>
                                    <option disabled selected>choisir responsable</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">semestre du module</label>
                                <select value="" name="semes_ue" class="form-select" id="" required>
                                    <option disabled selected>choisir semestre</option>
                                    <option>S1</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                    <option>S4</option>
                                    <option>S5</option>
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


    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">ENSAH-service &copy; 2025-All rights reserved </p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/ENSAH-service/index.html">Home</a></li>
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

        // add responsable to a module
        document.querySelectorAll(".add-unite").forEach(button => {
            button.addEventListener('click', () => {
                const profsData = button.getAttribute('data-profs');
                const profsList = document.getElementById('modal-profs');
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
    </script>
    <script>
        // afficher les details d'une unitée
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Get the data from the clicked button
                    const unit_nom = button.getAttribute('data-unitName');
                    const spec = button.getAttribute('data-spec');
                    const filiere_Nom = button.getAttribute('data-filiere');
                    const volume = button.getAttribute('data-volume');
                    const resp_nom = button.getAttribute('data-resp');
                    const resp_img = button.getAttribute('data-respImg');
                    const resp_email = button.getAttribute('data-respEmail');
                    const phone = button.getAttribute('data-phone');
                    const linkedin = button.getAttribute('data-linkedin');

                    // Populate the modal with the data
                    document.getElementById('modal-fullname').textContent = `${unit_nom}`;
                    document.getElementById('modal-spec').textContent = `${spec}`;
                    document.getElementById('modal-filiere').textContent = `${filiere_Nom}`;
                    document.getElementById('modal-volume').textContent = `${volume}`;
                    document.getElementById('modal-resp').textContent = `${resp_nom}`;
                    document.getElementById('modal-resp-img').src = `${resp_img}`;
                    document.getElementById('modal-email').textContent = `${resp_email}`;
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
        function deleteUnit(unitID) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce module ?")) {
                console.log(unitID);
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';

                const input = document.createElement('input');
                input.name = 'delete_unit';
                input.value = unitID;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    <?php
    function deleteUnit($unitID)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM unite WHERE unite_ID = :unite_id");
        $stmt->execute(['unite_id' => $unitID]);
        return $stmt->rowCount() > 0;
    }

    if (isset($_POST['delete_unit'])) {
        $unit_id = $_POST['delete_unit'];
        if (deleteUnit($unit_id)) {
            echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '<div class=\"alert alert-success\">module supprimé avec succès.</div>';
                }
              });
              setTimeout(function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '';
                  window.location.reload();
                }
              }, 1500);
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
                                        data-value="false"><span><img
                                                src="/ENSAH-service/assets/images/customization/default.svg"
                                                alt="img"></span><span>Light</span></a>
                                    <a href="#!" class="" onclick="layout_change('dark')" data-value="true"><span><img
                                                src="/ENSAH-service/assets/images/customization/dark.svg"
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
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 1</span></a>
                                    <a href="#!" class="" data-value="preset-2"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 2</span></a>
                                    <a href="#!" class="" data-value="preset-3"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 3</span></a>
                                    <a href="#!" class="" data-value="preset-4"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 4</span></a>
                                    <a href="#!" class="" data-value="preset-5"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 5</span></a>
                                    <a href="#!" class="" data-value="preset-6"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 6</span></a>
                                    <a href="#!" class="" data-value="preset-7"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 7</span></a>
                                    <a href="#!" class="" data-value="preset-8"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
                                                alt="img"></span><span>Theme 8</span></a>
                                    <a href="#!" class="" data-value="preset-9"><span><img
                                                src="/ENSAH-service/assets/images/customization/theme-color.svg"
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
                                        data-value="false"><span><img
                                                src="/ENSAH-service/assets/images/customization/default.svg"
                                                alt="img"></span><span>Fluid</span></a>
                                    <a href="#!" class="" onclick="change_box_container('true')"
                                        data-value="true"><span><img
                                                src="/ENSAH-service/assets/images/customization/container.svg"
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