<?php require "MasterPage/header.php"; ?>

  <link rel="stylesheet" href="ContextMenu/css/bootstrap.css">
  <script src="ContextMenu/dist/BootstrapMenu.min.js"></script>
<style>
#demo1Box:active {
    background-color: #e8f0fe;
}
#demo1Box:focus {
    background-color: #e8f0fe;
}
</style> 
<?php
session_name('SESSION');
session_start();

$Year = $_GET['Year'];
$_SESSION["Year"] = $Year;


$Nom =$_SESSION["SocieteName"];
$mystring =$Nom;
$find   = "'";
$pos = strpos($mystring, $find);
if ($pos != false) {
    $Nom =str_replace("'","''",$mystring);
} 
// ---------------------------------------------
$connectionInfo = array("Database" => $db['name'], "UID" => $db['user'], "PWD" => $db['pass']);
  $con = sqlsrv_connect($db['host'], $connectionInfo); 
    
    $cmd ="SELECT * FROM Societe where IdSociete= ".$_SESSION["id"]."";
    $query = sqlsrv_query( $con, $cmd );               
    if( sqlsrv_num_fields( $query ) )
    {             
        while( $obj = sqlsrv_fetch_object($query))
        {            
            
            $RaisonSocialeSociete= $obj->RaisonSocialeSociete;                        
            $IFSociete= $obj->IFSociete;  
            $ICESociete= $obj->ICESociete;  
            $ITVASociete= $obj->ITVASociete;  
        } 
    }
?>
 
<div class="row" style="margin-bottom: 23px;">
            <div class="col-12">             
                  <div style ="background: rgba(82, 95, 127, 0.05);border-radius: .375rem;border-top-left-radius: 0.375rem;border-bottom-left-radius: 0.375rem; margin-bottom: 12px;margin-top: -35px">
                      <p style="text-align: center;padding-top: 10px;padding-bottom: 10px;font-weight: bold;"><i class="fas fa-map-signs"></i> Les informations suivantes seront organisées comme suit<br> Année <i class="fas fa-arrow-right"></i> Produit <i class="fas fa-arrow-right"></i> Code(PDF)</p>                    
                </div>                
              </div>            
          </div>

<div class="row">
  <div class="col">      
    <div class="card shadow">     	

    	<div class="card-header border-0">
          <div class="row">
              
            <div class="col-md-10">            	
            	<h3 class="mb-0">
                 <ol class="breadcrumb" style="background-color:white">
                      <a href="ConsultationAnnée.php?id=<?= $_SESSION["id"]?>& NOM=<?= $_SESSION["SocieteName"]?>"><i class="fas fa-arrow-left"></i></a>
                        &nbsp;&nbsp;&nbsp;
                      <i class="far fa-file-powerpoint" style="margin-top: 4px;"></i>
                        &nbsp;&nbsp;&nbsp;                
                     <li class="breadcrumb-item"><a href="ConsultationAnnée.php?id=<?= $_SESSION["id"]?>& NOM=<?= $_SESSION["SocieteName"]?>"><?= $_SESSION["SocieteName"]?></a></li> 
                     <li class="breadcrumb-item active" aria-current="page"><?= $Year; ?></li>
                  </ol>           		
            	</h3>
            </div>
            <div class="col-md-2">
              <?php if( $_SESSION['CompteUSER']=='A'){ ?>
            	<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal">Ajouter</button>
          	<?php } ?>
            </div>

              <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog" style="margin-top: 7%;">
				    <form method="post" action="Function/AddFolderInYear.php" id="my_form"> 
				      <!-- Modal content-->
				      <div class="modal-content" style="margin-left: 17%;">
				        <div class="modal-header" style="padding-bottom: 0px;">
				        	<button type="button" class="btn btn-sm" data-dismiss="modal" style="margin-left: 418px;"><i class="fas fa-times"></i></button>
				        </div>

				        <div class="modal-body" style="padding-bottom: 0px;">
                  <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="produit">Ajouter un nouveau produit</label>
                		<input type="text" id="produit" name="produit" class="form-control" placeholder="produit" required>
                      </div>
                      <div class="text-right"> 
                          <div class="form-group">
                            <a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;" class="btn btn-sm btn-info">Ajouter</a>
                          </div>
                      </div>
                    </div>  
				        </div>				        
				      </div>
                  </form>
                </div>
             </div><!-- Modal-->              
            </div><!--row-->
           </div><!--header-->
        
        <div class="card-body " style="padding-bottom: 0.5rem;">
          <div class="row">
                <div class="col-lg-4">
                 
                  <div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Raison Sociale</label>
                        <input type="text" class="form-control" readonly value="<?=$RaisonSocialeSociete ?>">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Identifiant Fiscale (IF)</label>
                        <input type="text" class="form-control" readonly value="<?=$IFSociete ?>">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">(ICE)</label>
                        <input type="text" class="form-control" readonly value="<?=$ICESociete ?>">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Identifiant TVA (ITVA)</label>
                        <input type="text" class="form-control" readonly value="<?=$ITVASociete ?>">
                      </div>                
                  </div>
                </div>
               
