<?php
$charge_min = 180;
$charge_horaire_selectionne = 0;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['charge_min'] = $charge_min;

require_once $_SERVER['DOCUMENT_ROOT'] .'/ENSAH-service/inc/functions/connections.php';

$prof_id = $_SESSION['user']['prof_id'] ?? null;

if (!$prof_id) {
    die("Vous devez être connecté pour soumettre des vœux.");
}

if (!empty($_POST['voeux'])) {

    // Calcul de la charge horaire
    $charge = $pdo->prepare("SELECT volume_cours, volume_tp, volume_td FROM unite WHERE unite_ID = ?");
    foreach ($_POST['voeux'] as $id_unite) {
        $charge->execute([$id_unite]);
        $row = $charge->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $charge_horaire_selectionne += $row['volume_cours'] + $row['volume_tp'] + $row['volume_td'];
        }
    }

    if ($charge_horaire_selectionne < $charge_min) {
        $message = "Vous n’avez pas atteint la charge minimale de $charge_min h.";
        $succes = -1;
    } else {
        // Supprimer les anciens vœux
        $del = $pdo->prepare("DELETE FROM voeux WHERE id_prof=?");
        $del->execute([$prof_id]);

        // Insérer les nouveaux
        $ins = $pdo->prepare("INSERT INTO voeux(id_unite, id_prof) VALUES (?, ?)");
        foreach ($_POST['voeux'] as $id_unite) {
            $ins->execute([$id_unite, $prof_id]);
        }

        $message = "Vos vœux ont été enregistrés avec succès.";
        $succes = 1;
    }

} else {
    $message = "Vous n'avez sélectionné aucune unité d'enseignement.";
    $succes = 0;
}

header("Location:Prof_interface.php?message=" . urlencode($message) . "&succes=$succes");
exit();
?>
