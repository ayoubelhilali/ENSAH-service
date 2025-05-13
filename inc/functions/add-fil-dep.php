<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['add-filiere'])) {
    // Include the database connection file
    require_once __DIR__ . '/connections.php';
    print_r($_POST);
    // Get the form data
    $departement = $_POST['depart_nom'];
    // get id of the departement
    $stml = $pdo->prepare("SELECT depart_ID FROM departement WHERE depart_nom = ?"); 
    $stml->execute([$departement]);
    $depart_ID = $stml->fetchColumn();
    // get id of the prof
    $stml = $pdo->prepare("SELECT filliere_ID FROM filliere F WHERE filliere_nom = ?");
    $selectedOption = isset($_POST['fil_depart']) ? $_POST['fil_depart'] : "null";
    $stml->execute([$selectedOption]);
    $filiere_ID = $stml->fetchColumn();
    echo "filiere_ID: $filiere_ID";
    echo "depart_ID: $depart_ID";
    $stmt = $pdo->prepare("UPDATE filliere SET depart_ID = ? WHERE filliere_ID = ?");
    if ($stmt->execute([ $depart_ID,$filiere_ID])) {
        $_SESSION["success_message"] = "filiere ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/depart-list.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: la filiere n'a pas ajouté !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/depart-list.php?error=1");
        exit;
    }
}
