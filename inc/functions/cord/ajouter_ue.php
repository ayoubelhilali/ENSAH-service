<?php
require_once __DIR__ . '/../connections.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Init vars
$nom = $details = $departement = $coordonnateur = "";
$nom_error = $general_error = "";
$errors = 0;

// Formulaire soumis ?
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    // 🔹 Validation des champs
    $nom = !empty($_POST["nom"]) ? htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8') : "";
    if ($nom === "") {
        $nom_error = "Nom du module est obligatoire";
        $errors++;
    }
    $filiere_ue = $_SESSION["filiere"]["filiereID"];
    $volume_cours = !empty($_POST["volume_cours"]) ? (int) $_POST["volume_cours"] : 0;
    $volume_td = !empty($_POST["volume_td"]) ? (int) $_POST["volume_td"] : 0;
    $volume_tp = !empty($_POST["volume_tp"]) ? (int) $_POST["volume_tp"] : 0;
    $specialite = !empty($_POST["spec_ue"]) ? htmlspecialchars($_POST["spec_ue"], ENT_QUOTES, 'UTF-8') : "";

    if (empty($_POST["resp_ue"]) || !is_numeric($_POST["resp_ue"]) || (int) $_POST["resp_ue"] <= 0) {
        $resp_ue = null;
    } else {
        $resp_ue = (int) $_POST["resp_ue"];
    }
    if (empty($_POST["semes_ue"]) || !in_array($_POST["semes_ue"], ['S1', 'S2','S3','S4','S5'])) {
        $errors++;
    } else {
        $semes_ue = $_POST["semes_ue"];
    }

    // 🔹 Insertion si pas d'erreur
    if ($errors == 0) {
        $sql = "INSERT INTO unite(unite_name, unite_specialite, unite_resp, volume_cours, volume_td, volume_tp,semestre,filiere_ID)
                VALUES(:nom, :specialite, :resp, :vc, :vtd, :vtp,:sem,:fil)";
        $stmt = $pdo->prepare($sql);

        $success = $stmt->execute([
            ':nom' => $nom,
            ':specialite' => $specialite,
            ':resp' => $resp_ue,
            ':vc' => $volume_cours,
            ':vtd' => $volume_td,
            ':vtp' => $volume_tp,
            ':sem' => $semes_ue,
            ':fil' => $filiere_ue,
        ]);

        if ($success) {
            $_SESSION['success_message'] = "Unité ajoutée avec succès!";
            header("Location: /ENSAH-service/pages/coordonnateur/ue_list.php?success=1");
            exit;
        } else {
            $general_error = "Erreur lors de l'ajout.";
            $_SESSION['error_message'] = $general_error;
            header("Location: /ENSAH-service/pages/coordonnateur/ue_list.php?error=1");
            exit;
        }
    } else {
        $general_error = "Veuillez corriger les erreurs du formulaire.";
        $_SESSION['error_message'] = $general_error;
        header("Location: /ENSAH-service/pages/coordonnateur/ue_list.php?error=1");
        exit;
    }
}
?>