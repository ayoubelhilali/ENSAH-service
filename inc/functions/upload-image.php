<?php
if ($_SESSION["role"]="professeur") {
    $targetDir = "../../uploads/professeur/";
}elseif ($_SESSION["role"] = "vacataire") {
    $targetDir = "../../uploads/vacataire/";
}else {
    $targetDir = "../../uploads/"; // File system path for uploads
}

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (isset($_FILES['uplfile']) && $_FILES['uplfile']['error'] === 0) {
    // Get the file extension
    $extension = pathinfo($_FILES["uplfile"]["name"], PATHINFO_EXTENSION);

    // Generate a unique name for the file
    $uniqueName = time() . "." . $extension;

    // Full file system path for the uploaded file
    $targetFile = $targetDir . $uniqueName;

    // Relative path for use in the application
    $relativePath = "/ENSAH-service/uploads/" . $uniqueName;

    if (move_uploaded_file($_FILES["uplfile"]["tmp_name"], $targetFile)) {
        // Return the relative path for use in <img> tags or other purposes
        echo $relativePath;
    } else {
        // Handle upload failure
        echo "Error: Failed to move the uploaded file.";
    }
}
?>