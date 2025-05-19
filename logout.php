<?php
session_start(); // Démarre la session

// Supprime toutes les variables de session
$_SESSION = [];

// Détruit la session côté serveur
session_destroy();

// Redirige vers la page de connexion ou d’accueil
header("Location: index.php"); // Change "login.php" selon ton projet
exit;
?>
