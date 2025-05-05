<?php
session_start();
include('../inc/functions/connections.php');
require_once('../inc/funcions/inValidPhone.php');
// Initialize variables and error messages
$nom = $prenom= $birthday_day = $birthday_month = $birthday_year = "";
$genre = $email = $password = $md5_pass = $specialite = "";
$errors = 0;

$nom_error = $prenom_error = $birthday_error = "";
$genre_error = $email_error = $password_error = $specialite_error = $upload_error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Nom
    if (empty($_POST["nom"])) {
        $nom_error = "Nom is required";
        $errors++;
    } else {
        $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Prénom
    if (empty($_POST["prenom"])) {
        $prenom_error = "Prénom is required";
        $errors++;
    } else {
        $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Birthday
    if (empty($_POST["birthday_day"]) || empty($_POST["birthday_month"]) || empty($_POST["birthday_year"])) {
        $birthday_error = "Birthday is required";
        $errors++;
    } else {
        $birthday_day = htmlspecialchars($_POST["birthday_day"], ENT_QUOTES, 'UTF-8');
        $birthday_month = htmlspecialchars($_POST["birthday_month"], ENT_QUOTES, 'UTF-8');
        $birthday_year = htmlspecialchars($_POST["birthday_year"], ENT_QUOTES, 'UTF-8');
        $birthday = "$birthday_year-$birthday_month-$birthday_day"; // YYYY-MM-DD

        // Validate date format
        if (!DateTime::createFromFormat('Y-m-d', $birthday)) {
            $birthday_error = "Invalid date format.";
            $errors++;
        }
    }

    // Validate Genre
    if (empty($_POST["genre"])) {
        $genre_error = "Genre is required";
        $errors++;
    } else {
        $genre = htmlspecialchars($_POST["genre"], ENT_QUOTES, 'UTF-8');
    }

    // validate phone
    if (isValidPhone($_POST["phone"])) {
        $phone = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
    } else {
        $phone_error = "Phone is invalid";
        $errors++;
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
        $errors++;
    } else {
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors++;
        } else {
            // Check if email already exists
            $check_email_query = "SELECT * FROM professeur WHERE email = '$email'";
            $check_email_stmt = $pdo->prepare($check_email_query);
            $check_email_stmt->execute();
            if ($check_email_stmt->rowCount() > 0) {
                $email_error = "Email already exists.";
                $errors++;
            }
        }
    }

    // Handle avatar path
    $avatar_path = isset($_POST['avatar_path']) ? htmlspecialchars($_POST["avatar_path"], ENT_QUOTES, 'UTF-8') : '';

    // Proceed with insertion if no errors
    if ($errors == 0) {
        // Update user table
        $edit_user = "UPDATE user SET nom = ?, prenom = ?, image = ?, address = ?, date_naissance = ?, genre = ?, bio = ?, phone = ?, email = ?, linkedin = ? WHERE id = ?";
        $stmt = $pdo->prepare($edit_user);
        $stmt->execute([$nom, $prenom, $avatar_path, $address, $birthday, $genre, $bio, $phone, $email, $linkedin, $id]);
        if ($stmt->execute()) {
            
        } else {
            $general_error = "Failed to add user to the database.";
        }
    } else {
        $general_error = "Please correct the errors in the form.";
    }
}
?>