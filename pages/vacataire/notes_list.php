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
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ENSAH-service | les notes</title>
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
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/sidebar/vacat-sidebar.php") ?>
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
                                <li class="breadcrumb-item" aria-current="page">liste des notes</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Consulter les notes</h2>
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
                                            <th>Unité d'enseignement</th>
                                            <th>Session</th>
                                            <th>Filière</th>
                                            <th>semestre</th>
                                            <th>année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $units_query = "SELECT * FROM vacataire_note VA join unite U on VA.unite_ID=U.unite_ID  join filiere F on F.filiere_ID=U.filiere_ID  where VA.vacataire_ID = :vacataire_ID";
                                        $stmt = $pdo->prepare($units_query);
                                        $stmt->execute([
                                            ':vacataire_ID' => $_SESSION['user']['vacat_ID']
                                        ]);
                                        $all_notes = $stmt;
                                        while ($note = $all_notes->fetch(PDO::FETCH_ASSOC)) {
                                            $resp_query = $pdo->prepare("SELECT * FROM affect_ue_vac A  
                                            join vacataire V on A.vacataire_ID=V.vacat_ID 
                                            join user U2 on V.user_ID=U2.user_ID
                                            WHERE A.vacataire_ID = :affect_ue");
                                            $resp_query->execute([':affect_ue' => $note['vacataire_ID']]);
                                            $resp_ue = $resp_query->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                                <td><?= $note['Note_ID'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($note['unite_name'], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1"><?= $note['session'] ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1"><?= $note['filiere_nom'] ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($note["semestre"], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($note["annee"], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            title="Download">
                                                            <a href="<?php echo $note['file_path']; ?>" download="" class="avtar avtar-xs btn-link-danger remove-user">
                                                                <i class="ti ti-download f-18"></i>
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
    <form action="/ENSAH-service/inc/functions/cord/affect_ue_vacat.php" method="post" class="modal fade"
        id="ue-affect-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" enctype="multipart/form-data">
        <input type="hidden" name="avatar_path" id="avatar-path">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">Affecter unité a un vacataire</h5>
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
                                    placeholder="Nom de l'unité" id="modal-nom" value="" readonly>
                                <input type="hidden" name="unite_ID" id="modal-id" value="">
                            </div>
                            <div class="form-group">
                                <label class="form-label">volume horaire</label>
                                <div class="volume-inp" style="display:flex;gap:30px;">
                                    <input required name="volume_cours" type="number" class="form-control"
                                        placeholder="cours(h)" id="modal-volumeC" value="" readonly>
                                    <input required name="volume_td" type="number" class="form-control"
                                        placeholder="TD (h)" value="" id="modal-volumeTd" readonly>
                                    <input required name="volume_tp" type="number" class="form-control"
                                        placeholder="TP (h)" value="" id="modal-volumeTp" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Semestre de l'unité</label>
                                <input required name="semestre" type="text" class="form-control nameInput"
                                    placeholder="Semestre de l'unité" id="modal-semes" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">choisir le vacataire</label>
                                <select value="" name="vacataire" class="form-select" id="modal-vacats" required>
                                    <option disabled selected>choisir le vacataire</option>
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
        // affect unit to a vacataire :
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.affect-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Get the data from the clicked button
                    const unit_ID = button.getAttribute('data-unit');
                    const unit_nom = button.getAttribute('data-nom');
                    const volume_cours = button.getAttribute('data-volumeC');
                    const volume_td = button.getAttribute('data-volumeTd');
                    const volume_tp = button.getAttribute('data-volumeTp');
                    const semestre = button.getAttribute('data-semestre');
                    // Get the vacats data from the button
                    const vacatsData = button.getAttribute('data-vacats');
                    console.log(vacatsData);
                    const vacatsList = document.getElementById('modal-vacats');
                    // Set the values in the modal
                    document.getElementById('modal-nom').value = unit_nom;
                    document.getElementById('modal-id').value = unit_ID;
                    document.getElementById('modal-volumeC').value = volume_cours;
                    document.getElementById('modal-volumeTd').value = volume_td;
                    document.getElementById('modal-volumeTp').value = volume_tp;
                    document.getElementById('modal-semes').value = semestre;
                    try {
                        // Clear existing options
                        const firstOption = vacatsList.querySelector('option:first-child');
                        vacatsList.innerHTML = '';
                        if (firstOption) {
                            vacatsList.appendChild(firstOption); // Keep the first option
                            firstOption.selected = true;
                        }
                        const vacats = JSON.parse(vacatsData); // Parse JSON string
                        vacats.forEach(vacat => {
                            const option = document.createElement('option');
                            option.textContent = vacat.nom + " " + vacat.prenom; // Set the text of the option to the professor's name
                            option.value = vacat.vacat_ID; // Set the value of the option to the professor's ID
                            vacatsList.appendChild(option);
                        });
                    } catch (error) {
                        console.error('Invalid vacats data:', error);
                    }

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