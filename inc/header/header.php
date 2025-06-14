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
            <i class="ti ti-bell-ringing position-relative ">
              <?php
              // Count unread notifications
              $sql = "SELECT COUNT(*) FROM `notifications` WHERE status = 'unread' AND (type='general' OR (type='personel' AND id_user=?) OR type=?)";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$_SESSION["user"]["user_id"], $_SESSION["user"]["role"]]);
              $unreadCount = $stmt->fetchColumn();
              ?>
              <!-- Display unread count -->
              <?php
              if ($unreadCount > 0) { ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  style="font-size: 0.6em;" id="unread-count">
                  <?php
                  echo $unreadCount;
                  ?>
                </span>
              <?php } ?>
            </i>
          </a>
          <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header d-flex align-items-center justify-content-between">
              <h5 class="m-0">Notifications</h5>
              <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
              style="max-height: calc(100vh - 255px); overflow-y: auto;">
              <div class="list-group list-group-flush w-100">

                <?php
                $sql = "SELECT * FROM `notifications` WHERE status = 'unread' ORDER BY date_time DESC LIMIT 4";
                $stmt = $pdo->query($sql);
                $hasNotif = false;

                while ($notification = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $hasNotif = true;
                  if($notification["type"]=="general" || ($notification["type"]=="personel" && $notification["id_user"] == $_SESSION["user"]["user_id"]) ||
                      ($notification["type"]==$_SESSION["user"]["role"])) {
                    // Display only general and user notifications
                  ?>
                  <div class="list-group-item list-group-item-action mb-2 border rounded shadow-sm notification-item d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <h6 class="mb-0 text-primary fw-bold"><?= htmlspecialchars($notification["title"]) ?></h6>
                      <small class="text-muted ms-2">
                        <?php
                        $notificationDate = new DateTime($notification["date_time"]);
                        $now = new DateTime();
                        $diff = date_diff($notificationDate, $now);
                        if ($diff->d == 0) {
                          echo "Aujourd'hui";
                        } elseif ($diff->d == 1) {
                          echo "Hier";
                        } else {
                          echo $diff->d . " jours";
                        }
                        ?>
                      </small>
                    </div>
                    <p class="text-body mb-2 mt-1"><?= nl2br(htmlspecialchars($notification["content"])) ?></p>
                    <div class="d-flex justify-content-end">
                      <button class="btn btn-sm btn-outline-success"
                        onclick="markAsRead(<?= $notification['id_notification'] ?>)">
                        ✅ Marquer comme lu
                      </button>
                    </div>
                  </div>
                <?php }} ?>

                <?php if (!$hasNotif) { ?>
                  <div class="text-center text-muted py-3">
                    Aucune notification pour le moment.
                  </div>
                <?php } ?>

              </div>
            </div>

            <!-- Exemple de fonctions JS (à compléter selon ton back-end) -->
            <script>
              function markAsRead(id) {
                // Appeler une API pour marquer comme lu (exemple AJAX)
                console.log("Marquer comme lu : " + id);
                fetch('/ENSAH-service/inc/functions/notifications/marquer_lu.php?id=' + id)
                  .then(response => response.json())
                  .then(data => {
                    console.log(data);
                    if (data.status === 'success') {
                      // Mettre à jour l'interface utilisateur : retirer ou griser la notification
                      const notifElem = document.querySelector('.notification-item button[onclick="markAsRead(' + id + ')"]').closest('.notification-item');
                      if (notifElem) {
                        notifElem.classList.add('bg-light', 'text-muted');
                        notifElem.querySelectorAll('button').forEach(btn => btn.disabled = true);
                        notifElem.style.transition = 'opacity 0.5s ease';
                        notifElem.style.opacity = '0';
                        notifCount = document.getElementById('unread-count');
                        if (notifCount) {
                          notifCount.textContent = parseInt(notifCount.textContent) - 1;
                          if (parseInt(notifCount.textContent) <= 0) {
                            notifCount.remove();
                          }
                        }
                        setTimeout(() => {
                          notifElem.remove();
                        }, 500);

                      }
                    } else {
                      console.error(data.message);
                    }
                  })
                  .catch(error => console.error('Erreur:', error));
              }

              function deleteNotification(id) {
                // Appeler une API pour supprimer la notification (exemple AJAX)
                console.log("Supprimer notification : " + id);
                fetch('supprimer_notification.php?id=' + id);
              }
            </script>

            <!-- Un peu de style CSS pour embellir -->
            <style>
              .notification-item {
                transition: background-color 0.3s ease;
              }

              .notification-item:hover {
                background-color: #f8f9fa;
              }
            </style>

            <div class="dropdown-divider"></div>
            <div class="text-center py-2">
              <a href="/ENSAH-service/pages/notifications-list.php" class="link-primary">View all</a>
            </div>
          </div>
        </li>
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
                        <span
                          class="float-end text-muted"><?= date("d M Y H:i", strtotime($annonce["annonce_date"])) ?></span>
                        <h6 class="text-body mb-1"> <b><?= $annonce["annonce_head"] ?> </b></h6>
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
                    class="ti ti-power text-danger"
                    onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');"></i></a>
              </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1"
                  type="button" role="tab" aria-controls="drp-tab-1" aria-selected="true"><i class="ti ti-user"></i>
                  Profile</button>
              </li>
            </ul>
            <div class="tab-content" id="mysrpTabContent">
              <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1"
                tabindex="0">
                <a href="/ENSAH-service/pages/profil.php" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span> Profile</span>
                </a>
                <a href="/ENSAH-service/pages/profil.php" class="dropdown-item">
                  <i class="ti ti-clipboard-list"></i>
                  <span>Editer Profile</span>
                </a>
                <a href="/ENSAH-service/pages/annonces-list.php" class="dropdown-item">
                  <i class="ti ti-speakerphone"></i>
                  <span>Annonces</span>
                </a>
                <a href="/ENSAH-service/logout.php" class="dropdown-item"
                  onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
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