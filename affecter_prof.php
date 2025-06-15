<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] .'/ENSAH-service/inc/functions/connections.php' ;      

if(isset($_POST['choix']) && isset($_POST['id_unite'])){
   $choix = $_POST['choix'];
    $unite =  $_POST['id_unite'] ;

   if($choix==0){
      $requete=$pdo->prepare("DELETE FROM affect_ue_prof 
                            UNION affect_ue_vac 
                            WHERE id_unite=? ") ;
      $requete->execute([$unite]) ;
      header("Location:chef_depar.php ") ;
   }

   else{
    $requete1=$pdo->prepare("DELETE FROM affect_ue_prof 
           WHERE id_unite=? ") ;
    $requete1->execute([$unite]) ;

     $requete2=$pdo->prepare("INSERT INTO affect_ue_prof(id_unite,id_prof)
                               VALUES(?,?) ") ;
      
    $requete2->execute([$unite,$choix]) ;

   header("Location:chef_depar.php ") ;
   }
}














?>