<div class="col-lg-8">
  <div>
    <?php 
     $file_pointer =".\\CodeGed\\".$_SESSION["SocieteName"]."\\".$Year."\\";
      if (file_exists($file_pointer)) {
        $directory = $file_pointer;
        $results_array = array();
        if (is_dir($directory))
        {
            if ($handle = opendir($directory))
            {
                //Notice the parentheses I added:
                while(($file = readdir($handle)) !== FALSE)
                {
                        $results_array[] = $file;
                }
                closedir($handle);
            }
        }
         echo ' <div class="row">';
        for ($i=0; $i < count($results_array); $i++) { 

          if ($results_array[$i] == "." || $results_array[$i] == "..") {
            continue;           
          }
          $folder=$file_pointer.'\\'.$results_array[$i];

          $QuHide = "SELECT * FROM Hide WHERE IdUSER=".$_SESSION['IdUser']." AND folder='".$folder."'";
          $RsHide = sqlsrv_query($con, $QuHide);
          if(sqlsrv_has_rows($RsHide) != 0)
          {
            continue;
          }
          ?>
            <?php
              $string=$results_array[$i];
            ?>
           <a href="ConsultationFile.php?produit=<?= $results_array[$i]?>">
              <div class="col-auto mb-3" >
                <div id="demo1Box<?= $i?>" style="padding: 3px 11px;border-radius: 6px;border: 1px solid #dadce0;width: 210px;transition: box-shadow 200ms cubic-bezier(0.4,0.0,0.2,1);"  draggable="true" ondragstart="drag(event)">
                  <div class="row">
                    <div class="col-4">
                      <i class="fas fa-folder fa-3x" style="color: rgba(0, 0, 0, .5)"></i>          
                    </div>          
                    <div class="col-8" style=" display: flex;align-items: center;flex-wrap: wrap;">                               
                      <p class="" title="<?= $string?>" style="color: rgba(0,0,0,.72);">
                        <?php
                          if (strlen($string) > 14)
                          {           
                            $string = substr($string,0,14)." ..";
                          } 
                          echo $string;
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div> 
            </a>                       
            <script>
              function drag(ev) {
              ev.dataTransfer.setData("text", ev.target.id);
            }
            //copy
                function copyStringToClipboard (str) {
                 var el = document.createElement('textarea');
                 el.value = str;
                 el.setAttribute('readonly', '');
                 el.style = {position: 'absolute', left: '-9999px'};
                 document.body.appendChild(el);
                 el.select();
                 document.execCommand('copy');
                 document.body.removeChild(el);
                }
                         
              var menu = new BootstrapMenu('#demo1Box<?= $i?>', {
              actions: [{
              name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Open</a>',
                onClick: function() {
                window.location.href = "ConsultationFile.php?produit=<?= $results_array[$i]?>";
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-link"></i>&nbsp;&nbsp;&nbsp;obtenir le lien</a>',
                onClick: function() {
                copyStringToClipboard("<?= "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST']?>/<?=$db['Folder_Container']?>/ConsultationFile.php?produit=<?= $results_array[$i]?>");
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-eye-slash"></i>&nbsp;&nbsp;&nbsp;Masquer le dossier</a>',
                onClick: function() {
                 $('#myModalHide<?= $i?>').modal('show');
                }
                }]
                });
            </script>
            <div class="modal fade" id="myModalHide<?= $i?>" role="dialog">
              <div class="modal-dialog" >
                <?php 
                   $CurrentPage=utf8_encode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");                     
                  echo' <form method="post" action="function/F_Hide_Show.php">';
                ?>
                  <div class="modal-content" >  
                    <div class="modal-header">
                      <h5 class="modal-title">Cacher le dossier "<?=$string ?>"</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> 
                      <input type="text" name="CurrentPage" value="<?=$CurrentPage ?>" style="display: none;">
                      <input type="text" name="folder" value="<?=$folder ?>" style="display: none;">
                    </div>              
                    <div class="modal-body" style="padding-bottom: 0px;">
                      <div class="col-lg-12">
                        <p>choisissez les utilisateurs auxquels vous voulez masquer le dossier</p>
                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        $queryUSERS ="SELECT * FROM USERS where Request=0";
                        $resultUSERS = sqlsrv_query( $con, $queryUSERS );                                               
                        ?>
                        <div class="list-group"> 
                          <?php 
                          $b=1;
                          while( $obj = sqlsrv_fetch_object($resultUSERS))
                          {            
                            if ($obj->IdUSER==$_SESSION['IdUser']){
                              continue;
                            }    
                            $queryHide = "SELECT * FROM Hide WHERE IdUSER=".$obj->IdUSER." AND folder='".$folder."'";
                            $resultHide = sqlsrv_query($con, $queryHide);

                            if(sqlsrv_has_rows($resultHide) != 1)
                            {
                              echo '
                              <a href="#" class="list-group-item list-group-item-action" for="tableDefaultCheck'.$b.$i.'">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="check_list[]" value="'.$obj->IdUSER.'" class="custom-control-input" id="tableDefaultCheck'.$b.$i.'">
                                  <label class="custom-control-label" for="tableDefaultCheck'.$b.$i.'">'.utf8_encode($obj->NomUSER) .' '.utf8_encode($obj->PrenomUSER) . '</label>
                                </div>
                              </a>
                              ';  
                            }
                            else
                            {
                              echo '
                              <a href="#" class="list-group-item list-group-item-action" for="tableDefaultCheck'.$b.$i.'">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" checked name="check_list[]" value="'.$obj->IdUSER.'" class="custom-control-input" id="tableDefaultCheck'.$b.$i.'">
                                  <label class="custom-control-label" for="tableDefaultCheck'.$b.$i.'">'.utf8_encode($obj->NomUSER) .' '.utf8_encode($obj->PrenomUSER) .'</label>
                                </div>
                              </a>
                              ';
                            }$b=$b+1;                     
                          }                           
                          echo'
                        </div>
                      </div> 
                    </div>
                    <div class="modal-footer">  
                      <button type="submit" class="btn btn-info">terminé</button>     
                    </div> ';
                  ?>

                    </div>
                </form>
              </div>
            </div>                         
       <?php }
       
         echo "</div>";

        
       
      }else {
          echo "Pas de données disponibles!";
     // echo $file_pointer; path
      }                   
     ?>   


  </div>                      
</div>
            </div>                        
        </div> 

      </div> <!--card shadow-->        
    </div>
</div>


<?php require "MasterPage/footer.php"; ?>