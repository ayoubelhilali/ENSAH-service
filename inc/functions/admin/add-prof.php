<?php
session_start();
include('../inc/functions/connections.php');

// Initialize variables and error arrays
$nom = $prenom = $birthday = $genre = $email = $motdepasse = $specialite = "";
$errors = 0;
$nom_error = $prenom_error = $birthday_error = $genre_error = $email_error = $motdepasse_error = $specialite_error = $general_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Nom
    if (empty($_POST["nom"])) {
        $nom_error = "Nom is required";
        $errors++;
    } else {
        $nom = mysqli_real_escape_string($conne, $_POST["nom"]);
    }

    // Validate Prenom
    if (empty($_POST["prenom"])) {
        $prenom_error = "Prenom is required";
        $errors++;
    } else {
        $prenom = mysqli_real_escape_string($conne, $_POST["prenom"]);
    }

    // Validate Birthday
    if (empty($_POST["birthday"])) {
        $birthday_error = "Birthday is required";
        $errors++;
    } else {
        $birthday = mysqli_real_escape_string($conne, $_POST["birthday"]);
    }

    // Validate Genre
    if (empty($_POST["genre"])) {
        $genre_error = "Genre is required";
        $errors++;
    } else {
        $genre = mysqli_real_escape_string($conne, $_POST["genre"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
        $errors++;
    } else {
        $email = mysqli_real_escape_string($conne, $_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors++;
        }
        //Check if email exists
        $check_email_query = "SELECT * FROM professeur WHERE email = '$email'";
        $check_email_result = mysqli_query($conne, $check_email_query);
        if (mysqli_num_rows($check_email_result) > 0) {
            $email_error = "Email already exists.";
            $errors++;
        }
    }

    // Validate Motdepasse
    if (empty($_POST["motdepasse"])) {
        $motdepasse_error = "Password is required";
        $errors++;
    } else {
        $motdepasse = mysqli_real_escape_string($conne, $_POST["motdepasse"]);
        $motdepasse = password_hash($motdepasse, PASSWORD_DEFAULT); // Hash the password
    }

    // Validate Specialite
    if (empty($_POST["specialite"])) {
        $specialite_error = "Specialite is required";
        $errors++;
    } else {
        $specialite = mysqli_real_escape_string($conne, $_POST["specialite"]);
    }


    // If there are no errors, proceed with database insertion
    if ($errors == 0) {
        // Ajouter le professeur dans la table des utilisateurs
        $add_user = "INSERT INTO user(nom, prenom, date_naissance, genre) 
        VALUES('$nom', '$prenom', '$birthday', '$genre')";
        if (mysqli_query($conne, $add_user)) {
            // Récupérer l'ID de l'utilisateur inséré
            $user_id = mysqli_insert_id($conne);

            if ($user_id) {
                // Ajouter le professeur dans la table des professeurs avec l'ID utilisateur
                $add_prof = "INSERT INTO professeur(user_ID, email, password, specialite) 
                VALUES('$user_id', '$email', '$motdepasse', '$specialite')";
                if (mysqli_query($conne, $add_prof)) {
                    $_SESSION['success_message'] = "Professor added successfully!";  // Optional: set a success message
                    header("Location: /ENSAH-service/dashboard/admin-dash.php");  // Redirect to the dashboard
                    exit;
                } else {
                    $general_error = "Failed to add professor.";
                }

            } else {
                $general_error = "Failed to retrieve user ID.";
            }

        } else {
            $general_error = "Failed to add user to the database.";
        }

    } else {
        $general_error = "Please correct the errors in the form.";
    }
}
?>