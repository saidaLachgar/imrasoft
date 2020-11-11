<?php 

session_name('SESSION');
session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

$Série = $_POST["série"];
$_SESSION["Erreur"]= '';

$Nom22 =$_SESSION["SocieteName"];
$mystring =$Nom22;
$find   = "'";
$pos = strpos($mystring, $find);
if ($pos != false) {
    $Nom22 =str_replace("'","''",$mystring);
} 

 $target_dir ='../CodeGed/'.$_SESSION["SocieteName"].'/'.$_SESSION["Year"] .'/'.$_SESSION["produit"] .'/'; //dir where the file is going to be placed
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
               $IDcmd = "SELECT IdSOCIETE FROM Societe WHERE LibelleSociete='".$Nom22."'";
                $IDresult = sqlsrv_query($con, $IDcmd);    
                if( $IDresult === false )
              {
                   $_SESSION["Erreur"]= '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '<br/>'.$IDcmd.'</pre>' ;                   
               }
               while( $obj = sqlsrv_fetch_object($IDresult))
                {
                   $IdSOCIETE = $obj->IdSOCIETE;
                   if($obj->IdSOCIETE==$IdSOCIETE){
                       $query= "insert into code(IdSOCIETE,AnneeCODE,ProduitCODE,FileNameCODE,NuSerie,IdUSER) VALUES (".$IdSOCIETE.",'".$_SESSION['Year']."','".$_SESSION["produit"]."','". basename( $_FILES["fileToUpload"]["name"])."','".$Série."',".$_SESSION['IdUser'].")"; 
                        $result = sqlsrv_query($con, $query);                          
                    }
                }  

$FullPath=  $target_dir .basename($_FILES["fileToUpload"]["name"]);
$FilePath=dirname($FullPath);
$FileName= basename($FullPath, ".pdf");
$tif = $FilePath."/".$FileName.".tif";
$text = $FilePath."/".$FileName;

$pdf2tif = "C:\gs\bin\gswin64c.exe -dNOPAUSE -r300 -sDEVICE=tiffscaled24 -sCompression=lzw -dBATCH -sOutputFile=\"$tif\" \"$FullPath\" 2>&1";
shell_exec($pdf2tif);  
$tif2txt = "\"C:\OCR\\tesseract\" \"$tif\" \"$text\" -l fra  2>&1";
shell_exec($tif2txt);


$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." ajouter le document  ". basename( $_FILES["fileToUpload"]["name"])."','code.php?text=".basename( $_FILES["fileToUpload"]["name"])."',2, getdate())"; 
$Historyresult = sqlsrv_query($con, $Historyquery);             
$_SESSION["Erreur"]= "The file ".basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.".$_SESSION["Erreur"];         
        } 
        else 
        {
            $_SESSION["Erreur"]= 'Sorry, there was an error uploading your file.';
        }
    }
 header("Location:../ConsultationFile.php?produit=".$_SESSION["produit"]."");    
    exit();
 ?>