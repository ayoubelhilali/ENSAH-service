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

// Requête : récupérer les professeurs du département
$sql = "SELECT 
            u.nom, 
            u.prenom, 
            u.CIN, 
            u.Phone, 
            p.specialite, 
            p.email
        FROM professeur p
        JOIN user u ON u.user_ID = p.user_ID
        JOIN filiere f ON p.filiere_id=f.filiere_ID
        WHERE f.depart_ID = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$depart_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Création du fichier Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// En-têtes
$headers = ['Nom', 'Prénom', 'Spécialité', 'Email', 'CIN', 'Téléphone'];
$sheet->fromArray($headers, NULL, 'A1');

// Données
$row = 2;
foreach ($data as $prof) {
    $sheet->setCellValue('A' . $row, $prof['nom'] ?: '-');
    $sheet->setCellValue('B' . $row, $prof['prenom'] ?: '-');
    $sheet->setCellValue('C' . $row, $prof['specialite'] ?: '-');
    $sheet->setCellValue('D' . $row, $prof['email'] ?: '-');
    $sheet->setCellValue('E' . $row, $prof['CIN'] ?: '-');
    $sheet->setCellValue('F' . $row, $prof['Phone'] ?: '-');
    $row++;
}

// Ajustement automatique des colonnes
foreach (range('A', 'F') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Téléchargement
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"professeurs_" . date('Y-m-d_H-i-s') . ".xlsx\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
ob_end_clean();
$writer->save('php://output');
exit;
