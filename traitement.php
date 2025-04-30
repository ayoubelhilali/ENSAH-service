<?php 

$email= $_POST['email'] ;
$password = $_POST['password'] ;

$pdo = new PDO('mysql:host=localhost;dbname:ensah_service.sql','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $pdo->prepare("SELECT * FROM user where email=?") ;
$stmt->execute([$email]) ;
$user = $stmt->fetch() ;

if(!$user || $user['password']!=$password){
    header("Location: login.php?message=Email+ou+mot+de+passe+invalide") ;
    exit() ;
}



?>