<?php 

$email= trim($_POST['email']) ;
$password = trim($_POST['password']) ;
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=ensah_service', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($pdo) {
    $users_data = "SELECT * FROM admin WHERE email = ?";
    $stmt = $pdo->prepare($users_data);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user || $user['password'] != $password) {
        header("Location: login.php?message=Email+ou+mot+de+passe+invalide+$user");
        exit();
    }
}else {
    echo "failed to connect";
}

header("Location: dashboard/admin-dash.php");
exit();
?>