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
    $stml = $pdo->prepare("SELECT depart_ID, depart_nom FROM departement WHERE depart_nom = ?");
    $stml->execute([$departement]);
    $departement_row = $stml->fetch(PDO::FETCH_ASSOC);
    $depart_ID = $departement_row ? $departement_row['depart_ID'] : null;
    $departement = $departement_row ? $departement_row['depart_nom'] : null;

    // get data of the prof
    $prof_ID = isset($_POST['chef_depart']) ? $_POST['chef_depart'] : "null";
    $email = htmlspecialchars($_POST["chef_email"]);
    $password = password_hash($_POST["chef_password"], PASSWORD_DEFAULT);

    // get id of the user
    $stml = $pdo->prepare("SELECT user_ID FROM professeur WHERE prof_ID = ?");
    $stml->execute([$prof_ID]);
    $user_id = $stml->fetch(PDO::FETCH_ASSOC);


    // Prepare and execute the SQL statement
    echo "email: $email";
    echo "password: $password";
    echo "depart_ID: $depart_ID";
    echo "prof_ID: $prof_ID";
    $stmt = $pdo->prepare("INSERT INTO chef_depart (chef_email, chef_password,depart_ID,prof_ID) VALUES (?, ?,?,?)");
    if ($stmt->execute([$email,$password,$depart_ID, $prof_ID])) {
        // add notification
        $user_id_value = $user_id ? $user_id['user_ID'] : null;
        $add_notification = "INSERT INTO notifications(id_user, date_time, title, content, status, type) 
        VALUES('$user_id_value', NOW(), 'Nouvelle affectation', 'Felicitations! vous etes affectee comme chef du departement $departement', 'unread', 'personel')";
        $pdo->query($add_notification);

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
