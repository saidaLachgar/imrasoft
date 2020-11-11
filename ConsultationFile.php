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

$produit = $_GET['produit']; 
$_SESSION["produit"] = $produit;
$file = $_GET['file'];


$Nom =$_SESSION["SocieteName"];
$mystring =$Nom;
$find   = "'";
$pos = strpos($mystring, $find);
if ($pos != false) {
    $Nom =str_replace("'","''",$mystring);
} 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
// ---------------------------------------------
	class RD{

		Public Function Directory($dir){
			ob_start();
			$this->DirChild($dir);
			$con = ob_get_contents();
			ob_end_clean();
			return $con;
		}

		Public Function DirChild($dir){			
      $real = realpath($dir) . DIRECTORY_SEPARATOR;
			$scan = scandir($real);
      if(count(glob("$dir/*")) === 0){
        echo "Pas de données disponibles!";
      }
      else
      { $i=1;
        $a=1;
			  echo "<table id=\"myTable\" class=\"table align-items-center table-flush\"> <tbody>";     
				foreach ($scan as $file) {										
					if ($file == "." || $file == "..") {
						continue;
					}	
          if(strtolower(pathinfo($file,PATHINFO_EXTENSION))=="pdf")
          { 				
          echo'<tr> <td>            
  					<a style="color:rgba(0, 0, 0, .5)" onMouseOver="this.style.color=\'rgb(113, 182, 249)\'"onMouseOut="this.style.color=\'rgba(0, 0, 0, .5)\'"  href="File.php?file='.$file.'&produit='.$_GET['produit'].'"><i class="fas fa-caret-right"></i> &nbsp;
  						<i class="far fa-file-pdf fa-lg"></i>&nbsp;'.$file.'</a>
          
            </td>';
            if($_SESSION['CompteUSER']=='A'){
            echo'
            <td>            
            <button  style="color:#fb6340; margin-right: 0rem;" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModalSupp'.$i.'" ><i class="fas fa-trash"></i></button>            
            <button title="Changer le fichier" style="color:#2dce89; margin-right: 0rem;padding-left: 0px" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModalUpdate<?= $i?>"><i class="fas fa-exchange-alt" style="font-size: 14px;"></i></button>
                    
          
  
            
              </td>
              ';} echo'
              </tr>';
            }    $i+=1; $a+=1;           											
    			}	
       }		
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
                      <a href="ConsultationProduit.php?Year=<?= $_SESSION["Year"]?>"><i class="fas fa-arrow-left"></i></a>
                        &nbsp;&nbsp;&nbsp;
                      <i class="far fa-copy" style="margin-top: 4px;"></i>
                        &nbsp;&nbsp;&nbsp;                
                     <li class="breadcrumb-item"><a href="ConsultationAnnée.php?id=<?= $_SESSION["id"]?>& NOM=<?= $_SESSION["SocieteName"]?>"><?= $_SESSION["SocieteName"]?></a></li>
                     <li class="breadcrumb-item"><a href="ConsultationProduit.php?Year=<?= $_SESSION["Year"]?>"><?= $_SESSION["Year"]?></a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?= $produit; ?></li>
                  </ol>             		
            	</h3>
            </div>            
              <?php if( $_SESSION['CompteUSER']=='A'){ ?>

              
                  <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal">Ajouter</button>
            	<?php } ?>
            </div>

              <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog" >		
            
              <form action="Function/AddFolderInProduct.php" method="post" enctype="multipart/form-data">
           
				      <!-- Modal content-->
				      <div class="modal-content" style="margin-top: 90px;">
				        <div class="modal-header" style="padding-bottom: 0px;">
				        	<button type="button" class="btn btn-sm" data-dismiss="modal" style="margin-left: 418px;"><i class="fas fa-times"></i></button>
				        </div>

				        <div class="modal-body" style="padding-bottom: 0px;">
                  <div class="col-lg-12">
                  	<div class="form-group">                              	
                          <label class="form-control-label" for="fichier">N° de série</label><br>                        		                           	
                          <input type="number" id="série" name="série" class="form-control" placeholder="N° de série" required>
                      </div>
                      <div class="form-group">                              	
                          <label class="form-control-label" for="fichier">Select file to upload</label><br>                        		   
                		   <input type="file" name="fileToUpload" id="fileToUpload" >
                      </div>
                      <div class="text-right"> 
                          <div class="form-group">
                            <i id="icn" class="fas fa-spinner fa-spin" style="margin-right: 17px;visibility: hidden;"></i>
                            <input type="submit" onclick="display()" value="Ajouter" name="submit" class="btn btn-sm btn-info">
                          </div>
                      </div>
                    </div>  
				        </div>				        
				      </div>
                  </form>
                </div>
             </div><!-- Modal--> 
             <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog" style="margin-top: 7%;">
            <form method="post" action="Function/AddFolderIncodes.php" id="my_form"> 
              <!-- Modal content-->
              <div class="modal-content" style="margin-left: 17%;">
                <div class="modal-header" style="padding-bottom: 0px;">
                  <button type="button" class="btn btn-sm" data-dismiss="modal" style="margin-left: 418px;"><i class="fas fa-times"></i></button>
                </div>

                <div class="modal-body" style="padding-bottom: 0px;">
                  <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="produit">Ajouter un nouveau code</label>
                    <input type="text" id="produit" name="produit" class="form-control" placeholder="code" required>
                      </div>
                      <div class="text-right"> 
                          <div class="form-group">
                            <a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;" class="btn btn-sm btn-success">Ajouter</a>
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
        
       <div class="card-body" style="padding-bottom: 0.5rem;">
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
      $path =".\\CodeGed\\".$_SESSION["SocieteName"]."\\".$_SESSION["Year"]."\\".$produit."\\";
      if (file_exists($path)) {
      $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
      $files = array(); 
      foreach ($rii as $file) {
        if ($file->isDir()){ 
            continue;
        }
        $files[] = $file->getPathname();
      }     

    echo '<div class="row">';
    for ($i=0; $i<count($files); $i++) 
    { 
        if(strtolower(pathinfo($files[$i],PATHINFO_EXTENSION))=="pdf")
        { 
            $FullPath= $files[$i];
            $FilePath=dirname($FullPath);
            $FileName= basename($files[$i], ".pdf");
            $FNwithExt= basename($files[$i]);         
        
            if ($files[$i] == "." || $files[$i] == "..") {
              continue;
            }

          $folder=$path.'\\'.$files[$i];
          $QuHide = "SELECT * FROM Hide WHERE IdUSER=".$_SESSION['IdUser']." AND folder='".$folder."'";
          $RsHide = sqlsrv_query($con, $QuHide);
          if(sqlsrv_has_rows($RsHide) != 0)
          {
            continue;
          }
           $string=$FNwithExt;
              ?>
             <a href="File.php?file=<?= $string?>&produit=<?=$_GET['produit']?>">
                <div class="col-auto mb-3" >
                  <div id="demo1Box<?= $i?>" style="padding: 3px 11px;border-radius: 6px;border: 1px solid #dadce0;width: 210px;transition: box-shadow 200ms cubic-bezier(0.4,0.0,0.2,1);padding-top: 8px;padding-bottom: 7px;padding-right: 8px;padding-left: 8px;"  draggable="true" ondragstart="drag(event)">
                    <div class="row">
                      <div class="col-4">
                        <i class="fas fa-file-pdf fa-3x" style="color: rgba(0, 0, 0, .5)"></i> 
                      </div>          
                      <div class="col-8" style=" display: flex;align-items: center;flex-wrap: wrap;">                               
                        <p class="" title="<?= $string?>"  style="color: rgba(0,0,0,.72);">
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
                //drag
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
                //contextmenu         
                var menu = new BootstrapMenu('#demo1Box<?= $i?>', {
                actions: [{
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Ouvrir</a>',
                onClick: function() {
                window.location.href = "File.php?file=<?= $FNwithExt?>&produit=<?=$_GET['produit']?>";
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-folder-minus"></i>&nbsp;&nbsp;&nbsp;Supprimer</a>',
                onClick: function() {
                $('#myModalSupp<?= $i?>').modal('show');
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-exchange-alt"></i>&nbsp;&nbsp;&nbsp;Changer</a>',
                onClick: function() {
                  $('#myModalUpdate<?= $i?>').modal('show');
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-file-download"></i>&nbsp;&nbsp;&nbsp;Telecharger</a>',
                onClick: function() {
                  window.open("CodeGed/<?=$_SESSION['SocieteName']?>/<?=$_SESSION['Year']?>/<?=$_GET['produit']?>/<?=$FNwithExt?>","_blank");
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-link"></i>&nbsp;&nbsp;&nbsp;obtenir le lien</a>',
                onClick: function() {
                copyStringToClipboard("<?= "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST']?>/<?=$db['Folder_Container']?>/File.php?file=<?= $FNwithExt?>&produit=<?=$_GET['produit']?>");
                }
                }, {
                name: '<a style="color:rgba(0, 0, 0, .5);" href="#"><i class="fas fa-eye-slash"></i>&nbsp;&nbsp;&nbsp;Masquer le fichier</a>',
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
                      <h5 class="modal-title">Cacher le fichier "<?=$FNwithExt ?>"</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> 
                      <input type="text" name="CurrentPage" value="<?=$CurrentPage ?>" style="display: none;">
                      <input type="text" name="folder" value="<?=$folder ?>" style="display: none;">
                    </div>              
                    <div class="modal-body" style="padding-bottom: 0px;">
                      <div class="col-lg-12">
                        <p>choisissez les utilisateurs auxquels vous voulez masquer le fichier</p>
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

            <div class="modal fade" id="myModalSupp<?= $i?>" role="dialog">
              <div class="modal-dialog" style="margin-top: 17%;">
                <form method="post" action="Function/F_FileDelete&Update.php?DY=2&&AnneeCODE=<?= $_SESSION["Year"]?>&&ProduitCODE=<?=$_GET["produit"]?>&&FileNameCODE=<?= $FNwithExt?>&&SocieteName=<?=$_SESSION["SocieteName"]?>" id="my_form">              
                  <div class="modal-content" style="margin-left: 17%;">               
                    <div class="modal-body" style="padding-bottom: 0px;">
                      <div class="col-lg-12">
                        <h3> Es-tu sûr de supprimer? </h3>
                      </div>
                      <div class="col-lg-12">                    
                        <div class="text-right"> 
                          <div class="form-group">
                            <button type="button" class="btn btn-sm" data-dismiss="modal">Annuler</button>
                            <input type="submit" value="Supp" class="btn btn-sm btn-warning">                  
                          </div>
                        </div>
                      </div>  
                    </div>                
                  </div>
                </form>
              </div>
            </div> 

            <div class="modal fade" id="myModalUpdate<?= $i?>" role="dialog">
             <div class="modal-dialog" style="margin-top: 17%;">                    
              <form action="Function/F_FileDelete&Update.php?DY=1&&AnneeCODE=<?=$_SESSION["Year"]?>&&ProduitCODE=<?=$_GET["produit"]?>&&FileNameCODE=<?=$string?>&&SocieteName=<?=$_SESSION["SocieteName"]?>" method="post" enctype="multipart/form-data">           
              <!-- Modal content-->
                <div class="modal-content" style="margin-left: 17%;">
                  <div class="modal-header" style="padding-bottom: 0px;">
                    <button type="button" class="btn btn-sm" data-dismiss="modal" style="margin-left: 418px;"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="modal-body" style="padding-bottom: 0px;">
                    <div class="col-lg-12">                    
                      <div class="form-group">                                
                          <label class="form-control-label" for="fichier">Select file to upload</label><br>                              
                       <input type="file" name="fileToUpload" id="fileToUpload" >
                      </div>
                      <div class="text-right"> 
                          <div class="form-group">
                           <i id="icn2" class="fas fa-spinner fa-spin" style="margin-right: 17px;visibility: hidden;"></i>
                            <input  onclick="display()" type="submit" value="Mettre à Jour" name="submit" class="btn btn-sm btn-info">
                          </div>
                      </div>
                    </div>  
                  </div>                
                </div>
              </form>
            </div>
          </div>

         <?php }
              }       
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

<?php 
  if($_SESSION["Erreur"] != ''){
    echo' 
 <div class="toast shadow-lg" id="toast" style="border: 20px;background-color: white;padding: 15px;position: fixed;z-index: 100000;bottom: 5%;right: 3%;">
    <div class="toast-header">
      <strong class="mr-auto text-primary">Nouvelle notification</strong>
      <small class="text-muted">maintenant</small>
      <button id="closeme" type="button" class="ml-2 mb-1 close">&times;</button>
    </div>
    <div class="toast-body">
     '.$_SESSION["Erreur"].'
    </div>
  </div>
';                  
    unset($_SESSION["Erreur"]); 
   }   
?>  



<script LANGUAGE="JavaScript">   

     function display()
    {
      document.getElementById('icn').style.visibility = "visible";
      document.getElementById('icn2').style.visibility = "visible";

    }

    var closeme=document.getElementById("closeme");
    var toast=document.getElementById("toast")
    closeme.onclick =function(){
      toast.style.display="none";
    }
  </script>
<?php require "MasterPage/footer.php"; ?>  
