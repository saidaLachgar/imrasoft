<?php
    session_name('SESSION');
    session_start();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 
    
// --NomUSER  PrenomUSER  EmailUSER  TelephoneUSER  LoginUSER  PassUSER  CompteUSER ActiveUSER ConnectedUSER
$IdUSER=$_GET['id'];
$NomUSER=$_POST['NomUSER2'];
$PrenomUSER=$_POST['PrenomUSER2'];
$EmailUSER=$_POST['EmailUSER2'];
$TelephoneUSER=$_POST['TelephoneUSER2'];
$LoginUSER=$_POST['LoginUSER2'];
$PassUSER=$_POST['password'];


 $sql_Update = "UPDATE USERS SET NomUSER='".$NomUSER."', PrenomUSER='".$PrenomUSER."', EmailUSER='".$EmailUSER."', TelephoneUSER='".$TelephoneUSER."', LoginUSER='".$LoginUSER."' WHERE IdUSER=".$IdUSER."";
$stmt = sqlsrv_query( $con, $sql_Update);  
 

 if( $stmt === false )
{
        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

$Historyquery= "insert into History values(".$_SESSION['IdUser'].",'".$_SESSION['NomComplet']." modifier le collaborateur ".$NomUSER." ".$PrenomUSER."','Users.php?text=".$NomUSER."',3, getdate())"; 
    $Historyresult = sqlsrv_query($con, $Historyquery);
     if($Historyresult === false )
    {
        $_SESSION["Erreur"]= '<pre class="error">'.print_r( sqlsrv_errors(), true ) . '<br/>'.$Historyquery.'</pre>';
    }

header('Location: ../UpdateUsers.php?id='.$IdUSER.'');
exit;
