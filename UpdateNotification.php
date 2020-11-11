<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();
sqlsrv_configure("WarningsReturnAsErrors", 1);  
ini_set('display_errors',1); 
error_reporting(E_ALL);

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);

?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" href="CreateNotification.php">Création d'une notification</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Modification d'une notification</a>
  </li>
 
</ul>
  <div class="row">
    <div class="col">
      <div class="card shadow">       
         <div class="list-group list-group-flush">

          <?php          
          $Notifications ="SELECT Top 7 * FROM Notifications order by IdNoti desc";          
          $resultNoti = sqlsrv_query( $con, $Notifications );          
          if( $resultNoti === false )
          {
              exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
          }
          if( sqlsrv_num_fields($resultNoti) )
          {        $i=1;   
           while( $rowNoti = sqlsrv_fetch_array( $resultNoti, SQLSRV_FETCH_ASSOC ) )
            {                  
              $USERScmd ="SELECT * FROM USERS where IdUSER= ".$rowNoti['from']."";
              $USERSquery = sqlsrv_query( $con, $USERScmd );        
                   
              if( sqlsrv_num_fields( $USERSquery ) )
              {             
                  while( $rowUser = sqlsrv_fetch_object($USERSquery))
                  {                        
                    $NomUSER= $rowUser->NomUSER; 
                    $PrenomUSER= $rowUser->PrenomUSER; 
                  } 
              }
              if($_SESSION['CompteUSER']==$rowNoti['CompteUSER'] or $_SESSION['CompteUSER']=="A" )
              {
                echo '       
                 <a href="#" style="z-index: 0;" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModal'.$i.'">
                  <div class="row align-items-center">                  
                    <div class="col ml--2">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h4 class="mb-0 text-sm">'.$NomUSER." ".$PrenomUSER.'</h4>
                        </div>
                        <div class="text-right text-muted">
                          <small>';

                        $today = date("Y-m-d");                      
                        if ($today != $rowNoti['Date']->format('Y-m-d')) 
                        {
                          echo $rowNoti['Date']->format('F j, g:i a');
                        }
                        else
                        {
                          echo $rowNoti['Date']->format('g:i a');
                        } 
                          echo'</small>
                        </div>
                      </div>
                      <p class="text-sm mb-0">'. $rowNoti['Message'].'</p>
                    </div>
                  </div>
                </a>

            <div class="modal fade" id="myModal'.$i.'" role="dialog">
              <div class="modal-dialog" style="margin-top: 17%;max-width: 720px;">
              <form method="post" action="Function/F_UpdateNotification.php?IdNoti='.$rowNoti['IdNoti'].'" id="my_form">              
                <div class="modal-content" style="margin-left: 17%;">               
                  <div class="modal-body" style="padding-bottom: 0px;">
                    <div >';?>
                    <!-- <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="Date">Changer le temps</label>
                          <input type="date" id="Date" name="Date" class="form-control" required>
                        </div>
                      </div>
                    </div> -->
                     <div class="row">                   
                      <div class="col-lg-3">
                        <label class="form-control-label" for="input-email">To</label> <br>
                        <?php 
                        if($rowNoti['CompteUSER']=='U'){
                        ?>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio1" type="radio" checked value="U">
                            <label class="custom-control-label" for="customRadio1">
                              <span>Utilisateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio2"  type="radio" value="A">
                            <label class="custom-control-label" for="customRadio2">
                              <span>Administrateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio3" type="radio" value="I">
                            <label class="custom-control-label" for="customRadio3">
                              <span>Visiteurs</span>
                            </label>
                          </div>
                        <?php 
                          }elseif($rowNoti['CompteUSER']=='A'){
                        ?>
                        <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio1" type="radio"  value="U">
                            <label class="custom-control-label" for="customRadio1">
                              <span>Utilisateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio2"  type="radio" checked value="A">
                            <label class="custom-control-label" for="customRadio2">
                              <span>Administrateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio3" type="radio" value="I">
                            <label class="custom-control-label" for="customRadio3">
                              <span>Visiteurs</span>
                            </label>
                          </div>
                           <?php 
                          }elseif($rowNoti['CompteUSER']=='I'){
                        ?>
                         <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio1" type="radio"  value="U">
                            <label class="custom-control-label" for="customRadio1">
                              <span>Utilisateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio2"  type="radio" value="A">
                            <label class="custom-control-label" for="customRadio2">
                              <span>Administrateurs</span>
                            </label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input name="CompteUSER2" class="custom-control-input" id="customRadio3" type="radio" checked value="I">
                            <label class="custom-control-label" for="customRadio3">
                              <span>Visiteurs</span>
                            </label>
                          </div>
                           <?php } ?>
                        </div>
                         <div class="col-lg-9">
                          <textarea rows="6"  class="form-control form-control-alternative" name="message" placeholder="Le message de la notification.." required><?= $rowNoti['Message']?></textarea>
                        </div> 
                    </div>

                    <?php echo'</div>
                    <div class="col-lg-12">                    
                      <div class="text-right"> 
                        <div class="form-group" style="margin-top: 30px;">
                          <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Annuler</button>                                    
                          <input type="submit" value="Enregistrer" class="btn btn-sm btn-info"> 
                        </div>
                      </div>
                    </div>  
                  </div>                
                </div>
              </form>
            </div>
          </div>

                ';
              }$i+=1;
            }
          }
        ?>
              <a href="#!" class="list-group-item list-group-item-action" style="z-index: 0;">
                <div class="row align-items-center">                  
                  <div class="col ml--2">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h4 class="mb-0 text-sm">Imrasoft :: GED</h4>
                      </div>
                      <div class="text-right text-muted">
                        <small></small>
                      </div>
                    </div>
                    <p class="text-sm mb-0">Salut! Merci de votre inscription 😊 </p>
                  </div>
                </div>
              </a>             
            </div>
    </div>
  </div>
</div>

<?php require "MasterPage/footer.php"; ?>