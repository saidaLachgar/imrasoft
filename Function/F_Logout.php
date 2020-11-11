<?php
    session_name('SESSION');
    session_start(); 

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo);

    
    $sql_Update = "UPDATE USERS SET ConnectedUSER=0 WHERE LoginUSER='".$_SESSION['UserLogin']."'";
    $stmt = sqlsrv_query( $con, $sql_Update);
    
    if($stmt === false)
    {            
        echo $sql_Update;
        echo '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>';
        exit;
    }
    else
    {     
        $_SESSION = array();
        session_unset();         
        session_destroy();
        header('Location: ../login.php');
        exit;   
    }        
