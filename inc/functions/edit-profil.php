<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/connections.php");

// Ensure $pdo is initialized
if (!isset($pdo)) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/functions/isValidPhone.php");
// Initialize variables
$nom = $prenom = $birthday_day = $birthday_month = $birthday_year = "";
$genre = $email = $password = "";
$md5_pass = ""; // if needed later
$address = $bio = $linkedin = $phone = "";
$id = $_SESSION['user']['user_id'] ?? null; // You may need to adjust this depending on your logic

$errors = 0;

// Error messages
$general_error = $oldpass_error = $newpass_error = $confirmpass_error = "";

// Form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Nom
    if (empty($_POST["nom"])) {
        $nom_error = "Nom is required";
    } else {
        $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Prénom
    if (empty($_POST["prenom"])) {
        $prenom_error = "Prénom is required";
    } else {
        $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Birthday
    if (empty($_POST["birthday_day"]) || empty($_POST["birthday_month"]) || empty($_POST["birthday_year"])) {
        $birthday_error = "Birthday is required";
    } else {
        $birthday_day = htmlspecialchars($_POST["birthday_day"], ENT_QUOTES, 'UTF-8');
        $birthday_month = htmlspecialchars($_POST["birthday_month"], ENT_QUOTES, 'UTF-8');
        $birthday_year = htmlspecialchars($_POST["birthday_year"], ENT_QUOTES, 'UTF-8');
        $birthday = "$birthday_year-$birthday_month-$birthday_day";

        // Validate date format
        $date = DateTime::createFromFormat('Y-m-d', $birthday);
        if (!$date || $date->format('Y-m-d') !== $birthday) {
            $birthday_error = "Invalid date format.";

        }
    }

    // Validate Genre
    if (empty($_POST["genre"])) {
        $genre_error = "Genre is required";

    } else {
        $genre = htmlspecialchars($_POST["genre"], ENT_QUOTES, 'UTF-8');
    }

    // Validate Phone
    if (isset($_POST["phone"]) && isValidPhone($_POST["phone"])) {
        $phone = htmlspecialchars($_POST["phone"], ENT_QUOTES, 'UTF-8'); // ✅ fixed wrong source
    } else {
        $phone_error = "Phone is invalid";

    }

    // Validate Email
    if (empty($_POST["email"])) {
        $email_error = "Email is required";

    } else {
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $email_error = "Invalid email format";
    }
    // Handle optional fields (safe fallback)
    $avatar_path = isset($_POST['avatar_path']) ? htmlspecialchars($_POST["avatar_path"], ENT_QUOTES, 'UTF-8') : '/ENSAH-service/assets/images/avatar-M.jpg';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8') : '';
    $bio = isset($_POST['bio']) ? htmlspecialchars($_POST["bio"], ENT_QUOTES, 'UTF-8') : '';
    $linkedin = isset($_POST['linkedin']) ? htmlspecialchars($_POST["linkedin"], ENT_QUOTES, 'UTF-8') : '';

    // Final update if no errors
    if ($errors == 0 && $id !== null) {
        if ($_SESSION['user']['role'] == "admin") {
            $edit_user = "UPDATE user 
                  INNER JOIN admin ON admin.user_ID = user.user_ID 
                  SET user.nom = ?, user.prenom = ?, user.image = ?, user.address = ?, user.date_naissance=?,user.genre=?,user.bio=?,user.Phone=?,admin.email=?,user.linkedin=?
                  WHERE user.user_ID = ?";
            
        }elseif ($_SESSION['user']['role'] == "coordonnateur") {
            $edit_user = "UPDATE user
            INNER JOIN professeur ON professeur.user_ID = user.user_ID
            INNER JOIN coordonnateur ON coordonnateur.prof_ID = professeur.prof_ID
            SET user.nom = ?, user.prenom = ?, user.image = ?, user.address = ?, user.date_naissance=?,user.genre=?,user.bio=?,user.Phone=?,coordonnateur.cord_email=?,user.linkedin=?
            WHERE user.user_ID = ?";
        }
        $stmt = $pdo->prepare($edit_user);
        if ($stmt->execute([$nom, $prenom, $avatar_path, $address, $birthday, $genre, $bio, $phone, $email, $linkedin, $id])) {
            // Update session data
            $_SESSION['user'] = [
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom,
                'image' => $avatar_path,
                'linkedin' => $linkedin,
                'bio' => $bio,
                'genre' => $genre,
                'phone' => $phone,
                'address' => $address,
                'birthday' => $birthday,
            ];
            $_SESSION['success_message'] = "profil edited successfully!";
            header("Location: /ENSAH-service/pages/profil.php?success=1");
            exit(1);
        } else {
            $_SESSION['error_message'] = "Error dans la modification du profile!";
            header("Location: /ENSAH-service/pages/profil.php?error=1");
            exit(1);
        }
    } else {
        $_SESSION['error_message'] = "Error dans la modification du profile!";
        header("Location: /ENSAH-service/pages/profil.php?error=1");
        exit(1);
    }
}
?>