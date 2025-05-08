<<<<<<< HEAD
<?php
session_start();
$email= trim($_POST['email']) ;
$password = trim($_POST['password']) ;
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=ensah_service', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user = [];
if ($pdo) {
    $users_data = "SELECT * FROM admin WHERE email = ?";
    $stmt = $pdo->prepare($users_data);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user || $user['password'] != $password) {
        header("Location: login.php?message=Email+ou+mot+de+passe+invalide");
        exit();
    }
}else {
    echo "failed to connect";
    header("Location: login.php");
    exit();
}
$_SESSION['user']= $user["admin_ID"];
header("Location: dashboard/admin-dash.php");-
exit();
=======
<?php 

$email= $_POST['email'] ;
$password = $_POST['password'] ;

$pdo = new PDO('mysql:host=localhost;dbname:ensah_service.sql','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT password FROM professeur where email=?") ;
$stmt->execute([$email]) ;
$user = $stmt->fetch() ;

if(!$user || $user['password']!=$password){
    header("Location: login.php?message=Email+ou+mot+de+passe+invalide") ;
    exit() ;
}
 
>>>>>>> 6c6e07cdf7c8b07bdc01a0058065878f6d01a090
?>