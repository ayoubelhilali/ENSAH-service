<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    if (!session_start()) {
        die('Failed to start session');
    }
}

$pdo = new PDO('mysql:host=localhost;port=3307;dbname=ensah_service','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Get admins data
    $admins = [];
    $admins_data = "SELECT * FROM admin 
                   JOIN user ON admin.user_ID = user.user_ID";
    $stmt = $pdo->prepare($admins_data);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admins[$row['email']] = [
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'password' => $row['password'],
                'image' => $row['image'],
                'linkedin' => $row['linkedin'],
                'bio' => $row['bio'],
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
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'filiereID' => $row['filiere_ID'],
                'filiereNom' => $row['filiere_nom'],
                'password' => $row['cord_password'],
                'role' => "coordonnateur",
                'linkedin' => $row['linkedin'],
                'bio' => $row['bio'],
                'image' => $row['image']
            ];
        }
    }

} catch (PDOException $e) {
    // Handle database errors
    error_log("Database error: " . $e->getMessage());
    // You might want to redirect to an error page or display a message
}


// Check login credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if email exists in admins
    if (isset($admins[$email])) {
        // Verify password (assuming passwords are hashed)
        if ($password == $admins[$email]['password']) {
            $_SESSION['user'] = [
                'email' => $email,
                'nom' => $admins[$email]['nom'],
                'prenom' => $admins[$email]['prenom'],
                'image' => $admins[$email]['image'],
                'linkedin' => $admins[$email]['linkedin'],
                'bio' => $admins[$email]['bio'],
                'role' => 'admin'
            ];
            header('Location: dashboard/admin-dash.php');
            exit();
        } else {
            $error = "Invalid password";
        }
    }
    // Check if email exists in coordinators
    elseif (isset($cordons[$email])) {
        // Verify password (assuming passwords are hashed)
        if (password_verify($password, $cordons[$email]['password'])) {
            $_SESSION['user'] = [
                'email' => $email,
                'nom' => $cordons[$email]['nom'],
                'prenom' => $cordons[$email]['prenom'],
                'image' => $cordons[$email]['image'],
                'linkedin' => $cordons[$email]['linkedin'],
                'bio' => $cordons[$email]['bio'],
                'role' => 'coordonnateur'
            ];
            $_SESSION["filiere"]=[
                "filiereID" => $cordons[$email]['filiereID'],
                "filiereNom" => $cordons[$email]['filiereNom'],
            ];
            header("Location: dashboard/cord-dash.php?filiere");
            exit();
        } else {
            $message = $cordons[$email]['password'];
            header("Location: login.php?message=mot+de+passe+invalide $message");
            exit();
        }
    }
    // Email not found
    else {
        header("Location: login.php?message=Email+invalide");
        exit();
    }
}

header("Location: dashboard/admin-dash.php");
exit();