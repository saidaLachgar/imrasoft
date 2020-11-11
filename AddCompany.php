<?php require "MasterPage/header.php"; ?>

<div class=" col-xl-12 order-xl-1" style="top: 4%;">
  <div class="card bg-secondary shadow">            
    <div class="card-body" style="padding-bottom: 0.5rem;">
      <form method="post" action="Function/F_AddCompany.php" id="my_form">
        <h6 class="heading-small text-muted mb-4">Company information</h6>
        <div class="pl-lg-4">
           <!-- // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville -->
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-first-name">Nom</label>
                <input type="text" id="LibelleSociete" name="LibelleSociete" class="form-control" placeholder="Nom" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Raison Sociale</label>
                <input type="text" id="RaisonSocialeSociete" name="RaisonSocialeSociete" class="form-control" placeholder="Raison Sociale" required>
              </div>
            </div>                   
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">                       
                <label class="form-control-label" for="input-username">IF</label>
                <input type="number" id="IFSociete" name="IFSociete" class="form-control" placeholder="IF" required>
              </div>                      
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">ICE</label>
                <input type="number" id="ICESociete" name="ICESociete" class="form-control" placeholder="ICE" required>
              </div>
            </div>
          </div>    
            <div class="row">
            <div class="col-lg-6">
              <div class="form-group">                       
                <label class="form-control-label" for="input-username">ITVA</label>
                <input type="number" id="ITVASociete" name="ITVASociete" class="form-control" placeholder="ITVA" required>
              </div>                      
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Ville</label>
                <input type="text" id="Ville" name="Ville" class="form-control" placeholder="Ville" required>
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
          <a href="company.php" class=" btn btn-sm btn-primary">Annuler</a>
        </div>
      </div>  
    </form>
    </div>
  </div>
</div>
      
<?php require "MasterPage/footer.php"; ?>