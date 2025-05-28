   <div class="pc-content">            
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                  <h4 class="mb-4">Unités d'enseignement pour la prochaine année universitaire</h4>

                    <div class="card table-card">
                        <div class="card-body">
                              <form action="submit_voeux.php" method="POST">
                               <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Ajouter à vos voeux</th>
                                            <th rowspan="2">Unité d'enseignement</th>
                                            <th rowspan="2">Spécialité</th>
                                            <th rowspan="2">Responsable</th>
                                            <th colspan="3">Volume horaire</th>
                                            <th rowspan="2">Semestre</th>
                                       </tr>
                                        <tr>
                                           <th >Cours</th>
                                           <th>TD</th>
                                           <th>TP</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                       <?php 
                                         require_once 'C:\xampp\htdocs\ENSAH-service\inc\functions\connections.php' ;
                                         $sql = "SELECT * FROM unite" ;
                                         $stmt = $pdo->query($sql);
                        
                                      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                     echo  "<tr>" ;
                                     echo "<td><input type='checkbox' name='voeux[]' value='".$row["unite_ID"]."' data-cours='" . $row["volume_cours"] . "' data-td='" . $row["volume_td"] . "'data-tp='" . $row["volume_tp"] . "'></td>" ;
                                     echo "<td>".htmlspecialchars($row["unite_name"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["unite_specialite"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["unite_resp"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["volume_cours"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["volume_td"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["volume_tp"])."</td>" ;
                                     echo "<td>".htmlspecialchars($row["semestre"])."</td>" ;
                                     echo "</tr>" ;
                                   }                    
                                ?>
                                    </tbody>
                                </table>
                                 <div class="ms-4" > La charge horaire totale sélectionnée : <span id="total">0</span> h </div>
                                  <script>
                                     const checkboxes= document.querySelectorAll('input[name="voeux[]"]') ;
                                     const totaldisplay = document.getElementById('total') ;
                                  function updatetotal(){
                                    let total = 0 ;
                                    checkboxes.forEach(cb=>{
                                       if(cb.checked){
                                          const cours = parseFloat(cb.dataset.cours) || 0;
                                          const td = parseFloat(cb.dataset.td) || 0;
                                          const tp = parseFloat(cb.dataset.tp) || 0;
                                          total += cours + td + tp;
                                       }
                                    }) ;

                                    totaldisplay.textContent= total ;
                          

                                  }
                                  
                                    checkboxes.forEach(cb => {
                                       cb.addEventListener('change', updatetotal);
                                       });
                                  
                                  </script>
                                  <?php

                                    if (isset($_GET['message'])) {
                                       if($_GET['succes']==1)
                                           echo '<div style="background:none ;color:green ;margin-left:20px ;">'.htmlspecialchars($_GET['message']).'</div>' ;
                                        elseif($_GET['succes']==0)
                                           echo '<div style="background:none ;color:red ;margin-left:20px ;">'.htmlspecialchars($_GET['message']).'</div>' ;
                                         else
                                           echo '<div style="background:none ;color:red ;margin-left:20px ;">'.htmlspecialchars($_GET['message']).'</div>' ;

                                    }
                                   ?>
                                </div>
                             <button type="submit" class="btn btn-primary mt-3 ms-4">Valider mes vœux</button>
                           </form>
                        </div>
                    </div>
                </div>
                  <h5>Vous pouvez consulter les unités d'enseignement que vous avez assuré  <a href='Prof_interface.php?page=unite_assure' >ici</a></h5>

                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>