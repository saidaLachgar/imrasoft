<?php 
session_name('SESSION');
session_start ();
sqlsrv_configure("WarningsReturnAsErrors", 1);  
ini_set('display_errors',1); 
error_reporting(E_ALL);

$folder = $_POST["Année"];

$Path='../CodeGed/'.$_SESSION["SocieteName"].'/'.$folder;

if (!file_exists($Path))
{
    mkdir($Path, 0777, true);
}


$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." ajouter l'Année ".$folder." au Société ".$_SESSION["SocieteName"]."','consultationAnnée.php?NOM=".$_SESSION["SocieteName"]."',2, getdate())"; 
$Historyresult = sqlsrv_query($con, $Historyquery);

   header("Location:../consultationAnnée.php?NOM=".$_SESSION["SocieteName"]."");
    exit();    