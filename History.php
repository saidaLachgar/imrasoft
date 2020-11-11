<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);

if( $_SESSION['CompteUSER']=='A'){
 $queryHistory ="SELECT * FROM History order by IdHistory desc";
}else{
  $queryHistory ="SELECT * FROM History where IdUSER=".$_SESSION['IdUser']." order by IdHistory desc";
}

$resultHistory = sqlsrv_query( $con, $queryHistory );
if( $resultHistory === false )
{
    exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

if( sqlsrv_num_fields( $resultHistory ) )
{ echo'
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8"><h3 class="mb-0"  style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-history"></i>&nbsp; &nbsp;Historique</h3>
            </div>            
          </div>        
                 
        </div> 
        <div class="table-responsive">
          <table id="myTable" class="table align-items-center table-flush">';?>         
             <tbody>
              <?php
               if(sqlsrv_has_rows($resultHistory)  === false)
                {
                  echo'
                    <tr>                        
                      <td>Votre historique s\'affiche ici</td>
                    </tr>';
                }else{
                 while( $rowHs = sqlsrv_fetch_array( $resultHistory, SQLSRV_FETCH_ASSOC ) )
                  {
                    //IdHistory IdUSER History Url //1 supp 2 ajouter 3 modifier 4 active 5 show 6 accepter
                    echo'<tr>
                      <td ><a href="'. $rowHs['Url'].'" style="color: #525f7f;">';
                      if ($rowHs['mession']==1) {
                        echo '<i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;';
                      }elseif ($rowHs['mession']==2) {
                       echo '<i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;';
                      }elseif ($rowHs['mession']==3) {
                       echo '<i class="fas fa-pen"></i>&nbsp;&nbsp;&nbsp;';
                      }elseif ($rowHs['mession']==4) {
                       echo '<i class="fas fa-lock"></i>&nbsp;&nbsp;&nbsp;';
                      }elseif ($rowHs['mession']==5) {
                       echo '<i class="fas fa-eye"></i>&nbsp;&nbsp;&nbsp;';
                      }elseif ($rowHs['mession']==6) {
                       echo '<i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;';
                      }

                     echo $rowHs['History']; echo '</a></td> ';

                      $today = date("Y-m-d");                      
                      if ($today != $rowHs['date']->format('Y-m-d')) 
                      {
                        echo' <td >'.$rowHs['date']->format('F j, g:i a').'</td>';
                      }
                      else
                      {
                        echo' <td>'.$rowHs['date']->format('g:i a').'</td>';
                      }                                                        
                    echo '</tr>'; 
                    }         
                  }
                ?>           
              </tbody>
        </table>
      </div>         
    </div>
  </div>
</div><?php
}
        sqlsrv_close ( $con );       
?>     
 

<?php require "MasterPage/footer.php"; ?>