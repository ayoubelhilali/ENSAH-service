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

    // get id and nom of the filiere
    $stml = $pdo->prepare("SELECT filiere_ID, filiere_nom FROM filiere WHERE filiere_nom = ?");
    $stml->execute([$filiere]);
    $filiere_row = $stml->fetch(PDO::FETCH_ASSOC);
    $filiere_ID = $filiere_row ? $filiere_row['filiere_ID'] : null;
    $filiere= $filiere_row ? $filiere_row['filiere_nom'] : null;

    // get data of the prof
    $prof_ID = isset($_POST['cord_fil']) ? $_POST['cord_fil'] : "null";
    $email = htmlspecialchars($_POST["cord_email"]);
    $password = password_hash($_POST["cord_password"], PASSWORD_DEFAULT);

    // get id of the user
    $stml = $pdo->prepare("SELECT user_ID FROM professeur WHERE prof_ID = ?");
    $stml->execute([$prof_ID]);
    $user_id = $stml->fetch(PDO::FETCH_ASSOC);


    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO coordonnateur (cord_email, cord_password,filiere_ID,prof_ID) VALUES (?, ?,?,?)");
    if ($stmt->execute([$email, $password, $filiere_ID, $prof_ID])) {
        // add notification
        $user_id_value = $user_id ? $user_id['user_ID'] : null;
        $add_notification = "INSERT INTO notifications(id_user, date_time, title, content, status, type) 
        VALUES('$user_id_value', NOW(), 'Nouvelle affectation', 'Felicitations! vous etes affectee comme coordonnateur du filiere $filiere', 'unread', 'personel')";
        $pdo->query($add_notification);
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
