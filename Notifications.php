<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);

?>
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="far fa-bell"></i>&nbsp;Notifications</h3>
            </div>            
          </div>
        </div>
         <div class="list-group list-group-flush">

          <?php          
          $Notifications ="SELECT Top 7 * FROM Notifications order by IdNoti desc";          
          $resultNoti = sqlsrv_query( $con, $Notifications );          
          if( $resultNoti === false )
          {
              exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
          }
          if( sqlsrv_num_fields($resultNoti) )
          {           
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
              if($_SESSION['CompteUSER']==$rowNoti['CompteUSER'])
              {
                echo '       
                 <a href="'.$rowNoti['Url'].'" class="list-group-item list-group-item-action" style="z-index: 0;">
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
                </a>';
              }
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