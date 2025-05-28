<?php 
  
  require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php' ;

?>

<div class="container">
    <h4>Uploader les Notes :</h4>

    <form method="post" enctype="multipart/form-data" action="traitement_note.php">

      <div class="form-group">
        <label for="module">Module</label>
         <select name="unite_id" id="module" required>
          <option value="">-- Choisir un module --</option>
          <?php 
            session_start() ;
           $unites = $pdo->prepare("SELECT * FROM voeux v 
                                    JOIN unite u ON v.id_unite=u.unite_ID 
                                    WHERE v.id_prof=? AND v.status=? ") ;
           if($unites->execute([$_SESSION['user']['user_id'],1])){
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
        <input type="file" name="fichier_notes" accept=".csv">
       </div>

       <button type="submit" class="submit-btn">Enregistrer les notes</button>
       <div> <?php 
          if(isset($_GET['succes'])){
            if($_GET['succes']==1) echo "<h4 style='color:green;'>Fichier importé avec succès.<h4>"  ;
            elseif($_GET['succes']==0)  echo "<h4 style='color:red;'>Impossible de lire le fichier.<h4>" ;
        
            else   echo "<h4 style='color:red;'>Aucun fichier reçu.<h4>"  ;

          }
       ?></div>
    </form>
  
</div>