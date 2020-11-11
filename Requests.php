<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);

 $query ="SELECT * FROM users where Request=1 order by IdUSER desc";
$result = sqlsrv_query( $con, $query );
if( $result === false )
{
    exit( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

if( sqlsrv_num_fields( $result ) )
{ echo'
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8"><h3 class="mb-0" style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="far fa-paper-plane" ></i>&nbsp; &nbsp;les demandes d\'inscriptions</h3>
            </div>            
          </div>        
                 
        </div> 
        <div class="table-responsive">
          <table id="myTable" class="table align-items-center table-flush">
             <tbody> ';             
               if(sqlsrv_has_rows($result)  === false)
                {
                  echo'
                    <tr>                        
                      <td>Aucun demande d\'inscription <i class="far fa-frown-open"></i>!</td>
                    </tr>';$i=1;
                }else{
                 while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ) )
                  {
                    echo'<tr>
                      <td>User Name :'.$row['NomUSER'].'</td>
                      <td>Tele :'.$row['TelephoneUSER'].'</td>                      
                      <td>Email :<a href="mailto:'. $row['EmailUSER'] . '" target="_blank">'. $row['EmailUSER'] . '</a></td>
                      <td><button style="color:#2dce89;" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal'.$i.'">Accepter</button></td>
                      </tr>

            <div class="modal fade" id="myModal'.$i.'" role="dialog">
              <div class="modal-dialog" style="margin-top: 17%;">
              <form method="post" action="Function/F_AcceptUser.php?id='.$row['IdUSER'].'" id="my_form">              
                <div class="modal-content" style="margin-left: 17%;">               
                  <div class="modal-body" style="padding-bottom: 0px;">
                    <div >';?>
                    <div class="row">
                      <div class="col-lg-6">                       
                        <div class="form-group">            
                          <label class="form-control-label" for="input-username">Identifiant d'utilisateur</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend2">@</span>
                            </div>
                            <input type="text" class="form-control" id="LoginUSER2" name="LoginUSER2" placeholder="Identifiant d'utilisateur" required>
                          </div>
                        </div>                                           
                      </div>        
                      <div class="col-lg-6">
                        <label class="form-control-label" for="input-email">Rôles</label> <br>
                        <div class="custom-control custom-radio mb-3">
                          <input name="CompteUSER" class="custom-control-input" id="customRadio1" type="radio" checked value="U">
                          <label class="custom-control-label" for="customRadio1">
                            <span>User</span>
                          </label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                          <input name="CompteUSER" class="custom-control-input" id="customRadio2"  type="radio" value="A">
                          <label class="custom-control-label" for="customRadio2">
                            <span>Admin</span>
                          </label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                          <input name="CompteUSER" class="custom-control-input" id="customRadio3" type="radio" value="I">
                          <label class="custom-control-label" for="customRadio3">
                            <span>Invité</span>
                          </label>
                        </div>                      
                      </div>  
                    </div> 

                    <?php echo'</div>
                    <div class="col-lg-12">                    
                      <div class="text-right"> 
                        <div class="form-group">
                          <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Annuler</button>                                    
                          <input type="submit" value="Valider" class="btn btn-sm btn-info"> 
                        </div>
                      </div>
                    </div>  
                  </div>                
                </div>
              </form>
            </div>
          </div>
                      '; $i+=1;
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