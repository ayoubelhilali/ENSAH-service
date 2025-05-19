<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'connections.php'; // Assure-toi que ce fichier existe

try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['filiere_ID']) || empty($input['filiere_ID'])) {
        throw new Exception('ID de filière manquant.');
    }

    $filiere_ID = $input['filiere_ID'];

    // Vérifie si la filière existe
    $check = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE filiere_ID = ?");
    $check->execute([$filiere_ID]);

    if ($check->fetchColumn() == 0) {
        throw new Exception("Filière introuvable.");
    }

    // Supprimer
    $delete = $pdo->prepare("DELETE FROM filiere WHERE filiere_ID = ?");
    $deleted = $delete->execute([$filiere_ID]);

    if ($deleted) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception("Échec lors de la suppression.");
    }
} catch (Exception $e) {
    http_response_code(500); // important pour faire comprendre à JS qu'il y a une erreur serveur
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
