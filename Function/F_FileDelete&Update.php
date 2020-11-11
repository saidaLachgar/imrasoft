<?php
    session_name('SESSION');
    session_start ();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('MAX_EXECUTION_TIME', '-1');

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
 // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville 
    $DY=$_GET['DY'];
    $AnneeCODE=$_GET['AnneeCODE'];
    $ProduitCODE=$_GET['ProduitCODE'];
    $FileNameCODE=$_GET['FileNameCODE'];
    $SocieteName=$_GET['SocieteName'];  
// ------------------------------------------------------------------
if($DY == 1)
{//Update file

$myFile001 = "../CodeGed/".$SocieteName."/".$AnneeCODE."/".$ProduitCODE."/".$FileNameCODE;
unlink($myFile001) or die("Couldn't delete file");

$FullPath=  $myFile001;
$FilePath=dirname($FullPath);
$FileName= basename($FullPath, ".pdf");
$tif = $FilePath."/".$FileName.".tif";
$text = $FilePath."/".$FileName.".txt";

if (file_exists($tif)) {
unlink($tif) or die("Couldn't delete file");    
}
if (file_exists($text)) {
unlink($text) or die("Couldn't delete file");    
}


$target_dir ='../CodeGed/'.$SocieteName.'/'.$AnneeCODE.'/'.$ProduitCODE.'/'; //dir where the file is going to be placed
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //path of the file to be uploaded
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //holds the file extension of the file

// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION["Erreur"]= ' file already exists.';    
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "pdf") {
    $_SESSION["Erreur"]= ' only PDF files are allowed.';
    $uploadOk = 0;
}
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION["Erreur"]= ' your file was not uploaded.'.$_SESSION["Erreur"];
    }
     else 
     {// if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {            
               $IDcmd = "SELECT IdSOCIETE FROM Societe WHERE LibelleSociete='".$SocieteName."'";
                $IDresult = sqlsrv_query($con, $IDcmd);    
              
               while( $obj = sqlsrv_fetch_object($IDresult))
                {                                      
                    $query= "update code set FileNameCODE='".basename( $_FILES["fileToUpload"]["name"])."' where AnneeCODE='".$AnneeCODE."' and ProduitCODE='".$ProduitCODE."' and FileNameCODE='".$FileNameCODE."'"; 
                    $result = sqlsrv_query($con, $query);                     


$FullPath=  $target_dir .basename($_FILES["fileToUpload"]["name"]);
$FilePath=dirname($FullPath);
$FileName= basename($FullPath, ".pdf");
$tif = $FilePath."/".$FileName.".tif";
$text = $FilePath."/".$FileName;

$pdf2tif = "C:\gs\bin\gswin64c.exe -dNOPAUSE -r300 -sDEVICE=tiffscaled24 -sCompression=lzw -dBATCH -sOutputFile=\"$tif\" \"$FullPath\" 2>&1";
shell_exec($pdf2tif);  
$tif2txt = "\"C:\OCR\\tesseract\" \"$tif\" \"$text\" -l fra  2>&1";
shell_exec($tif2txt);
                    
                }                
$_SESSION["Erreur"]= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been changed.".$_SESSION["Erreur"];  


$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." modifier le document  ". basename( $_FILES["fileToUpload"]["name"])."','code.php?text=".basename( $_FILES["fileToUpload"]["name"])."',3, getdate())"; 
 sqlsrv_query($con, $Historyquery);

        } 
        else 
        {
            $_SESSION["Erreur"]= 'Sorry, there was an error uploading your file.';
        }
    }  
}
else
{//delete file & code
$qquery = sqlsrv_query($con,"DELETE FROM code where AnneeCODE='".$AnneeCODE."' and ProduitCODE='".$ProduitCODE."' and FileNameCODE='".$FileNameCODE."'");

$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." suprimer le document  ".$FileNameCODE."','#',1, getdate())"; 
$Historyresult = sqlsrv_query($con, $Historyquery);


$myFile00 = "../CodeGed/".$SocieteName."/".$AnneeCODE."/".$ProduitCODE."/".$FileNameCODE;
unlink($myFile00) or die("Couldn't delete file");

$FullPath=  $myFile00;
$FilePath=dirname($FullPath);
$FileName= basename($FullPath, ".pdf");
$tif = $FilePath."/".$FileName.".tif";
$text = $FilePath."/".$FileName.".txt";
if (file_exists($tif)) {
unlink($tif) or die("Couldn't delete file");    
}
if (file_exists($text)) {
unlink($text) or die("Couldn't delete file");    
}
}

header("Location:../ConsultationFile.php?produit=".$ProduitCODE."");    
    exit();

