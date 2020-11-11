
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


    $db = parse_ini_file("assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
 
// --NomUSER  PrenomUSER  EmailUSER  TelephoneUSER  LoginUSER  PassUSER  CompteUSER ActiveUSER ConnectedUSER
       $query = "SELECT * FROM USERS WHERE IdUSER='".$_SESSION['IdUser']."'";
        $result = sqlsrv_query($con, $query);
        if( $result === false )
        {
           die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
        }   
        
        while( $obj = sqlsrv_fetch_object($result))
        {          
          $IdUSER = $obj->IdUSER;
          $NomUSER = $obj->NomUSER;
          $PrenomUSER = $obj->PrenomUSER;
          $EmailUSER = $obj->EmailUSER;
          $TelephoneUSER = $obj->TelephoneUSER;
          $LoginUSER = $obj->LoginUSER;
          $CompteUSER = $obj->CompteUSER;
          $ActiveUSER = $obj->ActiveUSER; 
          $pass = $obj->PassUSER;   
          $Avatar= $obj->Avatar;      
        }     

?>

    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row" style="padding-top: 140px;">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2" style="margin-top: -33px;margin-left: -43px;">
                <div class="card-profile-image">
                  <div class="hovereffect rounded-circle">
                    <img src="assets/avatar/<?=$Avatar?>" class="rounded-circle img-responsive" style="width:100px; height:100px;margin-top: 24px;">
                     <div class="overlay"> 
                        <a class="info" href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-camera" style="font-size: 25px"></i><br>Mettre à Jour</a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog" style="margin-top: 17%;">            
                <form action="Function/F_Picture.php" method="post" enctype="multipart/form-data">
                <!-- Modal content-->
                <div class="modal-content" >
                  <div class="modal-header">
                    <button type="button" class="btn btn-sm" data-dismiss="modal" style="margin-left: 418px;"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="modal-body" style="padding-top: 0px;padding-left: 0px;padding-bottom: 0px;">
                    <div class="col-lg-12">                     
                      <div class="form-group" style="text-align: center;">
                        <a href="#" class="first" style="color: #4d4d4d"onMouseOver="this.style.color='#71b6f9'"onMouseOut="this.style.color='#4d4d4d'"><i class="fas fa-plus"></i>&nbsp;&nbsp;Importer une photo</a>
                        <input style="display: none;" class="second" type="file" name="fileToUpload" id="fileToUpload">
                      </div> 
                      <div class="text-right"> 
                          <div class="form-group" >
                            <input type="submit" value="Mettre à Jour" name="submit" class="btn btn-sm btn-info" >
                          </div>
                      </div>
                    </div>  
                  </div>                
                </div>
                </form>
              </div>
             </div><!-- Modal--> 
            
            <div class="card-body pt-0 pt-md-4">
            
              <div class="text-center">
                <?php 
                echo $_SESSION["Erreur"];
                unset($_SESSION["Erreur"]);
                 ?>
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
                </div>                                        
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <form method="post" id="my_form" name="formname" action="Function/F_Profile.php?id=<?=$IdUSER?>">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"> <?php echo $NomUSER.' '.$PrenomUSER;?> Info</h3>
                </div>                
                <div class="col-md-4">
                      <div class="col text-right">
                          <button type="submit" class="btn btn-sm btn-info" id="submitbtn" disabled>
                            <i class="fas fa-check"></i> Update
                        </button>
                    </div>
                  </div>                            
              </div>
            </div>
            <div class="card-body">
              
                <div class="pl-lg-4">                                                                                  
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
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">Telephone</label>
                        <input type="Tele" id="TelephoneUSER2" name="TelephoneUSER2" class="form-control" placeholder="Telephone" required value="<?=$TelephoneUSER ?>">
                      </div>                      
                    </div>
                     <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Email</label>
                        <input type="email" id="EmailUSER2" name="EmailUSER2" class="form-control" placeholder="jesse@example.com" required value="<?=$EmailUSER ?>">
                      </div>
                    </div>                   
                  </div>                              
                  <hr class="my-4" />
                  <h6 class="heading-small text-muted mb-4">Modifier votre mot de passe</h6>
                  <div class="row"> 
                    <div class="col-lg-6">
                      <div class="form-group">                       
                          <label class="form-control-label" for="input-username">Ancien mot de passe</label>
                           <input class="form-control" type="password" id="oldpassword" onKeyUp="validate()" name="oldpassword">
                           <div style="color:#fb6340; display: none;" id="V3ERR">                      
                              <h6  style="color:#fb6340;" class="heading-small  mb-4">* la mot de passe est incorrect</h6>
                            </div>
                      </div>
                    </div>                                       
                  </div>
                  <div class="row"> 
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">Nouveau mot de passe</label>
                           <input class="form-control" type="password" id="password1" onKeyUp="validate()" name="password">
                           <div style="display: none;" id="V2ERR">
                              <h6 style="color:#fb6340;" class="heading-small mb-4">* le mot de passe doit comporter au moins 6 caractères</h6>
                           </div> 
                      </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">vérifier le mot de passe</label>
                        <input class="form-control" type="password" id="password2" onKeyUp="validate()">
                        <div style="display: none;" id="V1ERR">
                          <h6 style="color:#fb6340;" class="heading-small mb-4">* les mots de passe doivent être les mêmes!</h6>
                        </div>
                      </div>
                    </div>
                  </div>                                                    
                  </div>                                            
              </form>
            </div>
          </div>
        </div>
      </div>

 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
 $(".first").click(function(){
    $(".second").click(); 
    return false;
});
</script>

<script LANGUAGE="JavaScript">
function validate() {
  
 var Pas = '<?php echo $_SESSION['Pass'];?>';
  V1= document.formname.password1.value == document.formname.password2.value;
  V2= document.formname.password1.value.length >= 6 ;
  V3= document.formname.oldpassword.value == Pas;


  if(!V1){
    document.getElementById('V1ERR').style.display='block';
  }else{
    document.getElementById('V1ERR').style.display='none';
  }

  if(!V2){
    document.getElementById('V2ERR').style.display='block';
  }else{
    document.getElementById('V2ERR').style.display='none';
  }

  if(!V3){
    document.getElementById('V3ERR').style.display='block';
  }else{
    document.getElementById('V3ERR').style.display='none';
  }



  isValid = (V1) ; 
  document.formname.submitbtn.disabled = !isValid;
}
</script>
<?php require "MasterPage/footer.php"; ?>