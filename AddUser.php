<?php require "MasterPage/header.php"; ?>

<div class=" col-xl-12 order-xl-1" style="top: 8%;">
  <div class="card bg-secondary shadow">            
    <div class="card-body" style="padding-bottom: 0.5rem;">
      <form method="post" action="Function/F_AddUser.php" id="my_form" name="formname">
        <h6 class="heading-small text-muted mb-4">User information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-12">
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
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-first-name">Prénom</label>
                <input type="text" id="PrenomUSER2" name="PrenomUSER2" class="form-control" placeholder="Prénom" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Nom</label>
                <input type="text" id="NomUSER2" name="NomUSER2" class="form-control" placeholder="Nom" required>
              </div>
            </div>                   
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">                       
                <label class="form-control-label" for="input-username">Telephone</label>
                <input type="Tele" id="TelephoneUSER2" name="TelephoneUSER2" class="form-control" placeholder="Telephone" required>
              </div>                      
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-last-name">Email</label>
                <input type="email" id="EmailUSER2" name="EmailUSER2" class="form-control " placeholder="jesse@example.com" required>
              </div>
            </div>
          </div>
          <div class="row">            
           <div class="col-lg-6">
              <label class="form-control-label" for="input-email">Rôles</label> <br>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio1" type="radio" checked value="U">
                  <label class="custom-control-label" for="customRadio1">
                    <span>User</span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio2"  type="radio" value="A">
                  <label class="custom-control-label" for="customRadio2">
                    <span>Admin</span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio3" type="radio" value="I">
                  <label class="custom-control-label" for="customRadio3">
                    <span>Invité</span>
                  </label>
                </div>
              </div>
              <div class="col-lg-6">                 
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckRegister" type="checkbox"  name="ActiveUSER2" checked value=1>
                  <label class="custom-control-label" for="customCheckRegister">
                    <span class="form-control-label">Désactivé/Activé Compte</span>
                  </label>
                </div>
              </div>
          </div>
          <hr class="my-4" />                              
            <div class="row"> 
              <div class="col-lg-6">
                <div class="form-group">                       
                  <label class="form-control-label" for="input-username">Nouveau mot de passe</label>
                     <input class="form-control" type="password" id="PassUSER2" onKeyUp="validate()" name="PassUSER2" required>
                     <div style="display: none;" id="V2ERR">
                        <h6 style="color:#fb6340;" class="heading-small mb-4">* le mot de passe doit comporter au moins 6 caractères</h6>
                     </div> 
                </div>
              </div> 
              <div class="col-lg-6">
                <div class="form-group">                       
                  <label class="form-control-label" for="input-username">vérifier le mot de passe</label>
                  <input class="form-control" type="password" id="password2" onKeyUp="validate()" required>
                  <div style="display: none;" id="V1ERR">
                    <h6 style="color:#fb6340;" class="heading-small mb-4">* les mots de passe doivent être les mêmes!</h6>
                  </div>
                </div>
              </div>
            </div>                   
          </div>         
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8"> 
              <h6 style="color:#fb6340;margin-left: 5%;" class="heading-small mb-4"><?= $_SESSION["ErreurLogin"]?></h6></br>
                <?php unset($_SESSION["ErreurLogin"]); ?>                                  
              </div>
              <div class="col-4 text-right">
                <input type="submit" value="Ajouter" class="btn btn-sm btn-primary"> 
                <a href="Users.php" class="closeme btn btn-sm btn-primary">Annuler</a>
              </div>        
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script LANGUAGE="JavaScript">
function validate() {  
  V1= document.formname.password2.value == document.formname.PassUSER2.value;
  V2= document.formname.PassUSER2.value.length >= 6 ;
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
  isValid = (V1) && (V2) ; 
  document.formname.submitbtn.disabled = !isValid;
}
</script>
<?php require "MasterPage/footer.php"; ?>