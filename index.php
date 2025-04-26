<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Redirection vers le bon dashboard selon le rôle
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: dashboard/admin.php');
            break;
        case 'enseignant':
            header('Location: dashboard/enseignant.php');
            break;
        // autres rôles ici...
    }
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>