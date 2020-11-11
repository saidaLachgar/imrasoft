<?php require "MasterPage/header.php"; ?>
<style>
  .custom-toggle input:checked + .custom-toggle-slider::before{
        background: #12a6e0;
  }
  .custom-radio .custom-control-input:checked ~ .custom-control-label::before {
    border-color: #12a6e0;
  }
  .custom-radio .custom-control-input:checked ~ .custom-control-label::before {
      background-color: #12a6e0;
  }
</style>
<?php

session_name('SESSION');
session_start();

 $IdUSER=$_GET['id'];

    $db = parse_ini_file("assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
 
// --NomUSER  PrenomUSER  EmailUSER  TelephoneUSER  LoginUSER  PassUSER  CompteUSER ActiveUSER ConnectedUSER
       $queryUSERS = "SELECT * FROM USERS WHERE IdUSER='".$IdUSER."'";
        $resultUSERS = sqlsrv_query($con, $queryUSERS);
        if( $resultUSERS === false )
        {
           die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
        }   
        
        while( $obj = sqlsrv_fetch_object($resultUSERS))
        {          
          $NomUSER = $obj->NomUSER;
          $PrenomUSER = $obj->PrenomUSER;
          $EmailUSER = $obj->EmailUSER;
          $TelephoneUSER = $obj->TelephoneUSER;
          $LoginUSER = $obj->LoginUSER;
          $CompteUSER = $obj->CompteUSER;
          $ActiveUSER = $obj->ActiveUSER;          
        }   

?>
    <!-- Page content -->

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link" href="UpdateUsers.php?id=<?=$IdUSER?>">Information Utilisateur</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active"href="#">Entreprise à sa disposition</a>
  </li>
 
</ul>

<?php
$querySociete ="SELECT * FROM Societe order by LEN(LibelleSociete) desc , LEN(ville) desc";
$resultSociete = sqlsrv_query( $con, $querySociete );

/* Handle sql errors if retuned */
if( $resultSociete === false )
{
        exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}
?>
<div class="container-fluid mt--7">
      <div class="row" style="padding-top: 140px;">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/team-4-800x800.png" class="rounded-circle" style="width:100px; height:100px;">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              
            </div>
            <div class="card-body pt-0 pt-md-4">
            
              <div class="text-center">
                <h3 style="margin-top: 17px;">
                     <?php echo $NomUSER.' '.$PrenomUSER;?><span class="font-weight-light">, <?php if($CompteUSER=='A'){echo'admin';}elseif($CompteUSER=='I'){echo'Invité';}else{echo'user';} ?>                       
                 </span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php if($ActiveUSER==1){echo 'Compte Activé';}else{echo'Compte Désactve';} ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?=$TelephoneUSER?> 
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i><?=$EmailUSER?>
                </div> </br>                                            
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
        <?php
        /* Handle sql response for track data */
        if( sqlsrv_num_fields( $resultSociete ) )
        { echo'          
                <div class="card-header border-0">
                  <div class="row">            
                    <div class="col-md-4">
                      <div class="col text-right">                              
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
              <table id="myTable" class="table align-items-center table-flush ">
               

                <tbody>';$i=1;
                while( $row = sqlsrv_fetch_array( $resultSociete, SQLSRV_FETCH_ASSOC ) )
                {
                  $queryusercompany = "SELECT * FROM usercompany WHERE IdUSER=".$IdUSER." and IdSOCIETE=".$row['IdSociete']."";
                  $resultusercompany = sqlsrv_query($con, $queryusercompany);
                  if( $resultusercompany === false )
                  {
                     die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
                  }   
                  if(sqlsrv_has_rows($resultusercompany) != 1)
                  {
                    echo'
                    <tr>                        
                      <td >
                      <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="tableDefaultCheck'.$i.'"  onchange="window.location.href=\'Function/F_UserCompany.php?IdSOCIETE='.$row['IdSociete'].'&&IdUSER='.$IdUSER.'\'">
                    <label class="custom-control-label" for="tableDefaultCheck'.$i.'">'.utf8_encode( $row['LibelleSociete']) . '</label>
                  </div>
                     </td>                                                           
                    </tr>';  
                  }
                  else
                  {
                    echo'
                    <tr>                        
                      <td >
                      <div class="custom-control custom-checkbox">
                    <input type="checkbox" checked class="custom-control-input" id="tableDefaultCheck'.$i.'"  onchange="window.location.href=\'Function/F_UserCompany.php?IdSOCIETE='.$row['IdSociete'].'&&IdUSER='.$IdUSER.'\'">
                    <label class="custom-control-label" for="tableDefaultCheck'.$i.'">'.utf8_encode( $row['LibelleSociete']) . '</label>
                  </div>
                     </td>                                                           
                    </tr>';         
                  }
                  $i+=1; 
                }
                echo'
               </tbody>
                  </table>
                </div>         
              ';
        }
        sqlsrv_close ( $con );
       

?>    
      </div>
    </div>
  </div>
</div>
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