<?php
    session_name('SESSION');
    session_start(); 
    if(isset($_SESSION['UserLogin'])) 
  {
     header("Location: index.php");
     exit;
  }           
?>
<!DOCTYPE html>
<html>
 
<head>  
  <meta charset="UTF-8">
  <link rel="icon" href="http://pv.imrasoft.ma/img/imra.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GED :: IMRASOFT</title>
   <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- fontawesome -->
  <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <!-- CSS Files -->
  <link href="./assets/login/css/material-kit.css?v=2.0.5" rel="stylesheet" />

 </head>
<body style="background-color: white">

 <div style="position: absolute;top: 5px;right: 5px;z-index: 1">
    <a href="https://www.facebook.com/imrasoft"><i class="fab fa-facebook" style="color: #FFF;margin-right: 15PX;"></i></a>
    <a href="https://www.imrasoft.ma"><i class="fas fa-globe" style="color: #FFF;margin-right: 15PX;"></i></a>
  </div>
 
  <div  style=" background-image: url('assets/img/data-illustration.jpg');background-position: left;background-repeat: no-repeat;background-size: cover;width: 50%;height: 100%;position: fixed;right: 0;">
  </div>
  <div class="row align-items-center " style="margin: 0;margin-left: 20px;height: 100%;position: absolute;">
    <div class="col" style="padding-right: 0px;padding-left: 0px;">
      <h2 style="text-transform: uppercase;margin-top: 0px;font-size: 30px;text-align: center;margin-right: 10px;">Gestion électronique des documents</h2>
        <h4 style="text-transform: uppercase;margin-left: 5px;font-size: 15px;text-align: center;margin-right: 10px;" > IMRASOFT | INTéGRATEUR DES SOLUTIONS SAGE</h4>  <br>  
      <h2 style="text-transform: uppercase;font-size: 25px;margin-left: 5px;" >login</h2>
      <form class="login-form" method="post" action="Function/F_Login.php" autocomplete="off" style="margin-left: 5px;"> 
      <div style="width: max-content;">              
        <div class="form-group" style="width: 280px">
          <label for="exampleInput1" class="bmd-label-floating">Email ou Nom d'utilisateur </label>
          <input id="user" type="text" name="user" placeholder="" required autocomplete="off" class="form-control">
        </div>
        <div class="form-group"style="width: 280px" >
          <label for="exampleInput1" class="bmd-label-floating">Mot de passe</label>
          <input id="password" type="password" name="pass" required autocomplete="off" class="form-control" id="exampleInput1">
        </div>
        <h6><?= $_SESSION["ErreurLogin"]?><?php unset($_SESSION["ErreurLogin"]); ?></h6>
         
        <button type="submit" class="btn" style="background-image: linear-gradient(138deg, #63b4f2, #7369fd);color: #fff !important;border-radius: 20px;padding: 10px 15px;margin-right: 0;margin-left: auto;display: block;">Se connecter</button> 
        </div>         
      </form> 
       <a href="#" style="color: inherit;font-size: 12px;"><i class="fas fa-key"></i> &nbsp;mot de passe oublié? </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" style="color: inherit;font-size: 12px;" data-toggle="modal" data-target="#myModal"><i class="fas fa-paper-plane"></i> &nbsp;Demande d'inscription</a>
     
    <h6 style="text-transform: uppercase;background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;text-align: center;margin-top: 35px;"> IMRASOFT | © Tous droits réservés pour Imrasoft 2019</h6>
    </div>
  </div> 
   
 <!-- Classic Modal -->
  <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 360px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="far fa-paper-plane"></i> &nbsp;Inscription </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <form method="post" action="Function/F_register.php" name="formname" autocomplete="off">
            <div class="modal-body">
              <div class="form-group" style="width: 280px">
                <label class="bmd-label-floating"><i class="fas fa-user"></i> &nbsp;Nom complet</label>
                <input type="text" name="Nom" placeholder="" required autocomplete="off" class="form-control">
              </div>                        
              <div class="form-group" style="width: 280px">
                <label class="bmd-label-floating"><i class="fas fa-envelope"></i> &nbsp;Email</label>
                <input type="Email" name="EmailUSER" placeholder="" required autocomplete="off" class="form-control">
              </div>
              <div class="form-group"style="width: 280px" >
                <label  class="bmd-label-floating"><i class="fas fa-phone"></i> &nbsp;Téléphone</label>
                <input type="Tel" name="TelephoneUSER" required autocomplete="off" class="form-control" id="exampleInput1">
              </div>
              <div class="form-group"style="width: 280px" >
                <label  class="bmd-label-floating"><i class="fas fa-lock"></i> &nbsp;Mot de passe</label>
                <input  type="password" name="password1" id="password1" required autocomplete="off" class="form-control" id="exampleInput1"  onKeyUp="validate()">
              </div>
                <div style="display: none;" id="V2ERR">
                  <h6 style="color:#fb6340;" class="heading-small mb-4">* le mot de passe doit comporter au moins 6 caractères</h6>
                </div> 
              <div class="form-group"style="width: 280px" >
                <label  class="bmd-label-floating"><i class="fas fa-lock"></i> &nbsp;vérifier le mot de passe</label>
                <input  type="password" name="password2" id="password2" required autocomplete="off" class="form-control" id="exampleInput1"  onKeyUp="validate()">
              </div> 
                <div style="display: none;" id="V1ERR">
                  <h6 style="color:#fb6340;" class="heading-small mb-4">* les mots de passe doivent être les mêmes!</h6>
                </div>
              <?php if(isset($_SESSION["Erreur"])) {?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 60px;">
                <?= $_SESSION["Erreur"]?><?php unset($_SESSION["Erreur"]); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php } ?>              
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-link" style="background: linear-gradient(138deg, #63b4f2, #7369fd);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;font-size: 12px"><i class="fas fa-check"></i> &nbsp;valider</button>         
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--  End Modal -->


</body>



   <!--   Core JS Files   -->
  <script src="./assets/login/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/login/js/plugins/moment.min.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/login/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/login/js/material-kit.js?v=2.0.5" type="text/javascript"></script>

<script LANGUAGE="JavaScript">
function validate() {
  

  V1= document.formname.password1.value == document.formname.password2.value;
  V2= document.formname.password1.value.length >= 6 ;
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

}
</script>
 
 </html>