<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once 'connections.php'; // Assure-toi que le chemin est correct

$input = json_decode(file_get_contents("php://input"), true);
$user_ID = $input['user_ID'] ?? null;

if ($user_ID) {
    $query = "DELETE user, professeur 
              FROM user 
              INNER JOIN professeur ON professeur.user_ID = user.user_ID 
              WHERE user.user_ID = ?";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$user_ID])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur dans l\'exécution SQL.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID utilisateur invalide.']);
}
?>