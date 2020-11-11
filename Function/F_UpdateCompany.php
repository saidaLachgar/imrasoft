<?php
    session_name('SESSION');
    session_start();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
    
// -- Societe : IdSociete LibelleSociete RaisonSocialeSociete IFSociete ICESociete ITVASociete Ville
$IdSociete=$_GET['id'];
$LibelleSociete=$_POST['LibelleSociete'];
$RaisonSocialeSociete=$_POST['RaisonSocialeSociete'];
$IFSociete=$_POST['IFSociete'];
$ICESociete=$_POST['ICESociete'];
$ITVASociete=$_POST['ITVASociete'];
$Ville=$_POST['Ville'];

		// $query = "SELECT * FROM Societe WHERE IdSociete='".$IdSociete."'";
  //       $result = sqlsrv_query($con, $query);
  //       if( $result === false )
  //       {
  //          die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
  //       }           
  //       while( $obj = sqlsrv_fetch_object($result))
  //       {          
  //         $LibelleSociete = $obj->LibelleSociete;       
  //         $Ville = $obj->Ville; 
  //       } 

$sql_Update = "UPDATE Societe SET RaisonSocialeSociete='".$RaisonSocialeSociete."', IFSociete='".$IFSociete."', ICESociete='".$ICESociete."', ITVASociete='".$ITVASociete."', Ville='".$Ville."' WHERE IdSociete=".$IdSociete."";
$stmt = sqlsrv_query( $con, $sql_Update);  
 
 if( $stmt === false )
{
        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}
$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." modifier la société ".$LibelleSociete."','Company.php?text=".$LibelleSociete."',3, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
    }

header('Location: ../UpdateCompany.php?id='.$IdSociete.'');
exit;