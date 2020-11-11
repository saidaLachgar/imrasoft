<?php
    session_name('SESSION');
    session_start();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
    
// --NomUSER  PrenomUSER  EmailUSER  TelephoneUSER  LoginUSER  PassUSER  CompteUSER ActiveUSER ConnectedUSER
$IdUSER=$_GET['id'];
$LoginUSER=$_POST['LoginUSER2'];
$CompteUSER=$_POST['CompteUSER'];

 $sql_Update = "UPDATE USERS SET LoginUSER='".$LoginUSER."', ActiveUSER=1 ,Request=0 WHERE IdUSER=".$IdUSER."";
$stmt = sqlsrv_query( $con, $sql_Update);  

 if( $stmt === false )
{
        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." Accepter le collaborateur ".$LoginUSER."','Users.php?text=".$LoginUSER."',6, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
    }

header('Location: ../Requests.php');
exit;
