<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['add-cord-fil'])) {
    // Include the database connection file
    require_once __DIR__ . '/../connections.php';
    // Get the form data
    $filiere = $_POST['filiere_nom'];
    echo "filiere: $filiere";
    // get id of the filiere
    $stml = $pdo->prepare("SELECT filiere_ID FROM filiere WHERE filiere_nom = ?");
    $stml->execute([$filiere]);
    $filiere_ID = $stml->fetchColumn();
    // get id of the prof
    $stml = $pdo->prepare("SELECT prof_ID FROM professeur P WHERE prof_ID = ?");
    $selectedOption = isset($_POST['cord_fil']) ? $_POST['cord_fil'] : "null";
    $stml->execute([$selectedOption]);
    $prof_ID = $stml->fetchColumn();
    $email = htmlspecialchars($_POST["cord_email"]);
    $password = password_hash($_POST["cord_password"], PASSWORD_DEFAULT);
    // Prepare and execute the SQL statement
    echo "email: $email";
    echo "password: $password";
    echo "filiere_ID: $filiere_ID";
    echo "prof_ID: $prof_ID";
    $stmt = $pdo->prepare("INSERT INTO coordonnateur (cord_email, cord_password,filiere_ID,prof_ID) VALUES (?, ?,?,?)");
    if ($stmt->execute([$email, $password, $filiere_ID, $prof_ID])) {
        $_SESSION["success_message"] = "coordonnateur ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/filiere-list.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: coordonnateur n'a pas ajouté !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/filiere-list.php?error=1");
        exit;
    }
}
