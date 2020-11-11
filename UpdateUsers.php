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
       $query = "SELECT * FROM USERS WHERE IdUSER='".$IdUSER."'";
        $result = sqlsrv_query($con, $query);
        if( $result === false )
        {
           die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
        }   
        
        while( $obj = sqlsrv_fetch_object($result))
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
    <a class="nav-link active" href="#home">Information Utilisateur</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"href="UserCompany.php?id=<?=$IdUSER?>">Entreprise à sa disposition</a>
  </li>
 
</ul>
 
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
                <?php 
                if($ConnectedUSER == 0){
                echo'	
	                <div>
	                  <i class="ni education_hat mr-2"></i>
	                  <a style="color:#fb6340" href="Function/F_DeleteUser.php?id='.$IdUSER.'"><i class="fas fa-trash"></i></a> 
	                </div>
                ';}?>                              
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"> <?php echo $NomUSER.' '.$PrenomUSER;?> Info</h3>
                </div>
                <div class="col-md-4">
                      <div class="col text-right">
                          <a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;"class="btn btn-info btn-sm">
                          <i class="fas fa-check"></i> Update</a>
                    </div>
                  </div>                            
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="Function/F_UpdateUsers.php?id=<?=$IdUSER?>" id="my_form">
                <div class="pl-lg-4">
             <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">            
                        <label class="form-control-label" for="input-username">Identifiant d'utilisateur</label>                        
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input type="text" class="form-control" id="LoginUSER2" name="LoginUSER2" placeholder="Identifiant d'utilisateur" required value="<?=$LoginUSER ?>">
                      </div>
                      </div>
                    </div>                  
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">Telephone</label>
                        <input type="Tele" id="TelephoneUSER2" name="TelephoneUSER2" class="form-control" placeholder="Telephone" required value="<?=$TelephoneUSER ?>">
                      </div>                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Prénom</label>
                        <input type="text" id="PrenomUSER2" name="PrenomUSER2" class="form-control" placeholder="Prénom" required value="<?=$PrenomUSER ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Nom</label>
                        <input type="text" id="NomUSER2" name="NomUSER2" class="form-control" placeholder="Nom" required value="<?=$NomUSER ?>">
                      </div>
                    </div>                   
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Email</label>
                        <input type="email" id="EmailUSER2" name="EmailUSER2" class="form-control " placeholder="jesse@example.com" required value="<?=$EmailUSER ?>">
                      </div>
                    </div>                                    
                  </div>                              
                </div>                                            
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
<?php require "MasterPage/footer.php"; ?>