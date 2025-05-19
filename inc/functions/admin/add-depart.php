<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['add-depart'])) {
    // Include the database connection file
    require_once __DIR__ . '/connections.php';

    // Get the form data
    $departement = $_POST['depart_nom'];
    $description = $_POST['depart_details'];

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO departement (depart_nom, depart_details) VALUES (?, ?)");
    if ($stmt->execute([$departement, $description])) {
        $_SESSION["success_message"] = "Département ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/depart-list.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: Département n'a pas ajouté !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/depart-list.php?error=1");
        exit;
    }
}
