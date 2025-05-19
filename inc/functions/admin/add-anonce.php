<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['annoncer'])) {
    // Include the database connection file
    require_once __DIR__ . '/../connections.php';

    // Get the form data
    $titre = $_POST['anonce_head'];
    $description = $_POST['anonce_body'];
    $today = new DateTime(); // current date
    $date=$today->format('Y-m-d H:i:s');

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO annonces (annonce_head, annonce_body , annonce_date) VALUES (?, ?,?)");
    if ($stmt->execute([$titre, $description,$date])) {
        $_SESSION["success_message"] = "L'annonce ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/annonces.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: Département n'a pas ajouté !";
        // Redirect to the annonces page with a success message
        header("Location: /ENSAH-service/pages/admin/annonces.php?error=1");
        exit;
    }
}
