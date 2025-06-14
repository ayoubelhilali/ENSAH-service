<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header" style="background-color:#000075;">
      <a href="#" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="/ENSAH-service/assets/images/logo-withoutBG.png" class="img-fluid" alt="logo">
      </a>
    </div>
    <div class="navbar-content" style="background-color:#000075;">
      <ul class="pc-navbar" style=" margin-bottom:30px;">
        <li class="pc-item">
          <a href="/ENSAH-service/dashboard/cord-dash.php" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <li style="color:#b08862" class="pc-item pc-caption">
          <label>Personnels</label>
          <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item">
          <a href="/ENSAH-service/pages/coordonnateur/vacat-list.php" class="pc-link">
            <span class="pc-micon"><i class="ti ti-user"></i></span>
            <span class="pc-mtext">vacataires</span>
          </a>
        </li>

        <li style="color:#b08862" class="pc-item pc-caption">
          <label>Gestion académique </label>
          <i class="ti ti-news"></i>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
              class="pc-mtext">Descriptif</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/ue_list.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-book"></i></span>
                <span class="pc-mtext">consulter descriptif </span>
              </a>
            </li>
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/import-desc.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-file-import"></i></span>
                <span class="pc-mtext">Importer descriptif </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
              class="pc-mtext">Affectation des UE</span><span class="pc-arrow"><i
                data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/affect_ue_list.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-clipboard-check"></i></span>
                <span class="pc-mtext">consulter les affectaions </span>
              </a>
            </li>
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/affect_vacant.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                <span class="pc-mtext">affecter une UE</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="fa-solid fa-calendar-days"></i></span><span
              class="pc-mtext">Emploi du temps</span><span class="pc-arrow"><i
                data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/emploi_list.php" class="pc-link">
                <span class="pc-micon"><i class="fa-regular fa-calendar-days"></i></span>
                <span class="pc-mtext">consulter les emploi </span>
              </a>
            </li>
            <li class="pc-item">
              <a href="/ENSAH-service/pages/coordonnateur/uploader-emploi.php" class="pc-link">
                <span class="pc-micon"><i class="fa-solid fa-calendar-plus"></i></span>
                <span class="pc-mtext">uploader emploi</span>
              </a>
            </li>
          </ul>
        </li>

        <li style="color:#b08862" class="pc-item pc-caption">
          <label>Other</label>
          <i class="ti ti-brand-chrome"></i>
        </li>

        <li class="pc-item">
          <a href="/ENSAH-service/pages/profil.php" class="pc-link">
            <span class="pc-micon"><i class="ti ti-user"></i></span>
            <span class="pc-mtext">Profile</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-speakerphone"></i></span><span
              class="pc-mtext">Les annonces</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item">
              <a href="/ENSAH-service/pages/annonces-list.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-list"></i></span>
                <span class="pc-mtext">consulter les annonces </span>
              </a>
            </li>
            <li class="pc-item">
              <a href="/ENSAH-service/pages/annonces.php" class="pc-link">
                <span class="pc-micon"><i class="ti ti-speakerphone"></i></span>
                <span class="pc-mtext"> creer une annonce</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="pc-item">
          <a href="/ENSAH-service/pages/historique.php" class="pc-link">
            <span class="pc-micon"><i class="ti ti-history"></i></span>
            <span class="pc-mtext">Historique</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="/ENSAH-service/logout.php" style="color:red;" class="pc-link">
            <span class="pc-micon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                <path d="M15 12h-12l3 -3" />
                <path d="M6 15l-3 -3" />
              </svg></span>
            <span class="pc-mtext">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>