 
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
 
    // -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville
$IdSociete=$_POST['IdSociete'];
$LibelleSociete=$_POST['LibelleSociete'];
$RaisonSocialeSociete=$_POST['RaisonSocialeSociete'];
$IFSociete=$_POST['IFSociete'];
$ICESociete=$_POST['ICESociete'];
$ITVASociete=$_POST['ITVASociete'];
$Ville=$_POST['Ville'];

    $query= "insert into Societe values('$LibelleSociete','$RaisonSocialeSociete','$IFSociete','$ICESociete','$ITVASociete','$Ville')";
	$result = sqlsrv_query($con, $query);        
    
 if( $result === false )
{
        $_SESSION["ErreurLogin"]= '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>';
         header('Location: ../Addcompany.php');
        exit; 
}

    $Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." mis à jour la société ".$LibelleSociete."','Company.php?text=".$LibelleSociete."',3, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
    }

 $folder = $LibelleSociete;

 echo  $Path='../CodeGed/'.$folder;

if(!file_exists($Path))
{
    mkdir($Path, 0777, true);
}

 header("Location:../Company.php");
 



