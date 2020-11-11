
<?php require "MasterPage/header.php"; ?>
 
<?php
session_name('SESSION');
session_start();
sqlsrv_configure("WarningsReturnAsErrors", 1);  
ini_set('display_errors',1); 
error_reporting(E_ALL);

$produit = $_GET['produit']; 
$file = $_GET['file'];


$Nom =$_SESSION["SocieteName"];
$mystring =$Nom;
$find   = "'";
$pos = strpos($mystring, $find);
if ($pos != false) {
    $Nom =str_replace("'","''",$mystring);
} 
$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." vu le fichier ".$_GET['file']."','CodeGed/".$_SESSION['SocieteName']."/".$_SESSION['Year']."/".$_GET['produit']."/".$_GET['file']."',5, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
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
                      <a href="ConsultationFile.php?produit=<?= $produit; ?>"><i class="fas fa-arrow-left"></i></a>
                        &nbsp;&nbsp;&nbsp;
                      <i class="far fa-copy" style="margin-top: 4px;"></i>
                        &nbsp;&nbsp;&nbsp;                
                     <li class="breadcrumb-item"><a href="ConsultationAnnée.php?id=<?= $_SESSION["id"]?>& NOM=<?= $_SESSION["SocieteName"]?>"><?= $_SESSION["SocieteName"]?></a></li>
                     <li class="breadcrumb-item"><a href="ConsultationProduit.php?Year=<?= $_SESSION["Year"]?>"><?= $_SESSION["Year"]?></a></li>
                     <li class="breadcrumb-item" ><a href="ConsultationFile.php?produit=<?= $produit; ?>"><?= $produit; ?></a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?= $_GET['file']; ?></li>
                  </ol>             		
            	</h3>
            </div>             
            </div><!--row-->     
           </div><!--header-->
        
       <div class="card-body" style="padding-bottom: 0.5rem;">
          <div class="row">
                
                <div class="col-lg-12">
                  <div>
                   <?php 

                  	$file='CodeGed/'.$_SESSION['SocieteName'].'/'.$_SESSION['Year'].'/'.$_GET['produit'].'/'.$_GET['file'].'';                 
                      echo'
                      <object data="'.$file.'" type="application/pdf" height="900" width="100%">
                        <embed src="'.$file.'" type="application/pdf" />
                      </object>';
                       ?>
                  </div>                      
                </div>
            </div>                        
        </div>                
    </div>
</div>

<?php require "MasterPage/footer.php"; ?>