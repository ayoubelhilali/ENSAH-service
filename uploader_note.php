<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Formulaire d'upload des notes pour les professeurs ENSAH.">
  <meta name="keywords" content="ENSAH, professeur, notes, upload, csv, excel">
  <meta name="author" content="ENSAH-service">

  <title>ENSAH-service | Uploader Notes</title>

  <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/png"> 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/tabler-icons.min.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/feather.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/fontawesome.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/fonts/material.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style.css">
  <link rel="stylesheet" href="/ENSAH-service/assets/css/style-preset.css">
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

  <!-- Pre-loader -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- Sidebar -->
  <?php 
    include_once 'C:\xampp\htdocs\ENSAH-service\inc\sidebar\prof-sidebar.php';
    include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/header/header.php");
  ?>

  <!-- Contenu principal -->
  <div class="pc-container">
    <div class="pc-content">
      <h4 class="mb-4">Uploader les Notes :</h4>

      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="traitement_note.php">

            <!-- Module -->
            <div class="mb-3">
              <label for="module" class="form-label">Module</label>
              <select name="unite_id" id="module" class="form-select" required>
                <option value="">-- Choisir un module --</option>
                <?php 
                $unites = $pdo->prepare("SELECT * FROM voeux v 
                                         JOIN unite u ON v.id_unite=u.unite_ID 
                                         WHERE v.id_prof=? AND v.status=?");
                if ($unites->execute([$_SESSION["user"]["prof_id"], 1])) {
                  $rows = $unites->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($rows as $row) {
                    echo '<option value="'.$row['unite_ID'].'">'.$row['unite_name'].'</option>';
                  }
                }
                ?>
              </select>
            </div>

            <!-- Session -->
            <div class="mb-3">
              <label for="session" class="form-label">Session</label>
              <select name="session" id="session" class="form-select" required>
                <option value="normale">Session normale</option>
                <option value="rattrapage">Rattrapage</option>
              </select>
            </div>

            <!-- Fichier -->
            <div class="mb-3">
              <label for="fichier_notes" class="form-label">Fichier Excel / CSV</label>
              <input type="file" name="fichier_notes" id="fichier_notes" class="form-control" accept=".xlsx, .xls" required>
            </div>

            <!-- Bouton -->
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-upload me-1"></i> Enregistrer les notes
              </button>
            </div>

          </form>

          <!-- Message retour -->
          <?php if (isset($_GET['succes'])): ?>
            <div class="mt-3">
              <?php if ($_GET['succes'] == 1): ?>
                <div class="alert alert-success" role="alert">
                   Fichier importé avec succès.
                </div>
              <?php elseif ($_GET['succes'] == 0): ?>
                <div class="alert alert-danger" role="alert">
                  ❌ Impossible de lire le fichier.
                </div>
              <?php else: ?>
                <div class="alert alert-warning" role="alert">
                   Aucun fichier reçu.
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
