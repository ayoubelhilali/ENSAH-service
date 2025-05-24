<?php
session_start();
require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php';

if (isset($_FILES['fichier_notes']) && $_FILES['fichier_notes']['error'] == 0) {
     $tmp_name = $_FILES['fichier_notes']['tmp_name'];
     $handle = fopen($tmp_name, 'r');
     
     if ($handle !== false) {
      fgetcsv($handle, 1000, ","); // sauter l'en-tête
       $unite_id = $_POST['unite_id'];
       $session = $_POST['session'];

       $stmt = $pdo->prepare("INSERT INTO notes(id_etudiant, id_unite,session,note)
                               VALUES (?, ?, ?, ?) ") ; 


       while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $id_etudiant = $data[0];
        $note = $data[1];
        $stmt->execute([$id_etudiant,$unite_id,$session,$note])   ;              

       }

       fclose($handle);
        $succes=1 ;
    } else {
        $succes=0 ;
    }
} else {
    $succes=-1 ;
}

$_SESSION['succes']=$succes ;

header("Location:Prof_interface.php") ;
       

?>