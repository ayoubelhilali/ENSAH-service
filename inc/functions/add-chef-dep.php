<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['add-depart'])) {
    // Include the database connection file
    require_once __DIR__ . '/connections.php';

    // Get the form data
    $departement = $_POST['depart_nom'];
    // get id of the departement
    $stml= $pdo->prepare("SELECT depart_ID FROM departement WHERE depart_nom = ?");
    $stml->execute([$departement]);
    $depart_ID = $stml->fetchColumn();

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO chef_depart (chef_email, chef_password,depart_ID,prof_ID) VALUES (?, ?,?,?)");
    if ($stmt->execute([$email,$password,$depart_ID, $prof_ID])) {
        $_SESSION["success_message"] = "chef du département ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/depart-list.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: chef du département n'a pas ajouté !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/depart-list.php?error=1");
        exit;
    }
}
