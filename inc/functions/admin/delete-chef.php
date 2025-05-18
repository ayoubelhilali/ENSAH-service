<?php
// Start session and include necessary files
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/ENSAH-service/inc/functions/connections.php');

// Verify CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error_message'] = "Erreur de sécurité (jeton CSRF invalide)";
    header("Location: /ENSAH-service/admin/departments.php");
    exit();
}

// Check if delete request is valid
if (!isset($_POST['delete_chef']) || !is_numeric($_POST['delete_chef'])) {
    $_SESSION['error_message'] = "Requête invalide";
    header("Location: /ENSAH-service/admin/departments.php");
    exit();
}

$depart_id = (int) $_POST['delete_chef'];

try {
    // Begin transaction
    $pdo->beginTransaction();

    // 1. First, get the professor ID from chef_depart table
    $stmt = $pdo->prepare("SELECT prof_ID FROM chef_depart WHERE depart_ID = :depart_id");
    $stmt->execute([':depart_id' => $depart_id]);
    $chef = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$chef) {
        throw new Exception("Aucun chef trouvé pour ce département");
    }

    $prof_id = $chef['prof_ID'];

    // 2. Delete from chef_depart table
    $stmt = $pdo->prepare("DELETE FROM chef_depart WHERE depart_ID = :depart_id");
    $stmt->execute([':depart_id' => $depart_id]);

    if ($stmt->rowCount() === 0) {
        throw new Exception("Échec de la suppression du chef de département");
    }

    // 3. Update the professor's role (optional - depends on your business logic)
    // For example, if you want to change their role from "chef" back to "professor"
    $stmt = $pdo->prepare("DELETE FROM chef_depart 
                          WHERE prof_ID = :prof_ID");
    $stmt->execute([':prof_id' => $prof_id]);

    // Commit transaction
    $pdo->commit();

    $_SESSION['success_message'] = "Chef de département supprimé avec succès";
} catch (Exception $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    $_SESSION['error_message'] = "Erreur lors de la suppression: " . $e->getMessage();
    error_log("Delete Chef Error: " . $e->getMessage());
}

// Redirect back to departments page
header("Location: /ENSAH-service/pages/admin/depart-list.php");
exit();
?>