<?php
session_start();
require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php';
?>

<div class="pc-content">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="mb-4">Unités d'enseignement assurées</h4>

      <div class="card table-card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="pc-dt-simple">
              <thead>
                <tr>
                  <th rowspan="2">Unité d'enseignement</th>
                  <th rowspan="2">Spécialité</th>
                  <th rowspan="2">Responsable</th>
                  <th colspan="3">Volume horaire</th>
                  <th rowspan="2">Semestre</th>
                </tr>
                <tr>
                  <th>Cours</th>
                  <th>TD</th>
                  <th>TP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM voeux v
                        JOIN unite u ON v.id_unite = u.unite_ID
                        WHERE v.id_prof = ? AND v.status = ?";
                $stmt = $pdo->prepare($sql);

                if ($stmt->execute([$_SESSION['user']['user_id'], 1])) {
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  if (empty($rows)) {
                    echo "<tr><td colspan='7'>Aucune unité d'enseignement assurée !</td></tr>";
                  } else {
                    foreach ($rows as $row) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row["unite_name"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["unite_specialite"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["unite_resp"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["volume_cours"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["volume_td"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["volume_tp"]) . "</td>";
                      echo "<td>" . htmlspecialchars($row["semestre"]) . "</td>";
                      echo "</tr>";
                    }
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <h5>Revenir à la page précédente <a href="Prof_interface.php">ici</a></h5>
    </div>
  </div>
</div>
