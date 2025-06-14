<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
  require_once  $_SERVER['DOCUMENT_ROOT']. '/ENSAH-service/inc/functions/connections.php' ;
?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fichier_notes']) && $_FILES['fichier_notes']['error'] === UPLOAD_ERR_OK) {

        // Chemin temporaire du fichier
        $tmpFilePath = $_FILES['fichier_notes']['tmp_name'];

        // Nom original du fichier
        $fileName = basename($_FILES['fichier_notes']['name']);

        // Dossier de destination
        $filiere = $pdo->prepare("SELECT f.filiere_nom FROM filiere f
                    JOIN unite u ON u.filiere_ID=f.filiere_ID 
                    WHERE u.unite_ID=? " )  ;
        if($filiere->execute([$_POST['unite_id']])){
            $row = $filiere->fetch(PDO::FETCH_ASSOC);

            $doc_filiere= $row['filiere_nom'] ;
        }
        

        $destinationDir = __DIR__ . '/uploads/notes/'.$doc_filiere.'/' ;

        // Crée le dossier s'il n'existe pas

        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }

        // Nouveau chemin avec le nom du fichier
        $destinationPath = $destinationDir . $fileName;

        // Déplacement du fichier
        if (move_uploaded_file($tmpFilePath, $destinationPath)) {
            header("Location: uploader_note.php?succes=1");
            exit;
        } else {
            header("Location: uploader_note.php?succes=0");
            exit;
        }

    } else {
        header("Location: uploader_note.php?succes=2");
        exit;
    }
}
?>
