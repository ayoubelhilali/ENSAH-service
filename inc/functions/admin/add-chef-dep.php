<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['add-depart'])) {
    // Include the database connection file
    require_once __DIR__ . '/../connections.php';
    print_r($_POST);
    // Get the form data
    $departement = $_POST['depart_nom'];
    // get id of the departement
    $stml= $pdo->prepare("SELECT depart_ID FROM departement WHERE depart_nom = ?");
    $stml->execute([$departement]);
    $depart_ID = $stml->fetchColumn();
    // get id of the prof
    $stml= $pdo->prepare("SELECT prof_ID FROM professeur P WHERE prof_ID = ?");
    $selectedOption = isset($_POST['chef_depart']) ? $_POST['chef_depart'] : "null";
    $stml->execute([$selectedOption]);
    $prof_ID = $stml->fetchColumn();
    $email=htmlspecialchars($_POST["chef_email"]);
    $password = hash('sha256', htmlspecialchars($_POST["chef_password"]));
    // Prepare and execute the SQL statement
    echo "email: $email";
    echo "password: $password";
    echo "depart_ID: $depart_ID";
    echo "prof_ID: $prof_ID";
    $stmt = $pdo->prepare("INSERT INTO chef_depart (chef_email, chef_password,depart_ID,prof_ID) VALUES (?, ?,?,?)");
    if ($stmt->execute([$email,$password,$depart_ID, $prof_ID])) {
        $_SESSION["success_message"] = "chef du département ajouté avec succès !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/depart-list.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: chef du département n'a pas ajouté !";
        // Redirect to the depart-list page with a success message
        header("Location: /ENSAH-service/pages/admin/depart-list.php?error=1");
        exit;
    }
}
