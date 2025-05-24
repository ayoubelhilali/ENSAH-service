<?php
// fichier : get_stats.php
header('Content-Type: application/json');
require_once '../connections.php';

$users_stmt = $pdo->query("SELECT  COUNT(*) as total FROM user ");
$users_data = $users_stmt->fetchAll(PDO::FETCH_ASSOC);

$profs_stmt = $pdo->query("SELECT  COUNT(*) as total FROM professeur ");
$profs_data = $profs_stmt->fetchAll(PDO::FETCH_ASSOC);

$cords_stmt = $pdo->query("SELECT  COUNT(*) as total FROM coordonnateur ");
$cords_data = $cords_stmt->fetchAll(PDO::FETCH_ASSOC);

$chefs_stmt = $pdo->query("SELECT  COUNT(*) as total FROM chef_depart ");
$chefs_data = $chefs_stmt->fetchAll(PDO::FETCH_ASSOC);

$vacataires_stmt = $pdo->query("SELECT  COUNT(*) as total FROM vacataire ");
$vacataires_data = $vacataires_stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'employés' => $users_data,
    'professeurs' => $profs_data,
    'chefs du département' => $chefs_data,
    'coordonnateurs' => $cords_data,
    'vacataires' => $vacataires_data
]);