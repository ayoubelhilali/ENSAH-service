<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once 'vendor/autoload.php';
require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_SESSION['user']) || !isset($_SESSION['user']['depart_id'])) {
    die("Accès refusé.");
}

$depart_id = $_SESSION['user']['depart_id'];

// Requête
$sql = "SELECT 
    u.unite_name,
    f.filiere_nom,
    u.unite_specialite,
    u.semestre,
    u.volume_cours,
    u.volume_td,
    u.volume_tp,
    COALESCE(ui.nom, uv.nom) AS nom_professeur,
    COALESCE(ui.prenom, uv.prenom) AS prenom_professeur,
    CASE 
        WHEN ui.user_id IS NOT NULL THEN 'Interne'
        WHEN uv.user_id IS NOT NULL THEN 'Vacataire'
        ELSE 'Non affecté'
    END AS type_professeur
FROM unite u
JOIN filiere f ON f.filiere_ID = u.filiere_ID
LEFT JOIN affect_ue_prof ap ON ap.id_unite = u.unite_ID
LEFT JOIN professeur p ON p.prof_ID = ap.id_prof
LEFT JOIN user ui ON ui.user_ID = p.user_ID
LEFT JOIN affect_ue_vac av ON av.unite_ID = u.unite_ID
LEFT JOIN vacataire v ON v.vacat_ID = av.vacataire_ID
LEFT JOIN user uv ON uv.user_ID = v.user_ID
WHERE f.depart_ID = ?" ;

$stmt = $pdo->prepare($sql);
$stmt->execute([$depart_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Création du fichier Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$headers = ['Intitulé', 'Filière', 'spécialité','semestre','Cours (h)', 'TD (h)', 'TP (h)','professeur','type professeur'];
$sheet->fromArray($headers, NULL, 'A1');

$row = 2;
foreach ($data as $ue) {
    $sheet->setCellValue('A' . $row, $ue['unite_name']);
    $sheet->setCellValue('B' . $row, $ue['filiere_nom']);
    $sheet->setCellValue('C' . $row, $ue['unite_specialite']);
    $sheet->setCellValue('D' . $row, $ue['semestre']);
    $sheet->setCellValue('E' . $row, $ue['volume_cours']);
    $sheet->setCellValue('F' . $row, $ue['volume_td']);
    $sheet->setCellValue('G' . $row, $ue['volume_tp']);
    $nomComplet = trim($ue['nom_professeur'] . ' ' . $ue['prenom_professeur']);
    if (empty($nomComplet)) {
    $nomComplet = '-';
    }
    $typeProf = ($ue['type_professeur'] === 'Non affecté') ? '-' : $ue['type_professeur'];
    $sheet->setCellValue('H' . $row, $nomComplet);
    $sheet->setCellValue('I' . $row, $typeProf);

    $row++;
}

// Ajuster automatiquement la largeur des colonnes
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"unites_enseignement_" . date('Y-m-d_H-i-s') . ".xlsx\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);

// Nettoie la sortie avant d'écrire le fichier
ob_end_clean();
$writer->save('php://output');
exit;
