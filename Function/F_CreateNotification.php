
<?php
    session_name('SESSION');
    session_start ();

    $db = parse_ini_file("../assets/ini/Config.ini");
    $connectionInfo = array("Database" => $db['name'], "Uid" => $db['user'], "PWD" => $db['pass']);
    $con = sqlsrv_connect($db['host'], $connectionInfo); 

    
$message=$_POST['message'];
$CompteUSER=$_POST['CompteUSER2'];        
              
$query= "insert into Notifications ([from],CompteUSER,[Message],Url,Date) values('".$_SESSION['IdUser']."','".$CompteUSER."','".$message."','#',getdate())";
$result = sqlsrv_query($con, $query);        
    
 if( $result === false )
{
        die( '<pre class="error">' . print_r( sqlsrv_errors(), true ) . '</pre>' );
}

        

    header("Location:../notifications.php");
    exit();    
 



