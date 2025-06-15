<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ENSAH-service/inc/functions/connections.php'; // Assure-toi que $pdo est défini

$nom = $prenom = $birthday = $genre = $email = $motdepasse = $specialite = "";
$errors = 0;
$nom_error = $prenom_error = $birthday_error = $genre_error = $email_error = $motdepasse_error = $specialite_error = $general_error =$departement_error= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prof_id = intval($_POST["prof_id"]);
    // Validation des champs
    if (empty($_POST["nom"])) {
        $nom_error = "Nom is required";
        $errors++;
    } else {
        $nom = trim($_POST["nom"]);
    }

    if (empty($_POST["prenom"])) {
        $prenom_error = "Prenom is required";
        $errors++;
    } else {
        $prenom = trim($_POST["prenom"]);
    }

    if (empty($_POST["birthday_day"]) || empty($_POST["birthday_month"]) || empty($_POST["birthday_year"])) {
        $birthday_error = "Birthday is required";
        $errors++;
    } else {
        $birthday = trim( $_POST["birthday_day"]."-". $_POST["birthday_month"] . "-". $_POST["birthday_year"]);
    }

    if (empty($_POST["email"])) {
        $email_error = "Email is required";
        $errors++;
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors++;
        }
    }

    if (empty($_POST["specialite"])) {
        $specialite_error = "Specialité est requise";
        $errors++;
    } else {
        $specialite = trim($_POST["specialite"]);
    }
    if (empty($_POST["departement"])) {
        $departement_error = "Departement est requise";
        $errors++;
    } else {
        $departement = trim($_POST["departement"]);
    }

    if (!empty($_POST["motdepasse"])) {
        $motdepasse = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT);
    }
    if ($errors == 0) {
        try {
            // Récupérer user_ID du professeur
            $stmt = $pdo->prepare("SELECT user_ID FROM professeur WHERE prof_ID = :prof_id");
            $stmt->execute(['prof_id' => $prof_id]);
            $prof_data = $stmt->fetch();
            echo $prof_data;
            if ($prof_data) {
                $user_id = $prof_data['user_ID'];

                // Mise à jour table `user`
                $stmt = $pdo->prepare("UPDATE user SET nom = :nom, prenom = :prenom, date_naissance = :birthday WHERE user_ID = :user_id");
                $stmt->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'birthday' => $birthday,
                    'user_id' => $user_id
                ]);
                // Mise à jour table `professeur`
                if (!empty($motdepasse)) {
                    $stmt = $pdo->prepare("UPDATE professeur SET email = :email, specialite = :specialite, password = :password, departement=:departement WHERE prof_ID = :prof_id");
                    $stmt->execute([
                        'email' => $email,
                        'specialite' => $specialite,
                        'password' => $motdepasse,
                        'departement' => $departement,
                        'prof_id' => $prof_id
                    ]);
                } else {
                    $stmt = $pdo->prepare("UPDATE professeur SET email = :email, specialite = :specialite,departement=:departement WHERE prof_ID = :prof_id");
                    $stmt->execute([
                        'email' => $email,
                        'specialite' => $specialite,
                        'departement' => $departement,
                        'prof_id' => $prof_id
                    ]);
                }

                $_SESSION['success_message'] = "Professeur mis à jour avec succès.";
                header("Location: /ENSAH-service/pages/admin/prof-list.php");
                exit;

            } else {
                $general_error = "Professeur introuvable.";
            }
        } catch (PDOException $e) {
            $general_error = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $general_error = "Veuillez corriger les erreurs dans le formulaire.";
    }
}
?>
