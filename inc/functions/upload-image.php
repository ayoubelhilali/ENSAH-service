<?php
$targetDir = "../../uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}



if (isset($_FILES['uplfile']) && $_FILES['uplfile']['error'] === 0) {
    $filename = basename($_FILES["uplfile"]["name"]);
    $targetFile = $targetDir . time() . "_" . $filename;
    $avatar = $targetFile;

    if (move_uploaded_file($_FILES["uplfile"]["tmp_name"], $targetFile)) {
        echo "/ENSAH-service/uploads/" . basename($targetFile); // chemin relatif pour <img>
    } else {
        echo "";
    }
} else {
    echo "";
}
?>