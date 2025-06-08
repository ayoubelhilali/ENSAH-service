<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/functions/connections.php");
// 📁 Dossier de destination
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
$targetDirectory = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/uploads/notes/";
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true); // Crée le dossier s’il n’existe pas
}

// 📦 Récupération des données du formulaire
$unite_ID = $_POST['unite'] ?? '';
$session = $_POST['session'] ?? '';
// Génére automatiquement "2023/2024"
$annee_courante = date("Y");
$mois = date("n"); // 1 (janvier) à 12 (décembre)

if ($mois < 9) {
    // On est encore dans la saison de l'année précédente
    $annee_debut = $annee_courante - 1;
    $annee_fin = $annee_courante;
} else {
    $annee_debut = $annee_courante;
    $annee_fin = $annee_courante + 1;
}

$saison = "$annee_debut/$annee_fin";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["document"];
    $fileName = basename($file["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $targetFile = $targetDirectory . $fileName;
    echo "$targetFile";
    // ✅ Types autorisés
    $allowedTypes = ["pdf", "doc", "docx"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Préparer l’insertion
            $stmt = $pdo->prepare("INSERT INTO vacataire_note (unite_ID, session,vacataire_ID, annee, file_path) VALUES (:unite_ID, :session, :vacataire_ID, :annee, :file_path)");
            $stmt->execute([
                ':unite_ID' => $unite_ID,
                ':session' => $session,
                ':vacataire_ID' => $_SESSION['user']['vacat_ID'], // Assurez-vous que l'ID du vacataire est dans la session
                ':annee' => $saison, // Année actuelle
                ':file_path' => "/ENSAH-service/uploads/notes/" . $fileName,
            ]);
            // Vérifier si l'insertion a réussi
            if ($stmt->rowCount() > 0) {
                // Enregistrement réussi
                $_SESSION["success_message"] = "✅ Fichier uploadé et enregistré dans la base de données.";
            } else {
                // Échec de l'enregistrement
                $_SESSION["error_message"] = "Une erreur est survenue lors de l'enregistrement dans la base de données.";
            }
            header("Location: /ENSAH-service/pages/vacataire/uploader_note.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Une erreur est survenue lors du téléchargement.";
            header("Location: /ENSAH-service/pages/vacataire/uploader_note.php");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Type de fichier non autorisé. Veuillez uploader un PDF ou un document Word.";
        header("Location: /ENSAH-service/pages/vacataire/uploader_note.php");
        exit();
    }
}
?>
