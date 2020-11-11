
<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

function countFolder($nom) {
    $file_pointer = ".\\CodeGed\\".$nom."\\";
    if (file_exists($file_pointer)) {
        $real = realpath($file_pointer) . DIRECTORY_SEPARATOR;
        $get = (count(scandir($real)) - 2);
        if ($get == -2) {
            $get = 0;
        }
        return $get;
    }
    else {
        return 99999;
    }                     
}


$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);    

if($_SESSION['CompteUSER']=='I')
{
  $cmd ="select * from Societe s join usercompany u  on(s.IdSociete=u.IdSOCIETE)  where U.IdUSER=".$_SESSION['IdUser'].";";
  $query = sqlsrv_query( $con, $cmd );
}
else{
  $cmd ="SELECT * FROM Societe order by LEN(LibelleSociete) desc , LEN(ville) desc";
  $query = sqlsrv_query( $con, $cmd );
}
if( $query === false )
{
        exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

if( sqlsrv_num_fields( $query ) )
{ echo'
  <div class="row">
  <div class="col">
    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="far fa-building" ></i> &nbsp; &nbsp;</i>Société</h3></div>

            <div class="col-md-4">
              <div class="col text-right">
              ';
            if( $_SESSION['CompteUSER']=='A')
            { echo'
                  <a href="AddCompany.php" class="btn btn-sm btn-info">Ajouter </a>
            ';} echo'                  
            </div>
          </div>
        </div>        
        <div class="input-group" style="margin-top: 10px;">
          <div class="input-group-prepend">  
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-search"></i></span>
          </div>
          <input type="text" class="form-control" id="LoginUSER2" onkeyup="myFunction()" placeholder="Search for names.." >
        </div>          
      </div>       
    <div class="table-responsive">
      <table id="myTable" class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>            
            <th scope="col">Nom</th>             
            <th scope="col" class="text-center">Nombre des années</th>            
            <th scope="col" class="text-center">Ville</th>            
            <th scope="col"  class="text-center"></th>            
          </tr>
        </thead>
        <tbody>';
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC ) )
        {echo'
          <tr>                        
            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal"><a  style="color:#172b4d" href="consultationAnnée.php?id='.$row['IdSociete'].'&NOM='.utf8_encode($row['LibelleSociete']).'">'.  utf8_encode( $row['LibelleSociete']) . '</a></td>             
            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal"  class="text-center"> ';
            if ((countFolder( utf8_encode($row['LibelleSociete'])))==99999)
            {
              echo 'Pas trouvé!';
            }
            elseif((countFolder( utf8_encode($row['LibelleSociete'])))<2)
            {
              echo countFolder( utf8_encode($row['LibelleSociete'])).'an';
            }
            else
            {
              echo countFolder( utf8_encode($row['LibelleSociete'])).' années';
            }
            echo '</td>            
            
            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal"  class="text-center"> '.  utf8_encode($row['Ville']) . '</td>                        
            <td  class="text-center"> ';

            if($_SESSION['CompteUSER']=='A'){echo '

            <button style="color:#fb6340; margin-right: 0rem;" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal'.$row['IdSociete'].'"><i class="fas fa-trash"></i></button>
                    <a href="UpdateCompany.php?id='.$row['IdSociete'].'" style="color:#2dce89"><i class="fas fa-pen"></i></a>
                      <div class="modal fade" id="myModal'.$row['IdSociete'].'" role="dialog">
                        <div class="modal-dialog" style="margin-top: 17%;">
                        <form method="post" action="Function/F_DeleteCompany.php?id='.$row['IdSociete'].'&NOM='.utf8_encode($row['LibelleSociete']).'" id="my_form2">              
                          <div class="modal-content" style="margin-left: 17%;">               
                            <div class="modal-body" style="padding-bottom: 0px;">
                              <div class="col-lg-12">
                                <h3> Es-tu sûr de supprimer? <br><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; Si la société a des codes, il ne supprimera pas<br><br></h3>
                              </div>
                              <div class="col-lg-12">                    
                                <div class="text-right"> 
                                  <div class="form-group">
                                    <button type="button" class="btn btn-sm" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-sm btn-warning">Delete</button>
                                  </div>
                                </div>
                              </div>  
                            </div>                
                          </div>
                        </form>
                      </div>
                    </div>  
                  ';} echo'
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a  style="color:#172b4d" href="consultationAnnée.php?id='.$row['IdSociete'].'&NOM='.utf8_encode($row['LibelleSociete']).'"><i class="fas fa-caret-right"></i> &nbsp;montre plus 
                  </a>                                         
            </td>          
          </tr>';          
        }
        echo'
       </tbody>
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

