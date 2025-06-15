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
        $date_time = date("Y-m-d H:i:s") ;
       $title=" Charge horaire minimum n'est pas atteint" ;
       $content = $content = "Nous vous informons Mr " . $row2['nom'] . " " . $row2['prenom'] .
           " que la minimum de charge horaire n'est pas atteint , essayez d'ajouter des nouvelles unités d'enseignement à vos voeux ";
       $type="personel" ;

        $requete4=$pdo->prepare("INSERT INTO notifications(id_user,date_time,title,content,type) 
                            VALUES (?,?,?,?,?) ") ;
        $requete4->execute([$id_prof,$date_time,$title,$content,$type]) ;

         $del = $pdo->prepare("DELETE FROM voeux WHERE id_prof=?");
        $del->execute([$prof_id]);

        $ins = $pdo->prepare("INSERT INTO voeux(id_unite, id_prof) VALUES (?, ?)");
        foreach ($_POST['voeux'] as $id_unite) {
            $ins->execute([$id_unite, $prof_id]);
        }


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
