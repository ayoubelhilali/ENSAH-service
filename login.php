<!DOCTYPE html>
<html lang="fr">


<head>
  <title>Se connecter à ENSAH Service</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description"
    content="Accédez facilement aux services de l'Ecole nationale des sciences appliquées d'Al Hoceima ">
  <meta name="keywords" content="ENSAH, Al Hoceima , E Service , Université Abdelmalek essaadi, Ecole nationale">

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

  <link rel="icon" href="assets/images/logo-small_noBG.png" type="image/png"> <!-- icone dans l'onglet de site-->

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="../assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="assets/css/style-preset.css">

</head>

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader- ">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
   
  <div class=" d-flex justify-content-center align-items-center vh-100" style=" background: linear-gradient(135deg, #d7e1ec, #a6c1ee); /* bleu très clair / gris bleu */">
    <div class="card shadow-lg p-4"
      style="max-width: 400px; width: 100%; border-radius: 15px;background: linear-gradient(135deg, #1e3c72, #2a5298);">
      <div class="text-center mb-4">
        <img src="assets/images/logo-withoutBG.png" alt="Logo" style="max-width: 150px;">
      </div>
      <h3 class="text-center mb-4 text-primary">Se connecter</h3>

      <form method="POST" action="traitement.php">
        <div class="mb-3">
          <label class="form-label" style="color:white;">Adresse Email</label>
          <input type="email" name="email" class="form-control" placeholder="Entrer votre adresse Email" required>
        </div>

        <!-- Ajouter ceci dans le <head> pour charger Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="mb-3 position-relative">
  <label class="form-label" style="color:white;">Mot de passe</label>
  <input type="password" name="password" class="form-control" id="input_password"
    placeholder="Entrer votre mot de passe" required>
  
  <!-- Ici on met une icône Font Awesome -->
  <button type="button"
    class="btn btn-outline-secondary btn-sm position-absolute top-50 end-0 translate-middle-y"
    id="togglePassword" style="margin-top: 15px; margin-right:5px;">
    <i class="fa-solid fa-eye"></i>
  </button>
</div>

<?php
if (isset($_GET['message'])) {
  echo "<p class='text-danger text-center'>" . htmlspecialchars($_GET['message']) . "</p>";
}
?>

<div class="form-check mb-3">
  <input class="form-check-input" type="checkbox" id="customCheckc1" checked>
  <label class="form-check-label" for="customCheckc1" style="color:white">Rester connecté</label>
</div>

<div class="d-grid">
  <button type="submit" class="btn btn-primary">Se connecter</button>
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('input_password');
  const icon = togglePassword.querySelector('i');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Change l'icône selon l'état
    if (type === 'password') {
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    } else {
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    }
  });
</script>



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