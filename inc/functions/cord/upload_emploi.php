<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/functions/connections.php");
// 📁 Dossier de destination
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$targetDirectory = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/uploads/emploi/";
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true); // Crée le dossier s’il n’existe pas
}

// 📦 Récupération des données du formulaire
$semestre = $_POST['semestre'] ?? '';
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
    $date = date("Y-m-d H:i:s"); // Date actuelle pour l'enregistrement
    echo "$targetFile";
    // ✅ Types autorisés
    $allowedTypes = ["pdf", "doc", "docx"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Préparer l’insertion
            $stmt = $pdo->prepare("INSERT INTO emploi (semestre, annee,filiereID, file_path, date_publication) VALUES (:semestre, :annee, :filiereID, :file_path, :date_publication)");
            $stmt->execute([
                ':semestre' => $semestre,
                ':annee' => $saison, // Année actuelle
                ':filiereID' => $_SESSION['filiere']['filiereID'], // Assurez-vous que la filière est dans la session
                ':file_path' => "/ENSAH-service/uploads/emploi/" . $fileName,
                ':date_publication' => $date,
            ]);
            // Vérifier si l'insertion a réussi
            if ($stmt->rowCount() > 0) {
                // Enregistrement réussi
                $_SESSION["success_message"] = "✅ Fichier uploadé et enregistré dans la base de données.";
            } else {
                // Échec de l'enregistrement
                $_SESSION["error_message"] = "Une erreur est survenue lors de l'enregistrement dans la base de données.";
            }
            header("Location: /ENSAH-service/pages/coordonnateur/uploader-emploi.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Une erreur est survenue lors du téléchargement.";
            header("Location: /ENSAH-service/pages/coordonnateur/uploader-emploi.php");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Type de fichier non autorisé. Veuillez uploader un PDF ou un document Word.";
        header("Location: /ENSAH-service/pages/coordonnateur/uploader-emploi.php");
        exit();
    }
}
?>