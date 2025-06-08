<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/ENSAH-service/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
require_once $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/inc/functions/connections.php";
// 📁 Dossier de destination


$targetDirectory = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/uploads/descreptif/";
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true); // Crée le dossier s’il n’existe pas
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["document"];
    $fileName = basename($file["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $targetFile = "{$targetDirectory}{$fileName}";
    $date = date("Y-m-d H:i:s"); // Date actuelle pour l'enregistrement
    echo (string)$targetFile;
    // ✅ Types autorisés
    $allowedTypes = ["xlsx", "xls", "xml"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // extract data and insert in database
            $inputFileName = $_SERVER['DOCUMENT_ROOT'] . "/ENSAH-service/uploads/descreptif/{$fileName}";

            // Charger le fichier Excel
            $spreadsheet = IOFactory::load($inputFileName);

            // Sélectionner la première feuille
            $sheet = $spreadsheet->getActiveSheet();

            // Lire toutes les lignes et colonnes avec les données
            $data = $sheet->toArray();

            $modules = []; // This will store the extracted module data
            // Iterate through the rows, skipping the header row
            foreach ($data as $rowIndex => $row) {
                // Skip the header row (assuming header is at index 0)
                if ($rowIndex === 0 || $rowIndex === 1) {
                    continue;
                }

                // Ensure the row has enough columns to avoid errors
                if (count($row) > 5) { // Check if there are at least 6 columns (0 to 5)
                    $moduleName = $row[0]; // Column A: Intitulé
                    $semestre = $row[1];
                    $volumeCours = $row[2]; // Column C: Cours
                    $volumeTD = $row[3];    // Column D: TD
                    $volumeTP = $row[4];    // Column E: TP
                    $responsableId = $row[5]; // Column F: responsable_ID

                    // Create an associative array for the current module
                    $moduleData = [
                        'name' => $moduleName,
                        'semestre'=>$semestre,
                        'volume' => [
                            'cours' => $volumeCours,
                            'td' => $volumeTD,
                            'tp' => $volumeTP
                        ],
                        'responsable_id' => $responsableId
                    ];

                    // Add the module data to the database
                    $stmt = $pdo->prepare("INSERT INTO unite (unite_name, unite_resp, volume_cours, volume_td, volume_tp, semestre, filiere_ID) VALUES (:unite_name, :unite_resp, :volume_cours, :volume_td, :volume_tp, :semestre, :filiere_ID)");
                    $stmt->execute([
                        ':unite_name' => $moduleData["name"],
                        ':unite_resp' => $moduleData["responsable_id"],
                        ':volume_cours' => $moduleData["volume"]["cours"],
                        ':volume_td' => $moduleData["volume"]["td"],
                        ':volume_tp' => $moduleData["volume"]["tp"],
                        ':filiere_ID' => $_SESSION['filiere']['filiereID'],
                        ':semestre' => $moduleData["semestre"],
                    ]);
                    if ($stmt->rowCount() > 0) {
                        // Enregistrement réussi
                        $_SESSION["success_message"] = "✅ Fichier uploadé et enregistré dans la base de données.";
                    } else {
                        // Échec de l'enregistrement
                        $_SESSION["error_message"] = "Une erreur est survenue lors de l'enregistrement dans la base de données.";
                    }
                }
            }
            header("Location: /ENSAH-service/pages/coordonnateur/uploader-desc.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Une erreur est survenue lors du téléchargement.";
            header("Location: /ENSAH-service/pages/coordonnateur/uploader-desc.php");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Type de fichier non autorisé. Veuillez uploader un PDF ou un document Word.";
        header("Location: /ENSAH-service/pages/coordonnateur/uploader-emploi.php");
        exit();
    }
}
