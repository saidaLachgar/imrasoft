<?php 
session_name('SESSION');
    session_start ();

$folder = $_POST["produit"];

$Path='../CodeGed/'.$_SESSION["SocieteName"].'/'.$_SESSION["Year"] .'/'.$folder;
echo $Path;
if (!file_exists($Path))
{
    mkdir($Path, 0777, true);
}

$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." ajouter produit ".$folder." au Société ".$_SESSION["SocieteName"]."','ConsultationProduit.php?Year=".$_SESSION["Year"]."',2, getdate())"; 
$Historyresult = sqlsrv_query($con, $Historyquery);


   header("Location:../ConsultationProduit.php?Year=".$_SESSION["Year"]."");
    exit();    