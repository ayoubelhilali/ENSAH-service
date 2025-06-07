<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['annoncer'])) {
    // Include the database connection file
    require_once __DIR__ . '/connections.php';

    // Get the form data
    $titre = $_POST['anonce_head'];
    $description = $_POST['anonce_body'];
    $today = new DateTime(); // current date
    $date = $today->format('Y-m-d H:i:s');
    $user_id = $_SESSION['user']['user_id'];

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO annonces (annonce_head, annonce_body , annonce_date) VALUES (?, ?,?)");
    if ($stmt->execute([$titre, $description, $date])) {
        $_SESSION["success_message"] = "L'annonce ajouté avec succès !";

        // add notification
        $add_notification = "INSERT INTO notifications(id_user, date_time, title, content,status,type) 
        VALUES('$user_id', NOW(), 'Nouvelle annonce', 'Nouvelle annonce a été publiée veuillez consulter les annonces', 'unread','general')";
        $pdo->query($add_notification);
        header("Location: /ENSAH-service/pages/annonces.php?success=1");
        exit;
    } else {
        $_SESSION["error_message"] = "Error: Département n'a pas ajouté !";
        // Redirect to the annonces page with a success message
        header("Location: /ENSAH-service/pages/annonces.php?error=1");
        exit;
    }
}
