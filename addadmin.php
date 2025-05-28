<?php
require_once 'inc/functions/connections.php';

$query ="SELECT * FROM admin";
$stmt = $pdo->prepare($query);
if ($stmt->execute()) {
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("Error fetching admins data.");
}
$password = "Admin@1234";
$password= password_hash($password, PASSWORD_DEFAULT);
$changepass_query= "UPDATE admin SET password = :password WHERE admin_ID = :admin_id";
$stmt = $pdo->prepare($changepass_query);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':admin_id', $admin['admin_ID']);
if ($stmt->execute()) {
    echo "Password updated successfully.";
} else {
    die("Error updating password.");
}