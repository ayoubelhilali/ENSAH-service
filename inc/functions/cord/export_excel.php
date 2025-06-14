<?php
session_start();
require_once '../connections.php'; // ton fichier de connexion PDO

if (isset($_POST['export_excel'])) {

    $units_query = "SELECT A.*, U.*, V.vacat_ID, U2.nom AS vac_nom, U2.prenom AS vac_prenom
                    FROM affect_ue_vac A 
                    JOIN unite U ON A.unite_ID=U.unite_ID  
                    LEFT JOIN vacataire V ON A.vacataire_ID=V.vacat_ID
                    LEFT JOIN user U2 ON V.user_ID=U2.user_ID
                    WHERE U.filiere_ID = ?";

    $stmt = $pdo->prepare($units_query);
    $stmt->execute([$_SESSION['filiere']['filiereID']]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Headers pour CSV US
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=affectations_ue.csv");

    // BOM UTF-8 pour que Excel lise bien les accents

    // Ouvre la sortie pour écrire le CSV
    $output = fopen("php://output", "w");

    // En-tête des colonnes
    fputcsv($output, ['ID', 'Nom UE', 'Volume Cours', 'Volume TD', 'Volume TP', 'Specialite', 'Affecte a', 'Semestre'], ',');

    // Données
    foreach ($rows as $unit) {
        $affecte = ($unit['vacat_ID']) ? "Dr. " . $unit['vac_nom'] . " " . $unit['vac_prenom'] : "Aucun responsable";

        fputcsv($output, [
            $unit['unite_ID'],
            $unit['unite_name'],
            $unit['volume_cours'],
            $unit['volume_td'],
            $unit['volume_tp'],
            $unit['unite_specialite'],
            $affecte,
            $unit['semestre']
        ], ','); // VIRGULE car Excel US attend ,
    }

    fclose($output);
    exit;

} else {
    header("Location: ton_dashboard.php"); // redirection si pas d'export demandé
    exit;
}
?>
