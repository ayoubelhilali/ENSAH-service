<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] .'/ENSAH-service/inc/functions/connections.php';

// Récupérer l'ID de l'enseignant connecté
$userId = $_SESSION['user']['prof_id'] ?? null;
if (!$userId) {
    header("Location: login.php") ;
    exit ;
}

// Récupérer les années où ce prof a été affecté
$annees = $pdo->prepare("SELECT annee FROM affect_ue_prof WHERE id_prof = ? ORDER BY annee DESC");
$annees->execute([$userId]);
$annees = $annees->fetchAll();

$anneeSelectionnee = $_POST['annee'] ?? ($annees[0]['annee'] ?? null);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>ENSAH-service | Espace Professeur - Historique</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    padding: 20px;
  }

  .container {
    max-width: 1200px;
    margin: auto;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 8px rgba(0,0,0,0.05);
  }

  h3 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
  }

  select {
    padding: 8px 12px;
    border-radius: 5px;
    border: 1px solid #bbb;
    font-size: 1rem;
    background-color: #f0f0f0;
  }

  .styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 0.95rem;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
    background-color: #fafafa;
  }

  .styled-table thead tr {
    background-color: #dcdcdc; /* Gris clair */
    color: #333;
    text-align: center;
  }

  .styled-table th, .styled-table td {
    padding: 12px 15px;
    border: 1px solid #ccc;
    text-align: center;
  }

  .styled-table tbody tr:nth-of-type(even) {
    background-color: #f2f2f2;
  }

  .styled-table tbody tr:nth-of-type(odd) {
    background-color: #ffffff;
  }

  .styled-table tbody tr:hover {
    background-color: #e0e0e0;
  }

  .alert {
    background-color: #fff3cd;
    color: #856404;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ffeeba;
    margin-top: 20px;
    text-align: center;
  }
</style>

</head>
<body>

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

<div class="container">
  <h3>Historique des unités assurées</h3>
  
  <form method="POST" class="mb-3" action="">
    <label for="annee">Choisir une année scolaire :</label>
    <select name="annee" id="annee" onchange="this.form.submit()">
      <?php foreach ($annees as $a): ?>
        <option value="<?= htmlspecialchars($a['annee']) ?>" 
          <?= ($anneeSelectionnee === $a['annee']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($a['annee']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>

  <?php
  if ($anneeSelectionnee) {
    $stmt = $pdo->prepare("
      SELECT u.unite_name, u.volume_cours, u.volume_td, u.volume_tp, a.annee
      FROM affect_ue_prof a
      JOIN unite u ON a.id_unite = u.unite_ID
      WHERE a.annee = ? AND a.id_prof = ?
      ORDER BY u.unite_name
    ");
    $stmt->execute([$anneeSelectionnee, $userId]);
    $rows = $stmt->fetchAll();

    if (!empty($rows)) {
  ?>
    <table class="styled-table">
      <thead>
        <tr>
          <th>Unité</th>
          <th>Cours (h)</th>
          <th>TD (h)</th>
          <th>TP (h)</th>
          <th>Année</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['unite_name']) ?></td>
            <td><?= htmlspecialchars($r['volume_cours']) ?></td>
            <td><?= htmlspecialchars($r['volume_td']) ?></td>
            <td><?= htmlspecialchars($r['volume_tp']) ?></td>
            <td><?= htmlspecialchars($r['annee']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php } else { ?>
    <div class="alert">Aucune donnée trouvée pour l’année : <?= htmlspecialchars($anneeSelectionnee) ?></div>
  <?php }} ?>
</div>
</body>
</html>
