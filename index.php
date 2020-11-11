<?php 
session_name('SESSION');
session_start();

sqlsrv_configure("WarningsReturnAsErrors", 1);  
ini_set('display_errors',1); 
error_reporting(E_ALL);

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);    


$querycode = sqlsrv_query( $con, "SELECT top 10 * from code order by IdSOCIETE DESC" );//code
$query1 = sqlsrv_query( $con, "select count(idUSER) as [count] from users" );//users
$query2 = sqlsrv_query( $con, "select count(IdSociete) as [count] from Societe" );//Societe
$query = sqlsrv_query( $con, "select count(idUSER) as [count] from users where ConnectedUSER=1" );//users

if( sqlsrv_num_fields( $query1 ) )
{
  while( $row1 = sqlsrv_fetch_array( $query1, SQLSRV_FETCH_ASSOC ) )
  {
    $Collaborateur= $row1['count'];
  }
}if( sqlsrv_num_fields( $query2 ) )
{
  while( $row2 = sqlsrv_fetch_array( $query2, SQLSRV_FETCH_ASSOC ) )
  {
    $Société= $row2['count'];
  }
}if( sqlsrv_num_fields( $query ) )
{
  while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC ) )
  {
    $Enligne= $row['count'];
  }
}
 ?>
  <?php require "MasterPage/header.php"; ?>
      <div class="row" style="margin-bottom: 23px;margin-left: 0px;margin-right: 0px;padding-left: 15px;padding-right: 15px;">
        <div style="margin-bottom: 5px;font-size: 1.125rem;line-height: 1.5em;font-family: 'Roboto', 'Helvetica','Arial', sans-serif; font-weight: 300;margin-bottom: 15px;">Rechercher plus rapidement sur un client, une entreprise ou un document</div>
        <form method="post" action="Function/search.php?url=<?=$_SERVER['PHP_SELF']?>" style="width: 100%;">
          <div class="input-group shadow" style="border: 0;">
            <input type="text" value="" class="form-control" name="text" style="border: 1px solid rgba(0, 0, 0, .05);">
            <div class="input-group-btn bs-dropdown-to-select-group dropdown">
              <button type="button" class="dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown" style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;border: 1px solid transparent;font-size: 1rem;font-weight: 600;line-height: 1.5;display: inline-block;padding: .625rem 1.25rem;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out; text-align: center;vertical-align: middle;white-space: nowrap;color: rgba(255, 255, 255, .7);border-left: 1px solid rgba(255, 255, 255, .5);padding-right: 0px;">
                <span data-bind="bs-drp-sel-label">Select...</span>
                <input type="hidden" name="selected_value" data-bind="bs-drp-sel-value" style="">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <button type="submit" style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;border: 1px solid transparent;font-size: 1rem;font-weight: 600;line-height: 1.5;display: inline-block;padding: .625rem 1.25rem;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out; text-align: center;vertical-align: middle;white-space: nowrap;color: rgba(255, 255, 255, .7);padding-right: 1.25rem;padding-left: 9px;">
                <i class="fas fa-search"></i>
              </button>
              <ul class="dropdown-menu" role="menu" style="">
                  <li data-value="1" class="dropdown-item"><a href="Company.php">Collaborateur</a></li>
                  <li data-value="2" class="dropdown-item"><a href="#">Société</a></li>
                  <li data-value="3" class="dropdown-item"><a href="#">Document</a></li>                        
              </ul>
          </div>
        </div>            
      </form>        
  </div>
       
  <div class="col-12" style="margin-top: 15px;margin-bottom: 25px;">
    <div class="row" >
      <div class="col-xl-4 col-lg-4">
        <div class="card card-stats mb-4 mb-xl-0 shadow" style="width: 100%;border-radius: 16px;background: rgba(255, 255, 255, .8);-webkit-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);-moz-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Collaborateur</h5>
                <span class="h2 font-weight-bold mb-0"><?= $Collaborateur ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape text-white rounded-circle shadow" style="background: linear-gradient(87deg,#f5365c 0,#f56036 100%) !important;">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4">
        <div class="card card-stats mb-4 mb-xl-0 shadow" style="width: 100%;border-radius: 16px;background: rgba(255, 255, 255, .8);-webkit-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);-moz-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">En ligne</h5>
                <span class="h2 font-weight-bold mb-0"><?= $Enligne ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape text-white rounded-circle shadow" style="background: linear-gradient(87deg,#1171ef 0,#11cdef 100%) !important;">
                  <i class="fas fa-plug"></i>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4">
        <div class="card card-stats mb-4 mb-xl-0 shadow" style="width: 100%;border-radius: 16px;background: rgba(255, 255, 255, .8);-webkit-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);-moz-box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);box-shadow: 0px 16px 25px 0px rgba(118, 88, 198, 0.1);">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Société</h5>
                <span class="h2 font-weight-bold mb-0"><?= $Société ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape text-white rounded-circle shadow" style="background: linear-gradient(87deg,#2dce89 0,#2dcecc 100%) !important;">
                  <i class="fas fa-briefcase"></i>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>                    
    </div>                  
  </div> 
<div class="row">
   <div class="col-12">
        <div class="card bg-gradient-danger" style="background-image: linear-gradient(138deg, #63b4f2, #7369fd) !important;border: 0;"><!-- Card body -->
          <div class="card-body" style="padding: 7px 10px 7px 10px;">                
            <div class="my-4">                  
              <div class="h3 text-white" style="text-align: center;">
                <span style="text-align: center;text-transform: capitalize;font-size: 18px;">Accédez à vos documents où que vous soyez &nbsp;<img src="assets/img/ok-hand.png" style="height: 25px;padding-bottom: 4px;"></span> <br>Vos fichiers dans GED sont accessibles depuis tous vos appareils. Ainsi vous pouvez y accéder où que vous soyez.
              </div>
            </div>                
          </div>
        </div>
      </div>
</div> 
<div class="row" style="margin-top: 30px;">      
      <div class="col-xl-12">
        <div class="card bg-secondary shadow">
          <?php
          if( $_SESSION['CompteUSER']=='A'){
           $queryHistory ="SELECT Top 7 * FROM History order by IdHistory desc";
          }else{
          $queryHistory ="SELECT Top 7 * FROM History where IdUSER=".$_SESSION['IdUser']." order by IdHistory desc";
          }
          $resultHistory = sqlsrv_query( $con, $queryHistory );
          // Votre historique s'affiche ici
          if( $resultHistory === false )
          {
              exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
          }
          if( sqlsrv_num_fields($resultHistory) )
          { ?>      
          <div class="card-header border-0">
            <div class="row">
              <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-history" ></i>&nbsp; &nbsp;</i>Historique</h3></div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="myTable" class="table align-items-center table-flush ">
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
                   echo '<tr><td colspan="12" class="text-center"> <a href="History.php">Afficher tous</a></td></tr>';
                ?>           
              </tbody>
            </table>                      
          </div>
        </div>
      </div>
      <?php }
      sqlsrv_close ( $con );?>
      </div>           
  
<div class="col-12">             
    <div style ="background: rgba(82, 95, 127, 0.03);border-radius: .375rem;border-top-left-radius: 0.375rem;border-bottom-left-radius: 0.375rem; margin-bottom: 12px;margin-top: 35px">
      <p style="text-align: center;padding-top: 10px;padding-bottom: 10px;font-weight: bold;background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-user-clock"></i> Votre compte sera verrouillé toutes les 15 minutes après le déverrouillage pour des raisons de sécurité!.</p>
  </div>                
</div>   


<script>  
    //Change sidebar and content-wrapper height
    applyStyles();
    function applyStyles() {
      //Applying perfect scrollbar
      if ($('.scroll-container').length) {
        const ScrollContainer = new PerfectScrollbar('.scroll-container');
      }
    }

    //checkbox and radios
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');


    $(".purchace-popup .popup-dismiss").on("click",function(){
      $(".purchace-popup").slideToggle();
    });
</script>
 <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("LoginUSER2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>     
<?php require "MasterPage/footer.php"; ?>