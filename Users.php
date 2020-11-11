<style type="text/css">
  #myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<?php require "MasterPage/header.php"; ?>
<?php 


session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);    


$cmd ="SELECT * FROM USERS where Request=0 order by CompteUSER ASC, ConnectedUSER DESC";
$query = sqlsrv_query( $con, $cmd );

/* Handle sql errors if retuned */
if( $query === false )
{
        exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

/* Handle sql response for track data */
if( sqlsrv_num_fields( $query ) )
{ 
    // NomUSER  PrenomUSER  EmailUSER  TelephoneUSER  LoginUSER  PassUSER  CompteUSER ActiveUSER ConnectedUSER    
    echo '<div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">

          <div class="row">
            <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-users" ></i> &nbsp; &nbsp; Collaborateur</h3></div>          
            <div class="col-md-4"><div class="col text-right">
             ';
            if( $_SESSION['CompteUSER']=='A')
            { echo'
                  <a href="AddUser.php" class="btn btn-sm btn-info"> <i class="fas fa-user-plus"></i> Ajouter </a>';
            } echo'
            </div>          
        </div>        

        <div class="input-group" style="margin-top: 10px;">
          <div class="input-group-prepend">  
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
          </div>
          <input type="text" class="form-control" id="LoginUSER2" onkeyup="myFunction()" placeholder="Search for names.." >
        </div>

        <div class="col-12 my-auto">
          <div class="row mt-3 ml-3">
            <i class="fas fa-trash" style="color:#fb6340;">&nbsp;&nbsp;<a style="font-family: Open Sans, sans-serif;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #525f7f;">supprimer</a></i>&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fas fa-pen" style="color:#2dce89">&nbsp;&nbsp;<a style="font-family: Open Sans, sans-serif;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #525f7f;">modifier</a></i>&nbsp;&nbsp;&nbsp;&nbsp;
             <span class="fas fa-lock-open"  style="color:#525f7f">&nbsp;&nbsp;<a style="font-family: Open Sans, sans-serif;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #525f7f;">activé</a></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="fas fa-lock" style="color:#525f7f">&nbsp;&nbsp;<a style="font-family: Open Sans, sans-serif;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #525f7f;">désactivé</a></span>            
          </div>
        </div>
</div>
          
        </div>        
        <div class="table-responsive">
          <table id="myTable" class="table align-items-center table-flush table-hover ">
            <thead class="thead-light">
              <tr>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Tele</th>
                <th scope="col">Rôles</th>
                <th scope="col">disponibilité</th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody>';$i=1;
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC ) )
        {           
        echo '<tr>
                <td scope="row">
                        <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3" style="width:28px;height:28px" >
                        <img alt="Image placeholder" src="assets/img/theme/team-4-800x800.png">
                        </a>
                        <div class="media-body">
                        <span class="mb-0 text-sm">'. $row['NomUSER'] .' '.$row['PrenomUSER'] .'</span>
                        </div>
                        </div>
                </td>
                <td><a href="mailto:'. $row['EmailUSER'] . '" target="_blank">'. $row['EmailUSER'] . '</a></td>
                <td>'. $row['TelephoneUSER'] . '</td>
                <td>'. $row['CompteUSER'] . '</td>
                <td>';
                        if($row['ConnectedUSER'] == 0){
                                echo '<span class="badge badge-dot mr-4">
                                <i class="bg-warning"></i> Hors ligne
                                </span>';
                        }else{
                                echo'<span class="badge badge-dot">
                                <i class="bg-success"></i> En ligne
                                </span>' ;
                        }
                echo'</td>                
                 <td>'; 
                 if($row['ConnectedUSER'] == 0 AND $_SESSION['CompteUSER']=='A')
                 {                                        
                    if($row['ActiveUSER'] == 0)
                    {                      
                      echo '
                      <a style="color:#172b4d" href="Function/F_Presence.php?prs='.$row['ActiveUSER'].' & id='.$row['IdUSER'].'"
                      data-toggle="tooltip" data-placement="top" title="cliquez pour Activé">                           
                      <span class="fas fa-lock"></span></a>';                    
                    }else
                    {
                      echo'
                      <a style="color:#172b4d" href="Function/F_Presence.php?prs='.$row['ActiveUSER'].' & id='.$row['IdUSER'].'"
                      data-toggle="tooltip" data-placement="top" title="cliquez pour désactivé" >                        
                      <span class="fas fa-lock-open"></span></a>' ; 
                    }                
                    echo' 
                    <button style="color:#fb6340; margin-right: 0rem;" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal'.$i.'"><i class="fas fa-trash"></i></button>
                    <a style="color:#2dce89" href="UpdateUsers.php?id='.$row['IdUSER'].'" ><i class="fas fa-pen"></i></a>

                        <div class="modal fade" id="myModal'.$i.'" role="dialog">
                          <div class="modal-dialog" style="margin-top: 17%;">
                          <form method="post" action="Function/F_DeleteUser.php?id='.$row['IdUSER'].'" id="my_form">              
                            <div class="modal-content" style="margin-left: 17%;">               
                              <div class="modal-body" style="padding-bottom: 0px;">
                                <div class="col-lg-12">
                                  <h3> Es-tu sûr de supprimer '. $row['NomUSER'] .' '.$row['PrenomUSER'] .'?</h3>
                                </div>
                                <div class="col-lg-12">                    
                                  <div class="text-right"> 
                                    <div class="form-group">
                                      <button type="button" class="btn btn-sm" data-dismiss="modal">Annuler</button>                                    
                                      <input type="submit" value="Supp" class="btn btn-sm btn-warning"> 
                                    </div>
                                  </div>
                                </div>  
                              </div>                
                            </div>
                          </form>
                        </div>
                      </div>';$i+=1; 
                }
          echo'</td>'; 
             echo '</tr>';
          }
    echo' </tbody>
        </table>
      </div>         
    </div>
  </div>
</div>';
}
        sqlsrv_close ( $con );       
?>    

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

<script>
  var text = '<?php echo $_GET['text'];?>'; 
  if (text != '') {
  var filter, table, tr, td, i, txtValue;  
  filter = text.toUpperCase();
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