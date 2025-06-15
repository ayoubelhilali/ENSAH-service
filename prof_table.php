<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT']. '/ENSAH-service/inc/functions/connections.php';
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

  <title>ENSAH-service | Professeurs </title>

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
$sidebarPath = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/sidebar/prof-sidebar.php";
$headerPath = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/header/header.php";

if (file_exists($sidebarPath)) {
    include_once($sidebarPath);
} else {
    error_log("Sidebar file missing: $sidebarPath");
}

if (file_exists($headerPath)) {
    include_once($headerPath);
} else {
    error_log("Header file missing: $headerPath");
}
?>

  <!-- Contenu principal -->
  <div class="pc-container">
    <div class="pc-content container-fluid">

      <!-- Section Professeurs -->
      <div class="card mb-4">
        <div class="card-header">
          <h4 class="mb-0">Les professeurs appartenant au département</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="pc-dt-prof">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>CIN</th>
                  <th>Spécialité</th>
                  <th>Email</th>
                  <th>Numéro de téléphone</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql = "SELECT * FROM professeur p 
                        JOIN departement d ON d.depart_ID=p.departement  
                        WHERE d.depart_ID=? ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION['user']['depart_id']]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>".htmlspecialchars($row["nom"])."</td>";
                  echo "<td>".htmlspecialchars($row["prenom"])."</td>";
                  echo "<td>".htmlspecialchars($row["CIN"])."</td>";
                  echo "<td>".htmlspecialchars($row["specialite"])."</td>";
                  echo "<td>".htmlspecialchars($row["email"])."</td>";
                  echo "<td>".htmlspecialchars($row["Phone"])."</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
          <form method="POST" action="export_prof.php" target="_blank" class="m-3">
  <button type="submit" class="btn btn-success">
      Exporter
  </button>
</form>
        </div>
      </div>

      <!-- Section Vœux -->
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Les vœux des professeurs</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="pc-dt-voeux">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>CIN</th>
                  <th>Vœux</th>
                  <th>Date soumission</th>
                  <th>Charge totale </th>
                  <th>Validation</th>
                </tr>
              </thead>
              <tbody>
                <?php 
              $sql = "SELECT 
            us.nom, 
            us.prenom, 
            us.CIN, 
            un.unite_name, 
            (un.volume_cours + un.volume_td + un.volume_tp) AS charge_voeu,
            v.date_soumission, 
            v.id_voeux, 
            v.id_prof, 
            v.id_unite,
            total.charge_totale
        FROM voeux v
        JOIN user us ON us.user_ID = v.id_prof
        JOIN unite un ON un.unite_ID = v.id_unite
        JOIN (
            SELECT v2.id_prof, 
                   SUM(un2.volume_cours + un2.volume_td + un2.volume_tp) AS charge_totale
            FROM voeux v2
            JOIN unite un2 ON un2.unite_ID = v2.id_unite
            WHERE v2.status = ?
            GROUP BY v2.id_prof
        ) AS total ON total.id_prof = v.id_prof
        WHERE v.status = ?
        ORDER BY total.charge_totale < 4 DESC, v.date_soumission DESC";



                $stmt = $pdo->prepare($sql);
                $stmt->execute([0,0]);
                $voeux = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($voeux)) {
                  echo '</tbody></table></div>';
                  echo '<div class="alert alert-warning text-center mt-3" role="alert">';
                  echo "Aucun voeu n'a été soumis pour le moment.";
                  echo '</div>';
                }
      else {
    $seuil_min = 180;
    $grouped_voeux = [];

    foreach ($voeux as $row) {
        $id_prof = $row['id_prof'];
        if (!isset($grouped_voeux[$id_prof])) {
            $grouped_voeux[$id_prof] = [
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'CIN' => $row['CIN'],
                'charge_totale' => $row['charge_totale'],
                'date_soumission' => $row['date_soumission'],
                'voeux' => [],
                'id_voeux' => [],
            ];
        }

        $grouped_voeux[$id_prof]['voeux'][] = $row['unite_name'] . " (" . $row['charge_voeu'] . " h)";
        $grouped_voeux[$id_prof]['id_voeux'][] = $row['id_voeux'];
    }

    foreach ($grouped_voeux as $id_prof => $prof) {
        $classe = ($prof['charge_totale'] < 180) ? 'table-danger fw-bold' : '';

        echo "<form method='POST' action='valider_voeux.php'>";
        foreach ($prof['id_voeux'] as $id_voeu) {
            echo "<input type='hidden' name='id_voeux[]' value='" . $id_voeu . "'>";
        }
        echo "<input type='hidden' name='id_prof' value='" . $id_prof . "'>";
        echo "<input type='hidden' name='charge_totale' value='" . $prof['charge_totale'] . "'>";

        echo "<tr class='$classe'>";
        echo "<td>" . htmlspecialchars($prof["nom"]) . "</td>";
        echo "<td>" . htmlspecialchars($prof["prenom"]) . "</td>";
        echo "<td>" . htmlspecialchars($prof["CIN"]) . "</td>";
        echo "<td>";
        foreach ($prof['voeux'] as $voeu) {
            echo htmlspecialchars($voeu) . "<br>";
        }
        echo "</td>";
        echo "<td>" . htmlspecialchars($prof["date_soumission"]) . "</td>";
        echo "<td>" . htmlspecialchars($prof["charge_totale"]) . " h</td>";
        echo "<td>";
        echo "<button type='submit' name='action' value='valider' class='btn btn-sm btn-primary ms-2'>Valider</button>";
        echo "<button type='submit' name='action' value='decliner' class='btn btn-sm btn-danger ms-2'>Décliner</button>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }
}
?>
              </tbody>
            </table>
          </div>
                ?>
          </div>
        </div>
        
      </div>

    </div>
  </div>
 </body>
</html>