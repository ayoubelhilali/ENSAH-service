<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
  require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php' ;
?>

<!DOCTYPE html>
<html lang="fr">
<!-- [Head] start -->

<head>
  <title>ENSAH-service | Professeur </title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="/ENSAH-service/assets/images/logo-small_noBG.png" type="image/png"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="assets/css/style-preset.css" >

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
  <?php 
    include_once 'C:\xampp\htdocs\ENSAH-service\inc\sidebar\prof-sidebar.php'
  ?>

  <?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/ENSAH-SERVICE/inc/header/header.php") 
  ?>
  <!-- body -->

<div class="pc-container">
   <div class="pc-content">
    <h4>Uploader les Notes :</h4>

    <form method="post" enctype="multipart/form-data" action="traitement_note.php">

      <div class="form-group">
        <label for="module">Module</label>
         <select name="unite_id" id="module" required>
          <option value="">-- Choisir un module --</option>
          <?php 
         
           $unites = $pdo->prepare("SELECT * FROM voeux v 
                                    JOIN unite u ON v.id_unite=u.unite_ID 
                                    WHERE v.id_prof=? AND v.status=? ") ;
           if($unites->execute([$_SESSION["user"]["prof_id"],1])){
              $rows = $unites->fetchAll(PDO::FETCH_ASSOC);
              foreach($rows as $row){

                echo '<option value="'.$row['unite_ID'].'">'.$row['unite_name'].'</option>'  ;

              }
            }
         ?>
        </select>
      </div>

      <div class="form-group">
        <label for="session">Session</label>
        <select name="session" id="session" required>
          <option value="normale">Session normale</option>
          <option value="rattrapage">Rattrapage</option>
        </select>
      </div>

      <div class="upload-alt">Importer votre fichier Excel / CSV :</div>

      <div class="form-group">
        <input type="file" name="fichier_notes" accept=".xlsx, .xls" required>
       </div>

       <button type="submit" class="submit-btn">Enregistrer les notes</button>
       <div> <?php 
          if(isset($_GET['succes'])){
            if($_GET['succes']==1) echo "<h4 style='color:green;'>Fichier importé avec succès.</h4>"  ;
            elseif($_GET['succes']==0)  echo "<h4 style='color:red;'>Impossible de lire le fichier.</h4>" ;
        
            else   echo "<h4 style='color:red;'>Aucun fichier reçu.</h4>"  ;

          }
       ?></div>
    </form>
    </div>
</div>
</body>
</html>