<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    // Redirect to login if not authenticated
    header('Location: ../login.php');
    exit();
}
$role = $_SESSION['user']['role'];
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>ENSAH services - Uploader Emploi</title>
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
    <?php
    if ($role == "admin") {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/admin-sidebar.php");
    } else if ($role == "coordonnateur") {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/cord-sidebar.php");
    } else if ($role == "vacataire") {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/vacat-sidebar.php");
    } else if ($role == "professeur") {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/prof-sidebar.php");
    } else {
        // Handle unexpected roles or redirect to an error page
        header('Location: /ENSAH-service/error.php');
        exit();
    }
    ?>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/header/header.php"); ?>
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
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">L'emploi</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Uploader l'emploi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <form action="/ENSAH-service/inc/functions/cord/upload_emploi.php" method="post" class="row"
                enctype="multipart/form-data">
                <!-- [ form-element ] start -->
                <div class="col-sm-6" style="width: 100%;">
                    <!-- Basic Inputs -->
                    <div class="col-sm-12">
                        <div class="card w-100">
                            <div class="card-header">
                                <h5>Uploader l'emploi</h5>
                            </div>
                            <?php
                            if (isset($_SESSION["success_message"])) { ?>
                                <div class="alert alert-success">
                                    <?php
                                    echo $_SESSION["success_message"];

                                    ?>
                                </div><?php } ?>
                            <script>
                                setTimeout(() => {
                                    document.querySelector(".alert").style.display = "none";
                                }, timeout = 5000);
                            </script>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Semestre</label>
                                    <select name="semestre" class="form-select selectInput" required>
                                        <option disabled class="defaultOption" selected>Selectionner la semestre </option>
                                        <option>S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                        <option>S4</option>
                                        <option>S5</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-label" for="exampleTextarea">Uploader le document (.pdf / .doc
                                        /.docx)</label>
                                    <div class="mb-3">
                                        <input class="form-control" name="document" type="file" id="formFile"
                                            accept=".pdf, .doc, .docx">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="annoncer" class="btn btn-primary me-2" value="Uploader">
                                <button type="reset" class="btn btn-light">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] end -->
            </form>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">ENSAH-service &copy; 2025 - Tous droits réservés.</p>
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





    <script>layout_change('light');</script>




    <script>change_box_container('false');</script>



    <script>layout_rtl_change('false');</script>


    <script>preset_change("preset-1");</script>


    <script>font_change("Public-Sans");</script>


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