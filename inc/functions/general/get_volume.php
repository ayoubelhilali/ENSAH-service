<?php
// fichier : get_volume.php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
require_once '../connections.php';

// Get units data with volume
$query = $pdo->prepare("
    SELECT * from affect_ue_vac VA 
    join unite U on U.unite_ID= VA.unite_ID 
    join vacataire V on V.vacat_ID = VA.vacataire_ID
    where V.vacat_ID = :vacataire_ID
");
$query->bindParam(':vacataire_ID', $_SESSION['user']['vacat_ID'], PDO::PARAM_INT);
$query->execute();

$units = $query->fetchAll(PDO::FETCH_ASSOC);

// Prepare result: each unite with its volume
$result = [];
foreach ($units as $unit) {
    $result[] = [
        'unite_ID' => $unit['unite_ID'],
        'nom_unite' => $unit['unite_name'],
        'volume' => ($unit['volume_cours'] + $unit['volume_td'] + $unit['volume_tp']) * 2, // Assuming volume is calculated as sum of courses, TD, and TP
    ];
}
echo json_encode($result);