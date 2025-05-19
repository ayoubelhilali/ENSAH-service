<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/connections.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/isStrongPass.php");

if (!isset($_SESSION["user"])) {
    header("Location: /ENSAH-service/pages/profil.php#profile-4?error=1");
    exit();
}

// Initialize variables
$id = $_SESSION['user']['user_id'] ?? null;
$errors = 0;
$changepass_error = $oldpass_error = $newpass_error = $confirmpass_error = "";
$success = 0;

// Validate Password
if ($_SESSION["user"]["role"] == "admin") {
    $user_data = "SELECT A.password FROM `user` U join `admin` A on A.user_ID = U.user_ID WHERE U.user_ID = :id";
} else if ($_SESSION["user"]["role"] == "coordonnateur") {
    $user_data = "SELECT C.cord_password FROM `user` U join `professeur` P on P.user_ID = U.user_ID join coordonnateur C on C.prof_ID=P.prof_ID  WHERE U.user_ID = :id";
}
$stmt = $pdo->prepare($user_data);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Determine the correct password field based on user role
    if ($_SESSION["user"]["role"] == "admin") {
        $db_password = $user["password"];
    } else if ($_SESSION["user"]["role"] == "coordonnateur") {
        $db_password = $user["cord_password"];
    } else {
        $db_password = null;
    }

    if ($db_password !== null && password_verify($_POST["oldpassword"], $db_password)) {
        if ($_POST["newpassword"] != $_POST["confirmpass"]) {
            $confirmpass_error = "Confirmation password is incorrect";
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
    $new_password = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);

    if ($_SESSION["user"]["role"] == "admin") {
        $edit_user = "UPDATE `user` U JOIN `admin` A ON A.user_ID = U.user_ID SET A.password = :password WHERE U.user_ID = :id";
    } else if ($_SESSION["user"]["role"] == "coordonnateur") {
        $edit_user = "UPDATE `user` U JOIN `professeur` P ON P.user_ID = U.user_ID JOIN coordonnateur C ON C.prof_ID=P.prof_ID SET C.cord_password = :password WHERE U.user_ID = :id";
    }
    $stmt = $pdo->prepare($edit_user);
    $stmt->bindParam(':password', $new_password);
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

$redirect_url = "/ENSAH-service/pages/profil.php";

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