<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$avatar = '/ENSAH-service/assets/images/avatar-M.jpg';
include($_SERVER['DOCUMENT_ROOT'] . '/ENSAH-service/inc/functions/connections.php');

$selected_year = isset($_GET['annee']) ? $_GET['annee'] : null;
$filiere = $_SESSION['filiere']["filiereID"];
$modules = [];

// Get available years for dropdown (extract year from datetime)
$years_sql = "SELECT DISTINCT YEAR(a.date) AS annee
              FROM affect_ue_vac a
              JOIN unite ue ON ue.unite_ID = a.unite_ID
              JOIN filiere f ON f.filiere_ID = ue.filiere_ID
              WHERE f.filiere_ID = ?
              ORDER BY a.date DESC";
$years_stmt = $pdo->prepare($years_sql);
$years_stmt->execute([$filiere]);
$annees_disponibles = $years_stmt->fetchAll(PDO::FETCH_COLUMN);

// Get modules for selected year
if ($selected_year && in_array($selected_year, $annees_disponibles)) {
    $modules_sql = "SELECT
                    ue.unite_ID, 
                    ue.unite_name AS unite_name,
                    ue.semestre,
                    ue.volume_cours,
                    ue.volume_td,
                    ue.volume_tp,
                    us.nom AS nom, 
                    f.filiere_nom AS filiere,
                    a.date AS date_affectation,
                    DATE_FORMAT(a.date, '%d/%m/%Y') AS date_formatted,
                    DATE_FORMAT(a.date, '%H:%i') AS heure_formatted
                FROM affect_ue_vac a
                JOIN unite ue ON a.unite_ID = ue.unite_ID
                JOIN filiere f ON ue.filiere_ID = f.filiere_ID
                JOIN vacataire V ON V.vacat_Id = a.vacataire_ID
                JOIN user us  on V.user_ID = us.user_ID
                WHERE f.filiere_ID=? AND YEAR(a.date) = ?";
    $stmt = $pdo->prepare($modules_sql);
    $stmt->execute([$filiere, $selected_year]);
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ENSAH-service | Historique des affectations</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Historique des affectations - ENSAH">
    
    <!-- Favicon -->
    <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/x-icon">
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
    
    <!-- Icons -->
    <link rel="stylesheet" href="/ENSAH-service/assets/fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="/ENSAH-service/assets/fonts/feather.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/ENSAH-service/assets/css/style.css">
    <link rel="stylesheet" href="/ENSAH-service/assets/css/style-preset.css">
    <link rel="stylesheet" href="/ENSAH-service/assets/css/main.css">
    
    <style>
        .history-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .year-selector {
            max-width: 300px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .no-data {
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .date-time {
            display: flex;
            flex-direction: column;
        }
        .date-part {
            font-weight: 500;
        }
        .time-part {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- [ Sidebar Menu ] start -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/sidebar/cord-sidebar.php") ?>
    <!-- [ Sidebar Menu ] end -->
    
    <!-- [ Header Topbar ] start -->
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
                                <li class="breadcrumb-item"><a href="/ENSAH-service/pages/vacataire/dashboard.php">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">Historique</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Historique des affectations</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card history-card">
                        <div class="card-body">
                            <!-- Success message -->
                            <?php if (isset($_GET['success']) && isset($_SESSION["success_message"])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= htmlspecialchars($_SESSION["success_message"]) ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION["success_message"]); ?>
                            <?php endif; ?>

                            <!-- Year selector form -->
                            <form  method="GET" class="mb-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="annee" class="form-label">Année académique:</label>
                                        <select name="annee" id="annee" class="form-select year-selector" onchange="this.form.submit()">
                                            <option value="">-- Sélectionner une année --</option>
                                            <?php foreach ($annees_disponibles as $annee): ?>
                                                    <option value="<?= htmlspecialchars($annee) ?>" 
                                                        <?= ($selected_year == $annee) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($annee) ?>/<?= htmlspecialchars($annee + 1) ?>
                                                    </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary mt-4">Afficher</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Modules table -->
                            <?php if (!empty($modules)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="history-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Module</th>
                                                    <th>Semestre</th>
                                                    <th>Filière</th>
                                                    <th>Charge horaire</th>
                                                    <th>Date et heure d'affectation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modules as $index => $module): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= htmlspecialchars($module['unite_name']) ?></td>
                                                            <td><?= htmlspecialchars($module['semestre']) ?></td>
                                                            <td><?= htmlspecialchars($module['filiere']) ?></td>
                                                            <td><?= htmlspecialchars($module['volume_cours']+$module["volume_td"]+$module["volume_tp"]) ?>h</td>
                                                            <td>
                                                                <div class="date-time">
                                                                    <span class="date-part"><?= $module['date_formatted'] ?></span>
                                                                    <span class="time-part"><?= $module['heure_formatted'] ?></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                            <?php else: ?>
                                    <div class="no-data text-center py-5">
                                        <div>
                                            <i class="ti ti-info-circle" style="font-size: 3rem; color: #6c757d;"></i>
                                            <h4 class="mt-3">
                                                <?php if ($selected_year): ?>
                                                        Aucune affectation trouvée pour l'année <?= htmlspecialchars($selected_year) ?>/<?= htmlspecialchars($selected_year + 1) ?>
                                                <?php else: ?>
                                                        Veuillez sélectionner une année académique
                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                    </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">ENSAH-service &copy; <?= date('Y') ?> - Tous droits réservés</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/ENSAH-service/">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Required Js -->
    <script src="/ENSAH-service/assets/js/plugins/popper.min.js"></script>
    <script src="/ENSAH-service/assets/js/plugins/simplebar.min.js"></script>
    <script src="/ENSAH-service/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/ENSAH-service/assets/js/pcoded.js"></script>
    
    <!-- DataTables -->
    <script src="/ENSAH-service/assets/js/plugins/simple-datatables.js"></script>
    <script>
        // Initialize DataTable
        document.addEventListener('DOMContentLoaded', function() {
            const dataTable = new simpleDatatables.DataTable('#history-table', {
                perPage: 10,
                perPageSelect: [5, 10, 15, 20],
                labels: {
                    placeholder: "Rechercher...",
                    perPage: "{select} éléments par page",
                    noRows: "Aucune donnée disponible",
                    info: "Affichage de {start} à {end} sur {rows} éléments"
                },
                columns: [
                    { select: 0, sort: "asc" }, // Sort by first column (index) ascending
                    null,
                    null,
                    null,
                    null,
                    null
                ]
            });
        });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>