<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$uploaded_image_path = '/ENSAH-service/assets/images/avatar-M.jpg'; // default avatar
if (isset($_FILES['uplfile']) && $_FILES['uplfile']['error'] == 0) {
    print_r($_FILES);
    echo "test";
    $target_dir = "/ENSAH-service/uploads/"; // dossier où tu veux stocker l'image
    $target_file = $target_dir . basename($_FILES["uplfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifier si c'est bien une image
    $check = getimagesize($_FILES["uplfile"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $upload_error = "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier (par exemple max 5Mo)
    if ($_FILES["uplfile"]["size"] > 5000000) {
        $upload_error = "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser seulement certains formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $upload_error = "Désolé, seulement JPG, JPEG, PNG sont autorisés.";
        $uploadOk = 0;
    }

    // Si tout est ok, déplacer le fichier
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["uplfile"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $target_file)) {
            $uploaded_image_path = $target_file;
            $_SESSION['avatar_path'] = $uploaded_image_path; // 🔥 ici on stocke l'image uploadée dans SESSION

        } else {
            $upload_error = "Erreur lors de l'upload du fichier.";
        }
    }

}
