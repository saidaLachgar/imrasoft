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


if($_POST['password'] != ''){	
	$PassUSER=$_POST['password'];

	$sql_Update = "UPDATE USERS SET NomUSER='".$NomUSER."', PrenomUSER='".$PrenomUSER."', EmailUSER='".$EmailUSER."', TelephoneUSER='".$TelephoneUSER."', PassUSER='".$PassUSER."' WHERE IdUSER=".$IdUSER."";
	$stmt = sqlsrv_query( $con, $sql_Update);  
	 	$_SESSION['Pass'] = $PassUSER;
	    $_SESSION['NomComplet']= $NomUSER.' '.$PrenomUSER;

	 if( $stmt === false )
	{
	        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
	}
}else{

	$sql_Update = "UPDATE USERS SET NomUSER='".$NomUSER."', PrenomUSER='".$PrenomUSER."', EmailUSER='".$EmailUSER."', TelephoneUSER='".$TelephoneUSER."' WHERE IdUSER=".$IdUSER."";
	$stmt = sqlsrv_query( $con, $sql_Update);  
	 
	    $_SESSION['NomComplet']= $NomUSER.' '.$PrenomUSER;

	 if( $stmt === false )
	{
	        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
	}
}
header('Location: ../profile.php?id='.$IdUSER.'');
exit;
