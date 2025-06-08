<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=ensah_service', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

