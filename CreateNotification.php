
<?php require "MasterPage/header.php"; ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active"  href="#">Création d'une notification</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="UpdateNotification.php">Modification d'une notification</a>
  </li>
 
</ul>
<div class=" col-xl-12 order-xl-1" style="top: 8%;padding-left: 0px;padding-right: 0px;">
  <div class="card bg-secondary" style="box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .1) !important;">            
    <div class="card-body" style="padding-bottom: 0.5rem;">
      <form method="post" action="Function/F_CreateNotification.php" id="my_form" name="formname">
        <div class="pl-lg-4">
          <div class="row">
                   
            <div class="col-lg-2">
              <label class="form-control-label" for="input-email">To</label> <br>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio1" type="radio" checked value="U">
                  <label class="custom-control-label" for="customRadio1">
                    <span>Utilisateurs</span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio2"  type="radio" value="A">
                  <label class="custom-control-label" for="customRadio2">
                    <span>Administrateurs</span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input name="CompteUSER2" class="custom-control-input" id="customRadio3" type="radio" value="I">
                  <label class="custom-control-label" for="customRadio3">
                    <span>Visiteurs</span>
                  </label>
                </div>
              </div>
               <div class="col-lg-10">
                <textarea rows="6"  class="form-control form-control-alternative" name="message" placeholder="Le message de la notification.." required></textarea>
            </div> 
          </div>                            
        </div> 

          <div class="border-0">
            <div class="row align-items-center">
              <div class="col-8"> 
                <h6 style="color:#fb6340;margin-left: 5%;" class="heading-small mb-4">
                  <?= $_SESSION["ErreurLogin"]?>                  
                </h6></br>
                  <?php unset($_SESSION["ErreurLogin"]); ?>                                  
              </div>
              <div class="col-4 text-right">
                <input type="submit" value="Envoyer" class="btn btn-sm btn-info">                
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