<?php
require_once __DIR__ . '/../connections.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Init vars
$ue_id  = $vacataire = "";
$vacat_error = "";
$errors = 0;
// Formulaire soumis ?
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // 🔹 Validation des champs
    $ue_id = $_POST["unite_ID"];
    echo $ue_id;
    if (empty($_POST["vacataire"]) || !is_numeric($_POST["vacataire"]) || $_POST["vacataire"] < 1) {
        $vacat_error = "Veuillez choisir un vacataire";
        $errors++;
    } else {
        $vacataire = (int) $_POST["vacataire"];
    }

    // 🔹 Insertion si pas d'erreur
    if ($errors == 0) {
        $sql = "INSERT INTO affect_ue_vac(unite_ID, vacataire_ID)
        VALUES(:unite, :vacataire)";
        $stmt = $pdo->prepare($sql);

        $success = $stmt->execute([
            ':unite' => $ue_id,
            ':vacataire' => $vacataire
        ]);

        if ($success) {
            $_SESSION['success_message'] = "affectation ajoutée avec succès!";
            header("Location: /ENSAH-service/pages/coordonnateur/affect_vacant.php?success=1");
            exit;
        } else {
            $general_error = "Erreur lors de l'ajout.";
            $_SESSION['error_message'] = $general_error;
            header("Location: /ENSAH-service/pages/coordonnateur/affect_vacant.php?error=1");
            exit;
        }
    } else {
        $general_error = "Veuillez corriger les erreurs du formulaire.";
        $_SESSION['error_message'] = $general_error;
        header("Location: /ENSAH-service/pages/coordonnateur/affect_vacant.php?error=1");
        exit;
    }
}
?>