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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page">User List</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Chefs des departements List</h2>
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
                  <i class="ti ti-plus f-18"></i> Add User
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>User Name</th>
                      <th>Contact</th>
                      <th>Age</th>
                      <th>Country</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>179</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Addie Bass</h5>
                            <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>45</td>
                      <td>United Kingdom</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Russia</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>133</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Alberta Robbins</h5>
                            <p class="text-muted f-12 mb-0">miza@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>20</td>
                      <td>Honduras</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-4.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Grenada</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-5.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Azerbaijan</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>179</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-6.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Addie Bass</h5>
                            <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>45</td>
                      <td>Kiribati</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-7.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Kiribati</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>133</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-8.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Alberta Robbins</h5>
                            <p class="text-muted f-12 mb-0">miza@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>20</td>
                      <td>Croatia</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-9.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Panama</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>179</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Addie Bass</h5>
                            <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>45</td>
                      <td>United Kingdom</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Russia</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>133</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/avatar-M.jpg" alt="user-image" class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Alberta Robbins</h5>
                            <p class="text-muted f-12 mb-0">miza@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>20</td>
                      <td>Honduras</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-4.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Grenada</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-5.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Azerbaijan</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>179</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-6.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Addie Bass</h5>
                            <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>45</td>
                      <td>Kiribati</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-7.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Kiribati</td>
                      <td><span class="badge bg-light-primary rounded-pill f-12">Pending</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>133</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-8.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Alberta Robbins</h5>
                            <p class="text-muted f-12 mb-0">miza@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>20</td>
                      <td>Croatia</td>
                      <td><span class="badge bg-light-success rounded-pill f-12">Verified</span> </td>
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
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>60</td>
                      <td>
                        <div class="row">
                          <div class="col-auto pe-0">
                            <img src="../assets/images/user/avatar-9.jpg" alt="user-image"
                              class="wid-40 rounded-circle">
                          </div>
                          <div class="col">
                            <h5 class="mb-0">Agnes McGee</h5>
                            <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                          </div>
                        </div>
                      </td>
                      <td>+1 (247) 849-6968</td>
                      <td>42</td>
                      <td>Panama</td>
                      <td><span class="badge bg-light-danger rounded-pill f-12">Rejected</span> </td>
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
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-map-pin"></i>
                      <p class="mb-0" id="modal-pays">--</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                      <i class="ti ti-link"></i>
                      <a href="#" class="link-primary">
                        <p class="mb-0" id="modal-link">--</p>
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
                          <h6 class="mb-0" id="modal-dob"></h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Genre</p>
                          <h6 class="mb-0" id="modal-genre"></h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                      <p class="mb-1 text-muted">Adresse</p>
                      <h6 class="mb-0" id="modal-adresse">--</h6>
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

  <div class="modal fade" id="user-edit_add-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Edit Customer</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3 text-center mb-3">
              <div class="user-upload wid-75">
                <img src="../assets/images/user/avatar-5.jpg" alt="img" class="img-fluid">
                <label for="uplfile" class="img-avtar-upload">
                  <i class="ti ti-camera f-24 mb-1"></i>
                  <span>Upload</span>
                </label>
                <input type="file" id="uplfile" class="d-none">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Name">
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-select">
                  <option>Select Status</option>
                  <option>Complicated</option>
                  <option>Single</option>
                  <option>Relationship</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Location</label>
                <textarea class="form-control" rows="3" placeholder="Enter Location"></textarea>
              </div>
              <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                <label class="form-check-label h5 pe-3 mb-0" for="customSwitchemlnot1">Make Contact Info Public
                  <span class="text-muted w-75 d-block text-sm f-w-400 mt-2">Means that anyone viewing your profile will
                    be able to see your contacts details</span>
                </label>
                <input class="form-check-input h4 m-0 position-relative" type="checkbox" id="customSwitchemlnot1"
                  checked="">
              </div>
              <hr class="my-3">
              <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                <label class="form-check-label h5 pe-3 mb-0" for="customSwitchemlnot2">Available to hire
                  <span class="text-muted w-75 d-block text-sm f-w-400 mt-2">Toggling this will let your teammates know
                    that you are available for acquiring new projects</span>
                </label>
                <input class="form-check-input h4 m-0 position-relative" type="checkbox" id="customSwitchemlnot2"
                  checked="">
              </div>
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
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
            <li class="list-inline-item"><a href="/ENSAH-service/">Home</a></li>
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
        document.getElementById('modal-nom').textContent = button.getAttribute('data-nom') + ' ' + button.getAttribute('data-prenom');
        document.getElementById('modal-poste').textContent = button.getAttribute('data-poste');
        document.getElementById('modal-email').textContent = button.getAttribute('data-email');
        document.getElementById('modal-fullname').textContent = button.getAttribute('data-nom') + ' ' + button.getAttribute('data-prenom');
        document.getElementById('modal-cin').textContent = button.getAttribute('data-cin');
        document.getElementById('modal-dob').textContent = button.getAttribute('data-dob');
        document.getElementById('modal-genre').textContent = button.getAttribute('data-genre');
        document.getElementById('modal-pays').textContent = button.getAttribute('data-pays');
        document.getElementById('modal-about').textContent = button.getAttribute('data-about');
      });
    });
  </script>







  <script>layout_change('light');</script>




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