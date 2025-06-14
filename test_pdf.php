<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'uploads/Copy of GI-ID-TDIA-AP(1).xlsx'; // Remplace par le chemin de ton fichier

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
    if ($rowIndex === 0 || $rowIndex ===1) {
        continue;
    }

    // Ensure the row has enough columns to avoid errors
    if (count($row) > 5) { // Check if there are at least 6 columns (0 to 5)
        $moduleName = $row[0]; // Column A: Intitulé
        $volumeCours = $row[2]; // Column C: Cours
        $volumeTD = $row[3];    // Column D: TD
        $volumeTP = $row[4];    // Column E: TP
        $responsableId = $row[5]; // Column F: responsable_ID

        // Create an associative array for the current module
        $moduleData = [
            'name' => $moduleName,
            'volume' => [
                'cours' => $volumeCours,
                'td' => $volumeTD,
                'tp' => $volumeTP
            ],
            'responsable_id' => $responsableId
        ];

        // Add the module data to the modules array
        $modules[] = $moduleData;
    }
}

// Print the extracted modules array to see the structure
echo "<pre>";
print_r($modules);
echo "</pre>";

// You can now loop through the $modules array to access each module's data
// foreach ($modules as $module) {
//     echo "Module Name: " . $module['name'] . "<br>";
//     echo "Volume Cours: " . $module['volume']['cours'] . "<br>";
//     echo "Volume TD: " . $module['volume']['td'] . "<br>";
//     echo "Volume TP: " . $module['volume']['tp'] . "<br>";
//     echo "Responsable ID: " . $module['responsable_id'] . "<br><br>";
// }

?>