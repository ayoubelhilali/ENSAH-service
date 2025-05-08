<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once 'connections.php'; // Assure-toi que le chemin est correct

$input = json_decode(file_get_contents("php://input"), true);
$user_ID = $input['user_ID'] ?? null;

if ($user_ID) {
    // Check if the user is in the vacataire table
    $checkVacataire = $pdo->prepare("SELECT COUNT(*) FROM vacataire WHERE user_ID = ?");
    $checkVacataire->execute([$user_ID]);
    $isVacataire = $checkVacataire->fetchColumn() > 0;

    if ($isVacataire) {
        $pdo->prepare("DELETE FROM vacataire WHERE user_ID = ?")->execute([$user_ID]);
    } else {
        $pdo->prepare("DELETE FROM professeur WHERE user_ID = ?")->execute([$user_ID]);
    }

    $query = "DELETE FROM user WHERE user_ID = ?";
    $stmt = $pdo->prepare($query);

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