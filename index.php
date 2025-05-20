<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    // Redirection vers le bon dashboard selon le rôle
    switch ($_SESSION['user']['role']) {
        case 'coordonnateur':
            header('Location: dashboard/cord-dash.php');
            break;
        case 'admin':
            header('Location: dashboard/admin-dash.php');
            break;
        case 'professeur':
            header('Location: dashboard/prof-dash.php');
            break;
        case 'vacataire':
            header('Location: dashboard/vac-dash.php');
            break;
    }
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>