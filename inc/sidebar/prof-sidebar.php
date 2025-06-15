<style>
  .pc-sidebar {
    width: 250px;
    height: 100vh;
    background-color: #000075;
    color: white;
    font-family: 'Segoe UI', sans-serif;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
  }

  .pc-sidebar .navbar-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .pc-sidebar .m-header {
    padding: 20px;
    text-align: center;
    background-color: #000075;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .pc-sidebar .m-header img {
    max-height: 50px;
  }

  .navbar-content {
    flex: 1;
    overflow-y: auto;
    padding-top: 20px;
  }

  .pc-navbar {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .pc-item {
    margin: 5px 0;
  }

  .pc-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: white;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
  }

  .pc-link:hover {
    background-color: #1a1aa0;
    color: #ffde59;
  }

  .pc-link i {
    margin-right: 12px;
    font-size: 18px;
    min-width: 20px;
  }

  .pc-caption {
    padding: 10px 20px;
    font-size: 13px;
    font-weight: bold;
    color: #b08862;
    text-transform: uppercase;
  }

  .pc-item.logout a {
    color: #ff6b6b !important;
  }

  .pc-item.logout a:hover {
    background-color: #b52b2b;
    color: white !important;
  }
</style>

<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="#" class="b-brand">
        <img src="/ENSAH-service/assets/images/logo-withoutBG.png" alt="logo">
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item">
          <a href="#" class="pc-link">
            <i class="ti ti-dashboard"></i>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <li class="pc-caption">Gestion</li>

        <li class="pc-item">
          <a href="/ENSAH-service/Prof_interface.php" class="pc-link">
            <i class="ti ti-book"></i>
            <span class="pc-mtext">Unités d'enseignement</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="/ENSAH-service/uploader_note.php" class="pc-link">
            <i class="ti ti-building-community"></i>
            <span class="pc-mtext">Uploader les notes</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="/ENSAH-service/pages/annonces-list.php" class="pc-link">
            <i class="ti ti-speakerphone"></i>
            <span class="pc-mtext">Annonces</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="/ENSAH-service/historique_prof.php" class="pc-link">
            <i class="ti ti-history"></i>
            <span class="pc-mtext">Historique</span>
          </a>
        </li>
        <li class="pc-item logout">
          <a href="/ENSAH-service/logout.php" class="pc-link">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
            <span class="pc-mtext">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
