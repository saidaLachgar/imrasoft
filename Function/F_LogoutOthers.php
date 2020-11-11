<?php
    session_name('SESSION');
    session_start();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    
    
        
    $IdUSER =$_GET['IdUSER'];    

    $query= "update ISuserABLE set capable= 0 where IdUSER='".$IdUSER."'";
    $query2= "UPDATE USERS SET ConnectedUSER=0 WHERE IdUSER='".$IdUSER."'";
    $result = sqlsrv_query($con, $query);     
    $result2 = sqlsrv_query($con, $query2);        
    $_SESSION["ErreurLogin"]= 'la déconnexion de l\'autre appareil est terminée! vous pouvez vous connecter maintenant';
    header("Location:../login.php");
exit;  