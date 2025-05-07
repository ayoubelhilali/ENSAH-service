<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/connections.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/isStrongPass.php");
$_SESSION["user_id"] = 50;
// Ensure $pdo is initialized and that $_SESSION['user_id'] is set
if (!isset($pdo)) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

if (!isset($_SESSION["user_id"])) {
    header("Location: /ENSAH-service/pages/profil.php#profile-4?error=1"); 
    exit();
}

// Initialize variables
$id = $_SESSION['user_id'];
$errors = 0;
$changepass_error = $oldpass_error = $newpass_error = $confirmpass_error = "";
$success = 0; 

// Validate Password
$user_data = "SELECT A.password FROM `user` U join `admin` A on A.user_ID = U.user_ID WHERE U.user_ID = :id";
$stmt = $pdo->prepare($user_data);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (md5($_POST["oldpassword"]) == $user["password"]) { 
        if (isStrongPassword($_POST["newpassword"])) {
            if ($_POST["newpassword"] != $_POST["confirmpass"]) {
                $confirmpass_error = "Confirmation password is incorrect";
                $errors++;
            }
        } else {
            $newpass_error = "Password should include at least: 1 uppercase, 1 lowercase, 1 digit, 1 special character, and be at least 8 characters long.";
            $errors++;
        }
    } else {
        $oldpass_error = "The old password is incorrect";
        $errors++;
    }
} else {
    $changepass_error = "Error 404: User not found!";
    $errors++;
}

if ($errors == 0) {
    $new_password = $_POST["newpassword"];
    $md5_pass = md5($new_password); 

    $edit_user = "UPDATE `user` SET password = :password WHERE user_ID = :id";
    $stmt = $pdo->prepare($edit_user);
    $stmt->bindParam(':password', $md5_pass); 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 

    try {
        $stmt->execute();
        $success = 1; // set success flag
    } catch (PDOException $e) {
        $changepass_error = "❌ Failed to update password in the database: " . $e->getMessage();
        $errors++;
    }
} else {
    $changepass_error = "⚠️ Please correct the errors in the form.";
}

$redirect_url = "/ENSAH-service/pages/profil.php#profile-4";

if ($success == 1) {
    $redirect_url .= "?success=1";
    $_SESSION['success_message'] = "Profile edited successfully!";
} else {
    $redirect_url .= "?error=1";
    $_SESSION['error_message'] = $changepass_error;
}

header("Location: " . $redirect_url);
exit();
?>