<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    // Redirect to login if not authenticated
    header('Location: /ENSAH-service/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ENSAH services - Les annonces</title>
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

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <?php if ($_SESSION['user']['role'] == 'admin') {
        require_once(__DIR__ . "/../inc/sidebar/admin-sidebar.php");
    } else {
        require_once __DIR__ . "/../inc/sidebar/cord-sidebar.php";
    } ?>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <?php require_once(__DIR__ . "/../inc/header/header.php"); ?>
    <!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/ENSAH-service/dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Les annonces</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Les annonces</h2>
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
                            <!-- -------------------------------------->
                            <!-- success and error messages -->
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
                            <!-------------------------------------->
                            <!-- get annonces data -->
                            <?php
                            // Get all annonces from database
                            $annonces_query = "SELECT * FROM annonces A order by annonce_date DESC";
                            $stmt = $pdo->prepare($annonces_query);
                            $stmt->execute();
                            $all_annonces = $stmt;
                            ?>
                            <!---------------------------------->
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr class="table-header">
                                            <th>#</th>
                                            <th >Titre de l'annonce</th>
                                            <th>Description</th>
                                            <th>Date de publication</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($annonce = $all_annonces->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td><?= $annonce['annonce_ID'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <?= htmlspecialchars($annonce['annonce_head'], ENT_QUOTES, 'UTF-8') ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <span><?= (strlen($annonce['annonce_body']) > 50) ? substr(htmlspecialchars($annonce['annonce_body'], ENT_QUOTES, 'UTF-8'), 0, 50) . ' . . .' : htmlspecialchars($annonce['annonce_body'], ENT_QUOTES, 'UTF-8') ?></span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="mb-1 text-muted">
                                                                <span><?= $annonce['annonce_date'] ?></span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <ul class="list-inline me-auto mb-0">
                                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            title="View">
                                                            <a href="#" class="avtar avtar-xs btn-link-secondary view-btn"
                                                                data-bs-toggle="modal" data-bs-target="#annonce-modal"
                                                                data-annonce_Head="<?= $annonce['annonce_head']; ?>"
                                                                data-desc="<?= $annonce['annonce_body']; ?>"
                                                                data-date="<?= $annonce['annonce_date']; ?>">
                                                                <i class="ti ti-eye f-18"></i>
                                                            </a>
                                                        </li>
                                                        <?php if ($_SESSION['user']['role'] == 'admin') { ?>
                                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip">
                                                                <a href="#" class="avtar avtar-xs btn-link-danger affect-btn"
                                                                    title="Supprimer l'annonce" data-bs-toggle="modal"
                                                                    data-bs-target="#ue-affect-modal"
                                                                    onclick="deleteAnnonce(<?= $annonce['annonce_ID']; ?>)">
                                                                    <i class="ti ti-trash f-18"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
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
    </section>
    <div class="modal fade" id="annonce-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="">
                <div class="modal-header border-0 pb-0">
                    <h5 class="mb-0">Détails de l'annonce</h5>
                    <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
                        <i class="ti ti-x f-20"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <h5 class="mb-0">Détails de l'annonce</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <p class="mb-1 text-muted">Titre de l'annonce</p>
                                            <h6 class="mb-0" id="modal-titre" style="color:#000061;"></h6>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Description</p>
                                            <h6 class="mb-0" id="modal-desc" style="color:#000061;"></h6>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Date de publication</p>
                                            <h6 class="mb-0" id="modal-date" style="color:#000061;"></h6>
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
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">ENSAH-services &copy; 2025-Tous droits réservés.</p>
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
    <script>layout_change('light');</script>
    <script>change_box_container('false');</script>



    <script>layout_rtl_change('false');</script>


    <script>preset_change("preset-1");</script>


    <script>font_change("Public-Sans");</script>
    <script>
        function deleteAnnonce(annonceID) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette annonce ?")) {
                console.log(annonceID);
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';

                const input = document.createElement('input');
                input.name = 'delete_annonce';
                input.value = annonceID;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    <?php
    function deleteAnnonce($annonceID)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM annonces WHERE annonce_ID = :annonce_id");
        $stmt->execute(['annonce_id' => $annonceID]);
        return $stmt->rowCount() > 0;
    }

    if (isset($_POST['delete_annonce'])) {
        $annonce_id = $_POST['delete_annonce'];
        if (deleteAnnonce($annonce_id)) {
            echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                const successMsg = document.querySelector('.success-msg');
                if (successMsg) {
                  successMsg.innerHTML = '<div class=\"alert alert-success\">annonce supprimé avec succès.</div>';
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
    <script>
        // afficher les details d'une annonce
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', () => {
                    // Get the data from the clicked button
                    const titre = button.getAttribute('data-annonce_Head');
                    const desc = button.getAttribute('data-desc');
                    const date = button.getAttribute('data-date');

                    // Populate the modal with the data
                    document.getElementById('modal-titre').textContent = `${titre}`;
                    document.getElementById('modal-desc').textContent = `${desc}`;
                    document.getElementById('modal-date').textContent = `${date}`;
                });
            });
        });
    </script>

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