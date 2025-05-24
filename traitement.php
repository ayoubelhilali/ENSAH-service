<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once __DIR__ . '/inc/functions/connections.php';

try {
    // Get admins data
    $admins = [];
    $admins_data = "SELECT * FROM admin 
                   JOIN user ON admin.user_ID = user.user_ID";
    $stmt = $pdo->prepare($admins_data);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admins[$row['email']] = [
                'user_id' => $row['user_ID'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'password' => $row['password'],
                'image' => $row['image'],
                'linkedin' => $row['linkedin'],
                'bio' => $row['bio'],
                'genre' => $row['genre'],
                'phone' => $row['Phone'],
                'address' => $row['address'],
                'birthday' => $row['date_naissance'],
                'email' => $row['email'],
                'role' => "admin"
            ];
        }
    }

    // Get coordinators data
    $cordons = [];
    $cordon_data = "SELECT * FROM coordonnateur C 
                        JOIN filiere F ON F.filiere_ID=C.filiere_ID
                        JOIN professeur P ON P.prof_ID = C.prof_ID 
                        JOIN user U ON P.user_ID = U.user_ID";
    $stmt = $pdo->prepare($cordon_data);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cordons[$row['cord_email']] = [
                'user_id' => $row['user_ID'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'filiereID' => $row['filiere_ID'],
                'filiereNom' => $row['filiere_nom'],
                'password' => $row['cord_password'],
                'role' => "coordonnateur",
                'linkedin' => $row['linkedin'],
                'bio' => $row['bio'],
                'genre' => $row['genre'],
                'phone' => $row['Phone'],
                'address' => $row['address'],
                'birthday' => $row['date_naissance'],
                'email' => $row['cord_email'],
                'image' => $row['image']
            ];
        }
    }

} catch (PDOException $e) {
    // Handle database errors
    error_log("Database error: " . $e->getMessage());
    // You might want to redirect to an error page or display a message
    header("Location: error.php?message=Database+error");
}


// Check login credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<script>console.log('POST request received');</script>";
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if email exists in admins
    if (isset($admins[$email])) {
        // Verify password (assuming passwords are hashed)
        if (password_verify($password, $admins[$email]['password'])) {
            $_SESSION['user'] = [
                'user_id' => $admins[$email]['user_id'],
                'email' => $email,
                'nom' => $admins[$email]['nom'],
                'prenom' => $admins[$email]['prenom'],
                'image' => $admins[$email]['image'],
                'linkedin' => $admins[$email]['linkedin'],
                'bio' => $admins[$email]['bio'],
                'genre' => $admins[$email]['genre'],
                'phone' => $admins[$email]['phone'],
                'address' => $admins[$email]['address'],
                'birthday' => $admins[$email]['birthday'],
                'role' => 'admin'
            ];
            header('Location: dashboard/admin-dash.php');
            exit();
        } else {
            $error = "password incorrect";
            header("Location: login.php?message= $error");
            exit();
        }
    }
    // Check if email exists in coordinators
    elseif (isset($cordons[$email])) {
        // Verify password (assuming passwords are hashed)
        if (password_verify($password, $cordons[$email]['password'])) {
            $_SESSION['user'] = [
                'user_id' => $cordons[$email]['user_id'],
                'email' => $email,
                'nom' => $cordons[$email]['nom'],
                'prenom' => $cordons[$email]['prenom'],
                'image' => $cordons[$email]['image'],
                'linkedin' => $cordons[$email]['linkedin'],
                'bio' => $cordons[$email]['bio'],
                'genre' => $cordons[$email]['genre'],
                'phone' => $cordons[$email]['phone'],
                'address' => $cordons[$email]['address'],
                'birthday' => $cordons[$email]['birthday'],
                'role' => 'coordonnateur'
            ];
            $_SESSION["filiere"]=[
                "filiereID" => $cordons[$email]['filiereID'],
                "filiereNom" => $cordons[$email]['filiereNom'],
            ];
            header("Location: dashboard/cord-dash.php?filiere");
            exit();
        } else {
            header("Location: login.php?message=mot+de+passe+invalide");
            exit();
        }
    }
    // Email not found
    else {
        header("Location: login.php?message=Email+invalide");
        exit();
    }
}
header("Location: login.php?message=formulaire+invalide");
exit();