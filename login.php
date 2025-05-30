<!DOCTYPE html>
<html lang="fr">


<head>
  <title>Se connecter à ENSAH Service</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="Accédez facilement aux services de l'Ecole nationale des sciences appliquées d'Al Hoceima ">
  <meta name="keywords" content="ENSAH, Al Hoceima , E Service , Université Abdelmalek essaadi, Ecole nationale">



  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<link rel="icon" href="assets/images/logo-small_noBG.png" type="image/png">     <!-- icone dans l'onglet de site-->

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="assets/css/style-preset.css" >

</head>

<body>

  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader- ">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="#" ><img id="imag_header" src="assets/images/logo-withoutBG.png" alt="img"></a>
        </div>
        <form method="POST"  action="traitement.php">
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0" id="se-connecter"><b>Se connecter</b></h3>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Adresse Email</label>
              <input type="email" name="email" class="form-control" placeholder="Entrer votre adresse Email">
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Mot de passe</label>
              <div class="inputPasswoed_iconeEye">
                 <input type="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" id="input_password">
                 <span class="material-symbols-outlined" id="icone_Eye">visibility_off</span>
              </div>
            </div>
            <?php 
               if(isset($_GET['message'])){
                echo "<p style='color: red;'>" . htmlspecialchars($_GET['message']) . "</p>";
                }
             ?>
            <div class="d-flex justify-content-between align-items-center mt-1">
              <div class="form-check m-0">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted ms-2" for="customCheckc1">Rester connecté</label>
              </div>
              <h5 class="text-secondary fw-normal text-decoration-none">Mot de passe oublié ?</h5>
            </div>
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  
  <script src="assets/js/JS.js"></script>
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  


</body>
<!-- [Body] end -->

</html>