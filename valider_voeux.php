<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']. '/ENSAH-service/inc/functions/connections.php';
 $id_voeux = $_POST["id_voeux"];
 $id_prof = $_POST["id_prof"];
$id_unite = $_POST["id_unite"];
    $charge_totale = (int) $_POST["charge_totale"];

    $charge_min = 180;

    $requete2=$pdo->prepare("SELECT nom,prenom FROM user WHERE user_ID=? ") ;
        $requete2->execute([$id_prof]) ;
        $row2=$requete2->fetch() ;
        
        $requete3=$pdo->prepare("SELECT unite_name FROM unite WHERE unite_ID=? ") ;
        $requete3->execute([$id_unite]) ;
        $row3=$requete3->fetch() ;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST['action']="decliner"){
        $requete1=$pdo->prepare("DELETE FROM voeux WHERE id_voeux=? ") ;
        $requete1->execute([$id_voeux]) ;
       
       $date_time = date("Y-m-d H:i:s") ;
       $title="Déclination d'une Voeu " ;
       $content = $content = "Nous vous informons Mr " . $row2['nom'] . " " . $row2['prenom'] .
           " que votre voeu pour l'unité d'enseignement " . $row3['unite_name'] . " a été décliné.";

       $type="personel" ;
        $requete4=$pdo->prepare("INSERT INTO notifications(id_user,date_time,title,content,type) 
                            VALUES (?,?,?,?,?) ") ;
        $requte4->execute([$id_prof,$date_time,$title,$content,$type]) ;

    }
    else{
    
    if ($charge_totale < $charge_min) {
        // ⚠ Ne pas valider
        echo "<script>
            alert('❌ La charge totale du professeur est inférieure à $charge_min heures. Le vœu ne peut pas être validé.');
            window.history.back();
        </script>";
        exit;
    }

    // Si la charge est suffisante, valider le vœu
    $stmt = $pdo->prepare("UPDATE voeux SET status = 1 WHERE id_voeux = ?");
    $stmt->execute([$id_voeux]);

// Supprimer dans affect_ue_prof
$stmt1 = $pdo->prepare("DELETE FROM affect_ue_prof WHERE id_unite = ?");
$stmt1->execute([$id_unite]);

// Supprimer dans affect_ue_vac
$stmt2 = $pdo->prepare("DELETE FROM affect_ue_vac WHERE id_unite = ?");
$stmt2->execute([$id_unite]);

$stmt3=$pdo->prepare("INSERT INTO affect_ue_prof(id_unite,id_prof) 
                    VALUES (?,?) ") ;
 $stmt3->execute([$id_unite,$id_prof]) ; 
 
 $date_time = date("Y-m-d H:i:s") ;
       $title="Validation d'une Voeu " ;
       $content = $content = "Nous vous informons Mr " . $row2['nom'] . " " . $row2['prenom'] .
           " que votre voeu pour l'unité d'enseignement " . $row3['unite_name'] . " a été validé.";

  $requete=$pdo->prepare("INSERT INTO notifications(id_user,date_time,title,content,type) 
                            VALUES (?,?,?,?,?) ") ;
        $requte->execute([$id_prof,$date_time,$title,$content,$type]) ;
 
    // Retour à la page précédente
    header("Location: chef_interface.php");
    exit;
  }
}
?>
