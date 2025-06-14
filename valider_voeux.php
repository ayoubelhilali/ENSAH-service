<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']. '/ENSAH-service/inc/functions/connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_voeux = $_POST["id_voeux"];
    $id_prof = $_POST["id_prof"];
    $id_unite = $_POST["id_unite"];
    $charge_totale = (int) $_POST["charge_totale"];

    $charge_min = 180;

    if ($charge_totale < $charge_min) {
        // ⚠ Ne pas valider
        echo "<script>
            alert('❌ La charge totale du professeur est inférieure à $charge_min heures. Le vœu ne peut pas être validé.');
            window.history.back();
        </script>";
        exit;
    }

    // ✅ Si la charge est suffisante, valider le vœu
    $stmt = $pdo->prepare("UPDATE voeux SET status = 1 WHERE id_voeux = ?");
    $stmt->execute([$id_voeux]);

    // Retour à la page précédente
    header("Location: chef_interface.php");
    exit;
}
?>
