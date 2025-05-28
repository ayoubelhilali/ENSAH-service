<!-- [ Header ] Start -->
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} 

if (!isset($_SESSION['user'])) {
  // Redirect to login if not authenticated
  header('Location: /ENSAH-service/login.php');
  exit();
}

include($_SERVER['DOCUMENT_ROOT'] . '/ENSAH-service/inc/functions/connections.php');
?>
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <!-- ======= Menu collapse Icon ===== -->
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="dropdown pc-h-item d-inline-flex d-md-none">
          <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="ti ti-search"></i>
          </a>
          <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3">
              <div class="form-group mb-0 d-flex align-items-center">
                <i data-feather="search"></i>
                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
              </div>
            </form>
          </div>
        </li>
        <li class="pc-h-item d-none d-md-inline-flex">
          <form class="header-search">
            <i data-feather="search" class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Search here. . .">
          </form>
        </li>
      </ul>
    </div>
    <!-- [Mobile Media Block end] -->
    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="ti ti-speakerphone"></i>
          </a>
          <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header d-flex align-items-center justify-content-between">
              <h5 class="m-0">Annonces</h5>
              <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
              style="max-height: calc(100vh - 255px)">
              <div class="list-group list-group-flush w-100">
                <?php
                $sql = "SELECT * FROM `annonces` ORDER BY annonce_date DESC limit 4";
                $stmt = $pdo->query($sql);
                $hasAnnonces = false;

                while ($annonce = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $hasAnnonces = true;
                  ?>
                  <a class="list-group-item list-group-item-action">
                    <div class="d-flex">
                      <div class="flex-grow-1 ms-1">
                        <span class="float-end text-muted"><?= date("d M Y H:i", strtotime($annonce["annonce_date"])) ?></span>
                        <h6 class="text-body mb-1"> <b><?=$annonce["annonce_head"]?> </b></h6>
                        <p class="text-body mb-1"><?= $annonce["annonce_body"] ?></p>
                        <span class="text-muted">
                          <?php
                            $annonceDate = new DateTime($annonce["annonce_date"]);
                            $now = new DateTime();
                            $diff = date_diff($annonceDate, $now);
                            if ($diff->d == 0) {
                              echo "Today";
                            } elseif ($diff->d == 1) {
                              echo "Yesterday";
                            } else {
                              echo $diff->d . " days ago";
                            }
                          ?>
                        </span>
                      </div>
                    </div>
                  </a>
                <?php } ?>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="text-center py-2">
              <a href="/ENSAH-service/pages/annonces-list.php" class="link-primary">View all</a>
            </div>
          </div>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
            <img
              src="<?php echo empty($_SESSION["user"]["image"]) ? "/ENSAH-service/assets/images/user_empty.png" : $_SESSION["user"]["image"] ?>"
              alt="user-image" class="user-avtar">
            <span><?php echo $_SESSION["user"]["nom"] ?></span>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
              <div class="d-flex mb-1">
                <div class="flex-shrink-0">
                  <img
                    src="<?php echo empty($_SESSION["user"]["image"]) ? "/ENSAH-service/assets/images/user_empty.png" : $_SESSION["user"]["image"] ?>"
                    alt="user-image" class="user-avtar wid-35">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1"><?php echo $_SESSION["user"]["nom"] . " " . $_SESSION["user"]["prenom"] ?></h6>
                  <span><?php echo $_SESSION["user"]["role"] ?></span>
                </div>
                <a href="/ENSAH-service/logout.php" class="pc-head-link bg-transparent"><i
                    class="ti ti-power text-danger"></i></a>
              </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1"
                  type="button" role="tab" aria-controls="drp-tab-1" aria-selected="true"><i class="ti ti-user"></i>
                  Profile</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="drp-t2" data-bs-toggle="tab" data-bs-target="#drp-tab-2" type="button"
                  role="tab" aria-controls="drp-tab-2" aria-selected="false"><i class="ti ti-settings"></i>
                  Setting</button>
              </li>
            </ul>
            <div class="tab-content" id="mysrpTabContent">
              <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1"
                tabindex="0">
                <a href="/ENSAH-service/pages/profil.php" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span> Profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-clipboard-list"></i>
                  <span>Social Profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-wallet"></i>
                  <span>Billing</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
                </a>
              </div>
              <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-help"></i>
                  <span>Support</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span>Account Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-lock"></i>
                  <span>Privacy Center</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-messages"></i>
                  <span>Feedback</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-list"></i>
                  <span>History</span>
                </a>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
<!-- [ Header ] end -->