<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use Smalot\PdfParser\Parser;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $tmp = $file['tmp_name'];

    if (in_array($ext, ['xls', 'xlsx'])) {
        $spreadsheet = IOFactory::load($tmp);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        echo "<h3>Données Excel :</h3><pre>";
        print_r($data);
        echo "</pre>";

    } elseif ($ext === 'pdf') {
        $parser = new Parser();
        $pdf = $parser->parseFile($tmp);
        $text = $pdf->getText();

        echo "<h3>Contenu PDF :</h3><pre>";
        echo htmlspecialchars($text);
        echo "</pre>";

    } else {
        echo "❌ Format non supporté.";
    }
}
