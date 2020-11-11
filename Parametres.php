<?php require "MasterPage/header.php"; ?>
<?php 
session_name('SESSION');
session_start();

$db = parse_ini_file("assets/ini/Config.ini");
$connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
$con = sqlsrv_connect($db['host'], $connectionInfo);    


?>
<!-- row------------------------------------------------------------------------------------------------------- -->
  <div class="row justify-content-around">
    <div class="col-lg-7 col-xl-7 col-md-12 col-sm-12 col-xs-12 shadow rounded"  style="background-color: white !important;border: 0;color: white;padding-bottom: 15px;padding-top: 15px;">
      <table class="w-100 h-100">
        <tbody>
          <tr> 
            <td align="center" style="padding-bottom: 9px;">           
              <h3 class="mb-0"  style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-server"></i> &nbsp; &nbsp;Fichier Configuration</h3> 
            </td>
          </tr>
          <form method="POST" action="Function/F_UpdateINI.php">
            <tr>
              <td align="center">              
                <div class="form-group">
                  <textarea name="ini" class="form-control col-xs-12" rows="8"><?php echo file_get_contents( 'assets/ini/Config.ini' ); ?></textarea>
                </div>            
              </td>  
            </tr>

            <tr class="align-bottom">
              <td align="right">
                <button type="submit" class="btn btn-sm btn-info">
                  <span class="btn-label"><i class="fas fa-save"></i>
                  </span>&nbsp;Enregistrer 
                </button>  
              </td> 
            </tr>
          </form>
        </tbody>
      </table>
  </div>
  <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 col-xs-12 shadow rounded" style="background-image: linear-gradient(138deg, #63b4f2, #7369fd) !important;border: 0;color: white;padding-bottom: 2%;">
    <div class="col-lg-12" style="height: 100%">
      <table class="h-100">
        <tbody>
          <tr> 
            <td align="center">           
              <p><?php                                                
                if($con)
                {
                  echo '<div class="">
                          <span><b> Success - </b> Connexion Etable avec Succée </span>
                        </div>';
                }
                else
                {
                  echo '<div class="">
                          <span><b> Danger - </b> '.print_r( sqlsrv_errors(), true).'</span>
                        </div>';
                }
              ?>
              </p> 
            </td>
          </tr>

          <tr>
            <td align="center">            
            <?php                                                
                if($con)
                {
                  echo '<i class="fas fa-check-circle fa-4x"></i>';
                }
                else
                {
                  echo '<i class="fas fa-times-circle fa-4x"></i>';
                }
              ?>
            </td>  
          </tr>

          <tr class="align-bottom">
            <td>
              <h5 style="color: white"> informations de base de données</h5>
              <p style="font-size: .8125rem">
                <?php echo '<b style="font-weight: bold;">Nom:</b> '.$db['name'].' <b style="font-weight: bold;">Host:</b> '.$db['host'].' <b style="font-weight: bold;">Nom d\'utilisateur:</b> '.$db['user'].' <b style="font-weight: bold;">Mot de passe:</b> '.$db['pass'].''; ?>         
              </p>
             </td> 
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
 
<!-- row------------------------------------------------------------------------------------------------------- -->
<div class="row justify-content-around" style="margin-top: 20px;">
    <div class="col-auto col-7 shadow"  style="background-color: white !important;border: 0;color: white;padding-bottom: 15px;padding-top: 15px;border-radius: 7%;">
      <table style="height: 100%;width: 100%;">
        <tbody>
          <tr> 
            <td align="center" style="padding-bottom: 9px;">           
              <h3 class="mb-0"  style="background: linear-gradient(to left, #7171fc 0%, #65abf3 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><i class="fas fa-server"></i> &nbsp; &nbsp;Fichier Configuration</h3> 
            </td>
          </tr>
          
          <tr>
            <td align="center">              
                         
            </td>  
          </tr>

        </tbody>
      </table>
  </div>
  <div class="col-auto col-4 shadow" style="background-color: white !important;border: 0;padding-bottom: 2%;border-radius: 7%;padding-top: 15px;">
    <div class="col-lg-12" style="height: 100%;">
      <table style="height: 100%">
        <tbody>
          <tr> 
            <td align="center">           
              <p>Convertir tout document qui est un code d’entreprise en un fichier texte.</p>
              <p>pour l'instant, l'URL à partir de laquelle vous allez convertir tous les fichiers pdf est:</p>
              <input class="form-control" type="text" value="C:\inetpub\wwwroot\GED\CodeGed" disabled>
            </td>
          </tr>

          <tr>
            <td align="center">
               <a class="btn btn-sm btn-info"  href="function/convert.php" onclick="display()" style="margin-top: 20px;">
                  <span class="btn-label"><i id="icn" class="fas fa-spinner fa-spin" style="display: none" ></i>&nbsp;Commencez maintenant 
                  </span> 
                </a>
            </td>  
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>

    


<?php 
  if($_SESSION["ErreurUpdateini"] != ''){
    echo' 
 <div class="toast shadow-lg" id="toast" style="border: 20px;background-color: white;padding: 15px;position: fixed;z-index: 100000;bottom: 5%;right: 3%;">
    <div class="toast-header">
      <strong class="mr-auto text-primary">Nouvelle notification</strong>
      <small class="text-muted">maintenant</small>
      <button id="closeme" type="button" class="ml-2 mb-1 close">&times;</button>
    </div>
    <div class="toast-body">
     '.$_SESSION["ErreurUpdateini"].'
    </div>
  </div>
';                  
    unset($_SESSION["ErreurUpdateini"]); 
   }   
?>  




<script LANGUAGE="JavaScript">   

     function display()
    {
      document.getElementById('icn').style.display='block';
    }
  </script>

<?php require "MasterPage/footer.php"; ?>
<!--#  -->