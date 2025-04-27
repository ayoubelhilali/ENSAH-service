<?php
// 🔵 Connexion à la base de données
$host = 'localhost';
$dbname = 'ensah_service';
$username = 'root';
$password = '';
$errors = 0;

include_once 'connections.php';  // Make sure the connection is established correctly


// 🟢 Vérifier si les données sont envoyées en POST
if (isset($_POST['submit'])) {
    // 🟢 Récupérer les données du formulaire
    $nom = stripcslashes($_POST['nom']);
    $prenom = stripcslashes($_POST['prenom']);
    $email = stripcslashes(strtolower($_POST['email']));
    $motdepasse = stripcslashes($_POST['password']);
    if (isset($_POST['birthday_year']) && isset($_POST['birthday_month']) && isset($_POST['birthday_day'])) {
        $jour = (int) $_POST['birthday_day'];
        $mois = (int) $_POST['birthday_month'];
        $annee = (int) $_POST['birthday_year'];
        // 📅 Formater la date
        $birthday = htmlentities(mysqli_real_escape_string($conne, $jour . "-" . $mois . "-" . $annee));
    }

    $nom = htmlentities(mysqli_real_escape_string($conne, $nom));
    $prenom = htmlentities(mysqli_real_escape_string($conne, $prenom));
    $email = htmlentities(mysqli_real_escape_string($conne, $email));
    $motdepasse = htmlentities(mysqli_real_escape_string($conne, $motdepasse));
    $md5_pass = md5($motdepasse);  // Use md5, but consider using password_hash()

    if (isset($_POST['genre'])) {
        $genre = htmlentities(mysqli_real_escape_string($conne, $_POST['genre']));
        if (!in_array($genre, ["Masculin", "Féminin"])) {
            $genre_error = "Please choose a valid genre!";
            $errors = 1;
        }
    }

    if (isset($_POST['specialite'])) {
        $specialite = htmlentities(mysqli_real_escape_string($conne, $_POST['specialite']));
        if (!in_array($specialite, ["Computer science", "Data analyst", "cybersecurity", "Mathematics"])) {
            $specialite_error = "Please choose a valid specialite!";
            $errors = 1;
        }
    }

    // check nom
    if (empty($nom)) {
        $nom_error = "Entrer un nom valide!";
        $errors = 1;
    } elseif (strlen($nom) < 3 || strlen($nom) > 15) {
        $nom_error = "Entrer un nom valide (3 -> 15 caractères)!";
        $errors = 1;
    } elseif (filter_var($nom, FILTER_VALIDATE_INT)) {
        $nom_error = "Entrer un nom valide!";
        $errors = 1;
    }

    // check prenom
    if (empty($prenom)) {
        $prenom_error = "Entrer un prénom valide!";
        $errors = 1;
    } elseif (strlen($prenom) < 3 || strlen($prenom) > 15) {
        $prenom_error = "Entrer un prénom valide (3 -> 15 caractères)!";
        $errors = 1;
    } elseif (filter_var($prenom, FILTER_VALIDATE_INT)) {
        $prenom_error = "Entrer un prénom valide!";
        $errors = 1;
    }

    // check email
    if (empty($email)) {
        $email_error = "Entrer un email valide!";
        $errors = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Entrer un email valide!";
        $errors = 1;
    }

    // check empty genre
    if (empty($genre)) {
        $genre_error = "Entrer le genre";
        $errors = 1;
    }

    // check empty birthday
    if (empty($birthday)) {
        $birthday_error = "Entrer une date de naissance!";
        $errors = 1;
    }

    // check empty password
    if (empty($motdepasse)) {
        $password_err = "Entrer le mot de passe!";
        $errors = 1;
    } elseif (strlen($motdepasse) < 6) {
        $password_err = "Mot de passe invalide!";
        $errors = 1;
    } else {
        if ($errors == 0) {
            // Ajouter le professeur dans la table des utilisateurs
            $add_user = "INSERT INTO user(nom, prenom, date_naissance, genre) 
            VALUES('$nom', '$prenom', '$birthday', '$genre')";
            mysqli_query($conne, $add_user);

            // Récupérer l'ID de l'utilisateur inséré
            $user_id = mysqli_insert_id($conne);

            if ($user_id) {
            echo "User $nom added to the database with ID $user_id!";

            // Ajouter le professeur dans la table des professeurs avec l'ID utilisateur
            $add_prof = "INSERT INTO professeur(user_ID, email, password, md5_pass, specialite) 
            VALUES('$user_id', '$email', '$motdepasse', '$md5_pass', '$specialite')";
            mysqli_query($conne, $add_prof);
            echo "Professeur $nom added to the database!";
            } else {
            echo "Failed to retrieve user ID.";
            }
        } else {
            include "../../pages/prof-list.php";  // Redirect to form if errors exist
            exit();
        }
    }
}
?>