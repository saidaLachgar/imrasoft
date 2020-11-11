<?php require "MasterPage/header.php"; ?>
<?php  

session_name('SESSION');
session_start();
    
    // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville
 $IdSociete=$_GET['id'];


    $db = parse_ini_file("assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 


       $query = "SELECT * FROM Societe WHERE IdSociete='".$IdSociete."'";
        $result = sqlsrv_query($con, $query);
        if( $result === false )
        {
           die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
        }   
        
        while( $obj = sqlsrv_fetch_object($result))
        {          
          $LibelleSociete = utf8_encode($obj->LibelleSociete);
          $RaisonSocialeSociete = $obj->RaisonSocialeSociete;
          $IFSociete = $obj->IFSociete;
          $ICESociete = $obj->ICESociete;
          $ITVASociete = $obj->ITVASociete;
          $Ville = $obj->Ville; 
        } 

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
 
?>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row" style="padding-top: 140px;">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/enterprise.jpg"  class="rounded-circle" style="width:100px; height:100px;">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              
            </div>
            <div class="card-body pt-0 pt-md-4">
            
              <div class="text-center">
                <h3 style="margin-top: 17px;">
                     <?=$LibelleSociete ?><span class="font-weight-light">, 
                      <?php                        
                        if ((countFolder($LibelleSociete))==99999)
                        {
                          echo 'Pas trouvé!';
                        }
                        elseif((countFolder($LibelleSociete))<2)
                        {
                          echo countFolder($LibelleSociete).'an';
                        }
                        else
                        {
                          echo countFolder($LibelleSociete).' années';
                        }
                      ?>
                 </span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?= $Ville ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>
                  <a style="color:#172b4d" href="consultationAnnée.php?NOM=<?=$LibelleSociete ?>" >montre plus..</a> 
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>
                  <a  style="color:#fb6340" href="Function/F_DeleteCompany.php?id=<?=$IdSociete?> & NOM=<?=$LibelleSociete ?>">
                   <i class="fas fa-trash"></i></a>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"> <?=$LibelleSociete ?> Info</h3>
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
              <form method="post" action="Function/F_UpdateCompany.php?id=<?=$IdSociete?>" id="my_form">
                <div class="pl-lg-4">
              <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Nom</label>
                        <input type="text" id="LibelleSociete" name="LibelleSociete" class="form-control" placeholder="Nom" required value="<?=$LibelleSociete ?>" disabled>
                      </div>
                    </div>
                    <!-- // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Raison Sociale</label>
                        <input type="text" id="RaisonSocialeSociete" name="RaisonSocialeSociete" class="form-control" placeholder="Raison Sociale" required value="<?=$RaisonSocialeSociete ?>">
                      </div>
                    </div>                   
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">IF</label>
                        <input type="number" id="IFSociete" name="IFSociete" class="form-control" placeholder="IF" required value="<?=$IFSociete ?>">
                      </div>                      
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">ICE</label>
                        <input type="number" id="ICESociete" name="ICESociete" class="form-control" placeholder="ICE" required value="<?=$ICESociete ?>">
                      </div>
                    </div>
                  </div>    
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">                       
                        <label class="form-control-label" for="input-username">ITVA</label>
                        <input type="number" id="ITVASociete" name="ITVASociete" class="form-control" placeholder="ITVA" required value="<?=$ITVASociete ?>">
                      </div>                      
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Ville</label>
                        <input type="text" id="Ville" name="Ville" class="form-control" placeholder="Ville" required value="<?=$Ville ?>">
                      </div>
                    </div>
                  </div>                           
                </div>                                            
              </form>
            </div>
          </div>
        </div>
      </div>

<?php require "MasterPage/footer.php"; ?>