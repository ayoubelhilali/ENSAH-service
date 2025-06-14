
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');
require_once '../connections.php';

$units_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM unite WHERE unite.filiere_ID = ?");
$units_stmt->execute([$_SESSION["filiere"]["filiereID"]]);
$units_data = $units_stmt->fetchAll(PDO::FETCH_ASSOC);

$affected_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM affect_ue_vac A 
join unite U on U.unite_ID=A.unite_ID
WHERE U.filiere_ID = ?");
$affected_stmt->execute([$_SESSION["filiere"]["filiereID"]]);
$affected_data = $affected_stmt->fetchAll(PDO::FETCH_ASSOC);

$unite_non_affecte = [
    ['total' => $units_data[0]['total'] - $affected_data[0]['total']]
];

echo json_encode([
    'unite' => $units_data,
    'unite_non_affecte' => $unite_non_affecte,
    'unite_affecte' => $affected_data,
]);